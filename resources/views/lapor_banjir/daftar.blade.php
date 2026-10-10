@extends('layouts.app')

@section('title', 'Daftar Laporan Banjir - BPBD Kab. Bandung')

@section('content')
<div class="card">
    <div class="card-header-hero">
        <div class="header-content-wrapper">
            <div>
                <h2>Daftar Laporan Banjir Terkini</h2>
                <p>Data laporan kejadian banjir di wilayah Kabupaten Bandung dari masyarakat</p>
            </div>
            <a href="{{ route('lapor.index') }}" class="btn-hero-action">
                + Buat Laporan
            </a>
        </div>
    </div>

    <div class="card-body">
        <!-- Informasi Status Genangan Air -->
        <div class="legend-box">
            <span class="legend-title">Klasifikasi Status Genangan:</span>
            <div class="legend-items">
                <span class="status-badge status-waspada">Waspada (&lt; 30 cm)</span>
                <span class="status-badge status-siaga">Siaga (30 - 70 cm)</span>
                <span class="status-badge status-awas">Awas (&gt; 70 cm)</span>
            </div>
        </div>

        {{-- Daftar Laporan menggunakan @forelse dan @include partial sesuai ketentuan --}}
        <div class="report-list">
            @forelse ($daftarLaporan as $laporan)
                @include('partials.laporan-card', ['laporan' => $laporan])
            @empty
                <div class="empty-state">
                    <p>Belum ada data laporan banjir yang tercatat saat ini.</p>
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection
