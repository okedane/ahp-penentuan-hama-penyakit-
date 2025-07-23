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
            ['kriteria_id' => 1, 'kode' => 'S1', 'nama' => 'Daun berlubang atau sobek'],
            ['kriteria_id' => 1, 'kode' => 'S2', 'nama' => 'Jaringan daun rusak hingga hanya tersisa tulang daun'],
            ['kriteria_id' => 1, 'kode' => 'S3', 'nama' => 'Bagian tanaman (batang/tongkol) digerogoti'],
            ['kriteria_id' => 1, 'kode' => 'S4', 'nama' => 'Tanaman menjadi kerdil atau layu akibat kerusakan akar'],
            ['kriteria_id' => 1, 'kode' => 'S5', 'nama' => 'Tassel atau tongkol rusak atau hancur'],


            ['kriteria_id' => 2, 'kode' => 'S1', 'nama' => 'Daun'],
            ['kriteria_id' => 2, 'kode' => 'S2', 'nama' => 'Batang'],
            ['kriteria_id' => 2, 'kode' => 'S3', 'nama' => 'Akar'],
            ['kriteria_id' => 2, 'kode' => 'S4', 'nama' => 'Tongkol'],
            ['kriteria_id' => 2, 'kode' => 'S5', 'nama' => 'Tassel'],


            ['kriteria_id' => 3, 'kode' => 'S1', 'nama' => 'Gigitan besar membentuk lubang'],
            ['kriteria_id' => 3, 'kode' => 'S2', 'nama' => 'Garis-garis makan kecil tak beraturan'],
            ['kriteria_id' => 3, 'kode' => 'S3', 'nama' => 'Lubang gorokan panjang di batang/tongkol'],
            ['kriteria_id' => 3, 'kode' => 'S4', 'nama' => 'Patah batang di permukaan tanah'],
            ['kriteria_id' => 3, 'kode' => 'S5', 'nama' => 'Jaringan daun terlihat mengering'],


            ['kriteria_id' => 4, 'kode' => 'S1', 'nama' => 'Ditemukan serangga pada daun atau batang'],
            ['kriteria_id' => 4, 'kode' => 'S2', 'nama' => 'Ada ulat di dalam tongkol'],
            ['kriteria_id' => 4, 'kode' => 'S3', 'nama' => 'Terdapat kotoran hama di dekat lubang'],
            ['kriteria_id' => 4, 'kode' => 'S4', 'nama' => 'Adanya bekas gigitan baru atau luka terbuka'],
            ['kriteria_id' => 4, 'kode' => 'S5', 'nama' => 'Adanya telur/kepompong pada bagian tanaman'],

        ]);
    }
}
