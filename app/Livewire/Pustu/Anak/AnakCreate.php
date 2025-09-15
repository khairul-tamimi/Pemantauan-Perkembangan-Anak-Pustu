<?php

namespace App\Livewire\Pustu\Anak;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\User;
use App\Models\OrangTua;
use App\Models\Anak;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class AnakCreate extends Component
{
    use WithFileUploads;

    public $nama_anak, $tanggal_lahir, $jenis_kelamin;
    public $nama_ibu, $no_hp, $alamat;
    public $email;
    public $foto; // upload foto orang tua

    protected $rules = [
        'nama_anak'      => 'required|string|max:255',
        'tanggal_lahir'  => 'required|date',
        'jenis_kelamin'  => 'required|in:L,P',
        'nama_ibu'       => 'required|string|max:255',
        'no_hp'          => 'nullable|string|min:10|max:13',
        'alamat'         => 'nullable|string|max:255',
        'email'          => 'required|email|unique:users,email',
        'foto'           => 'nullable|image|mimes:jpg,jpeg,png|max:1024',
    ];

        public function updated($propertyName)
    {
        $this->validateOnly($propertyName, $this->rules);
    }

    public function store()
    {
        $this->validate();

        DB::beginTransaction();
        try {
            // simpan foto kalau ada
            $fotoPath = null;
            if ($this->foto) {
                $fotoPath = $this->foto->store('foto_user', 'public');
            }

            // buat user dengan password default
            $user = User::create([
                'name'     => $this->nama_ibu,
                'email'    => $this->email,
                'password' => Hash::make('orangtua123'), // default password
                'role'     => 'orang_tua',
                'foto'     => $fotoPath,
            ]);

            // buat orang tua
            $orangTua = OrangTua::create([
                'user_id' => $user->id,
                'nama'    => $this->nama_ibu,
                'no_hp'   => $this->no_hp,
                'alamat'  => $this->alamat,
            ]);

            // simpan anak
            Anak::create([
                'orang_tua_id'  => $orangTua->id,
                'nama'          => $this->nama_anak,
                'tanggal_lahir' => $this->tanggal_lahir,
                'jenis_kelamin' => $this->jenis_kelamin,
            ]);

            DB::commit();

            session()->flash('success', 'Anak berhasil didaftarkan!');
            return redirect()->route('anak.index');

        } catch (\Throwable $e) {
            DB::rollBack();

            if (!empty($fotoPath) && Storage::disk('public')->exists($fotoPath)) {
                Storage::disk('public')->delete($fotoPath);
            }

            session()->flash('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.pustu.anak.anak-create');
    }
}
