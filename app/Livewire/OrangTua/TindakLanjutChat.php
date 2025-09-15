<?php

namespace App\Livewire\OrangTua;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\TindakLanjut;

class TindakLanjutChat extends Component
{
    public $tindakLanjut = [];

    protected $listeners = ['refreshTindakLanjut' => 'loadTindakLanjut'];

    public function mount()
    {
        $this->loadTindakLanjut();
    }

    public function loadTindakLanjut()
    {
        $user = Auth::user();

        $this->tindakLanjut = TindakLanjut::whereHas('pemeriksaan.anak.orangTua', function($q) use ($user){
            $q->where('user_id', $user->id);
        })
        ->orderBy('tanggal', 'desc')
        ->get();

    }

    // Tandai pesan sudah dibaca
    public function markAsRead($tindakLanjutId)
    {
        $tl = TindakLanjut::find($tindakLanjutId);
        if($tl) {
            $tl->is_read = true;
            $tl->save();
            $this->loadTindakLanjut();
        }
    }

    public function render()
    {
        return view('livewire.orang-tua.tindak-lanjut-chat');
    }
}
