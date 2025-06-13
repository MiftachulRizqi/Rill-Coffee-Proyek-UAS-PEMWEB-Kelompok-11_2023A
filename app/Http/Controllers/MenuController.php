<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MenuController extends Controller
{
    public function index()
    {
        $menus = Menu::all();
        return view('frontend.menu', compact('menus'));
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $menus = Menu::where('nama_kopi', 'LIKE', "%{$query}%")
            ->orWhere('deskripsi', 'LIKE', "%{$query}%")
            ->get();
        return view('frontend.menu', compact('menus'));
    }

    public function adminIndex()
    {
        $menus = Menu::all();
        return view('admin.menus.index', compact('menus'));
    }

    public function create()
    {
        return view('admin.menus.create');
    }

    public function store(Request $request)
    {
        try {
            $data = $request->validate([
                'nama_kopi' => 'required|string|max:255',
                'harga' => 'required|numeric',
                'deskripsi' => 'required|string',
                'foto' => 'nullable|image|max:5120', // Maks 5MB
            ]);

            if ($request->hasFile('foto')) {
                $file = $request->file('foto');
                $filename = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('photos'), $filename);
                $data['foto'] = 'photos/' . $filename;
                Log::info('File tersimpan di: ' . $data['foto']);
            }

            Menu::create($data);
            return redirect()->route('admin.menus.index')->with('success', 'Menu berhasil ditambahkan.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()
                ->withErrors($e->validator)
                ->withInput();
        } catch (\Throwable $e) {
            Log::error('Error saat menyimpan menu: ' . $e->getMessage());

            if (config('app.debug')) {
                return response()->json([
                    'error' => $e->getMessage(),
                    'line' => $e->getLine(),
                    'file' => $e->getFile(),
                ], 500);
            }

            return redirect()->back()->with('error', 'Gagal menambahkan menu. Silakan coba lagi.');
        }
    }

    public function edit($id)
    {
        $menu = Menu::findOrFail($id);
        return view('admin.menus.edit', compact('menu'));
    }

    public function update(Request $request, $id)
    {
        try {
            $menu = Menu::findOrFail($id);
            $data = $request->validate([
                'nama_kopi' => 'required|string|max:255',
                'harga' => 'required|numeric',
                'deskripsi' => 'required|string',
                'foto' => 'nullable|image|max:2048',
            ]);

            if ($request->hasFile('foto')) {
                if ($menu->foto && file_exists(public_path($menu->foto))) {
                    unlink(public_path($menu->foto));
                    Log::info('Gambar lama dihapus: ' . $menu->foto);
                }

                $file = $request->file('foto');
                $filename = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('photos'), $filename);
                $data['foto'] = 'photos/' . $filename;
                Log::info('File tersimpan di: ' . $data['foto']);
            }

            $menu->update($data);
            return redirect()->route('admin.menus.index')->with('success', 'Menu berhasil diperbarui.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()
                ->withErrors($e->validator)
                ->withInput();
        } catch (\Throwable $e) {
            Log::error('Error saat memperbarui menu: ' . $e->getMessage());

            if (config('app.debug')) {
                return response()->json([
                    'error' => $e->getMessage(),
                    'line' => $e->getLine(),
                    'file' => $e->getFile(),
                ], 500);
            }

            return redirect()->back()->with('error', 'Gagal memperbarui menu. Silakan coba lagi.');
        }
    }

    public function destroy($id)
    {
        try {
            $menu = Menu::findOrFail($id);

            if ($menu->foto && file_exists(public_path($menu->foto))) {
                unlink(public_path($menu->foto));
                Log::info('Gambar dihapus: ' . $menu->foto);
            }

            $menu->delete();
            return redirect()->route('admin.menus.index')->with('success', 'Menu berhasil dihapus.');
        } catch (\Throwable $e) {
            Log::error('Error saat menghapus menu: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Gagal menghapus menu. Silakan coba lagi.');
        }
    }
}