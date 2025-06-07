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
                                            data-bs-target="#tambahPelangganModal"><i class="bx bx-user-plus"></i>
                                            Tambah Pelanggan
                                        </button>
                                    </div>
                                    <div class="card-body">
                                        <x-Dashboard.alert />
                                        <div class="table-responsive">
                                            <table id="dataTable" class="table table-bordered table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Nama Pelanggan</th>
                                                        <th>Nomor HP</th>
                                                        <th>Alamat</th>
                                                        <th>Produk Dibeli</th>
                                                        <th>Beli</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php $No = 1; @endphp
                                                    @foreach ($pelanggan as $item)
                                                        <tr>
                                                            <td>{{ $No++ }}</td>
                                                            <td>{{ $item->nama }}</td>
                                                            <td>{{ $item->no_hp }}</td>
                                                            <td>{{ $item->alamat }}</td>
                                                            <td>
                                                                @if ($item->produk->count() > 0)
                                                                    <span
                                                                        class="badge bg-primary">{{ $item->produk->count() }}
                                                                        produk</span>
                                                                @else
                                                                    <span class="text-muted">Belum ada produk</span>
                                                                @endif
                                                            </td>

                                                            <td>
                                                                <a class="btn btn-sm btn-success"
                                                                    href="{{ route('beliProduk', $item->id) }}">
                                                                    Beli
                                                                </a>
                                                            </td>
                                                            <td>
                                                                <a class="btn btn-sm btn-outline-primary"
                                                                    href="{{ route('detailPelanggan', $item->id) }}">
                                                                    <i class="bx bx-user"></i>
                                                                </a>
                                                                <button type="button"
                                                                    class="btn btn-sm btn-outline-warning btnEdit"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#editPelangganModal"
                                                                    data-id="{{ $item->id }}"
                                                                    data-nama="{{ $item->nama }}"
                                                                    data-no_hp="{{ $item->no_hp }}"
                                                                    data-alamat="{{ $item->alamat }}"
                                                                    data-email="{{ $item->user->email }}">
                                                                    <i class="bx bx-edit"></i>
                                                                </button>

                                                                <button type="button"
                                                                    class="btn btn-sm btn-outline-danger btnHapus"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#hapusPelangganModal"
                                                                    data-id="{{ $item->id }}"
                                                                    data-nama="{{ $item->nama }}">
                                                                    <i class="bx bx-trash"></i>
                                                                </button>

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
                                <!-- Modal Edit Pelanggan -->
                                <div class="modal fade" id="editPelangganModal" tabindex="-1"
                                    aria-labelledby="editModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <form id="formEdit" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Edit Pelanggan</h5>
                                                    <button type="button" class="btn-close"
                                                        data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <input type="hidden" name="id" id="edit-id">
                                                    <div class="mb-3">
                                                        <label class="form-label">Nama</label>
                                                        <input type="text" name="nama" id="edit-nama"
                                                            class="form-control" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Nomor HP</label>
                                                        <input type="text" name="no_hp" id="edit-no_hp"
                                                            class="form-control" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Alamat</label>
                                                        <textarea name="alamat" id="edit-alamat" class="form-control" required></textarea>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Email</label>
                                                        <input type="email" name="email" id="edit-email"
                                                            class="form-control" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Password</label>
                                                        <input type="text" name="password" id="edit-password"
                                                            class="form-control">
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Batal</button>
                                                    <button type="submit" class="btn btn-primary">Update</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
<!-- Modal Hapus Pelanggan -->
<div class="modal fade" id="hapusPelangganModal" tabindex="-1" aria-labelledby="hapusModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="formHapus" method="POST">
            @csrf
            @method('DELETE')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Hapus Pelanggan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin menghapus pelanggan <strong id="hapus-nama"></strong>?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger">Ya, Hapus</button>
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
  <script>
    $(document).ready(function() {
        $('#dataTable').DataTable({
            responsive: true,
            pageLength: 10,
        });

        // Modal Edit
        $('.btnEdit').on('click', function () {
            const id = $(this).data('id');
            $('#formEdit').attr('action', `/home/pelanggan/dataPelanggan/${id}/updatePelanggan`);
            $('#edit-id').val(id);
            $('#edit-nama').val($(this).data('nama'));
            $('#edit-no_hp').val($(this).data('no_hp'));
            $('#edit-alamat').val($(this).data('alamat'));
            $('#edit-email').val($(this).data('email'));
            $('#edit-password').val($(this).data('password'));
        });

        // Modal Hapus
        $('.btnHapus').on('click', function () {
            const id = $(this).data('id');
            const nama = $(this).data('nama');
            $('#formHapus').attr('action', `/home/pelanggan/dataPelanggan/${id}/hapusPelanggan`);
            $('#hapus-nama').text(nama);
        });
    });
</script>




</body>

</html>
