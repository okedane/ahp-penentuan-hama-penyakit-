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
        return view('ahli.hama.kriteria', compact('kriteria'));
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
                            $editable[$row->id][$col->id] = true; // bisa diisi pertama kali
                        }
                    }
                }
            }
        }

        return view('ahli.hama.matrix_kriteria', compact('kriterias', 'matriks', 'editable'));
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
}
