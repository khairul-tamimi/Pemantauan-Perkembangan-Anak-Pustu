<div>
    <h4>Tambah Konsultasi</h4>

    @if (session()->has('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form wire:submit.prevent="save">
        <div class="mb-3">
            <label>Nama Anak</label>
            <input type="text" 
                   class="form-control" 
                   value="{{ \App\Models\Anak::find($anak_id)?->nama }}" 
                   disabled>
            <input type="hidden" wire:model="anak_id"> 
            @error('anak_id') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label for="keluhan">Keluhan</label>
            <textarea wire:model="keluhan" id="keluhan" rows="3" class="form-control"></textarea>
            @error('keluhan') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <button class="btn btn-primary">Simpan</button>
        <a href="{{ route('konsultasi.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
