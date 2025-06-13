@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/order_form.css') }}">
@endsection

@section('content')
    <div class="order-container">
        <h2>Pesan {{ $menu->nama_kopi }}</h2>
        <form action="{{ route('order.store') }}" method="POST">
            @csrf
            <input type="hidden" name="menu_id" value="{{ $menu->id }}">

            <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" name="nama" id="nama" required>
                @error('nama')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="jumlah">Jumlah</label>
                <input type="number" name="jumlah" id="jumlah" min="1" required>
                @error('jumlah')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="alamat">Alamat</label>
                <input type="text" name="alamat" id="alamat" required>
                @error('alamat')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="nomor_wa">Nomor WhatsApp</label>
                <input type="text" name="nomor_wa" id="nomor_wa" required>
                @error('nomor_wa')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <p>Total: Rp {{ number_format($menu->harga, 0) }} x Jumlah</p>
            <button type="submit" class="btn">Buat Pesanan</button>
        </form>
    </div>
@endsection