<?php

namespace App\Http\Controllers\petani;

use App\Http\Controllers\Controller;
use App\Models\GejalaPetani;
use App\Models\KriteriaHama;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

        // Hapus gejala sebelumnya dari user ini
        GejalaPetani::where('user_id', Auth::id())->delete();

        // Simpan data baru
        foreach ($request->sub_kriteria as $kriteriaId => $subKriteriaId) {
            GejalaPetani::create([
                'user_id' => Auth::id(),
                'sub_kriteria_id' => $subKriteriaId,
            ]);
        }

        return redirect()->route('dashboard.petani')->with('success', 'Gejala berhasil dikirim.');
    }
}
