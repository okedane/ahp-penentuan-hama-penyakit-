<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PenilaianAlternatifHamaSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            // Alternatif 1
            ['alternatif_id' => 1, 'sub_kriteria_id' => 1, 'nilai' => 5],
            ['alternatif_id' => 1, 'sub_kriteria_id' => 2, 'nilai' => 3],
            ['alternatif_id' => 1, 'sub_kriteria_id' => 3, 'nilai' => 2],
            ['alternatif_id' => 1, 'sub_kriteria_id' => 4, 'nilai' => 1],
            ['alternatif_id' => 1, 'sub_kriteria_id' => 5, 'nilai' => 2],

            ['alternatif_id' => 1, 'sub_kriteria_id' => 6, 'nilai' => 5],
            ['alternatif_id' => 1, 'sub_kriteria_id' => 7, 'nilai' => 2],
            ['alternatif_id' => 1, 'sub_kriteria_id' => 8, 'nilai' => 1],
            ['alternatif_id' => 1, 'sub_kriteria_id' => 9, 'nilai' => 2],
            ['alternatif_id' => 1, 'sub_kriteria_id' => 10, 'nilai' => 3],

            ['alternatif_id' => 1, 'sub_kriteria_id' => 11, 'nilai' => 5],
            ['alternatif_id' => 1, 'sub_kriteria_id' => 12, 'nilai' => 2],
            ['alternatif_id' => 1, 'sub_kriteria_id' => 13, 'nilai' => 1],
            ['alternatif_id' => 1, 'sub_kriteria_id' => 14, 'nilai' => 1],
            ['alternatif_id' => 1, 'sub_kriteria_id' => 15, 'nilai' => 1],

            ['alternatif_id' => 1, 'sub_kriteria_id' => 16, 'nilai' => 5],
            ['alternatif_id' => 1, 'sub_kriteria_id' => 17, 'nilai' => 1],
            ['alternatif_id' => 1, 'sub_kriteria_id' => 18, 'nilai' => 1],
            ['alternatif_id' => 1, 'sub_kriteria_id' => 19, 'nilai' => 4],
            ['alternatif_id' => 1, 'sub_kriteria_id' => 20, 'nilai' => 2],

            // Alternatif 2
            ['alternatif_id' => 2, 'sub_kriteria_id' => 1, 'nilai' => 4],
            ['alternatif_id' => 2, 'sub_kriteria_id' => 2, 'nilai' => 4],
            ['alternatif_id' => 2, 'sub_kriteria_id' => 3, 'nilai' => 3],
            ['alternatif_id' => 2, 'sub_kriteria_id' => 4, 'nilai' => 4],
            ['alternatif_id' => 2, 'sub_kriteria_id' => 5, 'nilai' => 3],

            ['alternatif_id' => 2, 'sub_kriteria_id' => 6, 'nilai' => 5],
            ['alternatif_id' => 2, 'sub_kriteria_id' => 7, 'nilai' => 4],
            ['alternatif_id' => 2, 'sub_kriteria_id' => 8, 'nilai' => 3],
            ['alternatif_id' => 2, 'sub_kriteria_id' => 9, 'nilai' => 2],
            ['alternatif_id' => 2, 'sub_kriteria_id' => 10, 'nilai' => 3],

            ['alternatif_id' => 2, 'sub_kriteria_id' => 11, 'nilai' => 4],
            ['alternatif_id' => 2, 'sub_kriteria_id' => 12, 'nilai' => 3],
            ['alternatif_id' => 2, 'sub_kriteria_id' => 13, 'nilai' => 2],
            ['alternatif_id' => 2, 'sub_kriteria_id' => 14, 'nilai' => 3],
            ['alternatif_id' => 2, 'sub_kriteria_id' => 15, 'nilai' => 3],

            ['alternatif_id' => 2, 'sub_kriteria_id' => 16, 'nilai' => 4],
            ['alternatif_id' => 2, 'sub_kriteria_id' => 17, 'nilai' => 2],
            ['alternatif_id' => 2, 'sub_kriteria_id' => 18, 'nilai' => 3],
            ['alternatif_id' => 2, 'sub_kriteria_id' => 19, 'nilai' => 4],
            ['alternatif_id' => 2, 'sub_kriteria_id' => 20, 'nilai' => 3],


            // // Alternatif 3
            ['alternatif_id' => 3, 'sub_kriteria_id' => 1, 'nilai' => 2],
            ['alternatif_id' => 3, 'sub_kriteria_id' => 2, 'nilai' => 2],
            ['alternatif_id' => 3, 'sub_kriteria_id' => 3, 'nilai' => 5],
            ['alternatif_id' => 3, 'sub_kriteria_id' => 4, 'nilai' => 3],
            ['alternatif_id' => 3, 'sub_kriteria_id' => 5, 'nilai' => 2],

            ['alternatif_id' => 3, 'sub_kriteria_id' => 6, 'nilai' => 2],
            ['alternatif_id' => 3, 'sub_kriteria_id' => 7, 'nilai' => 5],
            ['alternatif_id' => 3, 'sub_kriteria_id' => 8, 'nilai' => 4],
            ['alternatif_id' => 3, 'sub_kriteria_id' => 9, 'nilai' => 1],
            ['alternatif_id' => 3, 'sub_kriteria_id' => 10, 'nilai' => 1],

            ['alternatif_id' => 3, 'sub_kriteria_id' => 11, 'nilai' => 1],
            ['alternatif_id' => 3, 'sub_kriteria_id' => 12, 'nilai' => 2],
            ['alternatif_id' => 3, 'sub_kriteria_id' => 13, 'nilai' => 5],
            ['alternatif_id' => 3, 'sub_kriteria_id' => 14, 'nilai' => 2],
            ['alternatif_id' => 3, 'sub_kriteria_id' => 15, 'nilai' => 2],

            ['alternatif_id' => 3, 'sub_kriteria_id' => 16, 'nilai' => 2],
            ['alternatif_id' => 3, 'sub_kriteria_id' => 17, 'nilai' => 3],
            ['alternatif_id' => 3, 'sub_kriteria_id' => 18, 'nilai' => 5],
            ['alternatif_id' => 3, 'sub_kriteria_id' => 19, 'nilai' => 3],
            ['alternatif_id' => 3, 'sub_kriteria_id' => 20, 'nilai' => 2],

            // // Alternatif 4
            ['alternatif_id' => 4, 'sub_kriteria_id' => 1, 'nilai' => 1],
            ['alternatif_id' => 4, 'sub_kriteria_id' => 2, 'nilai' => 1],
            ['alternatif_id' => 4, 'sub_kriteria_id' => 3, 'nilai' => 4],
            ['alternatif_id' => 4, 'sub_kriteria_id' => 4, 'nilai' => 2],
            ['alternatif_id' => 4, 'sub_kriteria_id' => 5, 'nilai' => 5],

            ['alternatif_id' => 4, 'sub_kriteria_id' => 6, 'nilai' => 2],
            ['alternatif_id' => 4, 'sub_kriteria_id' => 7, 'nilai' => 3],
            ['alternatif_id' => 4, 'sub_kriteria_id' => 8, 'nilai' => 2],
            ['alternatif_id' => 4, 'sub_kriteria_id' => 9, 'nilai' => 5],
            ['alternatif_id' => 4, 'sub_kriteria_id' => 10, 'nilai' => 4],

            ['alternatif_id' => 4, 'sub_kriteria_id' => 11, 'nilai' => 1],
            ['alternatif_id' => 4, 'sub_kriteria_id' => 12, 'nilai' => 1],
            ['alternatif_id' => 4, 'sub_kriteria_id' => 13, 'nilai' => 4],
            ['alternatif_id' => 4, 'sub_kriteria_id' => 14, 'nilai' => 2],
            ['alternatif_id' => 4, 'sub_kriteria_id' => 15, 'nilai' => 1],

            ['alternatif_id' => 4, 'sub_kriteria_id' => 16, 'nilai' => 1],
            ['alternatif_id' => 4, 'sub_kriteria_id' => 17, 'nilai' => 5],
            ['alternatif_id' => 4, 'sub_kriteria_id' => 18, 'nilai' => 4],
            ['alternatif_id' => 4, 'sub_kriteria_id' => 19, 'nilai' => 2],
            ['alternatif_id' => 4, 'sub_kriteria_id' => 20, 'nilai' => 2],

            // Alternatif 5
            ['alternatif_id' => 5,'sub_kriteria_id' => 1,'nilai' => 2],
            ['alternatif_id' => 5,'sub_kriteria_id' => 2,'nilai' => 3],
            ['alternatif_id' => 5,'sub_kriteria_id' => 3,'nilai' => 1],
            ['alternatif_id' => 5,'sub_kriteria_id' => 4,'nilai' => 1],
            ['alternatif_id' => 5,'sub_kriteria_id' => 5,'nilai' => 5],

            ['alternatif_id' => 5,'sub_kriteria_id' => 6,'nilai' => 3],
            ['alternatif_id' => 5,'sub_kriteria_id' => 7,'nilai' => 3],
            ['alternatif_id' => 5,'sub_kriteria_id' => 8,'nilai' => 1],
            ['alternatif_id' => 5,'sub_kriteria_id' => 9,'nilai' => 2],
            ['alternatif_id' => 5,'sub_kriteria_id' => 10,'nilai' => 3],

            ['alternatif_id' => 5,'sub_kriteria_id' => 11,'nilai' => 2],
            ['alternatif_id' => 5,'sub_kriteria_id' => 12,'nilai' => 2],
            ['alternatif_id' => 5,'sub_kriteria_id' => 13,'nilai' => 3],
            ['alternatif_id' => 5,'sub_kriteria_id' => 14,'nilai' => 1],
            ['alternatif_id' => 5,'sub_kriteria_id' => 15,'nilai' => 3],

            ['alternatif_id' => 5,'sub_kriteria_id' => 16,'nilai' => 4],
            ['alternatif_id' => 5,'sub_kriteria_id' => 17,'nilai' => 1],
            ['alternatif_id' => 5,'sub_kriteria_id' => 18,'nilai' => 2],
            ['alternatif_id' => 5,'sub_kriteria_id' => 19,'nilai' => 3],
            ['alternatif_id' => 5,'sub_kriteria_id' => 20,'nilai' => 3],

            // Alternatif 6
            [ 'alternatif_id' => 6,'sub_kriteria_id' => 1,'nilai' => 2],
            [ 'alternatif_id' => 6,'sub_kriteria_id' => 2,'nilai' => 2],
            [ 'alternatif_id' => 6,'sub_kriteria_id' => 3,'nilai' => 1],
            [ 'alternatif_id' => 6,'sub_kriteria_id' => 4,'nilai' => 2],
            [ 'alternatif_id' => 6,'sub_kriteria_id' => 5,'nilai' => 1],

            [ 'alternatif_id' => 6,'sub_kriteria_id' => 6,'nilai' => 4],
            [ 'alternatif_id' => 6,'sub_kriteria_id' => 7,'nilai' => 2],
            [ 'alternatif_id' => 6,'sub_kriteria_id' => 8,'nilai' => 2],
            [ 'alternatif_id' => 6,'sub_kriteria_id' => 9,'nilai' => 1],
            ['alternatif_id' => 6,'sub_kriteria_id' => 10,'nilai' => 2],

            ['alternatif_id' => 6,'sub_kriteria_id' => 11,'nilai' => 2],
            ['alternatif_id' => 6,'sub_kriteria_id' => 12,'nilai' => 2],
            ['alternatif_id' => 6,'sub_kriteria_id' => 13,'nilai' => 2],
            ['alternatif_id' => 6,'sub_kriteria_id' => 14,'nilai' => 2],
            ['alternatif_id' => 6,'sub_kriteria_id' => 15,'nilai' => 3],

            ['alternatif_id' => 6,'sub_kriteria_id' => 16,'nilai' => 3],
            ['alternatif_id' => 6,'sub_kriteria_id' => 17,'nilai' => 2],
            ['alternatif_id' => 6,'sub_kriteria_id' => 18,'nilai' => 3],
            ['alternatif_id' => 6,'sub_kriteria_id' => 19,'nilai' => 3],
            ['alternatif_id' => 6,'sub_kriteria_id' => 20,'nilai' => 3],

        ];

        DB::table('penilaian_alternatif_hamas')->insert($data);

    }
}
