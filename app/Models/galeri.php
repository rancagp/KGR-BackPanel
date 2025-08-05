<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class galeri extends Model
{
    use HasFactory;

    protected $table = 'galeris';

    protected $fillable = [
        'image',
        'judul',
        'isi',
        'kategori',
        'status',
        'slug',
    ];

    // Buat slug otomatis saat membuat atau mengupdate
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($galeri) {
            $galeri->slug = Str::slug($galeri->judul);
        });

        static::updating(function ($galeri) {
            $galeri->slug = Str::slug($galeri->judul);
        });
    }
}
