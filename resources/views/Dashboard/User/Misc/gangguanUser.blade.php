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
                                <!-- Card Formulir Lapor Gangguan -->
                                <div class="card mb-4">
                                    <div class="card-header d-flex justify-content-between align-items-center">
                                        <h5 class="mb-0">Formulir Lapor Gangguan</h5>
                                    </div>

                                    <div class="card-body">
                                        <form action="{{ route('uploadGangguan') }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf

                                            {{-- Pilih Perangkat --}}
                                            <div class="mb-3">
                                                <label for="pembelian_id" class="form-label">Pilih Perangkat</label>
                                                <select name="pembelian_id" id="pembelian_id" class="form-select"
                                                    required>
                                                    <option value="">-- Pilih Perangkat --</option>
                                                    @foreach ($gangguan as $item)
                                                    <option value="{{ $item->id }}">
                                                        {{ $item->pembelian_id }} - {{ $item->produk->nama_produk }} -
                                                        {{ $item->alamat }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            {{-- Deskripsi Gangguan --}}
                                            <div class="mb-3">
                                                <label for="deskripsi" class="form-label">Deskripsi Gangguan</label>
                                                <textarea name="deskripsi" id="deskripsi" class="form-control" rows="4"
                                                    required
                                                    placeholder="Ceritakan gangguan yang terjadi..."></textarea>
                                            </div>

                                            {{-- Upload Foto --}}
                                            <div class="mb-3">
                                                <label for="foto" class="form-label">Upload Foto Gangguan (boleh lebih
                                                    dari 1)</label>
                                                <input type="file" name="foto_gangguan[]" id="foto" class="form-control"
                                                    multiple accept="image/*">
                                                <small class="text-muted">Format gambar: JPG, PNG, JPEG. Maks. ukuran
                                                    per file: 2MB</small>
                                            </div>

                                            <div class="d-flex justify-content-end">
                                                <button type="submit" class="btn btn-primary">Kirim Laporan</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                                <!-- Card Data Laporan Gangguan -->
                                <div class="card">
                                    <div class="card-header d-flex justify-content-between align-items-center">
                                        <h5 class="mb-0">Laporan Gangguan Anda</h5>
                                    </div>

                                    <div class="card-body">
                                        @if($laporanGangguan->count())
                                        <div class="table-responsive">
                                            <table class="table table-bordered" id="table-laporan-gangguan">
                                                <thead class="table-light">
                                                    <tr>
                                                        <th>Kode</th>
                                                        <th>Produk</th>
                                                        <th>Alamat</th>
                                                        <th>Deskripsi</th>
                                                        <th>Status</th>
                                                        <th>Foto</th>
                                                        <th>Dikirim Pada</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($laporanGangguan as $lapor)
                                                    <tr>
                                                        <td>{{ $lapor->gangguan_id }}</td>
                                                        <td>{{ $lapor->produk->nama_produk }}</td>
                                                        <td>{{ $lapor->pembelian->alamat ?? '-' }}</td>
                                                        <td>{{ $lapor->deskripsi }}</td>
                                                        <td>
                                                            <span
                                                                class="badge bg-{{ $lapor->status === 'Selesai' ? 'success' : 'warning' }}">
                                                                {{ $lapor->status }}
                                                            </span>
                                                        </td>
                                                        <td>
                                                            @if($lapor->foto_gangguan)
                                                            @foreach ($lapor->foto_gangguan as $foto)
                                                            <a href="{{ asset($foto) }}" target="_blank">
                                                                <img src="{{ asset($foto) }}" width="50"
                                                                    class="img-thumbnail me-1 mb-1">
                                                            </a>
                                                            @endforeach
                                                            @else
                                                            <span class="text-muted">-</span>
                                                            @endif
                                                        </td>
                                                        <td>{{ $lapor->created_at->format('d M Y') }}</td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        @else
                                        <p class="text-muted">Belum ada laporan gangguan yang dikirim.</p>
                                        @endif
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
        $(document).ready(function () {
            $('#table-laporan-gangguan').DataTable({
               
                responsive: true,
                autoWidth: false
            });
        });
    </script>
</body>

</html>