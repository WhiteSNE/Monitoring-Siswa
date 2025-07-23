<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class absensi extends Model
{
    protected $table = 'absensi';
    protected $fillable = [
        'penempatan_id',
        'tanggal',
        'status_kehadiran',
        'keterangan',
    ];

    protected function cast(): array{
        return [
            'tanggal' => 'date',
        ];
    }

    public function penempatanMagang(){
        return $this->belongsTo(penempatan_magang::class, 'penempatan_id');
    }
}
