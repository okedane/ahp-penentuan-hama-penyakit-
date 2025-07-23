<?php

namespace App\Http\Controllers\ahli\hama;

use App\Http\Controllers\Controller;
use App\Models\KriteriaHama;
use App\Models\PerbandinganKriteriaHama;
use Illuminate\Http\Request;

class KriteriaHamaController extends Controller
{
    public function index()
    {
        $kriteria = KriteriaHama::orderBy('created_at', 'asc')->get();
        return view('ahli.hama.kriteria.kriteria', compact('kriteria'));
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'kode'              => 'required',
                'nama'              => 'required',
            ]);

            KriteriaHama::create($validated);
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

            $kriteria = KriteriaHama::findOrFail($id);
            $kriteria->update($validated);

            return redirect()->back()->with('success', 'Jabatan berhasil diperbarui');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memperbarui Jabatan. Silakan coba lagi.' . $th->getMessage());
        }
    }

    public function delete($id)
    {
        $kriteria = KriteriaHama::findOrFail($id);
        $kriteria->delete();

        return back()->with('success', 'data telah dihapus');
    }


    public function matriks()
    {
        $kriterias = KriteriaHama::all();

        // Matriks utama
        $matriks = [];
        $editable = [];

        foreach ($kriterias as $row) {
            foreach ($kriterias as $col) {
                if ($row->id === $col->id) {
                    $matriks[$row->id][$col->id] = 1;
                    $editable[$row->id][$col->id] = false;
                } else {
                    $nilai = PerbandinganKriteriaHama::where('kriteria_id_1', $row->id)
                        ->where('kriteria_id_2', $col->id)->value('nilai');

                    if ($nilai) {
                        $matriks[$row->id][$col->id] = $nilai;
                        $editable[$row->id][$col->id] = true;
                    } else {
                        $nilai_kebalikan = PerbandinganKriteriaHama::where('kriteria_id_1', $col->id)
                            ->where('kriteria_id_2', $row->id)->value('nilai');
                        if ($nilai_kebalikan) {
                            $nilai = round(1 / $nilai_kebalikan, 4);
                            $matriks[$row->id][$col->id] = $nilai;
                            $editable[$row->id][$col->id] = false;
                        } else {
                            $matriks[$row->id][$col->id] = null;
                            $editable[$row->id][$col->id] = true;
                        }
                    }
                }
            }
        }

        // Panggil fungsi hitung bobot
        $hasil = $this->hitungBobotInternal($kriterias, $matriks); // Gunakan fungsi bantu internal
        $konsistensi = $this->hitungKonsistensi();

        return view('ahli.hama.kriteria.matrix_kriteria', [
            'kriterias' => $kriterias,
            'matriks' => $matriks,
            'editable' => $editable,
            'hasil' => $hasil,
            'konsistensi' => $konsistensi
        ]);
    }



    public function storeMatriks(Request $request)
    {
        $matriks = $request->input('matriks', []);

        $kriterias = KriteriaHama::all();

        foreach ($kriterias as $row) {
            foreach ($kriterias as $col) {
                $id1 = $row->id;
                $id2 = $col->id;

                if ($id1 == $id2) {
                    // Simpan nilai diagonal = 1
                    PerbandinganKriteriaHama::updateOrCreate([
                        'kriteria_id_1' => $id1,
                        'kriteria_id_2' => $id2,
                    ], [
                        'nilai' => 1
                    ]);
                } elseif (isset($matriks[$id1][$id2])) {
                    // Simpan nilai input user A vs B
                    $nilai = $matriks[$id1][$id2];

                    PerbandinganKriteriaHama::updateOrCreate([
                        'kriteria_id_1' => $id1,
                        'kriteria_id_2' => $id2,
                    ], [
                        'nilai' => $nilai
                    ]);

                    // Simpan juga nilai kebalikannya B vs A
                    PerbandinganKriteriaHama::updateOrCreate([
                        'kriteria_id_1' => $id2,
                        'kriteria_id_2' => $id1,
                    ], [
                        'nilai' => round(1 / $nilai, 4)
                    ]);
                }
            }
        }

        return redirect()->route('kriteria.matriks')->with('success', 'Seluruh matriks berhasil disimpan ke database!');
    }



    private function hitungBobotInternal($kriterias, $matriks)
    {
        $jumlahKolom = [];
        foreach ($kriterias as $col) {
            $total = 0;
            foreach ($kriterias as $row) {
                $total += $matriks[$row->id][$col->id] ?? 0;
            }
            $jumlahKolom[$col->id] = $total;
        }

        $matriksNormalisasi = [];
        $rataRata = [];

        foreach ($kriterias as $row) {
            $totalBaris = 0;
            foreach ($kriterias as $col) {
                $nilai = $matriks[$row->id][$col->id] ?? 0;
                $normal = $jumlahKolom[$col->id] != 0 ? round($nilai / $jumlahKolom[$col->id], 4) : 0;

                $matriksNormalisasi[$row->id][$col->id] = $normal;
                $totalBaris += $normal;
            }

            $rataRata[$row->id] = round($totalBaris / count($kriterias), 4);
        }

        return [
            'normalisasi' => $matriksNormalisasi,
            'rataRata' => $rataRata,
        ];
    }




    public function hitungKonsistensi()
    {
        $kriterias = KriteriaHama::all();
        $n = $kriterias->count();

        // Hitung jumlah kolom untuk normalisasi
        $jumlahKolom = [];

        foreach ($kriterias as $col) {
            $jumlah = 0;
            foreach ($kriterias as $row) {
                $jumlah += PerbandinganKriteriaHama::getNilai($row->id, $col->id); // ✅ gunakan model langsung
            }
            $jumlahKolom[$col->id] = $jumlah;
        }

        // Hitung bobot dari matriks normalisasi
        $normalisasi = [];
        $bobot = [];

        foreach ($kriterias as $row) {
            $total = 0;
            foreach ($kriterias as $col) {
                $nilai = PerbandinganKriteriaHama::getNilai($row->id, $col->id); // ✅ gunakan model langsung
                $normal = $jumlahKolom[$col->id] != 0 ? $nilai / $jumlahKolom[$col->id] : 0;

                $normalisasi[$row->id][$col->id] = $normal;
                $total += $normal;
            }

            $bobot[$row->id] = $total / $n;
        }

        // Hitung lambda max
        $lambdaMax = 0;
        foreach ($kriterias as $row) {
            $total = 0;
            foreach ($kriterias as $col) {
                $nilai = PerbandinganKriteriaHama::getNilai($row->id, $col->id);
                $total += $nilai * $bobot[$col->id]; // A * w
            }

            if ($bobot[$row->id] == 0) continue; // cegah pembagian nol

            $lambdaMax += $total / $bobot[$row->id]; // (Aw)/w
        }
        $lambdaMax = $lambdaMax / $n; // rata-rata lambdaMax



        // Hitung Consistency Index (CI)
        $ci = ($lambdaMax - $n) / ($n - 1);

        // Hitung Consistency Ratio (CR)
        $ri = $this->getRI($n);
        $cr = $ri == 0 ? 0 : $ci / $ri;

        return [
            'lambda_max' => round($lambdaMax, 4),
            'ci' => round($ci, 4),
            'cr' => round($cr, 4),
            'bobot' => $bobot,
        ];
    }


    private function getRI($n)
    {
        $riTable = [
            1 => 0.00,
            2 => 0.00,
            3 => 0.58,
            4 => 0.90,
            5 => 1.12,
            6 => 1.24,
            7 => 1.32,
            8 => 1.41,
            9 => 1.45,
            10 => 1.49
        ];

        return $riTable[$n] ?? 1.49;
    }
}
