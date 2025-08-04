<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    // GET /api/produk
    public function index()
    {
        $produk = Produk::latest()->get();

        return response()->json($produk, 200);
    }

    // GET /api/produk/{slug}
    public function show($slug)
    {
        $produk = Produk::where('slug', $slug)->first();

        if (!$produk) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        return response()->json($produk, 200);
    }
}
