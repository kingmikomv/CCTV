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
                                        <h5 class="mb-0">Detail pembelian</h5>
                                    </div>

                                    <!-- Card Body -->
                                    <div class="card-body p-3">
                                        <x-Dashboard.alert />
                                        <form action="{{route('updateDetail', $pembelian->id)}}" method="POST" enctype="multipart/form-data"
                                            class="p-4 border rounded bg-light">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="pembelian_id" value="{{ $pembelian->id }}">

                                            <!-- Informasi pembelian -->
                                            <div class="mb-3">
                                                <h5>Nama pembelian:</h5>
                                                <p class="fw-semibold mb-0">{{ $pembelian->nama }}</p>
                                            </div>
                                            <div class="mb-3">
                                                <h6>No HP:</h6>
                                                <p class="mb-0">{{ $pembelian->no_hp }}</p>
                                            </div>

                                            <!-- Status Pemasangan & Pembayaran -->
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label fw-semibold">Status Pemasangan</label>
                                                    <select name="status_pemasangan" class="form-select" required>
                                                        <option disabled>-- Pilih Status --</option>
                                                        <option value="Belum Dipasang"
                                                            {{ $pembelian->status_pemasangan == 'Belum Dipasang' ? 'selected' : '' }}>
                                                            Belum Terpasang</option>
                                                        <option value="Sudah Dipasang"
                                                            {{ $pembelian->status_pemasangan == 'Sudah Dipasang' ? 'selected' : '' }}>
                                                            Terpasang</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label fw-semibold">Status Pembayaran</label>
                                                    <select name="status_pembayaran" class="form-select" required>
                                                        <option disabled>-- Pilih Status --</option>
                                                        <option value="Belum Dibayar"
                                                            {{ $pembelian->status_pembayaran == 'Belum Dibayar' ? 'selected' : '' }}>
                                                            Belum Dibayar</option>
                                                        <option value="Sudah Dibayar"
                                                            {{ $pembelian->status_pembayaran == 'Sudah Dibayar' ? 'selected' : '' }}>
                                                            Lunas</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <!-- Pilih Produk -->
                                            <div class="mb-3">
                                                <label class="form-label fw-semibold">Pilih Produk</label>
                                                <select id="produkSelect" name="produk_id" class="form-select" required>
                                                    <option disabled>-- Pilih Produk --</option>
                                                    @foreach ($produk as $prod)
                                                        <option value="{{ $prod->id }}"
                                                            data-harga="{{ $prod->harga }}"
                                                            {{ $pembelian->produk_id == $prod->id ? 'selected' : '' }}>
                                                            {{ $prod->nama_produk }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <!-- Kode & Alamat -->
                                            <div class="mb-3">
                                                <label class="form-label fw-semibold">Kode Pembelian</label>
                                                <input id="kodePembelian" type="text" name="pembelian_id"
                                                    class="form-control" value="{{ $pembelian->pembelian_id }}"
                                                    readonly>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label fw-semibold">Alamat</label>
                                                <textarea name="alamat" rows="3" class="form-control">{{ $pembelian->alamat }}</textarea>
                                            </div>

                                            <!-- Informasi Pemasangan -->
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label fw-semibold">Tanggal Pemasangan</label>
                                                    <input type="date" name="tanggal_pemasangan" class="form-control"
                                                        value="{{ $pembelian->tanggal_pemasangan ? Carbon\Carbon::parse($pembelian->tanggal_pemasangan)->format('Y-m-d') : '' }}">
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label fw-semibold">Jumlah Kamera
                                                        Terpasang</label>
                                                    <input type="number" name="jumlah_kamera_terpasang"
                                                        class="form-control"
                                                        value="{{ $pembelian->jumlah_kamera_terpasang }}">
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label fw-semibold">Merek & Tipe Kamera</label>
                                                <input type="text" name="merek_tipe_kamera" class="form-control"
                                                    value="{{ $pembelian->merek_tipe_kamera }}">
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label fw-semibold">Tipe Perekam</label>
                                                    <select name="tipe_perekam" class="form-select">
                                                        <option disabled>-- Pilih Tipe --</option>
                                                        <option value="DVR"
                                                            {{ $pembelian->tipe_perekam == 'DVR' ? 'selected' : '' }}>
                                                            DVR</option>
                                                        <option value="NVR"
                                                            {{ $pembelian->tipe_perekam == 'NVR' ? 'selected' : '' }}>
                                                            NVR</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label fw-semibold">Merek Perekam</label>
                                                    <input type="text" name="merek_perekam" class="form-control"
                                                        value="{{ $pembelian->merek_perekam }}">
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label fw-semibold">Jumlah & Ukuran Harddisk</label>
                                                <input type="text" name="jumlah_ukuran_harddisk" class="form-control"
                                                    value="{{ $pembelian->jumlah_ukuran_harddisk }}">
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label fw-semibold">Jenis Kabel yang Digunakan</label>
                                                <input type="text" name="jenis_kabel" class="form-control"
                                                    value="{{ $pembelian->jenis_kabel }}">
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label fw-semibold">Topologi / Lokasi Kamera</label>
                                                <textarea name="topologi_pemasangan" rows="3" class="form-control">{{ $pembelian->topologi_pemasangan }}</textarea>
                                            </div>

                                            <!-- Akses & Akun -->
                                            <div class="mb-3">
                                                <label class="form-label fw-semibold">Jenis Akses</label>
                                                <input type="text" name="jenis_akses" class="form-control"
                                                    value="{{ $pembelian->jenis_akses }}">
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label fw-semibold">Username Monitoring</label>
                                                    <input type="text" name="akun_username" class="form-control"
                                                        value="{{ $pembelian->akun_username }}">
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label fw-semibold">Password Monitoring</label>
                                                    <input type="text" name="akun_password" class="form-control"
                                                        value="{{ $pembelian->akun_password }}">
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label fw-semibold">ID Device / Serial Number</label>
                                                <input type="text" name="device_id_serial" class="form-control"
                                                    value="{{ $pembelian->device_id_serial }}">
                                            </div>

                                            <!-- Biaya -->
                                            <div class="mb-3">
                                                <label class="form-label fw-semibold">Total Biaya Pemasangan</label>
                                                <input type="number" name="total_biaya_pemasangan"
                                                    class="form-control"
                                                    value="{{ $pembelian->total_biaya_pemasangan }}">
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label fw-semibold">Rincian Biaya</label>
                                                <textarea name="rincian_biaya" rows="4" class="form-control">{{ $pembelian->rincian_biaya }}</textarea>
                                            </div>

                                            <!-- Pembayaran -->
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label fw-semibold">Tanggal Pembayaran</label>
                                                    <input type="date" name="tanggal_pembayaran"
                                                        class="form-control"
                                                        value="{{ $pembelian->tanggal_pembayaran ? Carbon\Carbon::parse($pembelian->tanggal_pembayaran)->format('Y-m-d') : '' }}">
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label fw-semibold">Metode Pembayaran</label>
                                                    <select name="metode_pembayaran" class="form-select">
                                                        <option disabled>-- Pilih Metode --</option>
                                                        <option value="Cash"
                                                            {{ $pembelian->metode_pembayaran == 'Cash' ? 'selected' : '' }}>
                                                            Cash</option>
                                                        <option value="Transfer"
                                                            {{ $pembelian->metode_pembayaran == 'Transfer' ? 'selected' : '' }}>
                                                            Transfer</option>
                                                    </select>
                                                </div>
                                            </div>

                                            

                                            <!-- Tombol Submit -->
                                            <button type="submit" class="btn btn-success w-100">Update
                                                Pembelian</button>
                                        </form>
                                    </div>


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
