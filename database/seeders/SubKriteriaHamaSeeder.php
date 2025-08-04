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
            ['kriteria_id' => 1, 'kode' => 'S1', 'nama' => 'Daun berlubang atau sobek', 'bobot' => 0.354],
            ['kriteria_id' => 1, 'kode' => 'S2', 'nama' => 'Jaringan daun rusak hingga hanya tersisa tulang daun', 'bobot' => 0.236],
            ['kriteria_id' => 1, 'kode' => 'S3', 'nama' => 'Bagian tanaman (batang/tongkol) digerogoti', 'bobot' => 0.241],
            ['kriteria_id' => 1, 'kode' => 'S4', 'nama' => 'Tanaman menjadi kerdil atau layu akibat kerusakan akar', 'bobot' => 0.104],
            ['kriteria_id' => 1, 'kode' => 'S5', 'nama' => 'Tassel atau tongkol rusak atau hancur', 'bobot' => 0.065],
            


            ['kriteria_id' => 2, 'kode' => 'S1', 'nama' => 'Daun', 'bobot' => 0.411],
            ['kriteria_id' => 2, 'kode' => 'S2', 'nama' => 'Batang', 'bobot' => 0.261],
            ['kriteria_id' => 2, 'kode' => 'S3', 'nama' => 'Akar', 'bobot' => 0.147],
            ['kriteria_id' => 2, 'kode' => 'S4', 'nama' => 'Tongkol', 'bobot' => 0.093],
            ['kriteria_id' => 2, 'kode' => 'S5', 'nama' => 'Tassel', 'bobot' => 0.087],


            ['kriteria_id' => 3, 'kode' => 'S1', 'nama' => 'Gigitan besar membentuk lubang', 'bobot' => 0.334],
            ['kriteria_id' => 3, 'kode' => 'S2', 'nama' => 'Garis-garis makan kecil tak beraturan', 'bobot' => 0.290],
            ['kriteria_id' => 3, 'kode' => 'S3', 'nama' => 'Lubang gorokan panjang di batang/tongkol', 'bobot' => 0.159],
            ['kriteria_id' => 3, 'kode' => 'S4', 'nama' => 'Patah batang di permukaan tanah', 'bobot' => 0.130],
            ['kriteria_id' => 3, 'kode' => 'S5', 'nama' => 'Jaringan daun terlihat mengering', 'bobot' => 0.087],
          


            ['kriteria_id' => 4, 'kode' => 'S1', 'nama' => 'Ditemukan serangga pada daun atau batang', 'bobot' => 0.340],
            ['kriteria_id' => 4, 'kode' => 'S2', 'nama' => 'Ada ulat di dalam tongkol', 'bobot' => 0.296],
            ['kriteria_id' => 4, 'kode' => 'S3', 'nama' => 'Terdapat kotoran hama di dekat lubang', 'bobot' => 0.204],
            ['kriteria_id' => 4, 'kode' => 'S4', 'nama' => 'Adanya bekas gigitan baru atau luka terbuka', 'bobot' => 0.094],
            ['kriteria_id' => 4, 'kode' => 'S5', 'nama' => 'Adanya telur/kepompong pada bagian tanaman', 'bobot' => 0.066],

        ]);
    }
}
