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

            ],
            [
                'kode' => 'C2',
                'nama' => 'Bagian Tanaman Yang Diserang',

            ],
            [
                'kode' => 'C3',
                'nama' => 'Bentuk Serangan',

            ],
            [
                'kode' => 'C4',
                'nama' => 'Tanda keberadaan Hama',

            ],
            
        ]);
    }
}
