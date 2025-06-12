<!DOCTYPE html>
<html lang="en"
      class="light-style layout-menu-fixed"
      dir="ltr"
      data-theme="theme-default"
      data-assets-path="{{ asset('DHS/assets/') }}"
      data-template="vertical-menu-template-free">

<x-Dashboard.head />

<body>
<div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
        <x-Dashboard.sidebar />

        <div class="layout-page">
            <x-Dashboard.nav />

            <div class="content-wrapper">
                <div class="container-xxl flex-grow-1 container-p-y">
                    <div class="row g-4">
                
                        {{-- Tombol Kembali --}}
                        <div class="col-12">
                            <a href="{{ url()->previous() }}" class="btn btn-sm btn-secondary">← Kembali</a>
                        </div>
                
                        @if ($pembelian)
                            {{-- Info Umum --}}
                            <div class="col-md-6">
                                <div class="card h-100">
                                    <div class="card-header"><strong>Info Umum</strong></div>
                                    <div class="card-body">
                                        <dl class="row mb-0">
                                            <dt class="col-sm-5">Kode Pembelian</dt>
                                            <dd class="col-sm-7">{{ $pembelian->pembelian_id }}</dd>
                
                                            <dt class="col-sm-5">Produk</dt>
                                            <dd class="col-sm-7">{{ $pembelian->produk->nama_produk ?? '-' }}</dd>
                
                                            <dt class="col-sm-5">Alamat</dt>
                                            <dd class="col-sm-7">{{ $pembelian->alamat ?? '-' }}</dd>
                                        </dl>
                                    </div>
                                </div>
                            </div>
                
                            {{-- Status --}}
                            <div class="col-md-6">
                                <div class="card h-100">
                                    <div class="card-header"><strong>Status</strong></div>
                                    <div class="card-body">
                                        <dl class="row mb-0">
                                            <dt class="col-sm-5">Pembayaran</dt>
                                            <dd class="col-sm-7">
                                                <span class="badge {{ $pembelian->status_pembayaran === 'Sudah Dibayar' ? 'bg-success' : 'bg-warning' }}">
                                                    {{ $pembelian->status_pembayaran === 'Sudah Dibayar' ? 'Lunas' : 'Belum Lunas' }}
                                                </span>
                                            </dd>
                
                                            <dt class="col-sm-5">Pemasangan</dt>
                                            <dd class="col-sm-7">
                                                <span class="badge {{ $pembelian->status_pemasangan === 'Sudah Dipasang' ? 'bg-primary' : 'bg-secondary' }}">
                                                    {{ $pembelian->status_pemasangan === 'Sudah Dipasang' ? 'Terpasang' : 'Belum Terpasang' }}
                                                </span>
                                            </dd>
                                        </dl>
                                    </div>
                                </div>
                            </div>
                
                            {{-- Informasi Pemasangan --}}
                            <div class="col-md-6">
                                <div class="card h-100">
                                    <div class="card-header"><strong>Informasi Pemasangan</strong></div>
                                    <div class="card-body">
                                        <dl class="row mb-0">
                                            <dt class="col-sm-6">Tanggal Pemasangan</dt>
                                            <dd class="col-sm-6">{{ optional($pembelian->tanggal_pemasangan)->format('d M Y') }}</dd>
                
                                            <dt class="col-sm-6">Jumlah Kamera</dt>
                                            <dd class="col-sm-6">{{ $pembelian->jumlah_kamera_terpasang }}</dd>
                
                                            <dt class="col-sm-6">Merek Kamera</dt>
                                            <dd class="col-sm-6">{{ $pembelian->merek_tipe_kamera }}</dd>
                
                                            <dt class="col-sm-6">Tipe Perekam</dt>
                                            <dd class="col-sm-6">{{ $pembelian->tipe_perekam }}</dd>
                
                                            <dt class="col-sm-6">Merek Perekam</dt>
                                            <dd class="col-sm-6">{{ $pembelian->merek_perekam }}</dd>
                
                                            <dt class="col-sm-6">Ukuran Harddisk</dt>
                                            <dd class="col-sm-6">{{ $pembelian->jumlah_ukuran_harddisk }}</dd>
                
                                            <dt class="col-sm-6">Jenis Kabel</dt>
                                            <dd class="col-sm-6">{{ $pembelian->jenis_kabel }}</dd>
                
                                            <dt class="col-sm-6">Topologi</dt>
                                            <dd class="col-sm-6">{{ $pembelian->topologi_pemasangan }}</dd>
                                        </dl>
                                    </div>
                                </div>
                            </div>
                
                            {{-- Akses Monitoring --}}
                            <div class="col-md-6">
                                <div class="card h-100">
                                    <div class="card-header"><strong>Akses Monitoring</strong></div>
                                    <div class="card-body">
                                        <dl class="row mb-0">
                                            <dt class="col-sm-6">Jenis Akses</dt>
                                            <dd class="col-sm-6">{{ $pembelian->jenis_akses }}</dd>
                
                                            <dt class="col-sm-6">Username</dt>
                                            <dd class="col-sm-6">{{ $pembelian->akun_username }}</dd>
                
                                            <dt class="col-sm-6">Password</dt>
                                            <dd class="col-sm-6">{{ $pembelian->akun_password }}</dd>
                
                                            <dt class="col-sm-6">Device ID</dt>
                                            <dd class="col-sm-6">{{ $pembelian->device_id_serial }}</dd>
                                        </dl>
                                    </div>
                                </div>
                            </div>
                
                            {{-- Biaya --}}
                            <div class="col-md-6">
                                <div class="card h-100">
                                    <div class="card-header"><strong>Biaya</strong></div>
                                    <div class="card-body">
                                        <dl class="row mb-0">
                                            <dt class="col-sm-6">Total Biaya</dt>
                                            <dd class="col-sm-6">Rp {{ number_format($pembelian->total_biaya_pemasangan, 0, ',', '.') }}</dd>
                
                                            <dt class="col-sm-12">Rincian Biaya</dt>
                                            <dd class="col-sm-12"><pre>{{ $pembelian->rincian_biaya }}</pre></dd>
                                        </dl>
                                    </div>
                                </div>
                            </div>
                
                            {{-- Pembayaran --}}
                            <div class="col-md-6">
                                <div class="card h-100">
                                    <div class="card-header"><strong>Pembayaran</strong></div>
                                    <div class="card-body">
                                        <dl class="row mb-0">
                                            <dt class="col-sm-6">Tanggal</dt>
                                            <dd class="col-sm-6">{{ optional($pembelian->tanggal_pembayaran)->format('d M Y') }}</dd>
                
                                            <dt class="col-sm-6">Metode</dt>
                                            <dd class="col-sm-6">{{ $pembelian->metode_pembayaran }}</dd>
                
                                            <dt class="col-sm-6">Bukti Transfer</dt>
                                            <dd class="col-sm-6">
                                                @if ($pembelian->bukti_transfer)
                                                    <a href="{{ asset('storage/' . $pembelian->bukti_transfer) }}" target="_blank">Lihat</a>
                                                @else
                                                    <span class="text-muted">Tidak tersedia</span>
                                                @endif
                                            </dd>
                                        </dl>
                                    </div>
                                </div>
                            </div>
                
                            {{-- Dokumentasi --}}
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header"><strong>Dokumentasi</strong></div>
                                    <div class="card-body">
                                        <dl class="row mb-0">
                                            <dt class="col-sm-3">Denah Lokasi</dt>
                                            <dd class="col-sm-9">
                                                @if ($pembelian->gambar_denah_lokasi)
                                                    <img src="{{ asset('storage/' . $pembelian->gambar_denah_lokasi) }}"
                                                         class="img-fluid" style="max-width: 300px;">
                                                @else
                                                    <span class="text-muted">Tidak tersedia</span>
                                                @endif
                                            </dd>
                
                                            <dt class="col-sm-3">Bukti Transaksi</dt>
                                            <dd class="col-sm-9">
                                                @if ($pembelian->bukti_transaksi)
                                                    <a href="{{ asset('storage/' . $pembelian->bukti_transaksi) }}" target="_blank">Lihat Kwitansi</a>
                                                @else
                                                    <span class="text-muted">Tidak tersedia</span>
                                                @endif
                                            </dd>
                
                                            <dt class="col-sm-3">Foto Instalasi</dt>
                                            <dd class="col-sm-9">
                                                @if ($pembelian->foto_instalasi)
                                                    @foreach (json_decode($pembelian->foto_instalasi, true) as $foto)
                                                        <img src="{{ asset('storage/' . $foto) }}" class="img-thumbnail me-2 mb-2" style="max-width: 150px;">
                                                    @endforeach
                                                @else
                                                    <span class="text-muted">Tidak tersedia</span>
                                                @endif
                                            </dd>
                                        </dl>
                                    </div>
                                </div>
                            </div>
                
                        @else
                            <div class="col-12">
                                <div class="alert alert-warning">Data tidak ditemukan.</div>
                            </div>
                        @endif
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
</body>
</html>
