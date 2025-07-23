<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\Types\This;

class dudi extends Model
{
    protected $table = 'dudis';
    protected $fillable = [
        'user_id',
        'nama_perusahaan',
        'alamat',
        'email_perusahaan',
        'no_telepon_perusahaan',
        'nama_pic',
        'deskripsi',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function penempatanMagang(){
        return $this->hasMany(penempatan_magang::class);
    }
}
