<?php

namespace App\Livewire\Pustu\RiwayatPosyandu;

use Livewire\Component;
use App\Models\RiwayatPosyandu;

class PosyanduEdit extends Component
{
    public $riwayat_id, $anak_id, $tanggal, $berat_badan, $tinggi_badan, $lingkar_kepala, $lingkar_lengan;

    protected $rules = [
        'tanggal' => 'required|date',
        'berat_badan' => 'required|numeric',
        'tinggi_badan' => 'required|numeric',
        'lingkar_kepala' => 'nullable|numeric',
        'lingkar_lengan' => 'nullable|numeric',
    ];

    public function mount($riwayat_id)
    {
        $riwayat = RiwayatPosyandu::findOrFail($riwayat_id);
        $this->riwayat_id = $riwayat->id;
        $this->anak_id = $riwayat->anak_id;
        $this->tanggal = $riwayat->tanggal;
        $this->berat_badan = $riwayat->berat_badan;
        $this->tinggi_badan = $riwayat->tinggi_badan;
        $this->lingkar_kepala = $riwayat->lingkar_kepala;
        $this->lingkar_lengan = $riwayat->lingkar_lengan;
    }

    public function update()
    {
        $this->validate();

        RiwayatPosyandu::where('id', $this->riwayat_id)->update([
            'tanggal' => $this->tanggal,
            'berat_badan' => $this->berat_badan,
            'tinggi_badan' => $this->tinggi_badan,
            'lingkar_kepala' => $this->lingkar_kepala,
            'lingkar_lengan' => $this->lingkar_lengan,
        ]);

        session()->flash('success', 'Riwayat Posyandu berhasil diperbarui.');
        return redirect()->route('posyandu.index', $this->anak_id);
    }

    public function render()
    {
        return view('livewire.pustu.riwayat-posyandu.posyandu-edit');
    }
}
