<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class jurusan extends Model
{
    protected $fillable = ['nama_jurusan'];

    public function siswas(){
        return $this->hasMany(siswa::class);
    }
}
