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
                <h5 class="card-title mb-0">Standar Pertumbuhan</h5>

                <div class="d-flex gap-2">
                    <label for="filter_anak">Filter Anak:</label>
                    <select wire:model.live="filter_anak" id="filter_anak" class="border rounded p-1">
                        <option value="">-- Semua Anak --</option>
                        @foreach($anaks as $anak)
                            <option value="{{ $anak->id }}">{{ $anak->nama }}</option>
                        @endforeach
                    </select>

                    <a href="{{ route('jadwal-kunjungan.create') }}" class="btn btn-primary">Tambah</a>
                </div>
            </div>

            <div class="card-body pt-0">
                <!-- Table starts -->
                <div class="table-responsive">
                    <table class="table m-0 align-middle dataTable no-footer">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama Anak</th>
                                <th>Tanggal Kunjungan</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($jadwal as $index => $item)
                                <tr>
                                    <td>{{ $index+1}}</td>
                                    <td>{{ $item->anak->nama }}</td>
                                    <td>{{ \Carbon\Carbon::parse($item->tanggal_kunjungan)->translatedFormat('d F Y') }}</td>
                                    <td>
                                        <span class="badge 
                                            {{ $item->status === 'Hadir' ? 'bg-success' : ($item->status === 'Tidak Hadir' ? 'bg-danger' : 'bg-warning') }}">
                                            {{ $item->status }}
                                        </span>
                                    </td>
                                    <td>
                                        <a href="{{ route('jadwal-kunjungan.edit', $item->id) }}" class="btn btn-warning btn-sm" data-bs-toggle="tooltip" title="Edit">
                                            <i class="ri-edit-box-line"></i></a>
                                            <button type="button" wire:click.prevent="deleteConfirmation('{{ $item->id }}')"
                                                class="btn btn-danger btn-sm" data-bs-toggle="tooltip" data-bs-placement="top"
                                                data-bs-title="Hapus Data">
                                                <i class="ri-delete-bin-line"></i>
                                            </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class=" p-2 text-center text-gray-500">Belum ada jadwal kunjungan</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <!-- Table ends -->
            </div>
        </div>
    </div>
</div>
<!-- Row ends -->
