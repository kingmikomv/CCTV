<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default"
    data-assets-path="{{ asset('DHS/assets/"
              data-template="vertical-menu-template-free') }}">
<x-Dashboard.head />

<body>
    <!-- Layout wrapper -->
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
                                        <h5 class="mb-0">Kategori Produk</h5>
                                        <!-- Tombol Tambah Kategori -->
                                        <button class="btn btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#tambahKategoriModal">
                                            Tambah Kategori
                                        </button>
                                    </div>
                                    <div class="card-body p-3">
                                        <div class="table-responsive">
                                            @if (session('success'))
                                                <div class="alert alert-success alert-dismissible fade show"
                                                    role="alert">
                                                    {{ session('success') }}
                                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                        aria-label="Close"></button>
                                                </div>
                                            @endif
                                            <table class="table table-bordered table-striped mb-0">
                                                <thead class="table-light">
                                                    <tr>
                                                        <th style="width: 60px;" class="text-center">No</th>
                                                        <th>Nama Kategori</th>
                                                        <th style="width: 150px;" class="text-center">Jumlah Produk</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse ($kategoris as $index => $kategori)
                                                        <tr>
                                                            <td class="text-center">{{ $index + 1 }}</td>
                                                            <td>{{ $kategori->nama_kategori }}</td>
                                                            <td class="text-center">{{ $kategori->produk_count }}</td>
                                                        </tr>
                                                    @empty
                                                        <tr>
                                                            <td colspan="3" class="text-center text-muted">Belum ada
                                                                kategori.</td>
                                                        </tr>
                                                    @endforelse
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                                <!-- Modal Tambah Kategori -->
                                <div class="modal fade" id="tambahKategoriModal" tabindex="-1"
                                    aria-labelledby="tambahKategoriLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <form action="{{ route('tambahKategori') }}" method="POST">
                                            @csrf
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="tambahKategoriLabel">Tambah Kategori
                                                    </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label for="nama_kategori" class="form-label">Nama
                                                            Kategori</label>
                                                        <input type="text" class="form-control" id="nama_kategori"
                                                            name="nama_kategori" required autofocus>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Batal</button>
                                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                                </div>
                                            </div>
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
</body>

</html>
