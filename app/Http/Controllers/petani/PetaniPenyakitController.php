<?php

namespace App\Http\Controllers\petani;

use App\Http\Controllers\Controller;

use App\Models\AlternatifPenyakit;
use App\Models\GejalaPenyakitPetani;
use App\Models\HasilDiagnosaPenyakit;
use App\Models\KriteriaPenyakit;
use App\Models\PenilaianAlternatifPenyakit;
use App\Models\SubKriteriaPenyakit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PetaniPenyakitController extends Controller
{
    public function inputGejalaForm()
    {
        $kriterias = KriteriaPenyakit::with('subKriterias')->get();
        return view('petani.penilaian.penyakit.input_gejala', compact('kriterias'));
    }

    public function simpanGejala(Request $request)
    {
        $request->validate([
            'sub_kriteria' => 'required|array',
        ]);

        $userId = Auth::id();

        // Hapus gejala lama
        GejalaPenyakitPetani::where('user_id', $userId)->delete();

        // Simpan gejala baru
        foreach ($request->sub_kriteria as $kriteriaId => $subKriteriaId) {
            GejalaPenyakitPetani::create([
                'user_id' => $userId,
                'sub_kriteria_id' => $subKriteriaId,
            ]);
        }

        // Langsung arahkan ke diagnosa
        return $this->diagnosa($request);
    }
    public function diagnosa(Request $request)
    {
        $userId = Auth::id();

        // Ambil subkriteria yang dipilih petani
        $subKriteriaIds = GejalaPenyakitPetani::where('user_id', $userId)->pluck('sub_kriteria_id')->toArray();

        if (empty($subKriteriaIds)) {
            return redirect()->route('petani.input.gejala.penyakit')->with('error', 'Silakan isi gejala terlebih dahulu.');
        }

        $alternatifs = AlternatifPenyakit::all();
        $subkriterias = SubKriteriaPenyakit::with('kriteria')->get();

        // Ambil bobot subkriteria dan kriteria
        $bobotSub = [];
        $bobotKriteria = [];

        foreach ($subkriterias as $sub) {
            $bobotSub[$sub->id] = $sub->bobot;
            $bobotKriteria[$sub->id] = $sub->kriteria->bobot;
        }

        // Hitung skor setiap alternatif
        $hasil = [];

        foreach ($alternatifs as $alt) {
            $skor = 0;
            $detail = [];

            foreach ($subKriteriaIds as $subId) {
                $data = PenilaianAlternatifPenyakit::where('alternatif_id', $alt->id)
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

        HasilDiagnosaPenyakit::create([
            'user_id' => $userId,
            'sub_kriteria_ids' => json_encode($subKriteriaIds),
            'alternatif_id' => $terbaik['alternatif_id'],
            'skor' => $terbaik['skor'],
        ]);

        return view('petani.diagnosa.penyakit.hasil', compact('hasil', 'terbaik'));
    }
}
