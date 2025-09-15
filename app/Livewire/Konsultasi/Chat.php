<?php
namespace App\Livewire\Konsultasi;

use Livewire\Component;
use App\Models\Konsultasi;
use App\Models\KonsultasiChat;
use Illuminate\Support\Facades\Auth;

class Chat extends Component
{
    public $konsultasi;
    public $pesan;

    protected $rules = [
        'pesan' => 'required|string|max:500',
    ];

    public function mount($id)
    {
        $this->konsultasi = Konsultasi::findOrFail($id);
    }

    public function kirimPesan()
    {
        $this->validate();

        KonsultasiChat::create([
            'konsultasi_id' => $this->konsultasi->id,
            'user_id'       => Auth::id(),
            'pesan'         => $this->pesan,
        ]);

        $this->pesan = '';
    }

    public function render()
    {
        $chats = KonsultasiChat::with('user')
            ->where('konsultasi_id', $this->konsultasi->id)
            ->orderBy('created_at')
            ->get();

        return view('livewire.konsultasi.chat', compact('chats'));
    }
}
