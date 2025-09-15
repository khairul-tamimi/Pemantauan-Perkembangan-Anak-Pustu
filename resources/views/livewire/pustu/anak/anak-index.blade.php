<!-- Row starts -->
<div class="row gx-3">
    <div class="col-sm-12">
        @if(session()->has('success'))
            <div class="alert bg-success text-white alert-dismissible d-flex align-items-center fade show" role="alert">
                <i style="color: white"
                    class="ri-checkbox-circle-line fs-3 me-2 lh-1"></i>{{ session('success') }}.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if(session()->has('error'))
            <div class="alert bg-danger text-white alert-dismissible d-flex align-items-center fade show" role="alert">
                <i style="color: white"
                    class="ri-checkbox-circle-line fs-3 me-2 lh-1"></i>{{ session('error') }}.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if(session()->has('warning'))
            <div class="alert bg-warning text-white alert-dismissible d-flex align-items-center fade show" role="alert">
                <i style="color: white"
                    class="ri-checkbox-circle-line fs-3 me-2 lh-1"></i>{{ session('warning') }}.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="card">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h5 class="card-title mb-0">Data Anak</h5>
                {{-- @if(Auth::user()->role === 'orang_tua') --}}
                @if(in_array(Auth::user()->role, ['admin', 'petugas']))
                    <div class="d-flex gap-2">
                        <input type="text" class="form-control" 
                            placeholder="Cari nama anak / orang tua..."
                            wire:model.live="search">

                        <a href="{{ route('anak.create') }}" class="btn btn-primary">Tambah</a>
                    </div>
                @endif
            </div>

            <div class="card-body pt-0">

                <!-- Table starts -->
                <div class="table-responsive">
                    <table id="scrollVertical" class="table truncate m-0 align-middle">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama Anak</th>
                                <th class="text-center">Umur</th>
                                <th class="text-center">Nama Orang Tua</th>
                                <th class="text-center">E-mail</th>
                                <th class="text-center">Kontak</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($anakList as $index => $anak)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>
                                        {{ $anak->nama }}
                                    </td>
                                    <td class="text-center text-info">
                                        <span class="badge border border-primary text-primary">{{ hitungUmur($anak->tanggal_lahir) }}</span>
                                    </td>
                                    <td class="text-center">{{ $anak->orangTua->nama }}</td>
                                    <td class="text-center">{{ $anak->orangTua->user->email }}</td>
                                    <td class="text-center">{{ $anak->orangTua->no_hp }}</td>
                                    <td>
                                        <div class="d-inline-flex gap-1">
                                            <a href="{{ route('posyandu.index', $anak->id) }}" class="btn btn-info btn-sm" data-bs-toggle="tooltip" data-bs-placement="top"
                                                data-bs-title="Riwayat Posyandu">
                                                <i class="ri-user-heart-fill"></i>
                                            </a>
                                            <a href="{{route('anak.edit', $anak->id)}}" class="btn btn-success btn-sm"
                                                data-bs-toggle="tooltip" data-bs-placement="top"
                                                data-bs-title="Edit Data">
                                                <i class="ri-edit-box-line"></i>
                                            </a>
                                            @if(in_array(Auth::user()->role, ['admin', 'petugas']))
                                                <button type="button" wire:click.prevent="deleteConfirmation('{{ $anak->id }}')" class="btn btn-danger btn-sm" data-bs-toggle="tooltip" data-bs-placement="top"
                                                    data-bs-title="Hapus Data">
                                                <i class="ri-delete-bin-line"></i>
                                                </button>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center p-4 text-gray-500">Belum ada data anak</td>
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