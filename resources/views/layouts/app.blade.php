<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'LaporBanjir - BPBD Kabupaten Bandung')</title>
    <!-- CSS Sistem LaporBanjir -->
    <link rel="stylesheet" href="{{ asset('css/lapor_banjir.css') }}">
</head>
<body>

    <!-- Header & Menu Navigasi -->
    <header class="navbar">
        <div class="nav-container">
            <a href="{{ route('lapor.index') }}" class="brand">
                <div class="brand-badge">BPBD</div>
                <div>
                    <h1>LaporBanjir</h1>
                    <span>Kabupaten Bandung</span>
                </div>
            </a>

            <!-- Menu Navigasi Menggunakan Named Route -->
            <nav class="nav-links">
                <a href="{{ route('lapor.index') }}" class="nav-item {{ request()->routeIs('lapor.index') || request()->routeIs('lapor.form') ? 'active' : '' }}">
                    Form Lapor
                </a>
                <a href="{{ route('lapor.daftar') }}" class="nav-item {{ request()->routeIs('lapor.daftar') ? 'active' : '' }}">
                    Daftar Laporan
                </a>
                <a href="{{ route('lapor.konfirmasi') }}" class="nav-item {{ request()->routeIs('lapor.konfirmasi') ? 'active' : '' }}">
                    Konfirmasi Laporan
                </a>
            </nav>
        </div>
    </header>

    {{-- Main Content Area (@yield) --}}
    <main class="main-wrapper">
        @yield('content')
    </main>

    <!-- Footer Sistem -->
    <footer class="footer">
        <div class="footer-container">
            <p class="footer-title">&copy; {{ date('Y') }} BPBD Kabupaten Bandung - Sistem Pelaporan Cepat LaporBanjir</p>
            <p class="footer-sub">Badan Penanggulangan Bencana Daerah (BPBD) Kabupaten Bandung &bull; Tanggap, Tangguh, dan Sigap Bencana</p>
        </div>
    </footer>

</body>
</html>
