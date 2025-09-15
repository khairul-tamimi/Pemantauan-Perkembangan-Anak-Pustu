<?php

namespace App\Livewire\Pustu\RiwayatPosyandu;

use Livewire\Component;
use App\Models\RiwayatPosyandu;
use App\Models\Anak;

class PosyanduIndex extends Component
{
    public $anak_id;
    public $delete_id;
    protected $listeners = ['delete' => 'destroyData'];

    public function deleteConfirmation($id)
    {
        $this->delete_id = $id;
        $this->dispatch('konfirmDelete'); // untuk trigger JS confirm modal
    }

    public function destroyData()
    {
        $riwayat = RiwayatPosyandu::findOrFail($this->delete_id);
        $riwayat->delete();

        session()->flash('success', 'Riwayat posyandu berhasil dihapus!');
    }

    public function mount($anak_id)
    {
        $this->anak_id = $anak_id;
    }

    public function render()
    {
        $anak = Anak::findOrFail($this->anak_id);
        $riwayat = RiwayatPosyandu::where('anak_id', $this->anak_id)
                    ->orderBy('tanggal', 'desc')
                    ->get();

        return view('livewire.pustu.riwayat-posyandu.posyandu-index', [
            'anak' => $anak,
            'riwayat' => $riwayat
        ]);
    }
}
