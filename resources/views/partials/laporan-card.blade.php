{{-- Partial Kartu Laporan (resources/views/partials/laporan-card.blade.php) --}}
<div class="report-card">
    <div class="report-card-top">
        <div class="report-location">
            <span class="location-icon">📍</span>
            <h3 class="location-title">{{ $laporan['lokasi'] }}</h3>
        </div>

        {{-- Logika Penentuan Status Genangan Menggunakan @if / @elseif / @else Sesuai Ketentuan --}}
        @if ($laporan['tinggi_air'] < 30)
            <span class="status-badge status-waspada">Waspada</span>
        @elseif ($laporan['tinggi_air'] <= 70)
            <span class="status-badge status-siaga">Siaga</span>
        @else
            <span class="status-badge status-awas">Awas</span>
        @endif
    </div>

    <div class="report-card-body">
        <div class="report-meta-item">
            <span class="meta-label">Nama Pelapor:</span>
            <span class="meta-value">{{ $laporan['nama_pelapor'] }}</span>
        </div>

        <div class="report-meta-item">
            <span class="meta-label">Tinggi Genangan Air:</span>
            <span class="meta-value height-value">
                <strong>{{ $laporan['tinggi_air'] }}</strong> cm
            </span>
        </div>

        @if (!empty($laporan['waktu']))
            <div class="report-meta-item">
                <span class="meta-label">Waktu Dilaporkan:</span>
                <span class="meta-value time-value">{{ $laporan['waktu'] }}</span>
            </div>
        @endif
    </div>
</div>
