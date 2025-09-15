<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Konsultasi extends Model
{
    use HasFactory;

    protected $table = 'konsultasi';

    protected $fillable = [
        'anak_id',
        'petugas_id',
        'tanggal',
        'keluhan',
        'saran',
        'catatan',
    ];

    // 🔹 Relasi ke Anak
    public function anak()
    {
        return $this->belongsTo(Anak::class, 'anak_id');
    }

    // 🔹 Relasi ke Petugas (User role=petugas)
    public function petugas()
    {
        return $this->belongsTo(User::class, 'petugas_id');
    }

    // 🔹 Relasi ke chat
    public function chats()
    {
        return $this->hasMany(KonsultasiChat::class, 'konsultasi_id');
    }
}
