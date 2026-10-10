@extends('layouts.app')

@section('title', 'Konfirmasi Laporan Banjir - BPBD Kab. Bandung')

@section('content')
<div class="card">
    <div class="card-header-hero success-banner">
        <h2>Konfirmasi Laporan Banjir</h2>
        <p>Terima kasih, laporan Anda telah diterima oleh BPBD Kabupaten Bandung</p>
    </div>

    <div class="card-body">
        {{-- Ketentuan c: Tampilkan pesan laporan berhasil dikirim menggunakan komponen Blade <x-alert> --}}
        <x-alert type="success">
            <div>
                <strong>Laporan Berhasil Dikirim!</strong>
                <p>Data laporan kejadian banjir telah berhasil dicatat oleh sistem LaporBanjir dan diteruskan ke tim penanganan bencana.</p>
            </div>
        </x-alert>

        <!-- Rincian Data Yang Telah Dikirimkan -->
        <h3 class="section-title">Rincian Data Laporan</h3>
        <table class="detail-table">
            <tbody>
                <tr>
                    <td class="label-col">Nama Pelapor</td>
                    <td class="value-col">{{ $namaPelapor }}</td>
                </tr>
                <tr>
                    <td class="label-col">Lokasi Kejadian (Kecamatan/Desa)</td>
                    <td class="value-col">{{ $lokasi }}</td>
                </tr>
                <tr>
                    <td class="label-col">Tinggi Genangan Air</td>
                    <td class="value-col highlight-val">{{ $tinggiAir }} cm</td>
                </tr>
                <tr>
                    <td class="label-col">Status Genangan</td>
                    <td class="value-col">
                        @if ($tinggiAir < 30)
                            <span class="status-badge status-waspada">Waspada (&lt; 30 cm)</span>
                        @elseif ($tinggiAir <= 70)
                            <span class="status-badge status-siaga">Siaga (30 - 70 cm)</span>
                        @else
                            <span class="status-badge status-awas">Awas (&gt; 70 cm)</span>
                        @endif
                    </td>
                </tr>
            </tbody>
        </table>

        <!-- Tombol Aksi Navigasi -->
        <div class="action-buttons-group">
            <a href="{{ route('lapor.index') }}" class="btn-primary-action">
                Kembali ke Form Pelaporan
            </a>
            <a href="{{ route('lapor.daftar') }}" class="btn-secondary-action">
                Lihat Daftar Laporan
            </a>
        </div>
    </div>
</div>
@endsection
