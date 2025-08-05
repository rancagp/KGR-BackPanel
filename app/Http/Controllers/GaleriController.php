<?php

namespace App\Http\Controllers;

use App\Models\galeri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class GaleriController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $kategori = $request->query('kategori');
        $status = $request->query('status');

        $query = galeri::query();

        if ($status === 'draft') {
            // Tampilkan hanya galeri dengan status draft
            $query->where('status', 'draft');
        } elseif ($kategori) {
            // Jika kategori dipilih, dan status bukan draft, tampilkan berdasarkan kategori dan status published
            $query->where('kategori', $kategori)
                ->where('status', 'published');
        } else {
            // Default: tampilkan semua galeri yang published
            $query->where('status', 'published');
        }

        $galeriFiltered = $query->latest()->get();
        $countGaleri = $galeriFiltered->count();

        return view('galeri.index', compact('galeriFiltered', 'countGaleri'));
    }

    public function create()
    {
        return view('galeri.create');
    }

    public function store(Request $request)
    {
        // Menambahkan validasi untuk kategori
        $request->validate([
            'judul' => 'required|string|max:100',
            'isi' => 'required|string',
            'kategori' => 'required|in:Info & Kegiatan,Pengumuman',
            'status' => 'required|in:draft,published',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Menambahkan kategori ke dalam data
        $data = $request->only(['judul', 'isi', 'kategori', 'status']);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $tanggal = date('Y-m-d-H-i-s');
            $judulSlug = str_replace(' ', '-', strtolower($request->judul));
            $imageName = $tanggal . '-' . $judulSlug . '.' . $image->getClientOriginalExtension();

            $image->move(public_path('img/galeri'), $imageName);

            $data['image'] = $imageName;
        }

        galeri::create($data);

        return redirect()->route('galeri.index')->with('success', 'Galeri berhasil ditambahkan.');
    }

    public function show(string $id)
    {
        try {
            // Mencari galeri berdasarkan ID atau akan gagal jika tidak ditemukan
            $galeri = galeri::findOrFail($id);

            // Mengembalikan view dengan data galeri yang ditemukan
            return view('galeri.show', compact('galeri'));
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            // Jika galeri tidak ditemukan, arahkan ke halaman galeri.index dengan pesan error
            return redirect()->route('galeri.index')->with('error', 'Data tidak ditemukan');
        }
    }

    public function edit(string $id)
    {
        try {
            // Mencari galeri berdasarkan ID atau akan gagal jika tidak ditemukan
            $galeri = galeri::findOrFail($id);

            // Mengembalikan view dengan data galeri yang ditemukan
            return view('galeri.edit', compact('galeri'));
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            // Jika galeri tidak ditemukan, arahkan ke halaman galeri.index dengan pesan error
            return redirect()->route('galeri.index')->with('error', 'Data tidak ditemukan');
        }
    }

    public function update(Request $request, string $id)
    {
        $galeri = galeri::findOrFail($id);

        // Menambahkan validasi untuk kategori
        $request->validate([
            'judul' => 'required|string|max:100',
            'isi' => 'required|string',
            'kategori' => 'required|in:Info & Kegiatan,Pengumuman',
            'status' => 'required|in:draft,published',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Menambahkan kategori ke dalam data
        $data = $request->only(['judul', 'isi', 'kategori', 'status']);

        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($galeri->image && File::exists(public_path($galeri->image))) {
                File::delete(public_path($galeri->image));
            }

            $image = $request->file('image');
            $tanggal = date('Y-m-d-H-i-s');
            $judulSlug = str_replace(' ', '-', strtolower($request->judul));
            $imageName = $tanggal . '-' . $judulSlug . '.' . $image->getClientOriginalExtension();

            $image->move(public_path('img/galeri'), $imageName);

            $data['image'] = $imageName;
        }

        $galeri->update($data);

        return redirect()->route('galeri.index')->with('success', 'Galeri berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $galeri = galeri::findOrFail($id);

        // Hapus gambar jika ada
        if ($galeri->image && File::exists(public_path($galeri->image))) {
            File::delete(public_path($galeri->image));
        }

        $galeri->delete();

        return redirect()->route('galeri.index')->with('success', 'Galeri berhasil dihapus.');
    }
}
