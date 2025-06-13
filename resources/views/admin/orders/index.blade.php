@extends('layouts.admin')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/admin_orders_index.css') }}">
@endsection

@section('content')
    <div class="admin-section">
        <h2>Kelola Pesanan</h2>
        <table>
            <thead>
                <tr>
                    <th>Pelanggan</th>
                    <th>Kopi</th>
                    <th>Jumlah</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Waktu Pesan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                    <tr>
                        <td>{{ $order->user->name }}</td>
                        <td>{{ $order->menu->nama_kopi }}</td>
                        <td>{{ $order->jumlah }}</td>
                        <td>Rp {{ number_format($order->jumlah * $order->menu->harga, 0) }}</td>
                        <td>{{ ucfirst($order->status) }}</td>
                        <td>{{ $order->waktu_pesan }}</td>
                        <td>
                            @if ($order->status === 'pending')
                                <div class="action-buttons">
                                    <form action="{{ route('admin.orders.confirm', $order->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn small primary">Konfirmasi</button>
                                    </form>
                                    <form action="{{ route('admin.orders.cancel', $order->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn small danger">Batal</button>
                                    </form>
                                </div>
                            @else
                                <span class="status-label {{ strtolower($order->status) }}">{{ ucfirst($order->status) }}</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection