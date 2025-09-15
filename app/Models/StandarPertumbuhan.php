<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StandarPertumbuhan extends Model
{
    use HasFactory;

    protected $table = 'standar_pertumbuhan';

    protected $fillable = [
        'jenis_kelamin',
        'usia_bulan',
        'bb_min',
        'bb_max',
        'tb_min',
        'tb_max',
        'lk_min',
        'lk_max',
        'll_min',
        'll_max',
    ];
}
