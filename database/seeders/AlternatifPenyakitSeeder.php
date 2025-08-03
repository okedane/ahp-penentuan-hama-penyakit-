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
                'kode' => 'A1',
                'nama' => 'Belalang',
            ],
            [
                'kode' => 'A2',
                'nama' => 'Ulat Grayak',
            ],
            [
                'kode' => 'A3',
                'nama' => 'Penggerek Batang',
            ],
            [
                'kode' => 'A4',
                'nama' => 'Penggerek Tongkol',
            ],
            [
                'kode' => 'A5',
                'nama' => 'Kutu Daun',
            ],
            [
                'kode' => 'A6',
                'nama' => 'Wereng Jagung (Kumbang Tanduk)',
            ],

        ]);
    }
}
