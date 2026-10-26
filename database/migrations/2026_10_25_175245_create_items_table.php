
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('items')) {
            Schema::create('items', function (Blueprint $table) {
                $table->id();
                $table->string('kode_barang', 50)->unique();
                $table->string('nama_barang');
                $table->string('kategori');
                $table->unsignedInteger('jumlah')->default(0);
                $table->string('lokasi_simpan');
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
