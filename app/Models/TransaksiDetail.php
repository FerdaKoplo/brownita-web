<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'transaksi_id',
        'katalog_id',
        'quantity',
        'harga_satuan'
    ];

    public function katalog()
    {
        return $this->belongsTo(Katalog::class);
    }

    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class);
    }
}
