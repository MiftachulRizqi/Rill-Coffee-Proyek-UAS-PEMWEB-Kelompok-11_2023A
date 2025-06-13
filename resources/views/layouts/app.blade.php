<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rill Coffee</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @yield('css') <!-- Bagian untuk memuat CSS khusus -->
</head>
<body>
    <nav class="navbar">
        <div class="logo">Rill Coffee</div>
        <ul class="nav-links">
            <li><a href="{{ route('home') }}#section1" id="beranda-link">Beranda</a></li>
            <li><a href="{{ route('home') }}#section3">Menu</a></li>
            <li><a href="{{ url('/api-doc') }}">Dokumentasi</a></li>

            @auth
                <li><a href="{{ route('order.history') }}">Riwayat Pesanan</a></li>
                @if (Auth::user()->role === 'admin')
                    <li><a href="{{ route('admin.dashboard') }}">Dashboard Admin</a></li>
                @endif
                <li>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="nav-button">Keluar</button>
                    </form>
                </li>
            @else
                <li><a href="{{ route('login') }}">Masuk</a></li>
                <li><a href="{{ route('register') }}">Daftar</a></li>

            @endauth
        </ul>
    </nav>
    <main>
        @if (session('success'))
            <div class="alert success">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="alert error">{{ session('error') }}</div>
        @endif
        @yield('content')
    </main>
    @stack('scripts')
</body>
</html>