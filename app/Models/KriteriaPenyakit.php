<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KriteriaPenyakit extends Model
{
    use HasFactory;
    protected $table = 'kriteria_penyakit';
    protected $fillable = [
        'kode',
        'nama',
        'bobot',
    ];

    public function subKriterias()
    {
        return $this->hasMany(SubKriteriaPenyakit::class, 'kriteria_id');
    }
    public function perbandinganKriteria1()
    {
        return $this->hasMany(PerbandinganKriteriaPenyakit::class, 'kriteria_id_1');
    }
    public function perbandinganSubKriteria2()
    {
        return $this->hasMany(PerbandinganSubKriteriaPenyakit::class, 'sub_kriteria_id_1');
    }
}
