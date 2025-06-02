<section id="belanja" class="about section" style="margin-top: 100px">
    <div class="container" data-aos="fade-up">
        <div class="section-header text-center mb-5">
            <h2 class="fw-bold">Produk Unggulan Kami</h2>
            <p class="text-muted">Temukan produk terbaik kami dengan kualitas unggulan.</p>
        </div>

        <div class="row gy-4 justify-content-center">
            @foreach ($produks as $produk)
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="card h-100 shadow-sm border-0 rounded-4">
                        <img src="{{ asset('produk/' . $produk->gambar) }}" class="card-img-top rounded-top-4" alt="{{ $produk->nama_produk }}" style="height: 250px; object-fit: cover;">
                        <div class="card-body">
                            <h5 class="card-title">{{ $produk->nama_produk }}</h5>
<p class="card-text text-muted mb-2" style="min-height: 50px;">
    {{ Str::limit(strip_tags($produk->deskripsi), 100) }}
</p>
                            <h6 class="fw-semibold text-primary">Rp {{ number_format($produk->harga, 0, ',', '.') }}</h6>
                            <a href="{{route('belanjaShow', $produk->slug)}}" class="btn btn-outline-primary mt-3 w-100">Lihat Detail</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="text-center mt-5">
            <a href="" class="btn btn-primary px-4 py-2 rounded-pill">Lihat Semua Produk</a>
        </div>
    </div>
</section>
