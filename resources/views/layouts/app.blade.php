<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'LaporBanjir - BPBD Kabupaten Bandung')</title>
    <!-- CSS Terpisah di folder public/css -->
    <link rel="stylesheet" href="{{ asset('css/lapor_banjir.css') }}">
</head>
<body>

    <!-- Header / Navbar -->
    <header class="navbar">
        <div class="nav-container">
            <a href="{{ route('lapor.index') }}" class="brand">
                <h1>LaporBanjir</h1>
                <span>BPBD Kab. Bandung</span>
            </a>
        </div>
    </header>

    <!-- Main Content -->
    <main class="main-wrapper">
        @yield('content')
    </main>

</body>
</html>
