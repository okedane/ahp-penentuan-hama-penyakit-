<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PenilaianAlternatifHamaSeeder extends Seeder
{
    // public function run(): void
    // {
    //     // $data = [
    //     //     // Alternatif 1
    //     //     ['alternatif_id' => 1, 'sub_kriteria_id' => 1, 'nilai' => 3],
    //     //     ['alternatif_id' => 1, 'sub_kriteria_id' => 2, 'nilai' => 4],
    //     //     ['alternatif_id' => 1, 'sub_kriteria_id' => 3, 'nilai' => 3],
    //     //     ['alternatif_id' => 1, 'sub_kriteria_id' => 4, 'nilai' => 2],
    //     //     ['alternatif_id' => 1, 'sub_kriteria_id' => 5, 'nilai' => 5],
    //     //     ['alternatif_id' => 1, 'sub_kriteria_id' => 6, 'nilai' => 3],
    //     //     ['alternatif_id' => 1, 'sub_kriteria_id' => 7, 'nilai' => 5],
    //     //     ['alternatif_id' => 1, 'sub_kriteria_id' => 8, 'nilai' => 4],
    //     //     ['alternatif_id' => 1, 'sub_kriteria_id' => 9, 'nilai' => 2],
    //     //     ['alternatif_id' => 1, 'sub_kriteria_id' => 10, 'nilai' => 2],

    //     //     // Alternatif 2
    //     //     ['alternatif_id' => 2, 'sub_kriteria_id' => 1, 'nilai' => 1],
    //     //     ['alternatif_id' => 2, 'sub_kriteria_id' => 2, 'nilai' => 5],
    //     //     ['alternatif_id' => 2, 'sub_kriteria_id' => 3, 'nilai' => 1],
    //     //     ['alternatif_id' => 2, 'sub_kriteria_id' => 4, 'nilai' => 4],
    //     //     ['alternatif_id' => 2, 'sub_kriteria_id' => 5, 'nilai' => 5],
    //     //     ['alternatif_id' => 2, 'sub_kriteria_id' => 6, 'nilai' => 3],
    //     //     ['alternatif_id' => 2, 'sub_kriteria_id' => 7, 'nilai' => 3],
    //     //     ['alternatif_id' => 2, 'sub_kriteria_id' => 8, 'nilai' => 3],
    //     //     ['alternatif_id' => 2, 'sub_kriteria_id' => 9, 'nilai' => 2],
    //     //     ['alternatif_id' => 2, 'sub_kriteria_id' => 10, 'nilai' => 1],

    //     //     // Alternatif 3
    //     //     ['alternatif_id' => 3, 'sub_kriteria_id' => 1, 'nilai' => 1],
    //     //     ['alternatif_id' => 3, 'sub_kriteria_id' => 2, 'nilai' => 5],
    //     //     ['alternatif_id' => 3, 'sub_kriteria_id' => 3, 'nilai' => 1],
    //     //     ['alternatif_id' => 3, 'sub_kriteria_id' => 4, 'nilai' => 3],
    //     //     ['alternatif_id' => 3, 'sub_kriteria_id' => 5, 'nilai' => 1],
    //     //     ['alternatif_id' => 3, 'sub_kriteria_id' => 6, 'nilai' => 5],
    //     //     ['alternatif_id' => 3, 'sub_kriteria_id' => 7, 'nilai' => 5],
    //     //     ['alternatif_id' => 3, 'sub_kriteria_id' => 8, 'nilai' => 5],
    //     //     ['alternatif_id' => 3, 'sub_kriteria_id' => 9, 'nilai' => 3],
    //     //     ['alternatif_id' => 3, 'sub_kriteria_id' => 10, 'nilai' => 5],

    //     //     // Alternatif 4
    //     //     ['alternatif_id' => 4, 'sub_kriteria_id' => 1, 'nilai' => 4],
    //     //     ['alternatif_id' => 4, 'sub_kriteria_id' => 2, 'nilai' => 3],
    //     //     ['alternatif_id' => 4, 'sub_kriteria_id' => 3, 'nilai' => 3],
    //     //     ['alternatif_id' => 4, 'sub_kriteria_id' => 4, 'nilai' => 1],
    //     //     ['alternatif_id' => 4, 'sub_kriteria_id' => 5, 'nilai' => 5],
    //     //     ['alternatif_id' => 4, 'sub_kriteria_id' => 6, 'nilai' => 2],
    //     //     ['alternatif_id' => 4, 'sub_kriteria_id' => 7, 'nilai' => 4],
    //     //     ['alternatif_id' => 4, 'sub_kriteria_id' => 8, 'nilai' => 2],
    //     //     ['alternatif_id' => 4, 'sub_kriteria_id' => 9, 'nilai' => 4],
    //     //     ['alternatif_id' => 4, 'sub_kriteria_id' => 10, 'nilai' => 3],

    //     //     // Alternatif 5
    //     //     ['alternatif_id' => 5, 'sub_kriteria_id' => 1, 'nilai' => 2],
    //     //     ['alternatif_id' => 5, 'sub_kriteria_id' => 2, 'nilai' => 4],
    //     //     ['alternatif_id' => 5, 'sub_kriteria_id' => 3, 'nilai' => 4],
    //     //     ['alternatif_id' => 5, 'sub_kriteria_id' => 4, 'nilai' => 5],
    //     //     ['alternatif_id' => 5, 'sub_kriteria_id' => 5, 'nilai' => 2],
    //     //     ['alternatif_id' => 5, 'sub_kriteria_id' => 6, 'nilai' => 2],
    //     //     ['alternatif_id' => 5, 'sub_kriteria_id' => 7, 'nilai' => 4],
    //     //     ['alternatif_id' => 5, 'sub_kriteria_id' => 8, 'nilai' => 3],
    //     //     ['alternatif_id' => 5, 'sub_kriteria_id' => 9, 'nilai' => 4],
    //     //     ['alternatif_id' => 5, 'sub_kriteria_id' => 10, 'nilai' => 3],
    //     // ];

    //     // DB::table('penilaian_alternatif_hamas')->insert($data);



    // }

    public function run()
    {
        $alternatif = DB::table('alternatif_hamas')->get(); // 6 alternatif
        $subKriteria = DB::table('sub_kriteria_hamas')->get(); // 20 subkriteria

        // Contoh mapping manual nilai relevansi (bisa dikembangkan lebih lanjut)
        $mapping = [
            // hama_id => [sub_kriteria_id => nilai]
            1 => [1 => 3, 2 => 2, 3 => 1, 4 => 1, 5 => 2], // Belalang
            2 => [1 => 4, 2 => 5, 6 => 3, 7 => 4, 8 => 2], // Ulat Grayak
            3 => [9 => 5, 10 => 4, 11 => 3],              // Penggerek Batang
            4 => [11 => 4, 12 => 5, 13 => 2],             // Penggerek Tongkol
            5 => [1 => 3, 5 => 4, 6 => 2, 14 => 4],       // Kutu Daun
            6 => [2 => 3, 4 => 3, 15 => 5, 17 => 4],      // Wereng
        ];

        $now = Carbon::now();

        foreach ($alternatif as $alt) {
            foreach ($subKriteria as $sub) {
                $nilai = $mapping[$alt->id][$sub->id] ?? 1; // default nilai 1 jika tidak didefinisikan
                DB::table('penilaian_alternatif_hamas')->insert([
                    'alternatif_id' => $alt->id,
                    'sub_kriteria_id' => $sub->id,
                    'nilai' => $nilai,
                    'created_at' => $now,
                    'updated_at' => $now,
                ]);
            }
        }
    }
}
