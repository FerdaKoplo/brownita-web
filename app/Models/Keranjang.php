<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keranjang extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'katalog_id',
        'quantity'
    ];

    public function getTotalHargaAttribute()
    {
        return $this->quantity * $this->produk->harga;
    }

    public function getTotalHargaRupiahAttribute()
    {
        return 'Rp ' . number_format($this->total_harga, 0, ',', '.');
    }


    public function produk()
    {
        return $this->belongsTo(Katalog::class, 'katalog_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
