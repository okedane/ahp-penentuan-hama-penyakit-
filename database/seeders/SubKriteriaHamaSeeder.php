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
            ['kriteria_id' => 1, 'kode' => 'S1', 'nama' => 'Daun berlubang atau sobek', 'bobot' => 0.496],
            ['kriteria_id' => 1, 'kode' => 'S2', 'nama' => 'Jaringan daun rusak hingga hanya tersisa tulang daun', 'bobot' => 0.258],
            ['kriteria_id' => 1, 'kode' => 'S3', 'nama' => 'Bagian tanaman (batang/tongkol) digerogoti', 'bobot' => 0.138],
            ['kriteria_id' => 1, 'kode' => 'S4', 'nama' => 'Tanaman menjadi kerdil atau layu akibat kerusakan akar', 'bobot' => 0.072],
            ['kriteria_id' => 1, 'kode' => 'S5', 'nama' => 'Tassel atau tongkol rusak atau hancur', 'bobot' => 0.036],
            


            ['kriteria_id' => 2, 'kode' => 'S1', 'nama' => 'Daun', 'bobot' => 0.317],
            ['kriteria_id' => 2, 'kode' => 'S2', 'nama' => 'Batang', 'bobot' => 0.229],
            ['kriteria_id' => 2, 'kode' => 'S3', 'nama' => 'Akar', 'bobot' => 0.105],
            ['kriteria_id' => 2, 'kode' => 'S4', 'nama' => 'Tongkol', 'bobot' => 0.201],
            ['kriteria_id' => 2, 'kode' => 'S5', 'nama' => 'Tassel', 'bobot' => 0.149],


            ['kriteria_id' => 3, 'kode' => 'S1', 'nama' => 'Gigitan besar membentuk lubang', 'bobot' => 0.314],
            ['kriteria_id' => 3, 'kode' => 'S2', 'nama' => 'Garis-garis makan kecil tak beraturan', 'bobot' => 0.186],
            ['kriteria_id' => 3, 'kode' => 'S3', 'nama' => 'Lubang gorokan panjang di batang/tongkol', 'bobot' => 0.168],
            ['kriteria_id' => 3, 'kode' => 'S4', 'nama' => 'Patah batang di permukaan tanah', 'bobot' => 0.197],
            ['kriteria_id' => 3, 'kode' => 'S5', 'nama' => 'Jaringan daun terlihat mengering', 'bobot' => 0.134],
          


            ['kriteria_id' => 4, 'kode' => 'S1', 'nama' => 'Ditemukan serangga pada daun atau batang', 'bobot' => 0.299],
            ['kriteria_id' => 4, 'kode' => 'S2', 'nama' => 'Ada ulat di dalam tongkol', 'bobot' => 0.211],
            ['kriteria_id' => 4, 'kode' => 'S3', 'nama' => 'Terdapat kotoran hama di dekat lubang', 'bobot' => 0.147],
            ['kriteria_id' => 4, 'kode' => 'S4', 'nama' => 'Adanya bekas gigitan baru atau luka terbuka', 'bobot' => 0.202],
            ['kriteria_id' => 4, 'kode' => 'S5', 'nama' => 'Adanya telur/kepompong pada bagian tanaman', 'bobot' => 0.140],

        ]);
    }
}
