<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class penilaian extends Model
{
    protected $table = 'penilaian';
    protected $fillable = [
        'penempatan_id',
        'nilai_dudi',
        'feedback_dudi',
        'nilai_guru',
        'feedback_guru',
        'nilai_akhir',
    ];

    protected function cast(): array{
        return [
            'nilai_dudi' => 'decimal:2',
            'nilai_guru' => 'decimal:2',
            'nilai_akhir' => 'decimal:2',
        ];
    }

    public function penempatanMagang(){
        return $this->belongsTo(penempatan_magang::class, 'penempatan_id');
    }
}
