@extends('layouts.admin')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/admin_menus_index.css') }}">
@endsection

@section('content')
    <div class="admin-section">
        <h2>Kelola Menu</h2>
        <a href="{{ route('admin.menus.create') }}" class="btn primary">Tambah Menu Baru</a>
        <table>
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Harga</th>
                    <th>Deskripsi</th>
                    <th>Foto</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($menus as $menu)
                    <tr>
                        <td>{{ $menu->nama_kopi }}</td>
                        <td>Rp {{ number_format($menu->harga, 0) }}</td>
                        <td>{{ $menu->deskripsi }}</td>
                        <td>
                            @if ($menu->foto)
                                <img src="{{ asset($menu->foto) }}" alt="{{ $menu->nama_kopi }}" width="50">
                            @else
                                Tidak Ada Foto
                            @endif
                        </td>
                        <td>
                            <div class="action-buttons">
                                <a href="{{ route('admin.menus.edit', $menu->id) }}" class="btn small primary">Edit</a>
                                <form action="{{ route('admin.menus.destroy', $menu->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn small danger" onclick="return confirm('Apakah Anda yakin?')">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection