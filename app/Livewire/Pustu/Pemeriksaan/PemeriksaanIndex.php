<?php

namespace App\Livewire\Pustu\Pemeriksaan;

use Livewire\Component;
use App\Models\Pemeriksaan;
use App\Models\Anak;

class PemeriksaanIndex extends Component
{
    public $anak_id = null;
    public $delete_id;

    protected $listeners = ['delete' => 'destroyData'];

    public function deleteConfirmation($id)
    {
        $this->delete_id = $id;
        $this->dispatch('konfirmDelete'); // trigger modal JS
    }

    public function destroyData()
    {
        $pemeriksaan = Pemeriksaan::findOrFail($this->delete_id);
        $pemeriksaan->delete();

        session()->flash('success', 'Pemeriksaan berhasil dihapus!');
    }

    public function render()
    {
        $anakQuery = Anak::query();

        if (auth()->user()->role === 'orang_tua') {
            // hanya anak milik orang tua yg login
            $anakQuery->where('orang_tua_id', auth()->user()->orangTua->id);
        }

        $anakList = $anakQuery->get(); // untuk dropdown

        $pemeriksaan = [];

        if ($this->anak_id) {
            $pemeriksaan = Pemeriksaan::with(['anak', 'petugas'])
                ->where('anak_id', $this->anak_id)
                ->orderBy('tanggal', 'desc')
                ->get();
        }

        return view('livewire.pustu.pemeriksaan.pemeriksaan-index', [
            'anakList' => $anakList,
            'pemeriksaan' => $pemeriksaan
        ]);
    }

}
