@extends('layouts.admin')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/admin_dashboard.css') }}">
@endsection

@section('content')
    <div class="dashboard">
        <h2>Dashboard Admin</h2>
        <div class="stats">
            <div class="stat-card">
                <h3>Total Pesanan</h3>
                <p>{{ $totalOrders }}</p>
            </div>
            <div class="stat-card">
                <h3>Pesanan Menunggu</h3>
                <p>{{ $pendingOrders }}</p>
            </div>
            <div class="stat-card">
                <h3>Pesanan Dikonfirmasi</h3>
                <p>{{ $confirmedOrders }}</p>
            </div>
        </div>
    </div>
@endsection