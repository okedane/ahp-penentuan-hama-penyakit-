<?php

namespace App\Http\Controllers\ahli\hama;

use App\Http\Controllers\Controller;
use App\Models\AlternatifHama;
use App\Models\KriteriaHama;
use App\Models\PenilaianAlternatifHama;
use App\Models\SubKriteriaHama;
use Illuminate\Http\Request;

class alternatifHamaController extends Controller
{
    public function index()
    {
        $alternatif = AlternatifHama::orderBy('created_at', 'asc')->get();
        return view('ahli.hama.alternatif.alternatif', compact('alternatif'));
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'kode'              => 'required',
                'nama'              => 'required',
            ]);

            AlternatifHama::create($validated);
            return redirect()->back()->with('success', 'Jabatan berhasil di tambahkan');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menambahkan Jabatan. Silakan coba lagi.');
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $validated = $request->validate([
                'kode'              => 'required',
                'nama'              => 'required',
            ]);

            $alternatif = AlternatifHama::findOrFail($id);
            $alternatif->update($validated);

            return redirect()->back()->with('success', 'Jabatan berhasil diperbarui');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memperbarui Jabatan. Silakan coba lagi.' . $th->getMessage());
        }
    }

    public function delete($id)
    {
        $alternatif = AlternatifHama::findOrFail($id);
        $alternatif->delete();

        return back()->with('success', 'data telah dihapus');
    }


    public function tampilPenilaianAlternatif()
    {
        $alternatifs = AlternatifHama::all();
        $kriterias = KriteriaHama::with('subkriterias')->get();

        // Ambil nilai penilaian jika sudah pernah diisi
        $penilaian = [];

        foreach ($alternatifs as $alt) {
            foreach ($kriterias as $krit) {
                foreach ($krit->subkriterias as $sub) {
                    $nilai = PenilaianAlternatifHama::where('alternatif_id', $alt->id)
                        ->where('sub_kriteria_id', $sub->id)
                        ->value('nilai');
                    $penilaian[$alt->id][$sub->id] = $nilai;
                }
            }
        }

        // Panggil normalisasi
        $normalisasi = $this->getNormalisasiAlternatif();
        $pembobotan = $this->getHasilPembobotan();

        return view('ahli.hama.alternatif.penilaian', compact('alternatifs', 'kriterias', 'penilaian', 'normalisasi', 'pembobotan'));
    }




    public function simpanPenilaian(Request $request)
    {
        $data = $request->input('nilai'); // array[nama_alternatif][sub_kriteria_id] = nilai

        try {
            foreach ($data as $alternatif_id => $subkriterias) {
                foreach ($subkriterias as $subkriteria_id => $nilai) {
                    // Validasi nilai kosong atau tidak valid
                    if ($nilai === null || $nilai === '') {
                        continue;
                    }

                    PenilaianAlternatifHama::updateOrCreate(
                        [
                            'alternatif_id' => $alternatif_id,
                            'sub_kriteria_id' => $subkriteria_id,
                        ],
                        [
                            'nilai' => $nilai,
                        ]
                    );
                }
            }

            return redirect()->back()->with('success', 'Penilaian alternatif berhasil disimpan!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menyimpan penilaian: ' . $e->getMessage());
        }
    }


    private function getNormalisasiAlternatif()
    {
        $alternatifs = AlternatifHama::all();
        $kriterias = KriteriaHama::with('subkriterias')->get();

        // Ambil nilai mentah dulu
        $nilaiAwal = [];
        $pembagi = [];

        foreach ($alternatifs as $alt) {
            foreach ($kriterias as $kriteria) {
                foreach ($kriteria->subkriterias as $sub) {
                    $nilai = PenilaianAlternatifHama::where('alternatif_id', $alt->id)
                        ->where('sub_kriteria_id', $sub->id)
                        ->value('nilai') ?? 0;

                    $nilaiAwal[$alt->id][$sub->id] = $nilai;

                    // Simpan untuk pembagi (akar kuadrat dari jumlah kuadrat)
                    $pembagi[$sub->id] = ($pembagi[$sub->id] ?? 0) + pow($nilai, 2);
                }
            }
        }

        // Hitung akar kuadrat pembagi
        foreach ($pembagi as $sub_id => $total) {
            $pembagi[$sub_id] = sqrt($total);
        }

        // Normalisasi
        $normalisasi = [];
        foreach ($nilaiAwal as $alt_id => $subs) {
            foreach ($subs as $sub_id => $nilai) {
                $normalisasi[$alt_id][$sub_id] = $pembagi[$sub_id] != 0
                    ? round($nilai / $pembagi[$sub_id], 4)
                    : 0;
            }
        }

        return $normalisasi;
    }

    private function getBobotSubkriteria()
    {
        $subkriterias = SubKriteriaHama::all();
        $bobot = [];

        foreach ($subkriterias as $sub) {
            $bobot[$sub->id] = $sub->bobot ?? 0; // pastikan ada kolom `bobot` di tabel subkriteria
        }

        return $bobot;
    }

    private function getHasilPembobotan()
    {
        $normalisasi = $this->getNormalisasiAlternatif();
        $bobotSub = $this->getBobotSubkriteria();

        $pembobotan = [];

        foreach ($normalisasi as $alt_id => $subs) {
            foreach ($subs as $sub_id => $nilai) {
                $pembobotan[$alt_id][$sub_id] = round($nilai * ($bobotSub[$sub_id] ?? 0), 4);
            }
        }

        return $pembobotan;
    }
}
