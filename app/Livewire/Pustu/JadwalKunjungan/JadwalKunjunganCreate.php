<?php

namespace App\Livewire\Pustu\JadwalKunjungan;

use Livewire\Component;
use App\Models\JadwalKunjungan;
use App\Models\Anak;

class JadwalKunjunganCreate extends Component
{
    public $anak_id, $tanggal_kunjungan;

    public function save()
    {
        $this->validate([
            'anak_id' => 'required|exists:anak,id',
            'tanggal_kunjungan' => 'required|date',
        ]);

        JadwalKunjungan::create([
            'anak_id' => $this->anak_id,
            'tanggal_kunjungan' => $this->tanggal_kunjungan,
            'status' => 'Belum Hadir',
        ]);

        session()->flash('success', 'Jadwal pemeriksaan berhasil dibuat!');
        return redirect()->route('jadwal-kunjungan.index');
    }

    public function render()
    {
        return view('livewire.pustu.jadwal-kunjungan.jadwal-kunjungan-create', [
            'anaks' => Anak::orderBy('nama')->get(),
        ]);
    }
}
