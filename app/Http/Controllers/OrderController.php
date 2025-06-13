<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    // Tampilkan form order
    public function create($id)
    {
        $menu = Menu::findOrFail($id);
        return view('frontend.order_form', compact('menu'));
    }

    // Simpan pesanan
    public function store(Request $request)
    {
        $data = $request->validate([
            'menu_id'   => 'required|exists:menus,id',
            'nama'      => 'required|string|max:255',
            'jumlah'    => 'required|integer|min:1',
            'alamat'    => 'required|string',
            'nomor_wa'  => 'required|string|max:20',
        ]);

        Order::create([
            'user_id'      => auth()->id(), // pengguna login
            'menu_id'      => $data['menu_id'],
            'nama'         => $data['nama'],
            'jumlah'       => $data['jumlah'],
            'alamat'       => $data['alamat'],
            'nomor_wa'     => $data['nomor_wa'],
            'status'       => 'pending',
            'waktu_pesan'  => now(),
        ]);

        return redirect()->route('order.history')->with('success', 'Pesanan berhasil dibuat.');
    }

    // Lihat riwayat pesanan user
    public function history()
    {
        $orders = Order::where('user_id', Auth::id())->with('menu')->get();
        return view('frontend.order_history', compact('orders'));
    }

    // Admin dashboard
    public function adminDashboard()
    {
        $totalOrders     = Order::count();
        $pendingOrders   = Order::where('status', 'pending')->count();
        $confirmedOrders = Order::where('status', 'confirmed')->count();

        return view('admin.dashboard', compact('totalOrders', 'pendingOrders', 'confirmedOrders'));
    }

    // Admin: daftar semua order
    public function adminIndex()
    {
        $orders = Order::with(['user', 'menu'])->get();
        return view('admin.orders.index', compact('orders'));
    }

    // Admin: konfirmasi pesanan
    public function confirm($id)
    {
        $order = Order::findOrFail($id);
        $order->update(['status' => 'confirmed']);

        return redirect()->route('admin.orders.index')->with('success', 'Pesanan berhasil dikonfirmasi.');
    }

    // Admin: batalkan pesanan
    public function cancel($id)
    {
        $order = Order::findOrFail($id);
        $order->update(['status' => 'cancelled']);

        return redirect()->route('admin.orders.index')->with('success', 'Pesanan berhasil dibatalkan.');
    }
}