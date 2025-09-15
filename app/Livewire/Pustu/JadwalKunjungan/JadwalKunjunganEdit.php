<?php

namespace App\Livewire\Pustu\JadwalKunjungan;

use Livewire\Component;
use App\Models\JadwalKunjungan;
use App\Models\Anak;

class JadwalKunjunganEdit extends Component
{
    public $jadwalId;
    public $anak_id, $tanggal_kunjungan, $status;

    public function mount($id)
    {
        $jadwal = JadwalKunjungan::findOrFail($id);
        $this->jadwalId = $jadwal->id;
        $this->anak_id = $jadwal->anak_id;
        $this->tanggal_kunjungan = $jadwal->tanggal_kunjungan;
        $this->status = $jadwal->status;
    }

    public function update()
    {
        $this->validate([
            'anak_id' => 'required|exists:anak,id',
            'tanggal_kunjungan' => 'required|date',
            'status' => 'required|in:Belum Hadir,Hadir,Tidak Hadir',
        ]);

        $jadwal = JadwalKunjungan::findOrFail($this->jadwalId);
        $jadwal->update([
            'anak_id' => $this->anak_id,
            'tanggal_kunjungan' => $this->tanggal_kunjungan,
            'status' => $this->status,
        ]);

        session()->flash('success', 'Jadwal pemeriksaan berhasil diperbarui!');
        return redirect()->route('jadwal-kunjungan.index');
    }

    public function render()
    {
        return view('livewire.pustu.jadwal-kunjungan.jadwal-kunjungan-edit', [
            'anaks' => Anak::orderBy('nama')->get(),
        ]);
    }
}
