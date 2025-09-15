<div class="card">
    <div class="card-header">
        <h5 class="card-title">Edit Tindak Lanjut</h5>
    </div>
    <div class="card-body">
        <form wire:submit.prevent="update">
            <div class="mb-3">
                <label class="form-label">Jenis</label>
                <select wire:model="jenis" class="form-control">
                    <option value="Kunjungan Rumah">Kunjungan Rumah</option>
                    <option value="PMT">PMT</option>
                    <option value="Rujuk Puskesmas">Rujuk Puskesmas</option>
                    <option value="Lainnya">Lainnya</option>
                </select>
                @error('jenis') <div class="text-danger">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Tanggal</label>
                <input type="datetime-local" wire:model="tanggal" class="form-control">
                @error('tanggal') <div class="text-danger">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Keterangan</label>
                <textarea wire:model="keterangan" class="form-control"></textarea>
            </div>

            <div class="d-flex justify-content-end gap-2">
                <a href="{{ route('pemeriksaan.show', $pemeriksaan_id) }}" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>
</div>
