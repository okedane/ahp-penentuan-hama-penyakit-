<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('penilaian_alternatif_penyakits', function (Blueprint $table) {
            $table->id();
            $table->foreignId('alternatif_id')->constrained('alternatif_penyakits')->onDelete('cascade');
            $table->foreignId('sub_kriteria_id')->constrained('sub_kriteria_penyakits')->onDelete('cascade');
            $table->float('nilai');
            $table->decimal('normalisasi', 5, 3)->nullable();
            $table->decimal('pembobotan', 7, 4)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penilaian_alternatif_penyakits');
    }
};
