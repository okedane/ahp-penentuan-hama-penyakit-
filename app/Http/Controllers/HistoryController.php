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
        $riwayats = HasilDiagnosaPenyakit::with('alternatif')
            ->where('user_id', Auth::id())
            ->orderBy('created_at', 'DESC')
            ->paginate(10);

        return view('petani.history.penyakit.index', compact('riwayats'));
    }

    public function hama()
    {
        $riwayats = HasilDiagnosaPetani::with('alternatif')
            ->where('user_id', Auth::id())
            ->orderBy('created_at', 'DESC')
            ->paginate(10);

        return view('petani.history.hama.index', compact('riwayats'));
    }

    // Jika butuh detail spesifik
    // public function show($id)
    // {
    //     $riwayat = HasilDiagnosaPenyakit::with('alternatif')
    //         ->where('user_id', Auth::id())
    //         ->findOrFail($id);

    //     return view('petani.history.penyakit.detail', compact('riwayat'));
    // }
}
