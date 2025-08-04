<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProdukController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $produk = Produk::all();
        $countProduk = $produk->count();

        return view('produk.index', compact('produk', 'countProduk'));
    }

    public function show($id)
    {
        $produk = Produk::find($id);

        if (!$produk) {
            return redirect()->route('produk.index')->with('error', 'Data tidak ditemukan');
        }

        return view('produk.show', compact('produk'));
    }

    /**
     * Display the specified resource by slug for API.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function apiShowBySlug($slug)
    {
        $produk = Produk::where('slug', $slug)->first();

        if (!$produk) {
            return response()->json(['message' => 'Produk tidak ditemukan'], 404);
        }

        return response()->json($produk);
    }

    public function create()
    {
        return view('produk.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:50',
            'deskripsi' => 'required|string',
            'specs' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $originalName = $image->getClientOriginalName();
            $imageName = now()->format('dmY') . '-' . $originalName;
            $targetPath = 'img/produk/produk';
            $image->move(public_path($targetPath), $imageName);

            // Simpan path relatif
            $imagePath = 'produk/' . $imageName;
        }

        produk::create([
            'name' => $request->name,
            'deskripsi' => $request->deskripsi,
            'specs' => $request->specs,
            'image' => $imagePath,  // path: produk/namafile.jpg
        ]);

        return redirect()->route('produk.index')->with('success', 'Produk berhasil ditambahkan!');
    }

    public function edit(string $id)
    {
        $produk = produk::findOrFail($id);
        return view('produk.edit', compact('produk'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:50',
            'deskripsi' => 'required|string',
            'specs' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $produk = produk::findOrFail($id);

        if ($request->hasFile('image')) {
            if ($produk->image && File::exists(public_path('img/produk/' . $produk->image))) {
                File::delete(public_path('img/produk/' . $produk->image));
            }

            $image = $request->file('image');
            $originalName = $image->getClientOriginalName();
            $imageName = now()->format('dmY') . '-' . $originalName;
            $targetPath = 'img/produk/produk';
            $image->move(public_path($targetPath), $imageName);

            $imagePath = 'produk/' . $imageName;
        } else {
            $imagePath = $produk->image;
        }

        $produk->update([
            'name' => $request->name,
            'deskripsi' => $request->deskripsi,
            'specs' => $request->specs,
            'image' => $imagePath,
        ]);

        return redirect()->route('produk.index')->with('success', 'Produk berhasil diperbarui!');
    }

    public function destroy(string $id)
    {
        $produk = produk::findOrFail($id);

        if ($produk->image && File::exists(public_path('img/produk/' . $produk->image))) {
            File::delete(public_path('img/produk/' . $produk->image));
        }

        $produk->delete();

        return redirect()->route('produk.index')->with('success', 'Produk berhasil dihapus!');
    }
}
