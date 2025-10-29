<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ManualTransaksiData extends Model
{
    use HasFactory;

    protected $fillable = [
        'created_by',
        'updated_by',
        'customer_name',
        'customer_phone',
        'alamat',
        'total_harga',
        'status',
        'tipe_pemesanan',
        'notes',
        'preorder_start',
        'preorder_end'
    ];

    public function manualTransaksiDetailDatas(): HasMany
    {
        return $this->hasMany(ManualTransaksiDetailData::class);
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updater(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

}
