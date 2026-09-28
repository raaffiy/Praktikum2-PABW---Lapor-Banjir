@extends('layouts.app')

@section('title', 'Konfirmasi Laporan Banjir - BPBD Kab. Bandung')

@section('content')
<div class="card">
    <div class="success-banner">
        <h2>Konfirmasi Laporan Banjir</h2>
        <p>Berikut adalah data pelaporan yang telah Anda kirimkan:</p>
    </div>

    <div class="card-body">
        <!-- Rincian Data Sesuai Soal -->
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
            </tbody>
        </table>

        <!-- Tombol Kembali -->
        <div style="text-align: center; margin-top: 1.5rem;">
            <a href="{{ route('lapor.index') }}" class="btn-primary-action">
                Kembali ke Form Pelaporan
            </a>
        </div>
    </div>
</div>
@endsection
