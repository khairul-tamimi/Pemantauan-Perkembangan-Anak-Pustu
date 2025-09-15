<?php

namespace App\Livewire\Konsultasi;

use Livewire\Component;
use App\Models\Konsultasi;
use App\Models\Anak;
use Illuminate\Support\Facades\Auth;

class Create extends Component
{
    public $anak_id, $keluhan;

    protected $rules = [
        'anak_id' => 'required|exists:anak,id',
        'keluhan' => 'required|string|max:500',
    ];

    public function mount()
    {
        $orangTua = Auth::user()->orangTua; // perhatikan huruf besar T
        $anak = $orangTua?->anak()->first(); // langsung pakai relasi anak

        $this->anak_id = $anak?->id; // isi otomatis kalau ada
    }

    public function save()
    {
        $this->validate();

        Konsultasi::create([
            'anak_id'    => $this->anak_id,
            'petugas_id' => null, // nanti diisi petugas
            'tanggal'    => now()->toDateString(),
            'keluhan'    => $this->keluhan,
        ]);

        session()->flash('success', 'Konsultasi berhasil ditambahkan.');
        $this->dispatch('konsultasiUpdated');
        return redirect()->route('konsultasi.index');
    }

    public function render()
    {
        return view('livewire.konsultasi.create');
    }
}
