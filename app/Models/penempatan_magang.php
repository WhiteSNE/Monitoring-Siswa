<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class penempatan_magang extends Model
{
    protected $table = 'penempatan_magang';
    protected $fillable = [
        'siswa_id',
        'dudi_id',
        'guru_id',
        'tanggal_mulai',
        'tanggal_selesai',
        'status',
    ];

    protected function cast(): array{
        return [
            'tanggal_mulai' => 'date',
            'tanggal_selesai' => 'date',
        ];
    }

    public function siswa(){
        return $this->belongsTo(siswa::class);
    }

    public function dudi(){
        return $this->belongsTo(dudi::class);
    }

    public function guru(){
        return $this->belongsTo(guru::class);
    }

    public function jurnalHarian(){
        return $this->hasMany(jurnal_harian::class, 'penempatan_id');
    }

    public function absensi(){
        return $this->hasMany(absensi::class, 'penempatan_id');
    }

    public function bimbingan(){
        return $this->hasMany(bimbingan::class, 'penempatan_id');
    }

    public function penilaian(){
        return $this->hasOne(penilaian::class, 'penempatan_id');
    }
}
