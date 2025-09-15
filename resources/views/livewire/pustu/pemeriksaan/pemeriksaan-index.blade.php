<div class="row gx-3">
    <div class="col-sm-12">

        {{-- Alert --}}
        @if(session()->has('success'))
            <div class="alert bg-success text-white alert-dismissible d-flex align-items-center fade show" role="alert">
                <i class="ri-checkbox-circle-line fs-3 me-2 lh-1"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if(session()->has('error'))
            <div class="alert bg-danger text-white alert-dismissible d-flex align-items-center fade show" role="alert">
                <i class="ri-close-circle-line fs-3 me-2 lh-1"></i> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if(session()->has('warning'))
            <div class="alert bg-warning text-white alert-dismissible d-flex align-items-center fade show" role="alert">
                <i class="ri-alert-line fs-3 me-2 lh-1"></i> {{ session('warning') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        {{-- Card Pemeriksaan --}}
        <div class="card">
            @if(in_array(Auth::user()->role, ['admin', 'petugas']))
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">Daftar Pemeriksaan</h5>
                    <a href="{{ route('pemeriksaan.create') }}" class="btn btn-primary btn-sm">
                        <i class="ri-add-line me-1"></i> Tambah Pemeriksaan
                    </a>
                </div>
            @endif

            <div class="card-body">
                <div class="mb-3">
                    <label for="anak_id" class="form-label">Pilih Anak</label>
                    <select wire:model.live="anak_id" id="anak_id" class="form-control">
                        <option value="">-- Pilih Anak --</option>
                        @foreach($anakList as $anak)
                            <option value="{{ $anak->id }}">{{ $anak->nama }}</option>
                        @endforeach
                    </select>
                </div>

                @if($anak_id)
                    <h6 class="mb-3">
                        Riwayat Pemeriksaan: 
                        <strong>{{ \App\Models\Anak::find($anak_id)->nama }} | Umur: <span class="badge border border-primary text-primary">{{ hitungUmur(\App\Models\Anak::find($anak_id)->tanggal_lahir) }}</span></strong>
                    </h6>

                    <div class="table-responsive">
                        <table class="table m-0 align-middle dataTable no-footer">
                            <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th>Tanggal</th>
                                    <th>BB (kg) | BB</th>
                                    <th>TB (cm) | TB</th>
                                    <th>Status BB</th>
                                    <th>Status TB</th>
                                    <th>Lingkar Kepala | LK</th>
                                    <th>Lingkar Lengan | LL</th>
                                    <th>Status LK</th>
                                    <th>Status LL</th>
                                    <th>Petugas</th>
                                    <th style="width:120px">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($pemeriksaan as $index => $periksa)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $periksa->tanggal }} | Umur: {{ hitungUmur($periksa->anak->tanggal_lahir, $periksa->tanggal) }}</td>
                                        <td>{{ $periksa->berat_badan }} | {{ $periksa->perubahan_bb ?? '-' }}</td>
                                        <td>{{ $periksa->tinggi_badan }} | {{ $periksa->perubahan_tb ?? '-' }}</td>
                                        <td>{{ $periksa->status_bbu ?? '-' }}</td>
                                        <td>{{ $periksa->status_tbu ?? '-' }}</td>
                                        <td>{{ $periksa->lingkar_kepala }} | {{ $periksa->perubahan_lk ?? '-' }}</td>
                                        <td>{{ $periksa->lingkar_lengan }} | {{ $periksa->perubahan_ll ?? '-' }}</td>
                                        <td>{{ $periksa->status_lk ?? '-' }}</td>
                                        <td>{{ $periksa->status_ll ?? '-' }}</td>
                                        <td>{{ $periksa->petugas?->name ?? '-' }}</td>
                                        <td class="text-center">
                                            <a href="{{ route('pemeriksaan.show', $periksa->id) }}" 
                                            class="btn btn-sm {{ $periksa->tindakLanjut->isNotEmpty() ? 'btn-info' : 'btn-success' }}" 
                                            data-bs-toggle="tooltip" 
                                            title="Detail">
                                                <i class="ri-eye-line"></i>
                                            </a>

                                             @if(in_array(Auth::user()->role, ['admin', 'petugas']))
                                                <a href="{{ route('pemeriksaan.edit', $periksa->id) }}" 
                                                class="btn btn-warning btn-sm" data-bs-toggle="tooltip" title="Edit">
                                                    <i class="ri-edit-box-line"></i>
                                                </a>
                                                <button type="button" 
                                                        wire:click.prevent="deleteConfirmation('{{ $periksa->id }}')" 
                                                        class="btn btn-danger btn-sm" 
                                                        data-bs-toggle="tooltip" 
                                                        title="Hapus">
                                                    <i class="ri-delete-bin-line"></i>
                                                </button>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="11" class="text-center">Belum ada pemeriksaan</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
