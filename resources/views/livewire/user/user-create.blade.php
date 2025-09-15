<div class="row gx-3">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Tambah Data Anak</h5>
            </div>
            <div class="card-body">

                <form wire:submit.prevent="save" enctype="multipart/form-data">
                    <div class="mb-2">
                        <label>Nama</label>
                        <input type="text" wire:model="name" class="form-control">
                        @error('name') <small class="text-danger">{{ $message }}</small>@enderror
                    </div>

                    <div class="mb-2">
                        <label>Email</label>
                        <input type="email" wire:model="email" class="form-control">
                        @error('email') <small class="text-danger">{{ $message }}</small>@enderror
                    </div>

                    <div class="mb-2">
                        <label>Role</label>
                        <select wire:model="role" class="form-control">
                            <option value="">-- Pilih Role --</option>
                            <option value="admin">Admin</option>
                            <option value="petugas">Petugas</option>
                            <option value="orang_tua">Orang Tua</option>
                        </select>
                        @error('role') <small class="text-danger">{{ $message }}</small>@enderror
                    </div>

                    <div class="mb-2">
                        <label>Password</label>
                        <input type="password" wire:model="password" class="form-control">
                        @error('password') <small class="text-danger">{{ $message }}</small>@enderror
                    </div>

                    <div class="mb-2">
                        <label>Foto</label>
                        <input type="file" wire:model="foto" class="form-control">
                        @error('foto') <small class="text-danger">{{ $message }}</small>@enderror

                        @if ($foto)
                            <div class="mt-2">
                                <img src="{{ $foto->temporaryUrl() }}" alt="Preview" width="120" class="img-thumbnail">
                            </div>
                        @endif
                    </div>

                    <button class="btn btn-primary">Simpan</button>
                    <a href="{{ route('users.index') }}" class="btn btn-secondary">Kembali</a>
                </form>

            </div>
        </div>
    </div>
</div>

