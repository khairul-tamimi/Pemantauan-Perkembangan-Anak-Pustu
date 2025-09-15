<?php

namespace App\Livewire\Pustu\TindakLanjut;

use Livewire\Component;
use App\Models\TindakLanjut;
use App\Models\Pemeriksaan;
use App\Notifications\TindakLanjutNotification;

class TindakLanjutCreate extends Component
{
    public $pemeriksaan_id, $jenis, $keterangan, $tanggal;
    public $tindak;
    public function save()
    {
        $this->validate([
            'pemeriksaan_id' => 'required|exists:pemeriksaan,id',
            'jenis'          => 'required|in:Kunjungan Rumah,PMT,Rujuk Puskesmas,Lainnya',
            'keterangan'     => 'nullable|string',
            'tanggal'        => 'nullable|date',
        ]);

        TindakLanjut::create([
            'pemeriksaan_id' => $this->pemeriksaan_id,
            'jenis'          => $this->jenis,
            'keterangan'     => $this->keterangan,
            'tanggal'        => $this->tanggal,
        ]);

        session()->flash('success', 'Tindak lanjut berhasil ditambahkan!');
        return redirect()->route('pemeriksaan.show', $this->pemeriksaan_id);
    }

    public function render()
    {
        return view('livewire.pustu.tindak-lanjut.tindak-lanjut-create', [
            'pemeriksaan' => Pemeriksaan::find($this->pemeriksaan_id),
        ]);
    }
}
