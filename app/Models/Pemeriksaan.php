<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pemeriksaan extends Model
{
    use HasFactory;

    protected $table = 'pemeriksaan';

    protected $fillable = [
        'anak_id',
        'petugas_id',
        'tanggal',
        'berat_badan',
        'tinggi_badan',
        'lingkar_kepala',
        'lingkar_lengan',
        'status_bbu',
        'status_tbu',
        'status_lk',
        'status_ll',
        'perubahan_bb',
        'perubahan_tb',
        'perubahan_lk',
        'perubahan_ll',
        'keluhan',
        'catatan',
    ];

    /* ================= RELASI ================= */
    public function anak()
    {
        return $this->belongsTo(Anak::class);
    }

    public function petugas()
    {
        return $this->belongsTo(User::class, 'petugas_id');
    }

    public function tindakLanjut()
    {
        return $this->hasMany(TindakLanjut::class);
    }

    /* ================= LOGIC ================= */

    /** 
     * Hitung status gizi berdasarkan standar pertumbuhan
     */
    public function hitungStatus()
    {
        $anak = $this->anak;

        if (!$anak) return [];

        $usiaBulan = Carbon::parse($anak->tanggal_lahir)->diffInMonths(Carbon::parse($this->tanggal));

        $standar = StandarPertumbuhan::where('jenis_kelamin', $anak->jenis_kelamin)
            ->where('usia_bulan', $usiaBulan)
            ->first();

        if (!$standar) {
            return [
                'status_bbu' => null,
                'status_tbu' => null,
                'status_lk'  => null,
                'status_ll'  => null,
            ];
        }

        $status = [];

        // --- BB/U ---
        if ($this->berat_badan < $standar->bb_min) {
            $status['status_bbu'] = "Berat Kurang";
        } elseif ($this->berat_badan > $standar->bb_max) {
            $status['status_bbu'] = "Berat Lebih";
        } else {
            $status['status_bbu'] = "Normal";
        }

        // --- TB/U ---
        if ($this->tinggi_badan < $standar->tb_min) {
            $status['status_tbu'] = "Pendek";
        } elseif ($this->tinggi_badan > $standar->tb_max) {
            $status['status_tbu'] = "Tinggi";
        } else {
            $status['status_tbu'] = "Normal";
        }

        // --- Lingkar Kepala ---
        if ($this->lingkar_kepala < $standar->lk_min) {
            $status['status_lk'] = "Kurang";
        } elseif ($this->lingkar_kepala > $standar->lk_max) {
            $status['status_lk'] = "Lebih";
        } else {
            $status['status_lk'] = "Normal";
        }

        // --- Lingkar Lengan ---
        if ($this->lingkar_lengan < $standar->ll_min) {
            $status['status_ll'] = "Kurang";
        } elseif ($this->lingkar_lengan > $standar->ll_max) {
            $status['status_ll'] = "Lebih";
        } else {
            $status['status_ll'] = "Normal";
        }
        // --- Lingkar Kepala ---
        if ($this->lingkar_kepala < $standar->lk_min || $this->lingkar_kepala > $standar->lk_max) {
            $status['status_lk'] = "Tidak Normal";
        } else {
            $status['status_lk'] = "Normal";
        }

        // --- Lingkar Lengan ---
        if ($this->lingkar_lengan < $standar->ll_min || $this->lingkar_lengan > $standar->ll_max) {
            $status['status_ll'] = "Tidak Normal";
        } else {
            $status['status_ll'] = "Normal";
        }

        return $status;
    }

    /**
     * Hitung perubahan dibanding pemeriksaan sebelumnya
     */
    public function hitungPerubahan()
    {
        $anak = $this->anak;
        if (!$anak) return [];

        $prev = $anak->pemeriksaan()
            ->where('tanggal', '<', $this->tanggal)
            ->orderBy('tanggal', 'desc')
            ->first();

        $hasil = [
            'perubahan_bb' => null,
            'perubahan_tb' => null,
        ];

        if ($prev) {
            $hasil['perubahan_bb'] = $this->berat_badan - $prev->berat_badan;
            $hasil['perubahan_tb'] = $this->tinggi_badan - $prev->tinggi_badan;
        }

        return $hasil;
    }
}
