<!-- Row starts -->
<div class="row gx-3">
    <div class="col-sm-12">

        {{-- Alert messages --}}
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
            <div class="alert bg-warning text-dark alert-dismissible d-flex align-items-center fade show" role="alert">
                <i class="ri-alert-line fs-3 me-2 lh-1"></i> {{ session('warning') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card shadow-sm rounded-4">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h5 class="card-title mb-0">
                    List User 
                    <span class="badge border border-primary text-primary"></span>
                </h5>

                <div class="d-flex gap-2">
                @if(in_array(Auth::user()->role, ['admin']))
                    <input type="text" class="form-control"
                           placeholder="Cari..."
                           wire:model.live="search">
                    
                    {{-- tombol ke form create --}}
                    <a href="{{ route('users.create') }}" class="btn btn-primary">Tambah</a>
                @endif
                </div>
            </div>

            <div class="card-body pt-0">
                <!-- Table starts -->
                <div class="table-responsive">
                    <table class="table m-0 align-middle dataTable no-footer">
                        <thead>
                            <tr>
                                <th>Foto</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th width="150">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($users as $user)
                                <tr>
                                    <td>
                                        @if($user->foto)
                                            <img src="{{ asset('storage/'.$user->foto) }}" 
                                                 alt="foto" class="rounded-circle" width="40" height="40">
                                        @else
                                            <span class="badge bg-secondary">N/A</span>
                                        @endif
                                    </td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td><span class="badge bg-info">{{ ucfirst($user->role) }}</span></td>
                                    <td>
                                            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-info btn-sm"
                                                data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Edit Data">
                                                <i class="ri-edit-box-line"></i>
                                            </a>
                                        @if(in_array(Auth::user()->role, ['admin']))
                                            <button type="button" wire:click.prevent="deleteConfirmation('{{ $user->id }}')"
                                                class="btn btn-danger btn-sm" data-bs-toggle="tooltip" data-bs-placement="top"
                                                data-bs-title="Hapus Data">
                                                <i class="ri-delete-bin-line"></i>
                                            </button>
                                        @endif
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted">Tidak ada data user</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <!-- Table ends -->

                {{-- Pagination --}}
                <div class="mt-3">
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Row ends -->
