<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class guru extends Model
{
    protected $fillable = [
        'user_id',
        'nama_lengkap',
        'nip',
        'tanggal_lahir',
        'email',
        'no_telepon',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function penempatanMagang(){
        return $this->hasMany(penempatan_magang::class);
    }
}
