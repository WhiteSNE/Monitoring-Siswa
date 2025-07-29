<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Jurusan;
use App\Models\Kelas;


class siswa extends Model
{
    protected $fillable =[
        'user_id',
        'nisn',
        'nama_lengkap',
        'jurusan_id',
        'kelas_id',
        'alamat',
        'no_telepon',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function jurusan(){
        return $this->belongsTo(jurusan::class);
    }

    public function kelas(){
        return $this->belongsTo(kelas::class);
    }

    public function penempatanMagang(){
        return $this->hasOne(penempatan_magang::class);
    }
}
