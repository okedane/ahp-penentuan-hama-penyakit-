<?php

namespace App\Http\Controllers\petani;

use App\Http\Controllers\Controller;
use App\Models\AlternatifHama;
use App\Models\GejalaPetani;
use App\Models\HasilDiagnosaPetani;
use App\Models\KriteriaHama;
use App\Models\PenilaianAlternatifHama;
use App\Models\SubKriteriaHama;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;


class PetaniController extends Controller
{
    public function inputGejalaForm()
    {
        $kriterias = KriteriaHama::with('subKriterias')->get();
        return view('petani.penilaian.input_gejala', compact('kriterias'));
    }

    public function simpanGejala(Request $request)
    {
        $request->validate([
            'sub_kriteria' => 'required|array',
        ]);

        $userId = Auth::id();

        // Hapus gejala lama
        GejalaPetani::where('user_id', $userId)->delete();

        // Simpan gejala baru
        foreach ($request->sub_kriteria as $kriteriaId => $subKriteriaId) {
            GejalaPetani::create([
                'user_id' => $userId,
                'sub_kriteria_id' => $subKriteriaId,
            ]);
        }

        // Langsung arahkan ke diagnosa
        return $this->diagnosa($request);
    }

    // public function diagnosa(Request $request = null)
    // {
    //     $userId = Auth::id();

    //     // Ambil subkriteria yang dipilih petani
    //     $subKriteriaIds = GejalaPetani::where('user_id', $userId)->pluck('sub_kriteria_id')->toArray();

    //     if (empty($subKriteriaIds)) {
    //         return redirect()->route('petani.input.gejala')->with('error', 'Silakan isi gejala terlebih dahulu.');
    //     }

    //     $alternatifs = AlternatifHama::all();
    //     $subkriterias = SubKriteriaHama::with('kriteria')->get();

    //     // Ambil bobot subkriteria & kriteria
    //     $bobotSub = [];        // [sub_kriteria_id => bobot_sub]
    //     $bobotKriteria = [];   // [kriteria_id => bobot_kriteria]
    //     $subTerpilihPerKriteria = []; // [kriteria_id => sub_kriteria_id]

    //     foreach ($subkriterias as $sub) {
    //         $bobotSub[$sub->id] = $sub->bobot;
    //         $bobotKriteria[$sub->kriteria_id] = $sub->kriteria->bobot;

    //         if (in_array($sub->id, $subKriteriaIds)) {
    //             $subTerpilihPerKriteria[$sub->kriteria_id] = $sub->id;
    //         }
    //     }

    //     // Hitung skor untuk setiap alternatif
    //     $hasil = [];

    //     foreach ($alternatifs as $alt) {
    //         $skor = 0;

    //         foreach ($subTerpilihPerKriteria as $kriteriaId => $subId) {
    //             $nilai = PenilaianAlternatifHama::where('alternatif_id', $alt->id)
    //                 ->where('sub_kriteria_id', $subId)
    //                 ->value('nilai') ?? 0;

    //             $normalisasi = $this->normalisasiNilai($subId, $nilai); // Pastikan ini benar
    //             $bobot_alternatif = $normalisasi;
    //             $bobot_sub = $bobotSub[$subId] ?? 0;
    //             $bobot_kriteria = $bobotKriteria[$kriteriaId] ?? 0;

    //             $skor += $bobot_alternatif * $bobot_sub * $bobot_kriteria;
    //         }

    //         $hasil[] = [
    //             'alternatif_id' => $alt->id,
    //             'nama' => $alt->nama,
    //             'skor' => round($skor, 5),
    //         ];
    //     }

    //     // Urutkan skor dari tertinggi ke terendah
    //     usort($hasil, fn($a, $b) => $b['skor'] <=> $a['skor']);
    //     $terbaik = $hasil[0];

    //     // Simpan hasil
    //     HasilDiagnosaPetani::create([
    //         'user_id' => $userId,
    //         'sub_kriteria_ids' => json_encode($subKriteriaIds),
    //         'alternatif_id' => $terbaik['alternatif_id'],
    //         'skor' => $terbaik['skor'],
    //     ]);

    //     return view('petani.diagnosa.hasil', compact('hasil', 'terbaik'));
    // }

    // public function diagnosa(Request $request)
    // {
    //     $userId = Auth::id();

    //     // Ambil subkriteria yang dipilih petani
    //     $subKriteriaIds = GejalaPetani::where('user_id', $userId)->pluck('sub_kriteria_id')->toArray();

    //     if (empty($subKriteriaIds)) {
    //         return redirect()->route('petani.input.gejala')->with('error', 'Silakan isi gejala terlebih dahulu.');
    //     }

    //     $alternatifs = AlternatifHama::all();
    //     $subkriterias = SubKriteriaHama::with('kriteria')->get();

    //     // Ambil bobot
    //     $bobotSub = [];
    //     $bobotKriteria = [];

    //     foreach ($subkriterias as $sub) {
    //         $bobotSub[$sub->id] = $sub->bobot;
    //         $bobotKriteria[$sub->id] = $sub->kriteria->bobot;
    //     }

    //     // Hitung skor setiap alternatif
    //     $hasil = [];

    //     foreach ($alternatifs as $alt) {
    //         $skor = 0;

    //         foreach ($subKriteriaIds as $subId) {
    //             $nilai = PenilaianAlternatifHama::where('alternatif_id', $alt->id)
    //                 ->where('sub_kriteria_id', $subId)
    //                 ->value('nilai') ?? 0;

    //             $normalisasi = $this->normalisasiNilai($subId, $nilai);
    //             $bobot_alternatif = $normalisasi;
    //             $bobot_sub = $bobotSub[$subId] ?? 0;
    //             $bobot_kriteria = $bobotKriteria[$subId] ?? 0;

    //             $skorPartial = $bobot_alternatif * $bobot_sub * $bobot_kriteria;
    //             $skor += $skorPartial;
    //         }

    //         $hasil[] = [
    //             'alternatif_id' => $alt->id,
    //             'nama' => $alt->nama,
    //             'skor' => round($skor, 5),
    //         ];
    //     }

    //     // Urutkan dari skor tertinggi ke terendah
    //     usort($hasil, fn($a, $b) => $b['skor'] <=> $a['skor']);
    //     $terbaik = $hasil[0];

    //     // Simpan ke tabel hasil diagnosa
    //     HasilDiagnosaPetani::create([
    //         'user_id' => $userId,
    //         'sub_kriteria_ids' => json_encode($subKriteriaIds),
    //         'alternatif_id' => $terbaik['alternatif_id'],
    //         'skor' => $terbaik['skor'],
    //     ]);

    //     return view('petani.diagnosa.hasil', compact('hasil', 'terbaik'));
    // }

    public function diagnosa(Request $request)
    {
        $userId = Auth::id();

        $subKriteriaIds = GejalaPetani::where('user_id', $userId)->pluck('sub_kriteria_id')->toArray();

        if (empty($subKriteriaIds)) {
            return redirect()->route('petani.input.gejala')->with('error', 'Silakan isi gejala terlebih dahulu.');
        }

        $alternatifs = AlternatifHama::all();
        $subkriterias = SubKriteriaHama::with('kriteria')->get();

        $bobotSub = [];
        $bobotKriteria = [];

        foreach ($subkriterias as $sub) {
            $bobotSub[$sub->id] = $sub->bobot;
            $bobotKriteria[$sub->id] = $sub->kriteria->bobot;
        }

        // Debug sebelum perhitungan skor
        dd([
            'subKriteriaDipilih' => $subKriteriaIds,
            'bobotSub' => $bobotSub,
            'bobotKriteria' => $bobotKriteria,
        ]);

        $hasil = [];

        foreach ($alternatifs as $alt) {
            $skor = 0;

            foreach ($alternatifs as $alt) {
                $skor = 0;

                foreach ($subKriteriaIds as $subId) {
                    $nilai = PenilaianAlternatifHama::where('alternatif_id', $alt->id)
                        ->where('sub_kriteria_id', $subId)
                        ->value('nilai') ?? 0;

                    $normalisasi = $this->normalisasiNilai($subId, $nilai);

                    $bobot_alternatif = $normalisasi;
                    $bobot_sub = $bobotSub[$subId] ?? 0;
                    $bobot_kriteria = $bobotKriteria[$subId] ?? 0;

                    $skorPartial = $bobot_alternatif * $bobot_sub * $bobot_kriteria;

                    // 💥 Tambahkan debug di sini
                    dd([
                        'alternatif_id' => $alt->id,
                        'nama_alternatif' => $alt->nama,
                        'sub_kriteria_id' => $subId,
                        'nilai_penilaian' => $nilai,
                        'normalisasi' => $normalisasi,
                        'bobot_sub' => $bobot_sub,
                        'bobot_kriteria' => $bobot_kriteria,
                        'skor_partial' => $skorPartial
                    ]);
                }
            }


            $hasil[] = [
                'alternatif_id' => $alt->id,
                'nama' => $alt->nama,
                'skor' => round($skor, 5),
            ];
        }

        usort($hasil, fn($a, $b) => $b['skor'] <=> $a['skor']);
        $terbaik = $hasil[0];

        HasilDiagnosaPetani::create([
            'user_id' => $userId,
            'sub_kriteria_ids' => json_encode($subKriteriaIds),
            'alternatif_id' => $terbaik['alternatif_id'],
            'skor' => $terbaik['skor'],
        ]);

        return view('petani.diagnosa.hasil', compact('hasil', 'terbaik'));
    }



    private function normalisasiNilai($subId, $nilai)
    {
        $totalKuadrat = PenilaianAlternatifHama::where('sub_kriteria_id', $subId)
            ->get()
            ->sum(fn($item) => pow($item->nilai, 2));

        $akar = sqrt($totalKuadrat);

        dd(compact('subId', 'nilai', 'totalKuadrat', 'akar'));

        return $akar != 0 ? round($nilai / $akar, 4) : 0;
    }
}
