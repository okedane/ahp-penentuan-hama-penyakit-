<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AlternatifPenyakitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         DB::table('alternatif_penyakits')->insert([
            [
                'kode' => 'A01',
                'nama' => 'Penyakit Bulai',
            ],
            [
                'kode' => 'A02',
                'nama' => 'Virus Mozaik Kerdil',
            ],
            [
                'kode' => 'A03',
                'nama' => 'Penyakit Karat',
            ],
            [
                'kode' => 'A04',
                'nama' => 'Penyakit Gosong Bengkak',
            ],
            [
                'kode' => 'A05',
                'nama' => 'Busuk Batang dan Tongkol',
            ],

        ]);
    }
}
