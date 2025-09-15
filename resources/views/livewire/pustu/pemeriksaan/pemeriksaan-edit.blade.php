<div class="card">
    <div class="card-header">
        <h5 class="card-title">Edit Pemeriksaan</h5>
    </div>
    <div class="card-body">

              <div class="alert alert-info mb-4">
            <strong>ℹ️ Info:</strong> Status gizi dihitung berdasarkan
            <span class="fw-bold">Standar Pertumbuhan Anak WHO</span> 
            sesuai usia dan jenis kelamin anak.
        </div>
        <form wire:submit.prevent="update">
            
            <div class="mb-3">
                <label for="anak_id" class="form-label">Pilih Anak</label>
                <select wire:model="anak_id" id="anak_id" class="form-control" disabled>
                    @foreach($anaks as $anak)
                        <option value="{{ $anak->id }}">
                            {{ $anak->nama }} ({{ hitungUmur($anak->tanggal_lahir) }})
                        </option>
                    @endforeach
                </select>
                @error('anak_id') <span class="text-danger">{{ $message }}</span> @enderror
                <small class="text-muted">* Tidak bisa ubah anak</small>
            </div>

            <div class="mb-3">
                <label class="form-label">Tanggal</label>
                <input type="date" wire:model="tanggal" class="form-control">
                @error('tanggal') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <div class="row">
                <div class="col-md-3 mb-3">
                    <label class="form-label">Berat Badan (kg)</label>
                    <input type="number" step="0.1" wire:model="berat_badan" class="form-control">
                    @error('berat_badan') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="col-md-3 mb-3">
                    <label class="form-label">Tinggi Badan (cm)</label>
                    <input type="number" step="0.1" wire:model="tinggi_badan" class="form-control">
                    @error('tinggi_badan') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="col-md-3 mb-3">
                    <label class="form-label">Lingkar Kepala (cm)</label>
                    <input type="number" step="0.1" wire:model="lingkar_kepala" class="form-control">
                </div>
                <div class="col-md-3 mb-3">
                    <label class="form-label">Lingkar Lengan (cm)</label>
                    <input type="number" step="0.1" wire:model="lingkar_lengan" class="form-control">
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Keluhan</label>
                <textarea wire:model="keluhan" class="form-control" rows="2"></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Diagnosa / Catatan</label>
                <textarea wire:model="catatan" class="form-control" rows="3"></textarea>
            </div>

            <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-success">
                    <i class="bi bi-save"></i> Update
                </button>
                <a href="{{ route('pemeriksaan.index') }}" class="btn btn-secondary">
                    <i class="bi bi-x-circle"></i> Batal
                </a>
            </div>
        </form>
    </div>
</div>
