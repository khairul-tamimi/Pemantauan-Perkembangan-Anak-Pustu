<?php

namespace App\Livewire\Pustu\JadwalKunjungan;

use Livewire\Component;
use App\Models\JadwalKunjungan;
use App\Models\Anak;

class JadwalKunjunganIndex extends Component
{
    public $filter_anak = '';

            protected $listeners = [
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
        $data = JadwalKunjungan::findOrFail($this->delete_id);
        $data->delete();

        session()->flash('success', 'Data berhasil dihapus!');
    }

    public function render()
    {
        $jadwal = JadwalKunjungan::with('anak')
            ->when($this->filter_anak, function ($query) {
                $query->where('anak_id', $this->filter_anak);
            })
            ->orderBy('tanggal_kunjungan', 'desc')
            ->get();

        return view('livewire.pustu.jadwal-kunjungan.jadwal-kunjungan-index', [
            'jadwal' => $jadwal,
            'anaks' => Anak::orderBy('nama')->get(),
        ]);
    }
}
