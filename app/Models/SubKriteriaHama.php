<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SubKriteriaHama extends Model
{
    use HasFactory;

    protected $table = 'sub_kriteria_hamas';

    protected $fillable = ['kriteria_id', 'nama'];

    public function kriteria()
    {
        return $this->belongsTo(KriteriaHama::class, 'kriteria_id');
    }

    public function perbandingan1()
    {
        return $this->hasMany(PerbandinganSubKriteriaHama::class, 'sub_kriteria_id_1');
    }

    public function perbandingan2()
    {
        return $this->hasMany(PerbandinganSubKriteriaHama::class, 'sub_kriteria_id_2');
    }
}
