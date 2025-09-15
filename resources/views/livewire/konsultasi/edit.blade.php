<div>
    <h4>Edit Konsultasi</h4>

    @if (session()->has('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form wire:submit.prevent="update">
        <div class="mb-3">
            <label>Nama Anak</label>

            @if (Auth::user()->role === 'orang_tua')
                {{-- Orang tua tidak bisa ganti anak --}}
                <input type="text" 
                       class="form-control" 
                       value="{{ \App\Models\Anak::find($anak_id)?->nama }}" 
                       disabled>
                <input type="hidden" wire:model="anak_id"> 
            @else
                {{-- Admin/Petugas bisa pilih anak --}}
                <select class="form-control" wire:model="anak_id">
                    <option value="">-- pilih anak --</option>
                    @foreach($anakList as $anak)
                        <option value="{{ $anak->id }}">{{ $anak->nama }}</option>
                    @endforeach
                </select>
            @endif

            @error('anak_id') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label for="keluhan">Keluhan</label>
            <textarea wire:model="keluhan" id="keluhan" rows="3" class="form-control"></textarea>
            @error('keluhan') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <button class="btn btn-primary">Update</button>
        <a href="{{ route('konsultasi.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
