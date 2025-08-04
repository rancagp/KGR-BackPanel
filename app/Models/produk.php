<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Produk extends Model
{
    use HasFactory;

    protected $table = 'produkes';

    protected $fillable = [
        'name',
        'deskripsi',
        'specs',
        'image',
        'slug',
    ];

    // Buat slug otomatis saat membuat atau mengupdate
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($produk) {
            $produk->slug = Str::slug($produk->name);
        });

        static::updating(function ($produk) {
            $produk->slug = Str::slug($produk->name);
        });
    }
}
