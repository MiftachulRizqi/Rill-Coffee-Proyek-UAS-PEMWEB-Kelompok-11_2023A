<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'message' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        Review::create([
            'name' => $request->name,
            'message' => $request->message,
            'rating' => $request->rating,
        ]);

        return redirect()->route('home')->with('success', 'Terima kasih atas review Anda!');
        }
}