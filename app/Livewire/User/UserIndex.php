<?php

namespace App\Livewire\User;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserIndex extends Component
{
    use WithPagination;

    public $search = '';

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
        $data = User::findOrFail($this->delete_id);
        $data->delete();

        session()->flash('success', 'Data berhasil dihapus!');
    }

    public function render()
    {
        $query = User::query();

        if (Auth::user()->role === 'admin') {
            // Admin lihat semua admin & petugas
            $query->whereIn('role', ['admin', 'petugas']);
        } elseif (Auth::user()->role === 'petugas') {
            // Petugas hanya lihat datanya sendiri
            $query->where('id', Auth::id());
        }

        // Tambahin filter search kalau ada
        if ($this->search) {
            $query->where(function ($q) {
                $q->where('name', 'like', "%{$this->search}%")
                ->orWhere('email', 'like', "%{$this->search}%");
            });
        }

        $users = $query->orderBy('id', 'desc')->paginate(10);

        return view('livewire.user.user-index', compact('users'));
    }


}
