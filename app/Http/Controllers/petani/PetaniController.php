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
        return view('petani.penilaian.hama.input_gejala', compact('kriterias'));
    }

    public function simpanGejala(Request $request)
    {
        $request->validate([
            'sub_kriteria' => 'required|array',
        ]);

        $userId = Auth::id();


        GejalaPetani::where('user_id', $userId)->delete();


        foreach ($request->sub_kriteria as $kriteriaId => $subKriteriaId) {
            GejalaPetani::create([
                'user_id' => $userId,
                'sub_kriteria_id' => $subKriteriaId,
            ]);
        }


        return $this->diagnosa($request);
    }



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


        $hasil = [];

        foreach ($alternatifs as $alt) {
            $skor = 0;
            $detail = [];

            foreach ($subKriteriaIds as $subId) {
                $data = PenilaianAlternatifHama::where('alternatif_id', $alt->id)
                    ->where('sub_kriteria_id', $subId)
                    ->first();

                $nilai = $data->nilai ?? 0;
                $normalisasi = $data->normalisasi ?? 0;

                $bobot_sub = $bobotSub[$subId] ?? 0;
                $bobot_kriteria = $bobotKriteria[$subId] ?? 0;

                $skorPartial = $normalisasi * $bobot_sub * $bobot_kriteria;
                $skor += $skorPartial;

                $detail[] = [
                    'sub_id' => $subId,
                    'nilai' => $nilai,
                    'normalisasi' => $normalisasi,
                    'bobot_sub' => $bobot_sub,
                    'bobot_kriteria' => $bobot_kriteria,
                    'skor_partial' => $skorPartial,
                ];
            }

            $hasil[] = [
                'alternatif_id' => $alt->id,
                'nama' => $alt->nama,
                'skor' => round($skor, 5),
                'detail' => $detail,
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

        return view('petani.diagnosa.hama.hasil', compact('hasil', 'terbaik'));
    }
}
