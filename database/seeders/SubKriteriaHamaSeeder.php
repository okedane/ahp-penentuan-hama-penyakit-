<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubKriteriaHamaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('sub_kriteria_hamas')->insert([
            ['kriteria_id' => 1, 'nama' => 'Sangat Baik'],
            ['kriteria_id' => 1, 'nama' => 'Baik'],
            ['kriteria_id' => 1, 'nama' => 'Cukup'],
            ['kriteria_id' => 1, 'nama' => 'Buruk'],

            ['kriteria_id' => 2, 'nama' => 'Sangat Baik'],
            ['kriteria_id' => 2, 'nama' => 'Baik'],
            ['kriteria_id' => 2, 'nama' => 'Cukup'],
            ['kriteria_id' => 2, 'nama' => 'Buruk'],

            ['kriteria_id' => 3, 'nama' => 'Sangat Baik'],
            ['kriteria_id' => 3, 'nama' => 'Baik'],
            ['kriteria_id' => 3, 'nama' => 'Cukup'],
            ['kriteria_id' => 3, 'nama' => 'Buruk'],

            ['kriteria_id' => 4, 'nama' => 'Sangat Baik'],
            ['kriteria_id' => 4, 'nama' => 'Baik'],
            ['kriteria_id' => 4, 'nama' => 'Cukup'],
            ['kriteria_id' => 4, 'nama' => 'Buruk'],

            ['kriteria_id' => 5, 'nama' => 'Sangat Baik'],
            ['kriteria_id' => 5, 'nama' => 'Baik'],
            ['kriteria_id' => 5, 'nama' => 'Cukup'],
            ['kriteria_id' => 5, 'nama' => 'Buruk'],
        ]);
    }
}
