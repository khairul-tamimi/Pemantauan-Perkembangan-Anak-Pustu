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
                <h5 class="card-title mb-0">List Riwayat Posyandu <span class="badge border border-primary text-primary">{{ $anak->nama }}</span> </h5>
                @if(in_array(Auth::user()->role, ['admin', 'petugas']))
                    <div class="d-flex gap-2">
                        <input type="text" class="form-control" 
                            placeholder="Cari..."
                            wire:model.live="search">

                        <a href="{{ route('posyandu.create', $anak->id) }}" class="btn btn-primary">Tambah</a>
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
                                <th>Tanggal</th>
                                <th>Berat Badan (kg)</th>
                                <th>Tinggi Badan (cm)</th>
                                <th>Lingkar Kepala (cm)</th>
                                <th>Lingkar Lengan (cm)</th>
                                @if(in_array(Auth::user()->role, ['admin', 'petugas']))
                                    <th>Aksi</th>
                                @endif
                            </tr>
                        </thead>

                        <tbody>
                        @forelse($riwayat as $index =>$r)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $r->tanggal }}</td>
                                <td>{{ $r->berat_badan }}</td>
                                <td>{{ $r->tinggi_badan }}</td>
                                <td>{{ $r->lingkar_kepala }}</td>
                                <td>{{ $r->lingkar_lengan }}</td>
                                @if(in_array(Auth::user()->role, ['admin', 'petugas']))
                                <td>
                                    <a href="{{route('posyandu.edit', $r->id)}}" class="btn btn-success btn-sm">
                                        <i class="ri-edit-box-line"></i>
                                    </a>
                                        <button type="button" wire:click.prevent="deleteConfirmation('{{ $r->id }}')" class="btn btn-danger btn-sm" data-bs-toggle="tooltip" data-bs-placement="top"
                                            data-bs-title="Hapus Data">
                                            <i class="ri-delete-bin-line"></i>
                                        </button>
                                        
                                    </td>
                                @endif
                            </tr>
                        @empty
                            <tr><td colspan="6">Belum ada data</td></tr>
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