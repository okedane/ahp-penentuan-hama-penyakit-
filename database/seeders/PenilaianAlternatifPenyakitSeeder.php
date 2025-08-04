<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PenilaianAlternatifPenyakitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    // public function run()
    // {
    //     $alternatif = DB::table('alternatif_penyakits')->get(); // 6 alternatif
    //     $subKriteria = DB::table('sub_kriteria_penyakits')->get(); // 20 subkriteria

    //     // Contoh mapping manual nilai relevansi (bisa dikembangkan lebih lanjut)
    //     $mapping = [
    //         // hama_id => [sub_kriteria_id => nilai]
    //         1 => [1 => 3, 2 => 2, 3 => 1, 4 => 1, 5 => 2], // Belalang
    //         2 => [1 => 4, 2 => 5, 6 => 3, 7 => 4, 8 => 2], // Ulat Grayak
    //         3 => [9 => 5, 10 => 4, 11 => 3],              // Penggerek Batang
    //         4 => [11 => 4, 12 => 5, 13 => 2],             // Penggerek Tongkol
    //         5 => [1 => 3, 5 => 4, 6 => 2, 14 => 4],       // Kutu Daun
    //         6 => [2 => 3, 4 => 3, 15 => 5, 17 => 4],      // Wereng
    //     ];

    //     $now = Carbon::now();

    //     foreach ($alternatif as $alt) {
    //         foreach ($subKriteria as $sub) {
    //             $nilai = $mapping[$alt->id][$sub->id] ?? 1; // default nilai 1 jika tidak didefinisikan
    //             DB::table('penilaian_alternatif_penyakits')->insert([
    //                 'alternatif_id' => $alt->id,
    //                 'sub_kriteria_id' => $sub->id,
    //                 'nilai' => $nilai,
    //                 'created_at' => $now,
    //                 'updated_at' => $now,
    //             ]);
    //         }
    //     }
    // }
    public function run(): void
    {
        $data = [
            [
                'kode' => 'A01',
                'subkriteria' => [3, 2, 1, 1, 2,  1, 1, 1, 1, 1,  1, 1, 1, 1, 1,  1, 1, 1, 1, 1],
            ],
            [
                'kode' => 'A02',
                'subkriteria' => [4, 5, 1, 1, 1,   3, 4, 2, 1, 1,  1, 1, 1, 1, 1,  1, 1, 1, 1, 1],
            ],
            [
                'kode' => 'A03',
                'subkriteria' => [1, 1, 1, 1, 1,  1, 1, 1, 5, 4,  3, 1, 1, 1, 1,  1, 1, 1, 1, 1],
            ],
            [
                'kode' => 'A04',
                'subkriteria' => [1, 1, 1, 1, 1,  1, 1, 1, 1, 1,  4, 5, 2, 1, 1,  1, 1, 1, 1, 1],
            ],
            [
                'kode' => 'A05',
                'subkriteria' => [3, 1, 1, 1, 4,   2, 1, 1, 1, 1,  1, 1, 1, 4, 1,  1, 1, 1, 1, 1],
            ], 
        ];

        foreach ($data as $altIndex => $item) {
            foreach ($item['subkriteria'] as $subIndex => $nilai) {
                DB::table('penilaian_alternatif_penyakits')->insert([
                    'alternatif_id' => $altIndex + 1,
                    'sub_kriteria_id' => $subIndex + 1,
                    'nilai' => $nilai,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
