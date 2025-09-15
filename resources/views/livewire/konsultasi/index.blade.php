
    <div class="row gx-3">
        <div class="col-sm-12">
            <div class="d-flex justify-content-between mb-3">
                <h4>Daftar Konsultasi</h4>
            </div>

            <div class="d-flex gap-2 mb-3">
                <input type="text" class="form-control" placeholder="Cari nama anak / orang tua..."
                    wire:model.live="search">

                <a href="{{ route('konsultasi.create') }}" class="btn btn-primary">Tambah</a>
            </div>

            @if(session()->has('success'))
            <div class="alert bg-success text-white alert-dismissible d-flex align-items-center fade show" role="alert">
                <i style="color: white" class="ri-checkbox-circle-line fs-3 me-2 lh-1"></i>{{ session('success') }}.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
            @if(session()->has('error'))
            <div class="alert bg-danger text-white alert-dismissible d-flex align-items-center fade show" role="alert">
                <i style="color: white" class="ri-checkbox-circle-line fs-3 me-2 lh-1"></i>{{ session('error') }}.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
            @if(session()->has('warning'))
            <div class="alert bg-warning text-white alert-dismissible d-flex align-items-center fade show" role="alert">
                <i style="color: white" class="ri-checkbox-circle-line fs-3 me-2 lh-1"></i>{{ session('warning') }}.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            <table class="table m-0 align-middle dataTable no-footer">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Anak</th>
                        <th>Tanggal</th>
                        <th>Keluhan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($konsultasi as $index => $item)
                    <tr>
                        <td>{{ $konsultasi->firstItem() + $index }}</td>
                        <td>{{ $item->anak->nama ?? '-' }}</td>
                        <td>{{ $item->tanggal }}</td>
                        <td>{{ $item->keluhan }}</td>
                        <td>
                            <div class="d-inline-flex gap-1">
                                @if(in_array(Auth::user()->role, ['orang_tua']))
                                    @php
                                        $hasChat = \App\Models\KonsultasiChat::where('konsultasi_id', $item->id)->exists();
                                    @endphp

                                    <a href="{{ route('konsultasi.edit', $item->id) }}"
                                    class="btn btn-info btn-sm {{ $hasChat ? 'disabled' : '' }}"
                                    data-bs-toggle="tooltip" data-bs-placement="top" 
                                    data-bs-title="{{ $hasChat ? 'Tidak bisa edit, sudah ada percakapan' : 'Edit Data' }}">
                                        <i class="ri-edit-box-line"></i>
                                    </a>
                                @endif
                                    <a href="{{ route('konsultasi.chat', $item->id) }}" class="btn btn-success btn-sm"
                                        data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Riwayat Konsultasi">
                                        <i class="ri-chat-1-line"></i>
                                    </a>
                                @if(in_array(Auth::user()->role, ['admin']))
                                    <button type="button" wire:click.prevent="deleteConfirmation('{{ $item->id }}')"
                                        class="btn btn-danger btn-sm" data-bs-toggle="tooltip" data-bs-placement="top"
                                        data-bs-title="Hapus Data">
                                        <i class="ri-delete-bin-line"></i>
                                    </button>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center">Belum ada data</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>

            {{ $konsultasi->links() }}
        </div>
    </div>

