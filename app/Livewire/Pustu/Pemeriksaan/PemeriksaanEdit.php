<?php

namespace App\Livewire\Pustu\Pemeriksaan;

use Livewire\Component;
use App\Models\Pemeriksaan;
use App\Models\Anak;
use App\Models\StandarPertumbuhan;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class PemeriksaanEdit extends Component
{
    public $pemeriksaan_id;
    public $anak_id, $tanggal, $berat_badan, $tinggi_badan, $lingkar_kepala, $lingkar_lengan, $keluhan, $catatan;

    public function mount($id)
    {
        $pemeriksaan = Pemeriksaan::findOrFail($id);

        $this->pemeriksaan_id = $pemeriksaan->id;
        $this->anak_id        = $pemeriksaan->anak_id;
        $this->tanggal        = $pemeriksaan->tanggal;
        $this->berat_badan    = $pemeriksaan->berat_badan;
        $this->tinggi_badan   = $pemeriksaan->tinggi_badan;
        $this->lingkar_kepala = $pemeriksaan->lingkar_kepala;
        $this->lingkar_lengan = $pemeriksaan->lingkar_lengan;
        $this->keluhan        = $pemeriksaan->keluhan;
        $this->catatan        = $pemeriksaan->catatan;
    }

private function hitungPerubahan($sekarang, $sebelumnya)
{
    if ($sekarang > $sebelumnya) {
        return "Naik";
    } elseif ($sekarang < $sebelumnya) {
        return "Turun";
    }
    return "Tetap";
}

public function update()
{
    $this->validate([
        'anak_id'        => 'required|exists:anak,id',
        'tanggal'        => 'required|date',
        'berat_badan'    => 'required|numeric',
        'tinggi_badan'   => 'required|numeric',
        'lingkar_kepala' => 'nullable|numeric',
        'lingkar_lengan' => 'nullable|numeric',
        'keluhan'        => 'nullable|string',
        'catatan'        => 'nullable|string',
    ]);

    $anak = Anak::findOrFail($this->anak_id);

    // hitung usia bulan
    $usiaBulan = floor(
        Carbon::parse($anak->tanggal_lahir)->floatDiffInMonths(Carbon::parse($this->tanggal))
    );

    $standar = StandarPertumbuhan::where('jenis_kelamin', $anak->jenis_kelamin)
        ->where('usia_bulan', $usiaBulan)
        ->first();

    if (!$standar) {
        // fallback cari usia terdekat <= usiaBulan
        $standar = StandarPertumbuhan::where('jenis_kelamin', $anak->jenis_kelamin)
            ->where('usia_bulan', '<=', $usiaBulan)
            ->orderBy('usia_bulan', 'desc')
            ->first();
    }

    // default status
    $status_bbu = null;
    $status_tbu = null;
    $status_lk  = null;
    $status_ll  = null;

    if ($standar) {
        // --- BB/U ---
        if ($this->berat_badan < $standar->bb_min) {
            $status_bbu = "Gizi Kurang";
        } elseif ($this->berat_badan > $standar->bb_max) {
            $status_bbu = "Gizi Lebih";
        } else {
            $status_bbu = "Gizi Baik";
        }

        // --- TB/U ---
        if ($this->tinggi_badan < $standar->tb_min) {
            $status_tbu = "Pendek";
        } elseif ($this->tinggi_badan > $standar->tb_max) {
            $status_tbu = "Tinggi";
        } else {
            $status_tbu = "Normal";
        }

        // --- Lingkar Kepala ---
        if ($this->lingkar_kepala !== null) {
            if ($this->lingkar_kepala < $standar->lk_min) {
                $status_lk = "Kurang";
            } elseif ($this->lingkar_kepala > $standar->lk_max) {
                $status_lk = "Lebih";
            } else {
                $status_lk = "Normal";
            }
        }

        // --- Lingkar Lengan ---
        if ($this->lingkar_lengan !== null) {
            if ($this->lingkar_lengan < $standar->ll_min) {
                $status_ll = "Kurang";
            } elseif ($this->lingkar_lengan > $standar->ll_max) {
                $status_ll = "Lebih";
            } else {
                $status_ll = "Normal";
            }
        }
    }

    // ambil pemeriksaan sebelumnya (kecuali data ini sendiri)
    $lastCheck = Pemeriksaan::where('anak_id', $this->anak_id)
        ->where('tanggal', '<', $this->tanggal)
        ->where('id', '!=', $this->pemeriksaan_id)
        ->latest('tanggal')
        ->first();

    $perubahan_bb = null;
    $perubahan_tb = null;
    $perubahan_lk = null;
    $perubahan_ll = null;

    if ($lastCheck) {
        // --- BB ---
        $perubahan_bb = $this->hitungPerubahan($this->berat_badan, $lastCheck->berat_badan);

        // --- TB ---
        $perubahan_tb = $this->hitungPerubahan($this->tinggi_badan, $lastCheck->tinggi_badan);

        // --- LK ---
        if ($this->lingkar_kepala !== null && $lastCheck->lingkar_kepala !== null) {
            $perubahan_lk = $this->hitungPerubahan($this->lingkar_kepala, $lastCheck->lingkar_kepala);
        }

        // --- LL ---
        if ($this->lingkar_lengan !== null && $lastCheck->lingkar_lengan !== null) {
            $perubahan_ll = $this->hitungPerubahan($this->lingkar_lengan, $lastCheck->lingkar_lengan);
        }
    }

    $pemeriksaan = Pemeriksaan::findOrFail($this->pemeriksaan_id);

    $pemeriksaan->update([
        'anak_id'        => $this->anak_id,
        'petugas_id'     => Auth::id(),
        'tanggal'        => $this->tanggal,
        'berat_badan'    => $this->berat_badan,
        'tinggi_badan'   => $this->tinggi_badan,
        'lingkar_kepala' => $this->lingkar_kepala,
        'lingkar_lengan' => $this->lingkar_lengan,
        'status_bbu'     => $status_bbu,
        'status_tbu'     => $status_tbu,
        'status_lk'      => $status_lk,
        'status_ll'      => $status_ll,
        'perubahan_bb'   => $perubahan_bb,
        'perubahan_tb'   => $perubahan_tb,
        'perubahan_lk'   => $perubahan_lk,
        'perubahan_ll'   => $perubahan_ll,
        'keluhan'        => $this->keluhan,
        'catatan'        => $this->catatan,
    ]);

    session()->flash('success', 'Pemeriksaan berhasil diperbarui!');
    return redirect()->route('pemeriksaan.index');
}



    public function render()
    {
        return view('livewire.pustu.pemeriksaan.pemeriksaan-edit', [
            'anaks' => Anak::orderBy('nama')->get(),
        ]);
    }
}
