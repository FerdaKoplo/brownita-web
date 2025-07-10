<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KatalogImage extends Model
{
    use HasFactory;

     protected $fillable = [
        'katalog_id',
        'gambar_produk'
    ];

    public function katalog()
    {
        return $this->belongsTo(Katalog::class);
    }
}
