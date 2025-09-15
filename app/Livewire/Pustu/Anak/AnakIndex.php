<?php

namespace App\Livewire\Pustu\Anak;

use Livewire\Component;
use App\Models\Anak;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class AnakIndex extends Component
{

    public $search = '';

    protected $updatesQueryString = ['search'];
    public $delete_id;
    protected $listeners = ['delete' => 'destroyData'];

    public function deleteConfirmation($id)
    {
        $this->delete_id = $id;
        $this->dispatch('konfirmDelete');
    }

    public function destroyData()
    {
        $anak = \App\Models\Anak::with('orangTua.user')->findOrFail($this->delete_id);

        // ambil data user & foto lama
        $orangTua = $anak->orangTua;
        $user     = $orangTua->user ?? null;
        $foto     = $user?->foto;

        DB::beginTransaction();
        try {
            // hapus anak dulu
            $anak->delete();

            // hapus orang tua
            if ($orangTua) {
                $orangTua->delete();
            }

            // hapus user
            if ($user) {
                $user->delete();
            }

            // hapus foto di storage
            if ($foto && Storage::disk('public')->exists($foto)) {
                Storage::disk('public')->delete($foto);
            }

            DB::commit();

            session()->flash('success', 'Data anak & orang tua berhasil dihapus!');
        } catch (\Throwable $e) {
            DB::rollBack();
            session()->flash('error', 'Gagal hapus data: '.$e->getMessage());
        }
    }

    public function render()
    {
        $query = Anak::with('orangTua.user');

        if (auth()->user()->role === 'orang_tua') {
            // hanya anak milik orang tua yang login
            $query->where('orang_tua_id', auth()->user()->orangTua->id);
        } else {
            // admin & petugas → tampil semua anak
            $query->when($this->search, function ($query) {
                $query->where('nama', 'like', '%'.$this->search.'%')
                    ->orWhereHas('orangTua', function ($q) {
                        $q->where('nama', 'like', '%'.$this->search.'%');
                    });
            });
        }

        $anakList = $query->latest()->paginate(10);

        return view('livewire.pustu.anak.anak-index', compact('anakList'));
    }

}
