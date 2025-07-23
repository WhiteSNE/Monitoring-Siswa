<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class guru extends Model
{
    protected $fillable = [
        'user_id',
        'nip',
        'nama_lengkap',
        'no_telepon',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function penempatanMagang(){
        return $this->hasMany(penempatan_magang::class);
    }
}
