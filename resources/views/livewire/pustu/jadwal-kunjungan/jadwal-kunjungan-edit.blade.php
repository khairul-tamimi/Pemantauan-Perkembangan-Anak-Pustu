

<!-- Row starts -->
<div class="row gx-3">
    <div class="col-sm-12">

        {{-- Card --}}
        <div class="card">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h5 class="card-title mb-0">Tambah Jadwal Pemeriksaan</h5>
            </div>

            <div class="card-body">
                <form wire:submit.prevent="update">
                    <div class="row g-3">

                        <div class="col-md-12">
                            <select wire:model="anak_id" class="form-select">
                                <option value="">-- Pilih Anak --</option>
                                @foreach($anaks as $anak)
                                    <option value="{{ $anak->id }}">{{ $anak->nama }}</option>
                                @endforeach
                            </select>
                            @error('jenis_kelamin') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        <div class="col-md-12">
                            <label>Tanggal Kunjungan</label>
                            <input type="date" wire:model="tanggal_kunjungan" class="form-control">
                            @error('tanggal_kunjungan') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>


                    <div class="mt-4 d-flex justify-content-end gap-2">
                        <a href="{{ route('jadwal-kunjungan.index') }}" class="btn btn-secondary">Batal</a>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>
<!-- Row ends -->
