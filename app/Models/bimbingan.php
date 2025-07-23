<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class bimbingan extends Model
{
    protected $table = 'bimbingan';
    protected $fillable = [
        'penempatan_id',
        'tanggal_bimbingan',
        'topik_bimbingan',
        'catatan_guru',
    ];

    protected function cast(): array{
        return [
'tanggal_bimbingan' => 'date',
        ];
    }

    public function penempatanMagang(){
        return $this->belongsTo(penempatan_magang::class, 'penempatan_id');
    }
}
