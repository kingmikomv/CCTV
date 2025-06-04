<section class="py-5" style="margin-top: 80px;">
    <div class="container">
        <div class="row bg-white p-4 shadow rounded-4 align-items-center">
            <!-- Gambar Produk -->
            <div class="col-md-5 text-center mb-3 mb-md-0">
                <img src="{{ asset('produk/' . $produk->gambar) }}" alt="{{ $produk->nama_produk }}"
                    class="img-fluid rounded-3 border" style="max-height: 400px; object-fit: cover;" />
                <!-- Thumbnail sederhana, bisa ditambah jika ada gambar lain -->
                <div class="d-flex justify-content-center gap-2 mt-3 flex-wrap">
                    <img src="{{ asset('produk/' . $produk->gambar) }}" width="60" class="border rounded"
                        alt="Thumbnail" />
                </div>
            </div>

            <!-- Informasi Produk -->
            <div class="col-md-7">
                <h5 class="text-danger fw-bold mb-2">[Garansi 1 Tahun]</h5>
                <h2 class="fw-semibold mb-3">{{ $produk->nama_produk }}</h2>

                <!-- Harga -->
                <div class="d-flex align-items-baseline gap-3 mb-3">
                    <div class="bg-danger text-white py-2 px-3 rounded-2 fw-bold fs-5">
                        Rp {{ number_format($produk->harga, 0, ',', '.') }}
                    </div>
                    <div class="text-muted text-decoration-line-through fs-6">
                        Rp {{ number_format($produk->harga * 2, 0, ',', '.') }}
                    </div>
                </div>

                <!-- Tombol aksi -->
                <div class="d-flex gap-3 flex-wrap">
                    <button class="btn btn-outline-danger px-4 py-2 flex-grow-1 flex-md-grow-0">
                        <i class="bi bi-whatsapp"></i> Pesan Sekarang
                    </button>

                </div>
            </div>
        </div>


        <!-- Deskripsi -->
        <div class="bg-white mt-5 p-4 shadow rounded-4">
            <h4 class="fw-bold mb-3">Deskripsi Produk</h4>
            <div class="text-secondary lh-lg" style="font-size: 1rem;">
                {!! $produk->deskripsi !!}
            </div>
        </div>
    </div>
</section>
