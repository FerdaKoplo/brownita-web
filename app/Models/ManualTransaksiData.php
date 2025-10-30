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
        'tanggal_transaksi',
        'preorder_start',
        'preorder_deadline'
    ];

    protected $casts = [
        'tanggal_transaksi' => 'date',
        'preorder_start' => 'date',
        'preorder_deadline' => 'date',
    ];
    public function details()
    {
        return $this->hasMany(ManualTransaksiDetailData::class, 'manual_transaksi_data_id');
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
