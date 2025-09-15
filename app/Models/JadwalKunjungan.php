<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalKunjungan extends Model
{
    use HasFactory;

    protected $table = 'jadwal_kunjungan';

    protected $fillable = [
        'anak_id',
        'tanggal_kunjungan',
        'status',
    ];

    // relasi ke anak
    public function anak()
    {
        return $this->belongsTo(Anak::class);
    }
}
