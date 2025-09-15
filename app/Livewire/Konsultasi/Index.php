<?php

namespace App\Livewire\Konsultasi;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Konsultasi;

class Index extends Component
{
    use WithPagination;

    public $search = '';

    protected $listeners = [
        'konsultasiUpdated' => '$refresh',
        'delete' => 'destroyData',
    ];

        public $delete_id;

    public function deleteConfirmation($id)
    {
        $this->delete_id = $id;
        $this->dispatch('konfirmDelete'); // trigger modal JS
    }

    public function destroyData()
    {
        $data = Konsultasi::findOrFail($this->delete_id);
        $data->delete();

        session()->flash('success', 'Data berhasil dihapus!');
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $konsultasi = Konsultasi::with(['anak', 'petugas'])
            ->when(auth()->user()->role === 'orang_tua', function ($q) {
                $q->whereHas('anak', function ($anakQ) {
                    $anakQ->where('orang_tua_id', auth()->user()->orangTua->id);
                });
            })
            ->when($this->search, fn($q) =>
                $q->where('keluhan', 'like', "%{$this->search}%")
                ->orWhereHas('anak', fn($anakQ) => $anakQ->where('nama', 'like', "%{$this->search}%"))
            )
            ->latest()
            ->paginate(10);

        return view('livewire.konsultasi.index', [
            'konsultasi' => $konsultasi,
        ]);
    }


    // public function render()
    // {
    //     $konsultasi = Konsultasi::with(['anak', 'petugas'])
    //         ->when($this->search, fn($q) =>
    //             $q->where('keluhan', 'like', "%{$this->search}%")
    //               ->orWhereHas('anak', fn($q) => $q->where('nama', 'like', "%{$this->search}%"))
    //         )
    //         ->latest()
    //         ->paginate(10);

    //     return view('livewire.konsultasi.index', [
    //         'konsultasi' => $konsultasi,
    //     ]);
    // }
}
