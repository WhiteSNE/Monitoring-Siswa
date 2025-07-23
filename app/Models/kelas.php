<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class kelas extends Model
{
    protected $fillable = ['nama_kelas'];

    public function siswas(){
        return $this->hasMany(siswa::class);
    }
}
