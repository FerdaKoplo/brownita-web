<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ManualTransaksiDetailData extends Model
{
    use HasFactory;

    protected $fillable = [
        'manual_transaksi_data_id',
        'nama_produk',
        'quantity',
        'harga_satuan',
    ];

    public function manualTransaksiData(): BelongsTo
    {
        return $this->belongsTo(ManualTransaksiData::class);
    }
}
