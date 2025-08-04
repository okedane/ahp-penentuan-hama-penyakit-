<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenilaianAlternatifPenyakit extends Model
{
    use HasFactory;
    protected $table = 'penilaian_alternatif_penyakits';
    protected $fillable = ['alternatif_id', '
    sub_kriteria_id', 
    'nilai'];
    
    public function alternatif()
    {
        return $this->belongsTo(AlternatifPenyakit::class, 'alternatif_id');
    }

    
    public function subKriteria()
    {
        return $this->belongsTo(SubKriteriaPenyakit::class, 'sub_kriteria_id');
    }
}
