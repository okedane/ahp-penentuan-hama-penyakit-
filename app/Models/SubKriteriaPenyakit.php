<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubKriteriaPenyakit extends Model
{
    use HasFactory;
    protected $table = 'sub_kriteria_penyakits';
    protected $fillable = [
        'kriteria_id',
        'kode',
        'nama',
        'bobot',
    ];

    public function getNilai(SubKriteriaPenyakit $lainnya)
    {
        $nilai = PerbandinganKriteriaPenyakit::where('kriteria_id_1', $this->id)
            ->where('kriteria_id_2', $lainnya->kriteria_id)
            ->value('nilai');

        if ($nilai) return $nilai;
        $nilai = PerbandinganKriteriaPenyakit::where('kriteria_id_1', $lainnya->id)
            ->where('kriteria_id_2', $this->kriteria_id)
            ->value('nilai');
        return $nilai ? 1 / $nilai : 1;
    }


    public function kriteria()
    {
        return $this->belongsTo(KriteriaPenyakit::class, 'kriteria_id');
    }
    public function perbandinganSubKriteria1()
    {
        return $this->hasMany(PerbandinganSubKriteriaPenyakit::class, 'sub_kriteria_id_1');
    }
    public function perbandinganSubKriteria2()
    {
        return $this->hasMany(PerbandinganSubKriteriaPenyakit::class, 'sub_kriteria_id_2');
    }
    public function penilaian()
    {
        return $this->hasMany(PenilaianAlternatifPenyakit::class, 'sub_kriteria_id');
    }
}
