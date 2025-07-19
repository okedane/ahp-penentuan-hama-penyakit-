<?php

namespace App\Http\Controllers\ahli\hama;

use App\Http\Controllers\Controller;
use App\Models\KriteriaHama;
use App\Models\PerbandinganSubKriteriaHama;
use App\Models\SubKriteriaHama;
use Illuminate\Http\Request;

class SubKriteriaHamaController extends Controller
{

    public function index($id)
    {
        $subKriteria = SubKriteriaHama::where('kriteria_id', $id)->orderBy('created_at', 'asc')->get();
        $kriteria = KriteriaHama::findOrFail($id);
        return view('ahli.hama.sub_kriteria.sub_kriteria', compact('subKriteria', 'kriteria'));
    }

    public function post(Request $request)
    {
        try {
            $validated = $request->validate([
                'kriteria_id'        => 'required',
                'nama'              => 'required',


            ]);
            SubKriteriaHama::create($validated);
            return redirect()->back()->with('success', 'subKriteria berhasil di tambahkan');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menambahkan subKriteria. Silakan coba lagi.');
        }
    }

    public function put(Request $request, $id)
    {
        try {
            $validated = $request->validate([
                'nama'                => 'required',
            ]);

            $subKriteria = SubKriteriaHama::findOrFail($id);
            // dd($subKriteria);
            $subKriteria->update($validated);

            return redirect()->back()->with('success', 'SubKriteria berhasil diperbarui');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memperbarui SubKriteria. Silakan coba lagi.');
        }
    }

    public function delete($id)
    {
        $subKriteria = SubKriteriaHama::findOrFail($id);
        $subKriteria->delete();

        return back()->with('success', 'data telah dihapus');
    }

    // ===========================================================

    // public function matriks($id)
    // {
    //     $subKriteria = SubKriteriaHama::where('kriteria_id', $id)->get();
    //     $matriks = [];

    //     foreach ($subKriteria as $row) {
    //         foreach ($subKriteria as $col) {
    //             if ($row->id == $col->id) {
    //                 $matriks[$row->id][$col->id] = 1;
    //             } else {
    //                 $nilai = PerbandinganSubKriteriaHama::where('sub_kriteria_id_1', $row->id)
    //                     ->where('sub_kriteria_id_2', $col->id)->value('nilai');

    //                 $nilaiKebalikan = PerbandinganSubKriteriaHama::where('sub_kriteria_id_1', $col->id)
    //                     ->where('sub_kriteria_id_2', $row->id)->value('nilai');

    //                 if ($nilai) {
    //                     $matriks[$row->id][$col->id] = $nilai;
    //                 } elseif ($nilaiKebalikan) {
    //                     $matriks[$row->id][$col->id] = 1 / $nilaiKebalikan;
    //                 } else {
    //                     $matriks[$row->id][$col->id] = null;
    //                 }
    //             }
    //         }
    //     }

    //     return view('ahli.hama.sub_kriteria.matrik_sub_kriteria', compact('subKriteria', 'matriks', 'id'));
    // }

    public function matriks($id)
    {
        $subKriteria = SubKriteriaHama::where('kriteria_id', $id)->get();
        $matriks = [];

        foreach ($subKriteria as $row) {
            foreach ($subKriteria as $col) {
                if ($row->id == $col->id) {
                    $matriks[$row->id][$col->id] = 1;
                } else {
                    $nilai = PerbandinganSubKriteriaHama::where('sub_kriteria_id_1', $row->id)
                        ->where('sub_kriteria_id_2', $col->id)->value('nilai');

                    $nilaiKebalikan = PerbandinganSubKriteriaHama::where('sub_kriteria_id_1', $col->id)
                        ->where('sub_kriteria_id_2', $row->id)->value('nilai');

                    if ($nilai) {
                        $matriks[$row->id][$col->id] = $nilai;
                    } elseif ($nilaiKebalikan) {
                        $matriks[$row->id][$col->id] = 1 / $nilaiKebalikan;
                    } else {
                        $matriks[$row->id][$col->id] = null;
                    }
                }
            }
        }

        // ===== Proses Normalisasi dan Konsistensi =====
        $subkriterias = $subKriteria->values(); // indexed ulang
        $hasil = $this->hitungBobotInternal($subkriterias);
        $konsistensi = $this->hitungKonsistensi($hasil['matriks'], $hasil['bobot']);

        // Kirim semua data ke view
        return view('ahli.hama.sub_kriteria.matrik_sub_kriteria', [
            'subKriteria' => $subKriteria,
            'matriks' => $matriks,
            'normalisasi' => $hasil['normalisasi'],
            'jumlah' => $hasil['jumlah'],
            'bobot' => $hasil['bobot'],
            'lambdaMax' => $konsistensi['lambdaMax'],
            'ci' => $konsistensi['ci'],
            'cr' => $konsistensi['cr'],
            'id' => $id
        ]);
    }



    public function postMatriks(Request $request, $id)
    {
        $matriks = $request->input('matriks', []);
        $subKriteria = SubKriteriaHama::where('kriteria_id', $id)->get();

        foreach ($subKriteria as $row) {
            foreach ($subKriteria as $col) {
                $id1 = $row->id;
                $id2 = $col->id;

                if ($id1 == $id2) {
                    PerbandinganSubKriteriaHama::updateOrCreate([
                        'sub_kriteria_id_1' => $id1,
                        'sub_kriteria_id_2' => $id2,
                    ], ['nilai' => 1]);
                } elseif (isset($matriks[$id1][$id2])) {
                    $nilai = $matriks[$id1][$id2];

                    PerbandinganSubKriteriaHama::updateOrCreate([
                        'sub_kriteria_id_1' => $id1,
                        'sub_kriteria_id_2' => $id2,
                    ], ['nilai' => $nilai]);

                    PerbandinganSubKriteriaHama::updateOrCreate([
                        'sub_kriteria_id_1' => $id2,
                        'sub_kriteria_id_2' => $id1,
                    ], ['nilai' => 1 / $nilai]);
                }
            }
        }

        return redirect()->route('matriks', $id)->with('success', 'Matriks sub kriteria berhasil disimpan!');
    }

    // ===========================================================

    private function hitungBobotInternal($subkriterias)
    {
        $n = count($subkriterias);
        $matriks = [];
        $totalKolom = array_fill(0, $n, 0);

        foreach ($subkriterias as $i => $baris) {
            foreach ($subkriterias as $j => $kolom) {
                $nilai = $baris->getNilai($kolom->id);
                $matriks[$i][$j] = $nilai;
                $totalKolom[$j] += $nilai;
            }
        }

        $normalisasi = [];
        $jumlah = [];
        $bobot = [];

        for ($i = 0; $i < $n; $i++) {
            $sum = 0;
            for ($j = 0; $j < $n; $j++) {
                $norm = $matriks[$i][$j] / $totalKolom[$j];
                $normalisasi[$i][$j] = $norm;
                $sum += $norm;
            }
            $jumlah[$i] = $sum;
            $bobot[$i] = $sum / $n;
        }

        return compact('matriks', 'normalisasi', 'jumlah', 'bobot');
    }

    private function hitungKonsistensi($matriks, $bobot)
    {
        $n = count($matriks);
        $lambdaMax = 0;

        for ($i = 0; $i < $n; $i++) {
            $total = 0;
            for ($j = 0; $j < $n; $j++) {
                $total += $matriks[$i][$j] * $bobot[$j];
            }
            $lambdaMax += $total / $bobot[$i];
        }

        $lambdaMax = $lambdaMax / $n;
        $ci = ($lambdaMax - $n) / ($n - 1);
        $ri = $this->getRI($n);
        $cr = ($ri == 0) ? 0 : $ci / $ri;

        return compact('lambdaMax', 'ci', 'cr');
    }

    private function getRI($n)
    {
        $riTable = [0, 0, 0.58, 0.9, 1.12, 1.24, 1.32, 1.41, 1.45];
        return $riTable[$n] ?? 1.5;
    }
}
