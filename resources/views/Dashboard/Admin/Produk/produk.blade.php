<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default"
    data-assets-path="{{ asset('DHS/assets/') }}" data-template="vertical-menu-template-free">

<x-Dashboard.head />

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">

            {{-- Sidebar --}}
            <x-Dashboard.sidebar />

            <!-- Layout page -->
            <div class="layout-page">

                {{-- Navbar --}}
                <x-Dashboard.nav />

                {{-- Content wrapper --}}
                <div class="content-wrapper">

                    {{-- Main content container --}}
                    <div class="container-xxl flex-grow-1 container-p-y">

                        {{-- Data Produk Card --}}
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header d-flex justify-content-between align-items-center">
                                        {{-- Card Header: Title + Tambah Produk Button --}}
                                        <h5 class="m-0">Data Produk</h5>
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#tambahProdukModal">
                                            Tambah Produk
                                        </button>
                                    </div>

                                    {{-- Card Body: Tabel Produk --}}
                                    <div class="card-body px-3 py-3">
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-striped table-hover align-middle mb-0">
                                                <thead class="table-light text-center">
                                                    <tr>
                                                        <th style="width: 5%;">No</th>
                                                        <th style="width: 15%;">Kode Produk</th>
                                                        <th>Nama Produk</th>
                                                        <th style="width: 15%;">Kategori</th>
                                                        <th style="width: 15%;">Harga</th>
                                                        <th style="width: 10%;">Stok</th>
                                                        <th style="width: 10%;">Status</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($produk as $index => $produks)
                                                        <tr>
                                                            <td class="text-center">{{ $index + 1 }}</td>
                                                            <td>{{ $produks->kode_produk }}</td>
                                                            <td>{{ $produks->nama_produk }}</td>
                                                            <td>{{ $produks->kategori->nama_kategori ?? '-' }}</td>
                                                            <td class="text-end">{{ number_format($produks->harga, 0, ',', '.') }}</td>
                                                            <td class="text-center">{{ $produks->stok }}</td>
                                                            <td class="text-center">{{ ucfirst($produks->status) }}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        {{-- End Data Produk Card --}}

                    </div>
                    {{-- End Main content container --}}

                    {{-- Footer --}}
                    <x-Dashboard.footer />

                    <div class="content-backdrop fade"></div>
                </div>
                <!-- / Content wrapper -->

            </div>
            <!-- / Layout page -->

        </div>
        <!-- / Layout container -->

        <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->

    {{-- Scripts --}}
    <x-Dashboard.script />

    {{-- Modal Tambah Produk --}}
    <div class="modal fade" id="tambahProdukModal" tabindex="-1" aria-labelledby="tambahProdukModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form action="{{route('uploadProduk')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-content">

                    {{-- Modal Header --}}
                    <div class="modal-header">
                        <h5 class="modal-title" id="tambahProdukModalLabel">Tambah Produk</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    {{-- Modal Body --}}
                    <div class="modal-body">

                        <div class="row g-3">
                            {{-- Kode Produk --}}
                           
                            {{-- Nama Produk --}}
                            <div class="col-md-12">
                                <label for="nama_produk" class="form-label">Nama Produk</label>
                                <input type="text" class="form-control @error('nama_produk') is-invalid @enderror"
                                    id="nama_produk" name="nama_produk" value="{{ old('nama_produk') }}" required>
                                @error('nama_produk')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Kategori --}}
                            <div class="col-md-6">
                                <label for="kategori_id" class="form-label">Kategori</label>
                                <select name="kategori_id" id="kategori_id"
                                    class="form-select @error('kategori_id') is-invalid @enderror" required>
                                    <option value="">-- Pilih Kategori --</option>
                                    @foreach ($kategori as $k)
                                        <option value="{{ $k->id }}"
                                            {{ old('kategori_id') == $k->id ? 'selected' : '' }}>
                                            {{ $k->nama_kategori }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('kategori_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Harga --}}
                            <div class="col-md-6">
                                <label for="harga" class="form-label">Harga</label>
                                <input type="number" step="0.01"
                                    class="form-control @error('harga') is-invalid @enderror" id="harga" name="harga"
                                    value="{{ old('harga') }}" required>
                                @error('harga')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Stok --}}
                            <div class="col-md-6">
                                <label for="stok" class="form-label">Stok</label>
                                <input type="number" class="form-control @error('stok') is-invalid @enderror"
                                    id="stok" name="stok" value="{{ old('stok', 0) }}" required>
                                @error('stok')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Status --}}
                            <div class="col-md-6">
                                <label for="status" class="form-label">Status</label>
                                <select name="status" id="status"
                                    class="form-select @error('status') is-invalid @enderror" required>
                                    <option value="aktif" {{ old('status') == 'aktif' ? 'selected' : '' }}>Aktif
                                    </option>
                                    <option value="nonaktif" {{ old('status') == 'nonaktif' ? 'selected' : '' }}>Nonaktif
                                    </option>
                                </select>
                                @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Deskripsi --}}
                           <div class="col-12">
    <label for="deskripsi" class="form-label">Deskripsi</label>
    <textarea class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" name="deskripsi" rows="5">{{ old('deskripsi') }}</textarea>
    @error('deskripsi')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

                            {{-- Gambar Produk --}}
                            <div class="col-12">
                                <label for="gambar" class="form-label">Gambar Produk (optional)</label>
                                <input type="file" class="form-control @error('gambar') is-invalid @enderror"
                                    id="gambar" name="gambar" accept="image/*">
                                @error('gambar')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                    </div>

                    {{-- Modal Footer --}}
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan Produk</button>
                    </div>

                </div>
            </form>
        </div>
    </div>

</body>

</html>
