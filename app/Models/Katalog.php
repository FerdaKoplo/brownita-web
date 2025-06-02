<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Katalog extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'nama_produk',
        'gambar_produk',
        'deskripsi',
        'harga',
        'status'
    ];


    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
