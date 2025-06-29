<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('katalogs', function (Blueprint $table) {
            $table->text('foto_lain')->nullable()->after('gambar_produk');
        });
    }

    public function down(): void
    {
        Schema::table('katalogs', function (Blueprint $table) {
            $table->dropColumn('foto_lain');
        });
    }
};
