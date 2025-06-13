<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Rill Coffee</title>
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    @yield('css') <!-- Bagian untuk memuat CSS khusus -->
</head>
<body>
    <nav class="navbar">
        <div class="logo">Rill Coffee - Admin</div>
        <ul class="nav-links">
            <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li><a href="{{ route('admin.menus.index') }}">Kelola Menu</a></li>
            <li><a href="{{ route('admin.orders.index') }}">Kelola Pesanan</a></li>
            <li>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="nav-button">Keluar</button>
                </form>
            </li>
        </ul>
    </nav>
    <main>
        @if (session('success'))
            <div class="alert success">{{ session('success') }}</div>
        @endif
        @yield('content')
    </main>
</body>
</html>