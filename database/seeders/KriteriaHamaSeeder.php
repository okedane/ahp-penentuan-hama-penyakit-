<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KriteriaHamaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('kriteria_hama')->insert([
            [
                'kode' => 'C1',
                'nama' => 'Jenis Kerusakan',
                'bobot' => 0.480,

            ],
            [
                'kode' => 'C2',
                'nama' => 'Bagian Tanaman Yang Diserang',
                'bobot' => 0.230,


            ],
            [
                'kode' => 'C3',
                'nama' => 'Bentuk Serangan',
                'bobot' => 0.202,

            ],
            [
                'kode' => 'C4',
                'nama' => 'Tanda keberadaan Hama',
                'bobot' => 0.088,

            ],
            
        ]);
    }
}
