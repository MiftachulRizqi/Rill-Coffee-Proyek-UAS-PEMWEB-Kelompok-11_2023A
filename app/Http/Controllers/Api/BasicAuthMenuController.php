<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Menu;

class BasicAuthMenuController extends Controller
{
    public function index()
    {
        return response()->json(Menu::all());
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_kopi' => 'required|string|max:255',
            'harga' => 'required|numeric',
            'deskripsi' => 'nullable|string',
            'foto' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('photos'), $filename);
            $data['foto'] = 'photos/' . $filename;
        }

        $menu = Menu::create($data);
        return response()->json($menu, 201);
    }

    public function update(Request $request, $id)
    {
        $menu = Menu::findOrFail($id);

        $data = $request->validate([
            'nama_kopi' => 'required|string|max:255',
            'harga' => 'required|numeric',
            'deskripsi' => 'nullable|string',
            'foto' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            if ($menu->foto && file_exists(public_path($menu->foto))) {
                unlink(public_path($menu->foto));
            }
            $file = $request->file('foto');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('photos'), $filename);
            $data['foto'] = 'photos/' . $filename;
        }

        $menu->update($data);
        return response()->json($menu);
    }

    public function destroy($id)
    {
        $menu = Menu::findOrFail($id);
        if ($menu->foto && file_exists(public_path($menu->foto))) {
            unlink(public_path($menu->foto));
        }
        $menu->delete();
        return response()->json(['message' => 'Menu berhasil dihapus']);
    }
}