<!-- Row starts -->
<div class="row gx-3">
    <div class="col-sm-12">

        {{-- Alerts --}}
        @if(session()->has('success'))
            <div class="alert bg-success text-white alert-dismissible d-flex align-items-center fade show" role="alert">
                <i style="color: white" class="ri-checkbox-circle-line fs-3 me-2 lh-1"></i>
                {{ session('success') }}.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if(session()->has('error'))
            <div class="alert bg-danger text-white alert-dismissible d-flex align-items-center fade show" role="alert">
                <i style="color: white" class="ri-close-circle-line fs-3 me-2 lh-1"></i>
                {{ session('error') }}.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        {{-- Card --}}
        <div class="card">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h5 class="card-title mb-0">Edit Standar Pertumbuhan</h5>
                <a href="{{ route('standar-pertumbuhan.index') }}" class="btn btn-secondary btn-sm">Kembali</a>
            </div>

            <div class="card-body">
                <form wire:submit.prevent="update">
                    <div class="row g-3">

                        <div class="col-md-6">
                            <label class="form-label">Jenis Kelamin</label>
                            <select class="form-select" wire:model="jenis_kelamin">
                                <option value="">-- Pilih --</option>
                                <option value="L">Laki-laki</option>
                                <option value="P">Perempuan</option>
                            </select>
                            @error('jenis_kelamin') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Usia (bulan)</label>
                            <input type="number" class="form-control" wire:model="usia_bulan">
                            @error('usia_bulan') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">BB (min)</label>
                            <input type="number" step="0.01" class="form-control" wire:model="bb_min">
                            @error('bb_min') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">BB (max)</label>
                            <input type="number" step="0.01" class="form-control" wire:model="bb_max">
                            @error('bb_max') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">TB (min)</label>
                            <input type="number" step="0.1" class="form-control" wire:model="tb_min">
                            @error('tb_min') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">TB (max)</label>
                            <input type="number" step="0.1" class="form-control" wire:model="tb_max">
                            @error('tb_max') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">LK (min)</label>
                            <input type="number" step="0.1" class="form-control" wire:model="lk_min">
                            @error('lk_min') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">LK (max)</label>
                            <input type="number" step="0.1" class="form-control" wire:model="lk_max">
                            @error('lk_max') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">LL (min)</label>
                            <input type="number" step="0.1" class="form-control" wire:model="ll_min">
                            @error('ll_min') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">LL (max)</label>
                            <input type="number" step="0.1" class="form-control" wire:model="ll_max">
                            @error('ll_max') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                    </div>

                    <div class="mt-4 d-flex justify-content-end gap-2">
                        <a href="{{ route('standar-pertumbuhan.index') }}" class="btn btn-secondary">Batal</a>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>
<!-- Row ends -->
