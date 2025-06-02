<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
       Schema::create('produk', function (Blueprint $table) {
    $table->id();
    $table->string('slug')->unique(); // Tambah slug
    $table->string('kode_produk')->unique();
    $table->string('nama_produk');
    $table->foreignId('kategori_id')->constrained('kategori')->onDelete('cascade');
    $table->decimal('harga', 12, 2);
    $table->integer('stok')->default(0);
    $table->text('deskripsi')->nullable();
    $table->string('gambar')->nullable();
    $table->enum('status', ['aktif', 'nonaktif'])->default('aktif');
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produk');
    }
};
