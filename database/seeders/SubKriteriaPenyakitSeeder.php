<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubKriteriaPenyakitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('sub_kriteria_penyakits')->insert([
            ['kriteria_id' => 1, 'kode' => 'S1', 'nama' => 'Daun tampak bergaris kuning panjang', 'bobot' => 0.496],
            ['kriteria_id' => 1, 'kode' => 'S2', 'nama' => 'Permukaan daun berwarna coklat', 'bobot' => 0.258],
            ['kriteria_id' => 1, 'kode' => 'S3', 'nama' => 'Terdapat titik merah kecoklatan seperti karat', 'bobot' => 0.138],
            ['kriteria_id' => 1, 'kode' => 'S4', 'nama' => 'Terdapat serbuk berwarna kuning kecoklatan ', 'bobot' => 0.072],
            ['kriteria_id' => 1, 'kode' => 'S5', 'nama' => 'Warna daun dari hijau normal menjadi kekuning-kuningan', 'bobot' => 0.036],



            ['kriteria_id' => 2, 'kode' => 'S1', 'nama' => 'Daun tampak bercak bergaris kuning', 'bobot' => 0.317],
            ['kriteria_id' => 2, 'kode' => 'S2', 'nama' => 'Adanya garis-garis pendek terputus-putus pada tulang daun', 'bobot' => 0.229],
            ['kriteria_id' => 2, 'kode' => 'S3', 'nama' => 'Daun menjadi transparan, berlubang, tinggal tulang daun saja', 'bobot' => 0.105],
            ['kriteria_id' => 2, 'kode' => 'S4', 'nama' => 'Permukaan biji tertutupi miselium berwarna', 'bobot' => 0.201],
            ['kriteria_id' => 2, 'kode' => 'S5', 'nama' => 'Biji jagung bengkak berwarna hitam', 'bobot' => 0.149],


            ['kriteria_id' => 3, 'kode' => 'S1', 'nama' => 'Akar rusak karena gigitan lunak', 'bobot' => 0.314],
            ['kriteria_id' => 3, 'kode' => 'S2', 'nama' => 'Batang busuk', 'bobot' => 0.186],
            ['kriteria_id' => 3, 'kode' => 'S3', 'nama' => 'Rusaknya tongkol', 'bobot' => 0.168],
            ['kriteria_id' => 3, 'kode' => 'S4', 'nama' => 'Daun tanaman muda rusak', 'bobot' => 0.197],
            ['kriteria_id' => 3, 'kode' => 'S5', 'nama' => 'Pucuk daun layu', 'bobot' => 0.134],



            ['kriteria_id' => 4, 'kode' => 'S1', 'nama' => 'Tanaman menjadi kerdil', 'bobot' => 0.299],
            ['kriteria_id' => 4, 'kode' => 'S2', 'nama' => 'Tanaman menjadi layu', 'bobot' => 0.211],
            ['kriteria_id' => 4, 'kode' => 'S3', 'nama' => 'Tidak berbuah', 'bobot' => 0.147],
            ['kriteria_id' => 4, 'kode' => 'S4', 'nama' => 'Tongkol tidak normal', 'bobot' => 0.202],
            ['kriteria_id' => 4, 'kode' => 'S5', 'nama' => 'Batang dan tassel mudah patah', 'bobot' => 0.140],

        ]);
    }
}
