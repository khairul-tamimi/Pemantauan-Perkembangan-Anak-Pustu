<div class="max-w-4xl mx-auto">
    <div class="bg-white shadow rounded-lg p-4">
        <h2 class="text-xl font-bold mb-4 text-center">
            Grafik Pemeriksaan Anak
        </h2>

        <div class="mb-4 flex items-center space-x-2">
            <label for="anak_id" class="font-bold">Pilih Anak:</label>
            <select wire:model.live="anak_id" id="anak_id" class="form-control">
                <option value="">-- Pilih Anak --</option>
                @foreach($anakList as $anak)
                    <option value="{{ $anak->id }}">{{ $anak->nama }}</option>
                @endforeach
            </select>
        </div>

        <div wire:ignore>
            <canvas id="chartPemeriksaan" height="100"></canvas>
        </div>
    </div>
</div>

@push('js')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('livewire:init', () => {
        const ctx = document.getElementById('chartPemeriksaan').getContext('2d');

        // bikin variabel global
        window.chartPemeriksaan = new Chart(ctx, {
            type: 'line',
            data: {
                labels: @json($grafik['labels'] ?? []),
                datasets: [
                    {
                        label: 'Berat Badan (kg)',
                        data: @json($grafik['berat'] ?? []),
                        borderColor: 'blue',
                        backgroundColor: 'rgba(0,0,255,0.2)',
                        tension: 0.3
                    },
                    {
                        label: 'Tinggi Badan (cm)',
                        data: @json($grafik['tinggi'] ?? []),
                        borderColor: 'green',
                        backgroundColor: 'rgba(0,255,0,0.2)',
                        tension: 0.3
                    },
                    {
                        label: 'Lingkar Kepala (cm)',
                        data: @json($grafik['lingkar_kepala'] ?? []),
                        borderColor: 'orange',
                        backgroundColor: 'rgba(255,165,0,0.2)',
                        tension: 0.3
                    },
                    {
                        label: 'Lingkar Lengan (cm)',
                        data: @json($grafik['lingkar_lengan'] ?? []),
                        borderColor: 'red',
                        backgroundColor: 'rgba(255,0,0,0.2)',
                        tension: 0.3
                    }
                ]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { position: 'top' },
                    title: {
                        display: true,
                        text: 'Pertumbuhan Anak Berdasarkan Pemeriksaan'
                    }
                },
                scales: {
                    y: { beginAtZero: true }
                }
            }
        });
    });
</script>
<script>
document.addEventListener('livewire:init', () => {
Livewire.on('refreshChart', (data) => {
    console.log("📊 Data dari Livewire:", data);

    const chartData = data[0]; // ambil object pertama

    window.chartPemeriksaan.data.labels = chartData.labels;
    window.chartPemeriksaan.data.datasets[0].data = chartData.berat;
    window.chartPemeriksaan.data.datasets[1].data = chartData.tinggi;
    window.chartPemeriksaan.data.datasets[2].data = chartData.lingkar_kepala;
    window.chartPemeriksaan.data.datasets[3].data = chartData.lingkar_lengan;
    window.chartPemeriksaan.update();
});

});


</script>
@endpush
