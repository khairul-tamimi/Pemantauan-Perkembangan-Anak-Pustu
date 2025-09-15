<div class="row gx-3">
    <div class="col-12">
        <div class="card mb-3">
            <div class="card-body mh-190 d-flex flex-column">

                <h5 class="fw-bold mb-3">Pesan Tindak Lanjut</h5>

                <div class="chat-messages flex-grow-1" style="max-height:350px; overflow-y:auto;">
                    @forelse($tindakLanjut as $tl)
                        <div class="d-flex mb-3 {{ $tl->is_read ? 'justify-content-start' : 'justify-content-end' }}">
                            <div class="p-3 rounded-4 shadow-sm 
                                {{ $tl->is_read ? 'bg-light text-dark' : 'bg-primary text-white' }}"
                                style="max-width: 100%;">

                                                                {{-- Header: jenis tindak lanjut + tanggal --}}
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <small class="fw-semibold">{{ $tl->jenis ?? '-' }}</small>
                                    <small class="{{ $tl->is_read ? 'text-muted' : 'text-white-50' }}">
                                        {{ $tl->created_at?->format('d-m-Y') ?? '-' }}
                                    </small>
                                </div>

                                @if($tl->pemeriksaan)
                                    <div class="small mb-2 {{ $tl->is_read ? 'text-muted' : 'text-white-75' }}">
                                        <div>BB: {{ $tl->pemeriksaan->berat_badan }} kg, 
                                             TB: {{ $tl->pemeriksaan->tinggi_badan }} cm</div>
                                        <div>Status: {{ $tl->pemeriksaan->status_bbu }} / {{ $tl->pemeriksaan->status_tbu }}</div>
                                    </div>
                                @endif
                                <hr>

                                {{-- Jika ada jadwal kunjungan --}}
                                @if($tl->tanggal)
                                    @php
                                        $hari    = \Carbon\Carbon::parse($tl->tanggal_kunjungan)->translatedFormat('l'); 
                                        $tanggal = \Carbon\Carbon::parse($tl->tanggal_kunjungan)->format('d-m-Y');       
                                        $jam     = \Carbon\Carbon::parse($tl->tanggal_kunjungan)->format('H:i');         
                                    @endphp

                                    <div class="small fst-italic {{ $tl->is_read ? 'text-muted' : 'text-white-75' }}">
                                    <div class="lh-sm">{{ $tl->keterangan ?? '-' }}</div>
                                        <ul class="mb-0 ps-3">
                                            <li>Hari: <strong>{{ $hari }}</strong></li>
                                            <li>Tanggal: <strong>{{ $tanggal }}</strong></li>
                                            <li>Jam: <strong>{{ $jam }}</strong></li>
                                        </ul>
                                    </div>
                                @endif


                                {{-- Tombol tandai dibaca --}}
                                @if(!$tl->is_read)
                                    <div class="text-end mt-2">
                                        <button wire:click="markAsRead({{ $tl->id }})"
                                            class="btn btn-sm btn-light text-primary px-2 py-0">
                                            <i class="bi bi-check2-circle me-1"></i> Tandai sudah dibaca
                                        </button>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @empty
                        <p class="text-muted text-center">Belum ada tindak lanjut.</p>
                    @endforelse
                </div>

            </div>
        </div>
    </div>
</div>
