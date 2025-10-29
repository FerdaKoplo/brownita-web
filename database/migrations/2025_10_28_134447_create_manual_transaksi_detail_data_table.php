<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('manual_transaksi_detail_data', function (Blueprint $table) {
            $table->id();
            $table->foreignId('manual_transaksi_data_id')
                ->constrained('manual_transaksi_data')
                ->onDelete('cascade');
            $table->string('nama_produk');
            $table->integer('quantity');
            $table->decimal('harga_satuan', 15, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('manual_transaksi_detail_data');
    }
};
