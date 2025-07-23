<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class jurnal_harian extends Model
{
    protected $table = 'jurnal_harian';
    protected $fillable = [
        'penempatan_id',
        'tanggal',
        'kegiatan',
        'foto_kegiatan',
        'status_verifikasi',
        'catatan_pembimbing',
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
