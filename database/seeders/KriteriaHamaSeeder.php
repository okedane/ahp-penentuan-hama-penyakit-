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
                'nama' => 'Pekerjaan',

            ],
            [
                'kode' => 'C2',
                'nama' => 'Pendataan',

            ],
            [
                'kode' => 'C3',
                'nama' => 'Jumlah Tanggungan',

            ],
            [
                'kode' => 'C4',
                'nama' => 'Jenis Penerangan',

            ],
            [
                'kode' => 'C5',
                'nama' => 'usia',

            ],
        ]);
    }
}
