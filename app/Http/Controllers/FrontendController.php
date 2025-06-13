<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Review;

class FrontendController extends Controller
{
    public function index()
    {
        // Ambil semua data menu kopi
        $menus = Menu::all();

        // Ambil data review terbaru, urut dari yang paling baru
        $reviews = Review::latest()->get();

        // Kirim data ke view frontend.home
        return view('frontend.home', compact('menus', 'reviews'));
    }

    // Jika nanti perlu method untuk simpan review, bisa ditambahkan di sini
    // Contohnya:
    /*
    public function storeReview(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'rating' => 'required|integer|min:1|max:5',
            'komentar' => 'required|string|max:1000',
        ]);

        Review::create($validated);

        return redirect()->route('home')->with('success', 'Terima kasih atas review Anda!');
    }
    */
}