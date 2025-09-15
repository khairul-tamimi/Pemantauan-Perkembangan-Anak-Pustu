<?php

namespace App\Livewire\Pustu\RiwayatPosyandu;

use Livewire\Component;
use App\Models\RiwayatPosyandu;

class PosyanduCreate extends Component
{
    public $anak_id, $tanggal, $berat_badan, $tinggi_badan, $lingkar_kepala, $lingkar_lengan;

    protected $rules = [
        'tanggal' => 'required|date',
        'berat_badan' => 'required|numeric',
        'tinggi_badan' => 'required|numeric',
        'lingkar_kepala' => 'nullable|numeric',
        'lingkar_lengan' => 'nullable|numeric',
    ];

    public function store()
    {
        $this->validate();

        RiwayatPosyandu::create([
            'anak_id' => $this->anak_id,
            'tanggal' => $this->tanggal,
            'berat_badan' => $this->berat_badan,
            'tinggi_badan' => $this->tinggi_badan,
            'lingkar_kepala' => $this->lingkar_kepala,
            'lingkar_lengan' => $this->lingkar_lengan,
            'sumber_data' => 'Buku KIA'
        ]);

        session()->flash('success', 'Riwayat Posyandu berhasil ditambahkan.');
        return redirect()->route('posyandu.index', $this->anak_id);
    }

    public function render()
    {
        return view('livewire.pustu.riwayat-posyandu.posyandu-create');
    }
}
