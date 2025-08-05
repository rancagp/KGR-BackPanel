<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\galeri;
use Illuminate\Http\Request;

class GaleriController extends Controller
{
    // Menampilkan semua galeri yang berstatus published
    public function index()
    {
        $galeri = galeri::where('status', 'published')->latest()->get();

        return response()->json($galeri, 200);
    }

    // Menampilkan detail galeri berdasarkan slug
    public function show($slug)
    {
        $galeri = galeri::where('slug', $slug)->where('status', 'published')->first();

        if (!$galeri) {
            return response()->json(['message' => 'Galeri tidak ditemukan'], 404);
        }

        return response()->json($galeri, 200);
    }
}
