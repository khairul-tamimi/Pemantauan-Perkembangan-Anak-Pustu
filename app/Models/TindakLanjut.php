<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TindakLanjut extends Model
{
    use HasFactory;

    protected $table = 'tindak_lanjut';

    protected $fillable = [
        'pemeriksaan_id',
        'jenis',
        'keterangan',
        'tanggal',
    ];

    protected $casts = [
        'tanggal' => 'datetime', // sekarang $tl->tanggal adalah Carbon instance
    ];

    
    public function pemeriksaan()
    {
        return $this->belongsTo(Pemeriksaan::class);
    }
}
