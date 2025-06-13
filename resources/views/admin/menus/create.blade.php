@extends('layouts.admin')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/admin_menus_create.css') }}">
@endsection

@section('content')
    <div class="admin-section">
        <h2>Tambah Menu Baru</h2>

        {{-- Menampilkan pesan error dari session jika ada --}}
        @if(session('error'))
            <div class="alert alert-danger" style="margin-bottom: 20px;">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('admin.menus.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="nama_kopi">Nama Kopi</label>
                <input type="text" name="nama_kopi" id="nama_kopi" value="{{ old('nama_kopi') }}" required>
                @error('nama_kopi')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="harga">Harga</label>
                <input type="number" name="harga" id="harga" step="0.01" value="{{ old('harga') }}" required>
                @error('harga')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="deskripsi">Deskripsi</label>
                <textarea name="deskripsi" id="deskripsi" required>{{ old('deskripsi') }}</textarea>
                @error('deskripsi')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="foto">Foto</label>
                <input type="file" name="foto" id="foto">
                @error('foto')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="btn">Tambah Menu</button>
        </form>
    </div>
@endsection