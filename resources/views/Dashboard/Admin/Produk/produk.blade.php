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
                                            <i class="bx bx-plus"></i> Tambah Produk
                                        </button>
                                    </div>

                                    {{-- Card Body: Tabel Produk --}}
                                    <div class="card-body px-3 py-3">
                                        <div class="table-responsive">
                                            <x-Dashboard.alert />
                                            <form id="bulkActionForm" method="POST" action="">
                                                @csrf
                                                <div class="d-flex gap-2 mb-3">
                                                    <button type="button" class="btn btn-warning btn-sm"
                                                        onclick="openStokModal()">
                                                        <i class="bx bx-package me-1"></i> Ubah Stok Terpilih
                                                    </button>


                                                </div>
                                            </form>


                                           <table id="produkTable" class="table table-bordered table-striped table-hover align-middle mb-0">

                                                <thead class="table-light text-center">
                                                    <tr>
                                                        <th>
                                                            <input type="checkbox" id="checkAll">
                                                        </th>
                                                        <th>No</th>
                                                        <th>Kode</th>
                                                        <th>Nama Produk</th>
                                                        <th>Kategori</th>
                                                        <th>Harga</th>
                                                        <th>Stok</th>
                                                        <th>Status</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($produk as $index => $produks)
                                                        <tr>
                                                            <td class="text-center">
                                                                <input type="checkbox" name="selected[]"
                                                                    value="{{ $produks->id }}" form="bulkActionForm">

                                                            </td>
                                                            <td class="text-center">{{ $index + 1 }}</td>
                                                            <td>{{ $produks->kode_produk }}</td>
                                                            <td>{{ $produks->nama_produk }}</td>
                                                            <td>{{ $produks->kategori->nama_kategori ?? '-' }}</td>
                                                            <td class="text-end">
                                                                {{ number_format($produks->harga, 0, ',', '.') }}
                                                            </td>
                                                            <td class="text-center">{{ $produks->stok }}</td>
                                                            <td class="text-center">
                                                                <span
                                                                    class="badge bg-{{ $produks->status === 'aktif' ? 'success' : 'secondary' }}">
                                                                    {{ ucfirst($produks->status) }}
                                                                </span>
                                                            </td>
                                                            <td class="text-center">
                                                                <button type="button"
                                                                    class="btn btn-sm btn-outline-primary btn-edit me-1"
                                                                    data-bs-toggle="modal" data-bs-target="#editModal"
                                                                    data-id="{{ $produks->id }}"
                                                                    data-kode="{{ $produks->kode_produk }}"
                                                                    data-nama="{{ $produks->nama_produk }}"
                                                                    data-kategori="{{ $produks->kategori_id }}"
                                                                    data-harga="{{ $produks->harga }}"
                                                                    data-stok="{{ $produks->stok }}"
                                                                    data-status="{{ $produks->status }}">
                                                                    <i class="bx bx-edit me-1"></i>
                                                                </button>


                                                                <a href="{{ route('hapusProduk', $produks->id) }}"
                                                                    class="btn btn-sm btn-outline-danger">
                                                                    <i class="bx bx-trash me-1"></i>
                                                                    </button>
                                                                    </form>
                                                            </td>
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
            <form action="{{ route('uploadProduk') }}" method="POST" enctype="multipart/form-data">
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
                                    class="form-control @error('harga') is-invalid @enderror" id="harga"
                                    name="harga" value="{{ old('harga') }}" required>
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
                                    <option value="nonaktif" {{ old('status') == 'nonaktif' ? 'selected' : '' }}>
                                        Nonaktif
                                    </option>
                                </select>
                                @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Deskripsi --}}
                            <div class="col-12">
                                <label for="deskripsi" class="form-label">Deskripsi</label>
                                <textarea class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" name="deskripsi"
                                    rows="5">{{ old('deskripsi') }}</textarea>
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
    <!-- Modal Edit -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form method="POST" id="editForm">
                @csrf
                @method('PUT')
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Produk</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Tutup"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="produkId">

                        <div class="mb-3">
                            <label>Kode Produk</label>
                            <input type="text" name="kode_produk" id="editKode" class="form-control" required
                                readonly>
                        </div>
                        <div class="mb-3">
                            <label>Nama Produk</label>
                            <input type="text" name="nama_produk" id="editNama" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Kategori</label>
                            <select name="kategori_id" id="editKategori" class="form-control">
                                @foreach ($kategori as $kat)
                                    <option value="{{ $kat->id }}">{{ $kat->nama_kategori }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label>Harga</label>
                            <input type="number" name="harga" id="editHarga" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Stok</label>
                            <input type="number" name="stok" id="editStok" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Status</label>
                            <select name="status" id="editStatus" class="form-control">
                                <option value="aktif">Aktif</option>
                                <option value="nonaktif">Nonaktif</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- Modal Ubah Stok -->
    <div class="modal fade" id="stokModal" tabindex="-1" aria-labelledby="stokModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form method="POST" action="{{ route('produk.bulk-action') }}">
                @csrf
                <input type="hidden" name="action" value="ubah_stok">
                <div id="selectedIdsContainer"></div>
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Ubah Stok Produk Terpilih</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Tutup"></button>
                    </div>
                    <div class="modal-body">
                        <label>Stok Baru</label>
                        <input type="number" name="stok_baru" class="form-control" required>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-warning">Simpan</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const editButtons = document.querySelectorAll('.btn-edit');

            editButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const id = this.dataset.id;

                    // Ganti URL form action menggunakan route name dari Blade
                    const form = document.getElementById('editForm');
                    const routeTemplate = @json(route('updateProduk', ['id' => '__id__']));
                    form.action = routeTemplate.replace('__id__', id);

                    // Isi form input lainnya
                    document.getElementById('editKode').value = this.dataset.kode;
                    document.getElementById('editNama').value = this.dataset.nama;
                    document.getElementById('editKategori').value = this.dataset.kategori;
                    document.getElementById('editHarga').value = this.dataset.harga;
                    document.getElementById('editStok').value = this.dataset.stok;
                    document.getElementById('editStatus').value = this.dataset.status;
                });
            });
        });
    </script>

    <script>
        // Check all checkbox logic
        document.getElementById('checkAll').addEventListener('click', function() {
            document.querySelectorAll('input[name="selected[]"]').forEach(cb => {
                cb.checked = this.checked;
            });
        });
    </script>
    <script>
        // Check all checkbox
        document.getElementById('checkAll').addEventListener('change', function() {
            document.querySelectorAll('input[name="selected[]"]').forEach(cb => cb.checked = this.checked);
        });

        // Buka modal stok
        function openStokModal() {
            const selectedIds = Array.from(document.querySelectorAll('input[name="selected[]"]:checked'))
                .map(cb => cb.value);

            if (selectedIds.length === 0) {
                alert("Pilih minimal satu produk.");
                return;
            }

            // Tambahkan hidden input ke modal form
            const container = document.getElementById('selectedIdsContainer');
            container.innerHTML = ''; // kosongkan dulu

            selectedIds.forEach(id => {
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'selected[]';
                input.value = id;
                container.appendChild(input);
            });

            new bootstrap.Modal(document.getElementById('stokModal')).show();
        }
    </script>
<script>
    $(document).ready(function() {
        $('#produkTable').DataTable({
            // opsional, bisa diisi konfigurasi DataTables
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true
        });
    });

    // Untuk checkbox "Check All"
    $('#checkAll').on('click', function() {
        var checked = $(this).prop('checked');
        $('input[name="selected[]"]').prop('checked', checked);
    });
</script>

</body>

</html>
