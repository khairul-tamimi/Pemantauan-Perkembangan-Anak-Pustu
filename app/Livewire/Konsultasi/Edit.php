<?php

namespace App\Livewire\Konsultasi;

use Livewire\Component;
use App\Models\Konsultasi;
use App\Models\Anak;
use Illuminate\Support\Facades\Auth;

class Edit extends Component
{
    public $konsultasi_id, $anak_id, $keluhan;

    protected $rules = [
        'anak_id' => 'required|exists:anak,id',
        'keluhan' => 'required|string|max:500',
    ];

    public function mount($id)
    {
        $konsultasi = Konsultasi::with('anak')->findOrFail($id);

        // Simpan data awal ke properti
        $this->konsultasi_id = $konsultasi->id;
        $this->anak_id       = $konsultasi->anak_id;
        $this->keluhan       = $konsultasi->keluhan;
    }

    public function update()
    {
        $this->validate();

        $konsultasi = Konsultasi::findOrFail($this->konsultasi_id);

        $konsultasi->update([
            'anak_id' => $this->anak_id,
            'keluhan' => $this->keluhan,
        ]);

        session()->flash('success', 'Konsultasi berhasil diperbarui.');
        $this->dispatch('konsultasiUpdated');
        return redirect()->route('konsultasi.index');
    }

    public function render()
    {
        // kalau orang tua, hanya tampil anak miliknya
        if (Auth::user()->role === 'orang_tua') {
            $anakList = Auth::user()->orangTua->anak()->get();
        } else {
            $anakList = Anak::orderBy('nama')->get();
        }

        return view('livewire.konsultasi.edit', [
            'anakList' => $anakList,
        ]);
    }
}
