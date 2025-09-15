<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class OrangTua extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'orang_tua';

    protected $fillable = [
        'user_id',
        'nama',
        'nik',
        'alamat',
        'no_hp',
        'pekerjaan',
    ];

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke Anak
    public function anak()
    {
        return $this->hasMany(\App\Models\Anak::class, 'orang_tua_id');
    }

}
