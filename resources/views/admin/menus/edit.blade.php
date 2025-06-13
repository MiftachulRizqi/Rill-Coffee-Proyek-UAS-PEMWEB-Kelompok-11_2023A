@extends('layouts.admin')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/admin_menus_edit.css') }}">
@endsection

@section('content')
    <div class="admin-section">
        <h2>Edit Menu</h2>
        <form action="{{ route('admin.menus.update', $menu->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="nama_kopi">Nama Kopi</label>
                <input type="text" name="nama_kopi" id="nama_kopi" value="{{ $menu->nama_kopi }}" required>
            </div>
            <div class="form-group">
                <label for="harga">Harga</label>
                <input type="number" name="harga" id="harga" step="0.01" value="{{ $menu->harga }}" required>
            </div>
            <div class="form-group">
                <label for="deskripsi">Deskripsi</label>
                <textarea name="deskripsi" id="deskripsi" required>{{ $menu->deskripsi }}</textarea>
            </div>
            <div class="form-group">
                <label for="foto">Foto</label>
                <input type="file" name="foto" id="foto">
                @if ($menu->foto)
                    <img src="{{ asset('storage/' . $menu->foto) }}" alt="{{ $menu->nama_kopi }}" width="50">
                @endif
            </div>
            <button type="submit" class="btn">Perbarui Menu</button>
        </form>
    </div>
@endsection