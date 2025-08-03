<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\AlternatifHama;
use App\Models\AlternatifPenyakit;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeeder::class,
            KriteriaHamaSeeder::class,
            KriteriaPenyakitSeeder::class,

            SubKriteriaHamaSeeder::class,
            SubKriteriaPenyakitSeeder::class,
            
            AlternatifHamaSeeder::class,
            AlternatifPenyakitSeeder::class,

            PenilaianAlternatifHamaSeeder::class,
            PenilaianAlternatifPenyakitSeeder::class,
        ]);
    }
}
