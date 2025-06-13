@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/menu.css') }}">
@endsection

@section('content')
    <div class="menu-container">
        <h2>Menu Kopi Kami</h2>
        <form action="{{ route('menu.search') }}" method="GET" class="search-form">
            <input type="text" name="query" placeholder="Cari kopi..." value="{{ request('query') }}">
            <button type="submit">Cari</button>
        </form>
        <div class="menu-grid">
            @forelse ($menus as $menu)
                <div class="menu-item">
                    @if ($menu->foto)
                        <img src="{{ Storage::url($menu->foto) }}" alt="{{ $menu->nama_kopi }}">
                    @else
                        <img src="https://via.placeholder.com/150" alt="Kopi">
                    @endif
                    <h3>{{ $menu->nama_kopi }}</h3>
                    <p>{{ $menu->deskripsi }}</p>
                    <p class="price">Rp {{ number_format($menu->harga, 0) }}</p>
                    @auth
                        <a href="{{ route('order.create', $menu->id) }}" class="btn">Pesan Sekarang</a>
                    @else
                        <a href="{{ route('login') }}" class="btn">Masuk untuk Pesan</a>
                    @endauth
                </div>
            @empty
                <p>Tidak ada menu yang ditemukan.</p>
            @endforelse
        </div>
    </div>
@endsection