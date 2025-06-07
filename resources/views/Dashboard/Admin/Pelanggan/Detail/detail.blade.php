<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default"
    data-assets-path="{{ asset('DHS/assets/') }}" data-template="vertical-menu-template-free">

<x-Dashboard.head />

<body>
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">

            <!-- Sidebar -->
            <x-Dashboard.sidebar />

            <!-- Layout page -->
            <div class="layout-page">

                <!-- Navbar -->
                <x-Dashboard.nav />

                <!-- Content wrapper -->
                <div class="content-wrapper">

                    <!-- Main container -->
                    <div class="container-xxl flex-grow-1 container-p-y">

                        <!-- Page Heading -->
                        <div class="row">
                            <div class="col-12 col-lg-12 order-2 order-md-3 order-lg-2 mb-4">
                                <div class="card shadow-sm rounded">

                                    <!-- Card Header -->
                                    <div class="card-header">
                                        <h5 class="mb-0">Detail Pembelian</h5>
                                    </div>

                                    <!-- Card Body -->
                                    <div class="card-body">

                                        <!-- Info Pembeli -->
                                        <div class="mb-4">
                                            <h6 class="fw-bold">DATA PEMBELI</h6>
                                            <p class="mb-1">Nama: <span
                                                    class="text-primary">{{ $pembelian->nama }}</span></p>
                                            <p>No HP: <span class="text-primary">{{ $pembelian->no_hp }}</span></p>
                                        </div>
                                        <x-Dashboard.alert />
                                        <!-- Accordion for Pembelian Details -->
                                        <div class="accordion" id="accordionExample">
                                            @foreach ($data as $index => $pembeli)
                                                <div class="accordion-item mb-3 border rounded shadow-sm">
                                                    <h2 class="accordion-header" id="heading{{ $index }}">
                                                        <button class="accordion-button collapsed fw-semibold"
                                                            type="button" data-bs-toggle="collapse"
                                                            data-bs-target="#collapse{{ $index }}"
                                                            aria-expanded="false"
                                                            aria-controls="collapse{{ $index }}">
                                                            {{ $pembeli->produk->nama_produk }}

                                                        </button>
                                                    </h2>

                                                    <div id="collapse{{ $index }}"
                                                        class="accordion-collapse collapse"
                                                        aria-labelledby="heading{{ $index }}"
                                                        data-bs-parent="#accordionExample">
                                                        <div class="accordion-body">
                                                            <hr>
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <a href="{{route('editDetail', $pembeli->id)}}"
                                                                        class="btn btn-block btn-warning"><i
                                                                            class="bx bx-edit"></i> Edit</a>
                                                                    <a href="{{route('hapusDetail', $pembeli->id)}}"
                                                                        class="btn btn-block btn-danger"><i
                                                                            class="bx bx-trash"></i> Hapus</a>

                                                                </div>
                                                                <div class="col-md-6 mt-3">
                                                                    <p><strong>Status Pembayaran:</strong>
                                                                        {{ $pembeli->status_pembayaran ?? '-' }} -
                                                                        {{ $pembeli->pembelian_id }}</p>

                                                                    <p><strong>Tanggal Pemasangan:</strong>
                                                                        {{ $pembeli->tanggal_pemasangan ? $pembeli->tanggal_pemasangan->format('d-m-Y') : '-' }}
                                                                    </p>

                                                                    <p><strong>Alamat:</strong>
                                                                        {{ $pembeli->alamat ?? '-' }}</p>

                                                                    <p><strong>Jumlah Kamera Terpasang:</strong>
                                                                        {{ $pembeli->jumlah_kamera_terpasang ?? '-' }}
                                                                    </p>

                                                                    <p><strong>Merek & Tipe Kamera:</strong>
                                                                        {{ $pembeli->merek_tipe_kamera ?? '-' }}</p>

                                                                    <p><strong>Tipe Perekam:</strong>
                                                                        {{ $pembeli->tipe_perekam ?? '-' }}</p>

                                                                    <p><strong>Merek Perekam:</strong>
                                                                        {{ $pembeli->merek_perekam ?? '-' }}</p>

                                                                    <p><strong>Ukuran Harddisk:</strong>
                                                                        {{ $pembeli->jumlah_ukuran_harddisk ?? '-' }}
                                                                    </p>

                                                                    <p><strong>Jenis Kabel:</strong>
                                                                        {{ $pembeli->jenis_kabel ?? '-' }}</p>
                                                                </div>
                                                                <div class="col-md-6">

                                                                    <p><strong>Topologi Pemasangan:</strong>
                                                                        {{ $pembeli->topologi_pemasangan ?? '-' }}</p>

                                                                    <p><strong>Jenis Akses:</strong>
                                                                        {{ $pembeli->jenis_akses ?? '-' }}</p>

                                                                    <p><strong>Akun Username:</strong>
                                                                        {{ $pembeli->akun_username ?? '-' }}</p>

                                                                    <p><strong>Akun Password:</strong>
                                                                        {{ $pembeli->akun_password ?? '-' }}</p>

                                                                    <p><strong>Device ID Serial:</strong>
                                                                        {{ $pembeli->device_id_serial ?? '-' }}</p>

                                                                    <p><strong>Total Biaya Pemasangan:</strong>
                                                                        Rp{{ number_format($pembeli->produk->harga + $pembeli->total_biaya_pemasangan ?? 0, 2, ',', '.') }}
                                                                    </p>

                                                                    <p><strong>Rincian Biaya:</strong>
                                                                        {{ $pembeli->rincian_biaya ?? '-' }}</p>

                                                                    <p><strong>Tanggal Pembayaran:</strong>
                                                                        {{ $pembeli->tanggal_pembayaran ? $pembeli->tanggal_pembayaran->format('d-m-Y') : '-' }}
                                                                    </p>

                                                                    <p><strong>Metode Pembayaran:</strong>
                                                                        {{ $pembeli->metode_pembayaran ?? '-' }}</p>
                                                                </div>
                                                            </div>



                                                            {{-- Dokumentasi Foto Instalasi --}}
                                                            @if ($pembeli->foto_instalasi)
                                                                <p class="mt-3 fw-semibold">Foto Instalasi:</p>
                                                                <div class="d-flex flex-wrap gap-2">
                                                                    @foreach (json_decode($pembeli->foto_instalasi) as $foto)
                                                                        <img src="{{ asset('storage/' . $foto) }}"
                                                                            alt="Foto Instalasi" class="img-thumbnail"
                                                                            style="width:100px; height:auto;">
                                                                    @endforeach
                                                                </div>
                                                            @endif

                                                            {{-- Dokumentasi Denah Lokasi --}}
                                                            @if ($pembeli->gambar_denah_lokasi)
                                                                <p class="mt-3 fw-semibold">Denah Lokasi:</p>
                                                                <img src="{{ asset('storage/' . $pembeli->gambar_denah_lokasi) }}"
                                                                    alt="Denah Lokasi" class="img-fluid rounded"
                                                                    style="max-width:200px;">
                                                            @endif

                                                            {{-- Dokumentasi Bukti Transaksi --}}
                                                            @if ($pembeli->bukti_transaksi)
                                                                <p class="mt-3 fw-semibold">Bukti Transaksi:</p>
                                                                <img src="{{ asset('storage/' . $pembeli->bukti_transaksi) }}"
                                                                    alt="Bukti Transaksi" class="img-fluid rounded"
                                                                    style="max-width:200px;">
                                                            @endif

                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>

                                    </div> <!-- End Card Body -->

                                </div> <!-- End Card -->
                            </div>
                        </div> <!-- End Row -->

                    </div> <!-- End Container -->

                    <!-- Footer -->
                    <x-Dashboard.footer />

                    <div class="content-backdrop fade"></div>

                </div> <!-- End Content Wrapper -->

            </div> <!-- End Layout Page -->

        </div> <!-- End Layout Container -->

        <div class="layout-overlay layout-menu-toggle"></div>
    </div> <!-- End Layout Wrapper -->

    <!-- Bootstrap 5 JS Bundle (includes Popper) -->

    <!-- Dashboard Scripts -->
    <x-Dashboard.script />

</body>

</html>
