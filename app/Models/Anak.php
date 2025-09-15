<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Anak extends Model
{
    use HasFactory;

    protected $table = 'anak';

    protected $fillable = [
        'orang_tua_id',
        'nama',
        'tanggal_lahir',
        'jenis_kelamin',
        'bb_lahir',
        'tb_lahir',
    ];


    protected $casts = [
        'tanggal_lahir' => 'date',
    ];


    // Relasi ke Orang Tua
    public function orangTua()
    {
        return $this->belongsTo(OrangTua::class);
    }

    // Relasi ke Riwayat Posyandu
    public function riwayatPosyandu()
    {
        return $this->hasMany(RiwayatPosyandu::class);
    }

    // Relasi ke Pemeriksaan
    public function pemeriksaan()
    {
        return $this->hasMany(Pemeriksaan::class, 'anak_id');
    }

    public function jadwalKunjungan()
    {
        return $this->hasMany(JadwalKunjungan::class);
    }


}
