<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGangguansTable extends Migration
{
    public function up()
    {
        Schema::create('gangguans', function (Blueprint $table) {
            $table->id();
            $table->string('gangguan_id')->unique(); // Kode gangguan unik (GGN001, GGN002, dst)

            // Relasi
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('pembelian_id')->constrained()->onDelete('cascade');
            $table->foreignId('pelanggan_id')->constrained()->onDelete('cascade');
            $table->foreignId('produk_id')->constrained('produk')->onDelete('cascade');

            // Isi laporan
            $table->text('deskripsi');
            $table->json('foto_gangguan')->nullable(); // Untuk multiple foto
            $table->enum('status', ['Belum Dikerjakan', 'Selesai'])->default('Belum Dikerjakan'); // ✅ status baru

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('gangguans');
    }
}
