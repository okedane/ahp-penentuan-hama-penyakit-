<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HasilDiagnosaPenyakit extends Model
{
    use HasFactory;
    protected $table = 'hasil_diagnosa_penyakits';
    protected $fillable = ['user_id', 'sub_kriteria_ids', 'alternatif_id', 'skor'];


    protected $casts = [
        'sub_kriteria_ids' => 'array',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function alternatif()
    {
        return $this->belongsTo(AlternatifPenyakit::class, 'alternatif_id');
    }

    // public function subKriterias()
    // {
    //     return $this->belongsToMany(
    //         SubKriteriaPenyakit::class,
    //         null,
    //         'id', // tidak pakai pivot table, kita ambil manual dari array
    //         'id'
    //     )->whereIn('id', $this->sub_kriteria_ids ?? []);
    // }
}
