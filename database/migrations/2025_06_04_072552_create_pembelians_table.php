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
        Schema::create('pembelians', function (Blueprint $table) {
    $table->id();
    $table->string('pembelian_id')->nullable();
    $table->foreignId('pelanggan_id')->constrained('pelanggans')->onDelete('cascade');
    $table->foreignId('produk_id')->constrained('produk')->onDelete('cascade');
    $table->string('qrcode')->nullable();
    $table->text('alamat')->nullable();
    // Status
    $table->string('status_pembayaran')->nullable();
    $table->string('status_pemasangan')->nullable();

    // Informasi pemasangan
    $table->date('tanggal_pemasangan')->nullable();
    $table->integer('jumlah_kamera_terpasang')->nullable();
    $table->string('merek_tipe_kamera')->nullable();
    $table->string('tipe_perekam')->nullable(); // DVR / NVR
    $table->string('merek_perekam')->nullable();
    $table->string('jumlah_ukuran_harddisk')->nullable(); // Contoh: "2x1TB"
    $table->string('jenis_kabel')->nullable();
    $table->text('topologi_pemasangan')->nullable(); // Lokasi tiap kamera

    // Akses aplikasi monitoring
    $table->string('jenis_akses')->nullable(); // Misal: mobile app, web app
    $table->string('akun_username')->nullable();
    $table->string('akun_password')->nullable();
    $table->string('device_id_serial')->nullable();

    // Biaya
    $table->decimal('total_biaya_pemasangan', 15, 2)->nullable();
    $table->text('rincian_biaya')->nullable(); // JSON atau plain text

    // Pembayaran
    $table->date('tanggal_pembayaran')->nullable();
    $table->string('metode_pembayaran')->nullable(); // Cash, Transfer, dll
    $table->string('bukti_transfer')->nullable(); // Path file upload

    // Dokumentasi
    $table->json('foto_instalasi')->nullable(); // Array foto (awal, akhir)
    $table->string('gambar_denah_lokasi')->nullable(); // Path denah
    $table->string('bukti_transaksi')->nullable(); // Path kwitansi

    $table->timestamps();
});


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembelians');
    }
};
