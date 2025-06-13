@extends('layouts.app')


@section('css')
    <link rel="stylesheet" href="{{ asset('css/order_history.css') }}">
@endsection

@section('content')
    <div class="order-history">
        <h2>Riwayat Pesanan Anda</h2>
        <table>
            <thead>
                <tr>
                    <th>Kopi</th>
                    <th>Jumlah</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Waktu Pesan</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                    <tr>
                        <td>{{ $order->menu->nama_kopi }}</td>
                        <td>{{ $order->jumlah }}</td>
                        <td>Rp {{ number_format($order->jumlah * $order->menu->harga, 0) }}</td>
                        <td>{{ ucfirst($order->status) }}</td>
                        <td>{{ $order->waktu_pesan }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection