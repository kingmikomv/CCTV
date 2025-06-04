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
                                        <h5 class="mb-0">Data Pelanggan</h5>
                                        <button class="btn btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#tambahPelangganModal">
                                            Tambah Pelanggan
                                        </button>
                                    </div>
                                    <div class="card-body p-3">
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>Nama Pelanggan</th>
                                                        <th>Nomor HP</th>
                                                        <th>Alamat</th>
                                                        <th>Produk Dibeli</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($pelanggan as $item)
                                                        <tr>
                                                            <td>{{ $item->nama }}</td>
                                                            <td>{{ $item->no_hp }}</td>
                                                            <td>{{ $item->alamat }}</td>
                                                            <td>
                                                                @if ($item->produk->count())
                                                                    <ul class="mb-0 ps-3">
                                                                        @foreach ($item->produk as $produk)
                                                                            <li>{{ $produk->nama_produk }}</li>
                                                                        @endforeach
                                                                    </ul>
                                                                @else
                                                                    <span class="text-muted">Belum ada produk</span>
                                                                @endif
                                                            </td>
                                                            <td>
                                                                <a class="btn btn-sm btn-success" href="{{route('beliProduk', $item->id)}}">
                                                                    Beli Produk
                                                                </a>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                                <!-- Modal Tambah Pelanggan -->
                                <div class="modal fade" id="tambahPelangganModal" tabindex="-1"
                                    aria-labelledby="modalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form action="{{ route('uploadPelanggan') }}" method="POST">
                                                @csrf
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="modalLabel">Tambah Pelanggan Baru</h5>
                                                    <button type="button" class="btn-close"
                                                        data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label class="form-label">Nama</label>
                                                        <input type="text" name="nama" class="form-control"
                                                            required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Nomor HP</label>
                                                        <input type="text" name="no_hp" class="form-control"
                                                            required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Alamat</label>
                                                        <textarea name="alamat" class="form-control" required></textarea>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Email Login</label>
                                                        <input type="email" name="email" class="form-control"
                                                            required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Password Login</label>
                                                        <input type="password" name="password" class="form-control"
                                                            required>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Batal</button>
                                                    <button type="submit" class="btn btn-primary">Tambah</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <!-- Modal Beli Produk -->
                             
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

    

</body>

</html>
