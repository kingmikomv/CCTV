<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default"
    data-assets-path="{{ asset('DHS/assets/') }}" data-template="vertical-menu-template-free">

<x-Dashboard.head />

<body>
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <x-Dashboard.sidebar />

            <div class="layout-page">
                <x-Dashboard.nav />

                <div class="content-wrapper">
                    <div class="container-xxl flex-grow-1 container-p-y">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header d-flex justify-content-between align-items-center">
                                        <h5 class="mb-0">Tambah Pembelian</h5>
                                    </div>
 <x-Dashboard.alert />
                                    <div class="card-body p-3">
                                        <form action="{{ route('uploadPembelian', $pelanggan->id) }}" method="POST"
                                            enctype="multipart/form-data" class="p-4 border rounded bg-light">
                                            @csrf
                                            <input type="hidden" name="pelanggan_id" value="{{ $pelanggan->id }}">

                                            <div class="mb-3">
                                                <h5>Nama Pelanggan:</h5>
                                                <p class="fw-semibold mb-0">{{ $pelanggan->nama }}</p>
                                            </div>

                                            <div class="mb-3">
                                                <h6>No HP:</h6>
                                                <p class="mb-0">{{ $pelanggan->no_hp }}</p>
                                            </div>

                                            <!-- Status -->
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label fw-semibold">Status Pemasangan</label>
                                                    <select name="status_pemasangan" class="form-select" required>
                                                        <option value="" disabled selected>-- Pilih Status --
                                                        </option>
                                                        <option value="Belum Dipasang">Belum Terpasang</option>
                                                        <option value="Sudah Dipasang">Terpasang</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label fw-semibold">Status Pembayaran</label>
                                                    <select name="status_pembayaran" class="form-select" required>
                                                        <option value="" disabled selected>-- Pilih Status --
                                                        </option>
                                                        <option value="Belum Dibayar">Belum Dibayar</option>
                                                        <option value="Sudah Dibayar">Lunas</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <!-- Produk -->
                                            <div class="mb-3">
                                                <label class="form-label fw-semibold">Pilih Produk</label>
                                                <select id="produkSelect" name="produk_id" class="form-select" required>
                                                    <option value="" disabled selected>-- Pilih Produk --</option>
                                                    @foreach ($produk as $prod)
                                                        <option value="{{ $prod->id }}"
                                                            data-harga="{{ $prod->harga }}">{{ $prod->nama_produk }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label fw-semibold">Kode Pembelian</label>
                                                <input id="kodePembelian" type="text" name="pembelian_id"
                                                    class="form-control" readonly>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label fw-semibold">Alamat</label>
                                                <textarea name="alamat" rows="3" class="form-control"></textarea>
                                            </div>
                                            <!-- Informasi Pemasangan -->
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label fw-semibold">Tanggal Pemasangan</label>
                                                    <input type="date" name="tanggal_pemasangan"
                                                        class="form-control">
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label fw-semibold">Jumlah Kamera
                                                        Terpasang</label>
                                                    <input type="number" name="jumlah_kamera_terpasang"
                                                        class="form-control">
                                                </div>
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label fw-semibold">Merek & Tipe Kamera</label>
                                                <input type="text" name="merek_tipe_kamera" class="form-control">
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label fw-semibold">Tipe Perekam</label>
                                                    <select name="tipe_perekam" class="form-select">
                                                        <option value="" disabled selected>-- Pilih Tipe --
                                                        </option>
                                                        <option value="DVR">DVR</option>
                                                        <option value="NVR">NVR</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label fw-semibold">Merek Perekam</label>
                                                    <input type="text" name="merek_perekam" class="form-control">
                                                </div>
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label fw-semibold">Jumlah & Ukuran Harddisk</label>
                                                <input type="text" name="jumlah_ukuran_harddisk" class="form-control"
                                                    placeholder="Contoh: 2x1TB">
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label fw-semibold">Jenis Kabel yang Digunakan</label>
                                                <input type="text" name="jenis_kabel" class="form-control">
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label fw-semibold">Topologi / Lokasi Kamera</label>
                                                <textarea name="topologi_pemasangan" rows="3" class="form-control"></textarea>
                                            </div>

                                            <!-- Akses & Akun -->
                                            <div class="mb-3">
                                                <label class="form-label fw-semibold">Jenis Akses</label>
                                                <input type="text" name="jenis_akses" class="form-control"
                                                    placeholder="Contoh: aplikasi mobile">
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label fw-semibold">Username Monitoring</label>
                                                    <input type="text" name="akun_username" class="form-control">
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label fw-semibold">Password Monitoring</label>
                                                    <input type="text" name="akun_password" class="form-control">
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label fw-semibold">ID Device / Serial Number</label>
                                                <input type="text" name="device_id_serial" class="form-control">
                                            </div>

                                            <!-- Biaya -->
                                            <div class="mb-3">
                                                <label class="form-label fw-semibold">Total Biaya Pemasangan</label>
                                                <input type="number" name="total_biaya_pemasangan"
                                                    class="form-control">
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label fw-semibold">Rincian Biaya</label>
                                                <textarea name="rincian_biaya" rows="4" class="form-control"
                                                    placeholder="Contoh: CCTV: 2jt, DVR: 1jt, Kabel: 500rb, Jasa: 1jt"></textarea>
                                            </div>

                                            <!-- Pembayaran -->
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label fw-semibold">Tanggal Pembayaran</label>
                                                    <input type="date" name="tanggal_pembayaran"
                                                        class="form-control">
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label fw-semibold">Metode Pembayaran</label>
                                                    <select name="metode_pembayaran" class="form-select">
                                                        <option value="" disabled selected>-- Pilih Metode --
                                                        </option>
                                                        <option value="Cash">Cash</option>
                                                        <option value="Transfer">Transfer</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <!-- Upload -->
                                            <div class="mb-3">
                                                <label class="form-label fw-semibold">Upload Bukti Transfer</label>
                                                <input type="file" name="bukti_transfer" class="form-control">
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label fw-semibold">Foto-foto Instalasi (awal &
                                                    akhir)</label>
                                                <input type="file" name="foto_instalasi[]" class="form-control"
                                                    multiple>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label fw-semibold">Upload Gambar Denah
                                                    Lokasi</label>
                                                <input type="file" name="gambar_denah_lokasi"
                                                    class="form-control">
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label fw-semibold">Upload Bukti Transaksi /
                                                    Kwitansi</label>
                                                <input type="file" name="bukti_transaksi" class="form-control">
                                            </div>

                                            <button type="submit" class="btn btn-primary w-100">Simpan
                                                Pembelian</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <x-Dashboard.footer />
                    <div class="content-backdrop fade"></div>
                </div>
            </div>
        </div>

        <div class="layout-overlay layout-menu-toggle"></div>
    </div>

    <x-Dashboard.script />
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const produkSelect = document.getElementById('produkSelect');
            const kodePembelianInput = document.getElementById('kodePembelian');
            const pelangganId = "{{ $pelanggan->id }}";

            produkSelect.addEventListener('change', function() {
                // Format tanggal: ddmmyy
                const today = new Date();
                const dd = String(today.getDate()).padStart(2, '0');
                const mm = String(today.getMonth() + 1).padStart(2, '0'); // bulan dimulai dari 0
                const yy = String(today.getFullYear()).slice(-2);

                // Random alphanumeric string (3 chars)
                const random = Math.random().toString(36).substring(2, 5).toUpperCase();

                const kode = `#${dd}${mm}${yy}${pelangganId}${random}`;
                kodePembelianInput.value = kode;
            });
        });
    </script>

</body>

</html>
