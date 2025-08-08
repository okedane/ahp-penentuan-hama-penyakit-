<?php

namespace App\Http\Controllers;

use App\Models\HasilDiagnosaPenyakit;
use App\Models\HasilDiagnosaPetani;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HistoryController extends Controller
{
    public function index()
    {
        $riwayats = HasilDiagnosaPenyakit::with(['alternatif'])
            ->where('user_id', Auth::id())
            ->orderBy('created_at', 'DESC')
            ->paginate(10);

        foreach ($riwayats as $riwayat) {
            
            $ids = is_array($riwayat->sub_kriteria_ids)
                ? $riwayat->sub_kriteria_ids
                : json_decode($riwayat->sub_kriteria_ids, true);

            
            $riwayat->subkriteria_list = \App\Models\SubKriteriaPenyakit::whereIn('id', $ids ?? [])->get();
        }

        return view('petani.history.penyakit.index', compact('riwayats'));
    }



    public function hama()
    {
        $riwayats = HasilDiagnosaPetani::with(['alternatif'])
            ->where('user_id', Auth::id())
            ->orderBy('created_at', 'DESC')
            ->paginate(10);

        foreach ($riwayats as $riwayat) {
            
            $ids = is_array($riwayat->sub_kriteria_ids)
                ? $riwayat->sub_kriteria_ids
                : json_decode($riwayat->sub_kriteria_ids, true);

            
            $riwayat->subkriteria_list = \App\Models\SubKriteriaPenyakit::whereIn('id', $ids ?? [])->get();
        }

        return view('petani.history.hama.index', compact('riwayats'));
    }
    
}
