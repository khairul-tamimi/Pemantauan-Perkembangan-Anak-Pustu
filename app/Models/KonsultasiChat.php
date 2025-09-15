<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class KonsultasiChat extends Model
{
    use HasFactory;

    protected $table = 'konsultasi_chat';

    protected $fillable = [
        'konsultasi_id',
        'user_id',
        'pesan',
        'is_read',
    ];

    // 🔹 Relasi ke konsultasi
    public function konsultasi()
    {
        return $this->belongsTo(Konsultasi::class, 'konsultasi_id');
    }

    // 🔹 Relasi ke user (bisa ortu/petugas)
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
