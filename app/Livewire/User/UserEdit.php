<?php
namespace App\Livewire\User;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserEdit extends Component
{
    use WithFileUploads;

    public $userId, $name, $email, $role, $password, $foto, $oldFoto;

    public function mount($id)
    {
        $user = User::findOrFail($id);
        $this->userId = $user->id;
        $this->name   = $user->name;
        $this->email  = $user->email;
        $this->role   = $user->role;
        $this->oldFoto = $user->foto;
    }

    public function update()
    {
        $this->validate([
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users,email,' . $this->userId,
            'role' => 'required|in:admin,petugas,orang_tua',
            'password' => 'nullable|min:6',
            'foto' => 'nullable|image|max:2048',
        ]);

        $user = User::findOrFail($this->userId);

        $path = $this->oldFoto;
        if ($this->foto) {
            if ($this->oldFoto && Storage::disk('public')->exists($this->oldFoto)) {
                Storage::disk('public')->delete($this->oldFoto);
            }
            $path = $this->foto->store('foto_user', 'public');
        }

        $data = [
            'name' => $this->name,
            'email' => $this->email,
            'role' => $this->role,
            'foto' => $path,
        ];

        if ($this->password) {
            $data['password'] = Hash::make($this->password);
        }

        $user->update($data);

        session()->flash('success', 'User berhasil diupdate.');

        return redirect()->route('users.index');
    }

    public function render()
    {
        return view('livewire.user.user-edit');
    }
}
