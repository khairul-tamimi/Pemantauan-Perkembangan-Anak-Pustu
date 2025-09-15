<?php

namespace App\Livewire\User;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserCreate extends Component
{
    use WithFileUploads;

    public $name, $email, $role, $password, $foto;

    public function save()
    {
        $this->validate([
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users,email',
            'role' => 'required|in:admin,petugas,orang_tua',
            'password' => 'required|min:6',
            'foto' => 'nullable|image|max:2048', // max 2MB
        ]);

        $path = null;
        if ($this->foto) {
            $path = $this->foto->store('foto_user', 'public');
        }

        User::create([
            'name' => $this->name,
            'email' => $this->email,
            'role' => $this->role,
            'password' => Hash::make($this->password),
            'foto' => $path,
        ]);

        session()->flash('success', 'User berhasil ditambahkan.');

        return redirect()->route('users.index');
    }

    public function render()
    {
        return view('livewire.user.user-create');
    }
}
