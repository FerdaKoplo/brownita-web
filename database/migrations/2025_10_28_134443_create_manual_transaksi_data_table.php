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
        Schema::create('manual_transaksi_data', function (Blueprint $table) {
            $table->id();
            $table->foreignId('created_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();
            $table->foreignId('updated_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();
            $table->string('customer_name')->nullable();
            $table->string('customer_phone')->nullable();
            $table->text('alamat')->nullable();
            $table->decimal('total_harga', 15, 2)->default(0);
            $table->enum('status', ['draft', 'pending', 'dibayar', 'dibatalkan', 'selesai'])->default('draft');
            $table->date('tanggal_transaksi')->nullable();
            $table->enum('tipe_pemesanan', ['pre-order', 'order-via-whatsapp']);
            $table->text('notes')->nullable();
            $table->date('preorder_start')->nullable();
            $table->date('preorder_deadline')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('manual_transaksi_data');
    }
};
