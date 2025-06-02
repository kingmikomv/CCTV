<section id="produk-detail" class="py-5" style="margin-top: 80px;">
    <div class="container" data-aos="fade-up">
        <div class="section-header text-center mb-5">
            <h2 class="fw-bold">Produk Unggulan Kami</h2>
            <p class="text-muted">Temukan produk terbaik kami dengan kualitas unggulan.</p>
        </div>
        <div class="row align-items-center">
            {{-- Gambar Produk --}}
            <div class="col-md-6 mb-4 mb-md-0">
                <img src="{{ asset('produk/' . $produk->gambar) }}" 
                     alt="{{ $produk->nama_produk }}" 
                     class="img-fluid rounded-4 shadow-sm" 
                     style="max-height: 500px; object-fit: cover; width: 100%;">
            </div>

            {{-- Informasi Produk --}}
            <div class="col-md-6">
                <h2 class="fw-bold">{{ $produk->nama_produk }}</h2>

                <h4 class="text-primary fw-semibold mb-3">
                    Rp {{ number_format($produk->harga, 0, ',', '.') }}
                </h4>

                <div class="mb-4 text-muted">
                    {!! $produk->deskripsi !!}
                </div>

                <a href="{{route('belanja')}}" class="btn btn-outline-secondary">
                    Kembali ke Produk
                </a>
            </div>
        </div>
    </div>
</section>
