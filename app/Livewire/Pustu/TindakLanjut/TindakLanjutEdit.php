<?php

namespace App\Livewire\Pustu\TindakLanjut;

use Livewire\Component;
use App\Models\TindakLanjut;

class TindakLanjutEdit extends Component
{
    public $tindak_lanjut_id;
    public $pemeriksaan_id;
    public $jenis;
    public $keterangan;
    public $tanggal;

    protected $rules = [
        'jenis' => 'required|string',
        'keterangan' => 'nullable|string',
        'tanggal' => 'nullable|date',
    ];

    public function mount($id)
    {
        $tindak = TindakLanjut::findOrFail($id);
        $this->tindak_lanjut_id = $tindak->id;
        $this->pemeriksaan_id = $tindak->pemeriksaan_id;
        $this->jenis = $tindak->jenis;
        $this->keterangan = $tindak->keterangan;
        $this->tanggal = optional($tindak->tanggal)->format('Y-m-d\TH:i');
    }

    public function update()
    {
        $this->validate();

        $tindak = TindakLanjut::findOrFail($this->tindak_lanjut_id);
        $tindak->update([
            'jenis' => $this->jenis,
            'keterangan' => $this->keterangan,
            'tanggal' => $this->tanggal,
        ]);

        session()->flash('success', 'Tindak lanjut berhasil diperbarui!');
        return redirect()->route('pemeriksaan.show', $this->pemeriksaan_id);
    }

    public function render()
    {
        return view('livewire.pustu.tindak-lanjut.tindak-lanjut-edit');
    }
}
