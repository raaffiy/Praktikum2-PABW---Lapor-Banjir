@extends('layouts.app')

@section('title', 'Form Pelaporan Kejadian Banjir - BPBD Kab. Bandung')

@section('content')
<div class="card">
    <div class="card-header-hero">
        <h2>Formulir Lapor Kejadian Banjir</h2>
        <p>Sistem pelaporan kejadian banjir di wilayah BPBD Kabupaten Bandung.</p>
    </div>

    <div class="card-body">
        {{-- Pesan error validasi jika ada --}}
        @if ($errors->any())
            <div class="alert-danger">
                <strong>Mohon lengkapi formulir dengan benar:</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Form Pelaporan (Method POST) --}}
        <form action="{{ route('lapor.submit') }}" method="POST">
            @csrf

            <!-- 1. Nama Pelapor -->
            <div class="form-group">
                <label for="nama_pelapor" class="form-label">
                    Nama Pelapor <span class="required">*</span>
                </label>
                <div class="input-wrapper">
                    <input 
                        type="text" 
                        name="nama_pelapor" 
                        id="nama_pelapor" 
                        class="form-control @error('nama_pelapor') is-invalid @enderror" 
                        placeholder="Masukkan nama lengkap Anda"
                        value="{{ old('nama_pelapor') }}" 
                        required
                    >
                </div>
            </div>

            <!-- 2. Lokasi Kejadian (Kecamatan/Desa) -->
            <div class="form-group">
                <label for="lokasi" class="form-label">
                    Lokasi Kejadian (Kecamatan/Desa) <span class="required">*</span>
                </label>
                <div class="input-wrapper">
                    <input 
                        type="text" 
                        name="lokasi" 
                        id="lokasi" 
                        class="form-control @error('lokasi') is-invalid @enderror" 
                        placeholder="Contoh: Desa Citeureup, Kecamatan Dayeuhkolot"
                        value="{{ old('lokasi') }}" 
                        required
                    >
                </div>
            </div>

            <!-- 3. Tinggi Genangan Air -->
            <div class="form-group">
                <label for="tinggi_air" class="form-label">
                    Tinggi Genangan Air (cm) <span class="required">*</span>
                </label>
                <div class="input-wrapper">
                    <input 
                        type="number" 
                        name="tinggi_air" 
                        id="tinggi_air" 
                        class="form-control @error('tinggi_air') is-invalid @enderror" 
                        placeholder="Contoh: 75" 
                        min="1"
                        value="{{ old('tinggi_air') }}" 
                        required
                    >
                    <span class="input-suffix">cm</span>
                </div>
            </div>

            <!-- Tombol Kirim Laporan -->
            <button type="submit" class="btn-submit">
                Kirim Laporan
            </button>
        </form>
    </div>
</div>
@endsection
