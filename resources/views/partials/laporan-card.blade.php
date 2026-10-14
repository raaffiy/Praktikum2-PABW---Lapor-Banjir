{{-- Partial Kartu Laporan (resources/views/partials/laporan-card.blade.php) --}}
@php
    $lokasi = is_array($laporan) ? ($laporan['lokasi'] ?? '') : $laporan->lokasi;
    $namaPelapor = is_array($laporan) ? ($laporan['nama_pelapor'] ?? '') : $laporan->nama_pelapor;
    $tinggi = is_array($laporan) 
        ? ($laporan['tinggi_genangan'] ?? $laporan['tinggi_air'] ?? 0) 
        : ($laporan->tinggi_genangan ?? $laporan->tinggi_air ?? 0);
    $tanggal = is_array($laporan) ? ($laporan['tanggal_kejadian'] ?? null) : ($laporan->tanggal_kejadian ?? null);
    $waktu = is_array($laporan) ? ($laporan['waktu'] ?? null) : null;
@endphp

<div class="report-card">
    <div class="report-card-top">
        <div class="report-location">
            <span class="location-icon">📍</span>
            <h3 class="location-title">{{ $lokasi }}</h3>
        </div>

        {{-- Penentuan Status Genangan Menggunakan @if/@elseif/@else:
             < 30 cm: Waspada, 30–70 cm: Siaga, > 70 cm: Awas --}}
        @if ($tinggi < 30)
            <span class="status-badge status-waspada">Waspada</span>
        @elseif ($tinggi <= 70)
            <span class="status-badge status-siaga">Siaga</span>
        @else
            <span class="status-badge status-awas">Awas</span>
        @endif
    </div>

    <div class="report-card-body">
        <div class="report-meta-item">
            <span class="meta-label">Nama Pelapor:</span>
            <span class="meta-value">{{ $namaPelapor }}</span>
        </div>

        <div class="report-meta-item">
            <span class="meta-label">Tinggi Genangan:</span>
            <span class="meta-value height-value">
                <strong>{{ $tinggi }}</strong> cm
            </span>
        </div>

        @if ($tanggal)
            <div class="report-meta-item">
                <span class="meta-label">Tanggal Kejadian:</span>
                <span class="meta-value time-value">
                    📅 {{ \Carbon\Carbon::parse($tanggal)->translatedFormat('d F Y') }}
                </span>
            </div>
        @elseif ($waktu)
            <div class="report-meta-item">
                <span class="meta-label">Waktu:</span>
                <span class="meta-value time-value">{{ $waktu }}</span>
            </div>
        @endif
    </div>
</div>

