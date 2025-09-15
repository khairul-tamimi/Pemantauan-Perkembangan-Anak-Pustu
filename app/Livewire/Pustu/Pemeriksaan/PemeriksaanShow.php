<?php

namespace App\Livewire\Pustu\Pemeriksaan;

use Livewire\Component;
use App\Models\Pemeriksaan;
use App\Models\TindakLanjut;

class PemeriksaanShow extends Component
{
    public $pemeriksaanId;
    public $delete_id;

    protected $listeners = ['delete' => 'destroyData'];

    public function mount($id)
    {
        $this->pemeriksaanId = $id;
    }

    public function deleteConfirmation($id)
    {
        $this->delete_id = $id;
        $this->dispatch('konfirmDelete'); // trigger JS modal
    }

    public function destroyData()
    {
        $tindak = TindakLanjut::findOrFail($this->delete_id);
        $tindak->delete();

        session()->flash('success', 'Tindak lanjut berhasil dihapus!');
    }

    public function render()
    {
        $pemeriksaan = Pemeriksaan::with(['anak', 'petugas', 'tindakLanjut'])
            ->findOrFail($this->pemeriksaanId);

        return view('livewire.pustu.pemeriksaan.pemeriksaan-show', [
            'pemeriksaan' => $pemeriksaan,
            'tindakLanjut' => $pemeriksaan->tindakLanjut,
        ]);
    }
}
