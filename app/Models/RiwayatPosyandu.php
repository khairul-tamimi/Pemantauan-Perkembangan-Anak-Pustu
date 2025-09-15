<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RiwayatPosyandu extends Model
{
    use HasFactory;

    protected $table = 'riwayat_posyandu';

    protected $fillable = [
        'anak_id',
        'tanggal',
        'berat_badan',
        'tinggi_badan',
        'lingkar_kepala',
        'lingkar_lengan',
        'sumber_data',
    ];

    public function anak()
    {
        return $this->belongsTo(Anak::class);
    }
}
