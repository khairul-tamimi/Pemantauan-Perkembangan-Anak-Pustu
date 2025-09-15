<div class="row gx-3">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Tambah Data Anak</h5>
            </div>
            <div class="card-body">

                <form wire:submit.prevent="update">

                    <div class="mb-3">
                        <label class="form-label">Tanggal<span class="text-danger">*</span></label>
                        <input type="date" class="form-control" wire:model="tanggal">
                        @error('tanggal') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Berat Badan (kg)<span class="text-danger">*</span></label>
                        <input type="number" step="0.1"  class="form-control" wire:model="berat_badan">
                        @error('berat_badan') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Tinggi Badan (cm)<span class="text-danger">*</span></label>
                        <input type="number" step="0.1"  class="form-control" wire:model="tinggi_badan">
                        @error('tinggi_badan') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Lingkar Kepala (cm)<span class="text-danger">*</span></label>
                        <input type="number" step="0.1"  class="form-control" wire:model="lingkar_kepala">
                        @error('lingkar_kepala') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Lingkar Lengan (cm)<span class="text-danger">*</span></label>
                        <input type="number" step="0.1"  class="form-control" wire:model="lingkar_lengan">
                        @error('lingkar_lengan') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <!-- Tombol -->
                    <div class="d-flex gap-2 justify-content-end">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
