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

class AnakEdit extends Component
{
    use WithFileUploads;

    public $anakId;
    public $nama_anak, $tanggal_lahir, $jenis_kelamin;
    public $nama_ibu, $no_hp, $alamat;
    public $email;
    public $password; // password baru (opsional)
    public $foto; // foto baru (upload)
    public $oldFoto; // simpan foto lama user

    protected function rules()
    {
        return [
            'nama_anak'      => 'required|string|max:255',
            'tanggal_lahir'  => 'required|date',
            'jenis_kelamin'  => 'required|in:L,P',
            'nama_ibu'       => 'required|string|max:255',
            'no_hp'          => 'nullable|string|min:10|max:12',
            'alamat'         => 'nullable|string|max:255',
            'email'          => 'required|email|unique:users,email,' . $this->getUserId(),
            'password'       => 'nullable|string|min:6',
            'foto'           => 'nullable|image|mimes:jpg,jpeg,png|max:1024',
        ];
    }

    public function mount($id)
    {
        $anak = Anak::with('orangTua.user')->findOrFail($id);
        $this->anakId       = $anak->id;
        $this->nama_anak    = $anak->nama;
        $this->tanggal_lahir  = \Carbon\Carbon::parse($anak->tanggal_lahir)->format('Y-m-d');
        $this->jenis_kelamin = $anak->jenis_kelamin;

        $this->nama_ibu = $anak->orangTua->nama;
        $this->no_hp    = $anak->orangTua->no_hp;
        $this->alamat   = $anak->orangTua->alamat;
        $this->email    = $anak->orangTua->user->email;
        $this->oldFoto  = $anak->orangTua->user->foto;
    }

    private function getUserId()
    {
        $anak = Anak::with('orangTua.user')->find($this->anakId);
        return $anak?->orangTua?->user?->id;
    }

    public function update()
    {
        $this->validate();

        DB::beginTransaction();
        try {
            $anak = Anak::with('orangTua.user')->findOrFail($this->anakId);

            // update foto kalau ada
            $fotoPath = $this->oldFoto;
            if ($this->foto) {
                // hapus foto lama
                if ($this->oldFoto && Storage::disk('public')->exists($this->oldFoto)) {
                    Storage::disk('public')->delete($this->oldFoto);
                }
                $fotoPath = $this->foto->store('foto_user', 'public');
            }

            // update user
            $anak->orangTua->user->update([
                'name'  => $this->nama_ibu,
                'email' => $this->email,
                'foto'  => $fotoPath,
                'password' => $this->password 
                    ? Hash::make($this->password)
                    : $anak->orangTua->user->password, // tetap pakai lama kalau kosong
            ]);

            // update orang tua
            $anak->orangTua->update([
                'nama'   => $this->nama_ibu,
                'no_hp'  => $this->no_hp,
                'alamat' => $this->alamat,
            ]);

            // update anak
            $anak->update([
                'nama'          => $this->nama_anak,
                'tanggal_lahir' => $this->tanggal_lahir,
                'jenis_kelamin' => $this->jenis_kelamin,
            ]);

            DB::commit();

            session()->flash('success', 'Data anak berhasil diperbarui!');
            return redirect()->route('anak.index');

        } catch (\Throwable $e) {
            DB::rollBack();
            session()->flash('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.pustu.anak.anak-edit');
    }
}
