<div>
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
    {{-- ===== Page Header ===== --}}
    @php
        $mapBBU = [
            'Gizi Baik'   => 'success',
            'Gizi Kurang' => 'warning',
            'Gizi Buruk'  => 'danger',
            'Gizi Lebih'  => 'warning',
        ];
        $mapTBU = [
            'Normal' => 'success',
            'Pendek' => 'warning',
            'Tinggi' => 'primary',
        ];
        $clsBBU = $mapBBU[$pemeriksaan->status_bbu ?? ''] ?? 'secondary';
        $clsTBU = $mapTBU[$pemeriksaan->status_tbu ?? ''] ?? 'secondary';
    @endphp

    <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mb-3">
        <div>
            <h4 class="mb-1">
                Detail Pemeriksaan — {{ $pemeriksaan->anak->nama }}
            </h4>
            <div class="text-muted small">
                {{ \Carbon\Carbon::parse($pemeriksaan->tanggal)->format('d M Y') }}
                • Umur: {{ hitungUmur($pemeriksaan->anak->tanggal_lahir) }}
                • Petugas: <strong>{{ $pemeriksaan->petugas->name ?? '-' }}</strong>
            </div>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('pemeriksaan.index') }}" class="btn btn-outline-secondary">
                <i class="ri-arrow-left-line"></i> Kembali
            </a>
            @if(in_array(Auth::user()->role, ['admin', 'petugas']))
                <a href="{{ route('tindak-lanjut.create', $pemeriksaan->id) }}" class="btn btn-primary">
                    <i class="ri-add-line"></i> Tambah Tindak Lanjut
                </a>
                <a href="{{ route('pemeriksaan.edit', $pemeriksaan->id) }}" class="btn btn-warning">
                    <i class="ri-edit-2-line"></i> Edit Pemeriksaan
                </a>
            @endif
        </div>
    </div>

    {{-- Badge ringkas status --}}
    <div class="d-flex flex-wrap gap-2 mb-4">
        <span class="badge bg-{{ $clsBBU }}">Status BB/U: {{ $pemeriksaan->status_bbu ?? '-' }}</span>
        <span class="badge bg-{{ $clsTBU }}">Status TB/U: {{ $pemeriksaan->status_tbu ?? '-' }}</span>

        @if($pemeriksaan->perubahan_bb)
            <span class="badge bg-light text-dark border">
                @if($pemeriksaan->perubahan_bb === 'Naik')
                    <i class="ri-arrow-up-line"></i>
                @elseif($pemeriksaan->perubahan_bb === 'Turun')
                    <i class="ri-arrow-down-line"></i>
                @else
                    <i class="ri-subtract-line"></i>
                @endif
                Δ BB: {{ $pemeriksaan->perubahan_bb }}
            </span>
        @endif

        @if($pemeriksaan->perubahan_tb)
            <span class="badge bg-light text-dark border">
                @if($pemeriksaan->perubahan_tb === 'Naik')
                    <i class="ri-arrow-up-line"></i>
                @elseif($pemeriksaan->perubahan_tb === 'Turun')
                    <i class="ri-arrow-down-line"></i>
                @else
                    <i class="ri-subtract-line"></i>
                @endif
                Δ TB: {{ $pemeriksaan->perubahan_tb }}
            </span>
        @endif
    </div>

    {{-- ===== Detail Pemeriksaan ===== --}}
    <div class="card mb-4">
        <div class="card-header">
            <h5 class="card-title mb-0">Data Pemeriksaan</h5>
        </div>
        <div class="card-body">
            <table class="table table-bordered m-0">
                <tr>
                    <th style="width: 240px;">Anak</th>
                    <td>{{ $pemeriksaan->anak->nama }} ({{ hitungUmur($pemeriksaan->anak->tanggal_lahir) }})</td>
                </tr>
                <tr>
                    <th>Tanggal</th>
                    <td>{{ \Carbon\Carbon::parse($pemeriksaan->tanggal)->format('d M Y') }}</td>
                </tr>
                <tr>
                    <th>Berat Badan</th>
                    <td>{{ $pemeriksaan->berat_badan }} kg <span class="badge bg-{{ $clsBBU }}">{{ $pemeriksaan->status_bbu ?? '-' }}</span></td>
                </tr>
                <tr>
                    <th>Tinggi Badan</th>
                    <td>{{ $pemeriksaan->tinggi_badan }} cm <span class="badge bg-{{ $clsTBU }}">{{ $pemeriksaan->status_tbu ?? '-' }}</span></td>
                </tr>
                <tr>
                    <th>Lingkar Kepala</th>
                    <td>{{ $pemeriksaan->lingkar_kepala ?? '-' }} {{ $pemeriksaan->lingkar_kepala ? 'cm' : '' }}</td>
                </tr>
                <tr>
                    <th>Lingkar Lengan</th>
                    <td>{{ $pemeriksaan->lingkar_lengan ?? '-' }} {{ $pemeriksaan->lingkar_lengan ? 'cm' : '' }}</td>
                </tr>
                <tr>
                    <th>Δ Berat / Tinggi</th>
                    <td>
                        <span class="me-3">BB: {{ $pemeriksaan->perubahan_bb ?? '-' }}</span>
                        <span>TB: {{ $pemeriksaan->perubahan_tb ?? '-' }}</span>
                    </td>
                </tr>
                <tr>
                    <th>Keluhan</th>
                    <td>{{ $pemeriksaan->keluhan ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Diagnosa / Catatan</th>
                    <td>{{ $pemeriksaan->catatan ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Petugas</th>
                    <td>{{ $pemeriksaan->petugas->name ?? '-' }}</td>
                </tr>
            </table>
        </div>
    </div>

    {{-- ===== Tindak Lanjut ===== --}}
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <h5 class="card-title mb-0">Tindak Lanjut</h5>
        </div>
        <div class="card-body pt-0">
            <div class="table-responsive">
                <table class="table align-middle table-striped table-borderless m-0">
                    <thead class="table-light">
                        <tr>
                            <th style="width: 60px;">#</th>
                            <th style="width: 140px;">Tanggal</th>
                            <th style="width: 180px;">Jenis</th>
                            <th>Keterangan</th>
                            @if(in_array(Auth::user()->role, ['admin', 'petugas']))
                                <th style="width: 160px;" class="text-end">Aksi</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($tindakLanjut as $i => $tl)
                            <tr>
                                <td>{{ $i+1 }}</td>
                                <td>{{ $tl->tanggal ? \Carbon\Carbon::parse($tl->tanggal)->format('d M Y') : '-' }}</td>
                                <td><span class="badge bg-secondary">{{ $tl->jenis }}</span></td>
                                <td class="text-break">{{ $tl->keterangan ?? '-' }}</td>
                                @if(in_array(Auth::user()->role, ['admin', 'petugas']))
                                    <td class="text-end">
                                        <a href="{{ route('tindak-lanjut.edit', $tl->id) }}" class="btn btn-sm btn-warning">
                                            <i class="ri-edit-2-line"></i>
                                        </a>
                                        <button wire:click="deleteConfirmation({{ $tl->id }})" class="btn btn-sm btn-danger">
                                            <i class="ri-delete-bin-line"></i>
                                        </button>
                                    </td>
                                @endif
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-4 text-muted">Belum ada tindak lanjut.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
