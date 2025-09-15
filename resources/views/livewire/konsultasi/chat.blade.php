<div class="col-12">
    <div class="card mb-3 shadow-lg rounded-4" style="height: 80vh;">
        <div class="card-body d-flex flex-column">

            <h5 class="fw-bold mb-3">Pesan Konsultasi</h5>

            {{-- Chat Body --}}
            <div id="chatBody" class="chat-messages flex-grow-1 p-2"
                style="overflow-y:auto; overflow-x:hidden; word-wrap:break-word; white-space:normal;">
                @foreach($chats as $chat)
                    {{-- Pesan dari Bot / Sistem (kiri) --}}
                    @if($chat->user_id != auth()->id())
                        <div class="d-flex mb-3 justify-content-start animate__animated animate__fadeInLeft">
                            <div class="p-3 rounded-4 shadow-sm bg-light text-dark" style="max-width:75%; word-break:break-word;">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <small class="fw-semibold">Petugas</small>
                                    <small class="text-muted ms-2">{{ $chat->created_at->format('d-m-Y H:i') }}</small>
                                </div>
                                <div class="lh-sm">
                                    {{ $chat->pesan }}
                                </div>
                            </div>
                        </div>
                    @else
                        {{-- Pesan dari User (kanan) --}}
                        <div class="d-flex mb-3 justify-content-end animate__animated animate__fadeInRight">
                            <div class="p-3 rounded-4 shadow-sm bg-primary text-white" style="max-width:75%; word-break:break-word;">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <small class="fw-semibold">Anda</small>
                                    <small class="text-light ms-2">{{ $chat->created_at->format('d-m-Y H:i') }}</small>
                                </div>
                                <div class="lh-sm">
                                    {{ $chat->pesan }}
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>


            {{-- Input --}}
            <div class="mt-3 d-flex">
                <input type="text" wire:model.defer="pesan" wire:keydown.enter="kirimPesan"
                       class="form-control rounded-pill me-2"
                       placeholder="Ketik pesan...">
                <button wire:click="kirimPesan" class="btn btn-primary rounded-pill px-4">
                    <i class="ri-send-plane-line"></i>
                </button>
            </div>

        </div>
    </div>
</div>

@push('css')
<!-- Animasi pakai Animate.css -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
@endpush
