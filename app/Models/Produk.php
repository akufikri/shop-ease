<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    protected $fillable = [
        'produk_name',
        'kategori_id',
        'deskripsi',
        'harga',
        'stok',
        'photo_produk',
        'expired',
        'type_id',
    ];

    protected $table = 'produks';
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }
    public function type()
    {
        return $this->belongsTo(TypeProduk::class, 'type_id');
    }
}
