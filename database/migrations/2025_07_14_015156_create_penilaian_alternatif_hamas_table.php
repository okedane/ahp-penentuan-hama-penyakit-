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
        Schema::create('penilaian_alternatif_hamas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('alternatif_id')->constrained('alternatif_hamas')->onDelete('cascade');
            $table->foreignId('sub_kriteria_id')->constrained('sub_kriteria_hamas')->onDelete('cascade');
            $table->float('nilai');
            $table->float('normalisasi', 5, 3)->nullable();
            $table->float('pembobotan', 7,4)->nullable();
            $table->timestamps();
            $table->unique(['alternatif_id', 'sub_kriteria_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penilaian_alternatif_hamas');
    }
};
