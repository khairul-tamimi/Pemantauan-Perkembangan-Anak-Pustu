<div class="row gx-3">
  <div class="col-sm-12">
    <div class="card">
      <div class="card-header">
        <h5 class="card-title">Edit Data Anak</h5>
      </div>
      <div class="card-body">

        <form wire:submit.prevent="update" enctype="multipart/form-data">
          <!-- Nama Anak -->
          <div class="mb-3">
            <label class="form-label">Nama Anak</label>
            <input type="text" class="form-control" wire:model="nama_anak">
            @error('nama_anak') <small class="text-danger">{{ $message }}</small> @enderror
          </div>

          <!-- Tanggal Lahir -->
          <div class="mb-3">
            <label class="form-label">Tanggal Lahir</label>
            <input type="date" class="form-control" wire:model="tanggal_lahir" accept=".jpg,.jpeg,.png">
            @error('tanggal_lahir') <small class="text-danger">{{ $message }}</small> @enderror
          </div>

          <!-- Jenis Kelamin -->
          <div class="mb-3">
            <label class="form-label">Jenis Kelamin</label>
            <div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" wire:model="jenis_kelamin" value="L">
                <label class="form-check-label">Laki-laki</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" wire:model="jenis_kelamin" value="P">
                <label class="form-check-label">Perempuan</label>
              </div>
            </div>
            @error('jenis_kelamin') <small class="text-danger">{{ $message }}</small> @enderror
          </div>

          <hr>

          <!-- Nama Orang Tua -->
          <div class="mb-3">
            <label class="form-label">Nama Orang Tua</label>
            <input type="text" class="form-control" wire:model="nama_ibu">
            @error('nama_ibu') <small class="text-danger">{{ $message }}</small> @enderror
          </div>

          <!-- Email Orang Tua -->
          <div class="mb-3">
            <label class="form-label">Email Orang Tua</label>
            <input type="email" class="form-control" wire:model="email">
            @error('email') <small class="text-danger">{{ $message }}</small> @enderror
          </div>

          <!-- Password Baru (opsional) -->
          <div class="mb-3">
            <label class="form-label">Password Baru</label>
            <input type="password" class="form-control" wire:model="password" placeholder="Kosongkan jika tidak diganti">
            @error('password') <small class="text-danger">{{ $message }}</small> @enderror
          </div>

          <!-- No HP Orang Tua -->
          <div class="mb-3">
            <label class="form-label">No HP Orang Tua</label>
            <input type="text" class="form-control" wire:model="no_hp">
            @error('no_hp') <small class="text-danger">{{ $message }}</small> @enderror
          </div>

          <!-- Alamat -->
          <div class="mb-3">
            <label class="form-label">Alamat</label>
            <input type="text" class="form-control" wire:model="alamat">
            @error('alamat') <small class="text-danger">{{ $message }}</small> @enderror
          </div>

          <!-- Foto Orang Tua -->
          <div class="mb-3">
            <label class="form-label">Foto Orang Tua</label>
            <input type="file" class="form-control" wire:model="foto">
            @if ($foto)
              <img src="{{ $foto->temporaryUrl() }}" class="img-thumbnail mt-2" width="120">
            @elseif ($oldFoto)
              <img src="{{ asset('storage/' . $oldFoto) }}" class="img-thumbnail mt-2" width="120">
            @endif
            @error('foto') <small class="text-danger">{{ $message }}</small> @enderror
          </div>

          <!-- Tombol -->
          <div class="d-flex gap-2 justify-content-end">
            <a href="{{ route('anak.index') }}" class="btn btn-outline-secondary">Batal</a>
            <button type="submit" class="btn btn-primary">Update</button>
          </div>
        </form>

      </div>
    </div>
  </div>
</div>
