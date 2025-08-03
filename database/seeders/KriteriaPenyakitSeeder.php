<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KriteriaPenyakitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('kriteria_penyakit')->insert([
            [
                'kode' => 'C1',
                'nama' => 'Warna Daun',
                'bobot' => 0.315,

            ],
            [
                'kode' => 'C2',
                'nama' => 'Bentuk Bercak',
                'bobot' => 0.330,


            ],
            [
                'kode' => 'C3',
                'nama' => 'Bagian Terinfeksi',
                'bobot' => 0.152,

            ],
            [
                'kode' => 'C4',
                'nama' => 'Dampak Serangan',
                'bobot' => 0.202,

            ],
            
        ]);
    }
}
