<div class="row gx-3">
    <div class="col-xxl-12 col-sm-12">
        <div class="card mb-3 bg-4 shadow-sm">
            <div class="card-body">
                <div class="row gx-3 align-items-center mb-3">
                    <div class="col-sm-9">
                        <div class="text-primary">
                            <h4 class="mb-1">Selamat Datang</h4>
                            <h6 class="fw-normal mb-0">{{ Auth::user()->name }}</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Jika role admin/petugas tampilkan statistik --}}
    @if(Auth::user()->role === 'admin' || Auth::user()->role === 'petugas')
        <div class="col-xxl-12 col-sm-12">
            <div class="row gx-3">
                <div class="col-md-3 mb-3">
                    <div class="card h-100 bg-success text-white shadow-sm">
                        <div class="card-body d-flex flex-column justify-content-center text-center">
                            <h6 class="mb-2">Gizi Baik</h6>
                            <h2 class="fw-bold mb-0">{{ $statistik['Gizi Baik'] }}</h2>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <div class="card h-100 bg-warning text-dark shadow-sm">
                        <div class="card-body d-flex flex-column justify-content-center text-center">
                            <h6 class="mb-2">Gizi Kurang</h6>
                            <h2 class="fw-bold mb-0">{{ $statistik['Gizi Kurang'] }}</h2>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <div class="card h-100 bg-danger text-white shadow-sm">
                        <div class="card-body d-flex flex-column justify-content-center text-center">
                            <h6 class="mb-2">Gizi Buruk</h6>
                            <h2 class="fw-bold mb-0">{{ $statistik['Gizi Buruk'] }}</h2>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <div class="card h-100 bg-info text-white shadow-sm">
                        <div class="card-body d-flex flex-column justify-content-center text-center">
                            <h6 class="mb-2">Gizi Lebih</h6>
                            <h2 class="fw-bold mb-0">{{ $statistik['Gizi Lebih'] }}</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    {{-- Jika role orang_tua tampilkan anak-anaknya --}}
    @if(Auth::user()->role === 'orang_tua')
        <div class="col-xxl-12 col-sm-12">

        </div>

        <div class="row gx-3">
            <div class="col-xl-8 col-sm-12">

                <!-- Row starts -->
                <div class="row gx-3">
                    <div class="col-sm-12">
                        <div class="card mb-3">
                            <div class="card-header">
                                <h5 class="card-title">Jadwal Pemeriksaan</h5>
                            </div>
                                @foreach($anakSaya as $anak)
                                    <div class="mb-3">
                                        <div class="table-responsive">
                                            <table class="table m-0 align-middle dataTable no-footer">
                                                <thead class="table-light">
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Nama</th>
                                                        <th>Tanggal Pemeriksaan</th>
                                                        <th>Status</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse($anak->jadwalKunjungan as $index => $jadwal)
                                                        <tr>
                                                            <td>{{ $index + 1 }}</td>
                                                            <td>{{ $anak->nama }}</td>
                                                            <td>{{ \Carbon\Carbon::parse($jadwal->tanggal_kunjungan)->format('d M Y') }}</td>
                                                            <td>
                                                                <span class="badge 
                                                                    {{ $jadwal->status === 'Hadir' ? 'bg-success' : ($jadwal->status === 'Tidak Hadir' ? 'bg-danger' : 'bg-warning') }}">
                                                                    {{ $jadwal->status }}
                                                                </span>
                                                            </td>
                                                        </tr>
                                                    @empty
                                                        <tr>
                                                            <td colspan="3" class="text-center">Belum ada jadwal kunjungan</td>
                                                        </tr>
                                                    @endforelse
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                @endforeach
                        </div>
                    </div>
                </div>
                <!-- Row ends -->
            </div>
            <div class="col-xl-4 col-sm-12">

                <!-- Row starts -->
                <div class="row gx-3">
                    @forelse($anakSaya as $anak)
                        <div class="col-md-12 mb-3">
                            <div class="card border-0 shadow-lg rounded-4 h-100">
                                {{-- Header Card --}}
                                <div class="card-header border-0 rounded-top-4">
                                    <h5 class="fw-bold mb-0 text-primary">👶 {{ $anak->nama }}</h5>
                                    <small class="text-muted">
                                        Lahir: {{ \Carbon\Carbon::parse($anak->tanggal_lahir)->format('d-m-Y') }} | Umur: {{ hitungUmur($anak->tanggal_lahir) }}
                                    </small>
                                    <hr>
                                </div>

                                {{-- Body Card --}}
                                <div class="card-body">
                                    @if($anak->pemeriksaan->isNotEmpty())
                                        @php $last = $anak->pemeriksaan->first(); @endphp
                                        <p class="mb-2"><strong>Status Gizi:</strong> 
                                            <span class="badge badge-sm px-3 py-2 fs-6
                                                @if($last->status_bbu == 'Gizi Baik') bg-success 
                                                @elseif($last->status_bbu == 'Gizi Kurang') bg-warning text-dark
                                                @elseif($last->status_bbu == 'Gizi Buruk') bg-danger 
                                                @else bg-info @endif">
                                                {{ $last->status_bbu }}
                                            </span>
                                        </p>

                                        {{-- Tabel Pemeriksaan --}}
                                        <div class="table-responsive">
                                            <table class="table table-sm table-borderless mb-0">
                                                <tr>
                                                    <th width="45%">Tgl Periksa</th>
                                                    <td>: {{ \Carbon\Carbon::parse($last->tanggal)->format('d-m-Y') }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Berat</th>
                                                    <td>: {{ $last->berat_badan }} kg</td>
                                                </tr>
                                                <tr>
                                                    <th>Tinggi</th>
                                                    <td>: {{ $last->tinggi_badan }} cm</td>
                                                </tr>
                                                <tr>
                                                    <th>Lingkar Kepala</th>
                                                    <td>: {{ $last->lingkar_kepala ?? '-' }} cm</td>
                                                </tr>
                                                <tr>
                                                    <th>Catatan</th>
                                                    <td>: <em>{{ $last->catatan ?? 'Tidak ada' }}</em></td>
                                                </tr>
                                            </table>
                                        </div>
                                    @else
                                        <div class="alert alert-light text-muted py-2">
                                            <em>Belum ada data pemeriksaan</em>
                                        </div>
                                    @endif
                                </div>

                                {{-- Footer Card --}}
                                <div class="card-footer bg-white border-0 d-flex justify-content-end">
                                    <a href="{{ route('orangtua.tindak-lanjut') }}" class="btn btn-sm btn-outline-primary rounded-pill">
                                        📊 Notifikasi
                                    </a>
                                    <a href="{{ route('konsultasi.index', $anak->id) }}" class="btn btn-sm btn-primary rounded-pill">
                                        💬 Konsultasi
                                    </a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12">
                            <div class="alert alert-info shadow-sm">Belum ada data anak terdaftar.</div>
                        </div>
                    @endforelse
                </div>
                <!-- Row ends -->

            </div>
        </div>
    @endif



</div>
