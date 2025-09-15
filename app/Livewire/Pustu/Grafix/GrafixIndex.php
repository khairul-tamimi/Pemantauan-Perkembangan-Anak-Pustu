<?php

namespace App\Livewire\Pustu\Grafix;

use Livewire\Component;
use App\Models\Anak;
use App\Models\Pemeriksaan;
use Illuminate\Support\Facades\Log;

class GrafixIndex extends Component
{
    public $anak_id;
    public $grafik = [];

    public function mount()
    {
        $this->loadData();
    }

    public function updatedAnakId()
    {
        $this->loadData();
    }

public function loadData()
{
    if (!$this->anak_id) {
        $this->grafik = []; 
        return;
    }

    $records = Pemeriksaan::where('anak_id', $this->anak_id)
        ->orderBy('tanggal')
        ->get();

    // cek isi data
    Log::info('DATA PEMERIKSAAN', $records->toArray());

    $this->grafik = [
        'labels' => $records->pluck('tanggal')
                            ->map(fn($d) => date('d-m-Y', strtotime($d)))
                            ->toArray(),
        'berat'  => $records->pluck('berat_badan')->toArray(),
        'tinggi' => $records->pluck('tinggi_badan')->toArray(),
        'lingkar_kepala' => $records->pluck('lingkar_kepala')->toArray(),
        'lingkar_lengan' => $records->pluck('lingkar_lengan')->toArray(),
    ];

    $this->dispatch('refreshChart', $this->grafik);

}


    public function render()
    {
        $anakQuery = Anak::orderBy('nama');

        if (auth()->user()->role === 'orang_tua') {
            $anakQuery->where('orang_tua_id', auth()->user()->orangTua->id);
        }

        return view('livewire.pustu.grafix.grafix-index', [
            'anakList' => $anakQuery->get()
        ]);
    }

}