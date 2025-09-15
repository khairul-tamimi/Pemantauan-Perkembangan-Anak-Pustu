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
                    <input type="text" class="form-control" 
                        placeholder="Cari berdasarkan usia..."
                        wire:model.live="search">

                    <a href="{{ route('standar-pertumbuhan.create') }}" class="btn btn-primary">Tambah</a>
                </div>
            </div>

            <div class="card-body pt-0">
                <!-- Table starts -->
                <div class="table-responsive">
                    <table class="table truncate m-0 align-middle">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Jenis Kelamin</th>
                                <th class="text-center">Usia (bulan)</th>
                                <th class="text-center">BB (min - max)</th>
                                <th class="text-center">TB (min - max)</th>
                                <th class="text-center">LK (min - max)</th>
                                <th class="text-center">LL (min - max)</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($standarList as $index => $row)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $row->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                                    <td class="text-center">
                                        <span class="badge border border-primary text-primary">{{ $row->usia_bulan }}</span>
                                    </td>
                                    <td class="text-center">{{ $row->bb_min }} - {{ $row->bb_max }}</td>
                                    <td class="text-center">{{ $row->tb_min }} - {{ $row->tb_max }}</td>
                                    <td class="text-center">{{ $row->lk_min }} - {{ $row->lk_max }}</td>
                                    <td class="text-center">{{ $row->ll_min }} - {{ $row->ll_max }}</td>
                                    <td>
                                        <div class="d-inline-flex gap-1">
                                            <a href="{{ route('standar-pertumbuhan.edit', $row->id) }}" class="btn btn-success btn-sm"
                                                data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Edit Data">
                                                <i class="ri-edit-box-line"></i>
                                            </a>
                                            <button type="button" wire:click.prevent="deleteConfirmation('{{ $row->id }}')" 
                                                class="btn btn-danger btn-sm" 
                                                data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Hapus Data">
                                                <i class="ri-delete-bin-line"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center p-4 text-gray-500">Belum ada data standar pertumbuhan</td>
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
