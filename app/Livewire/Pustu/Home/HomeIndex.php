<?php

namespace App\Livewire\Pustu\Home;

use Livewire\Component;
use App\Models\Pemeriksaan;
use Illuminate\Support\Facades\Auth;

class HomeIndex extends Component
{
    public $statistik = [];
    public $anakSaya = [];

    public function mount()
    {
        $user = Auth::user();

        // Jika admin/petugas => tampilkan statistik global
        if ($user->role === 'admin' || $user->role === 'petugas') {
            $latestPemeriksaan = Pemeriksaan::select('id','anak_id','status_bbu','tanggal')
                ->whereIn('id', function($q){
                    $q->selectRaw('MAX(id)')
                      ->from('pemeriksaan')
                      ->groupBy('anak_id');
                })
                ->get();

            $statistik = $latestPemeriksaan->groupBy('status_bbu')->map->count();

            $this->statistik = [
                'Gizi Baik'   => $statistik->get('Gizi Baik', 0),
                'Gizi Kurang' => $statistik->get('Gizi Kurang', 0),
                'Gizi Buruk'  => $statistik->get('Gizi Buruk', 0),
                'Gizi Lebih'  => $statistik->get('Gizi Lebih', 0),
            ];
        }

        // Jika orang tua => tampilkan data anak mereka
    if ($user->role === 'orang_tua') {
        $this->anakSaya = $user->orangTua?->anak()
            ->with([
                'pemeriksaan' => function($q){
                    $q->latest('tanggal');
                },
                'jadwalKunjungan' => function($q){
                    $q->orderBy('tanggal_kunjungan', 'desc');
                }
            ])->get() ?? [];
    }

    }

    public function render()
    {
        return view('livewire.pustu.home.home-index');
    }
}
