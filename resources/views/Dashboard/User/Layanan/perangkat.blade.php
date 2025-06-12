<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default"
    data-assets-path="{{ asset('DHS/assets/" data-template="vertical-menu-template-free') }}">
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
                                        <h5 class="mb-0">Perangkat Saya</h5>
                                        <!-- Tombol Tambah Kategori -->
                                       
                                    </div>
                                    <div class="card-body p-3">
                                        <div class="table-responsive">
                                            <table id="table-perangkat" class="table table-bordered table-striped">
                                                <thead class="table-light">
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Kode Pembelian</th>
                                                        <th>Merek Kamera</th>
                                                        <th>Alamat</th>

                                                        <th>Tanggal Pemasangan</th>
                                                        <th>Status</th>

                                                        <th>Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse ($perangkat as $index => $item)
                                                    @foreach ($item->pembelian as $pembelian)
                                                    <tr>
                                                        <td>{{ $index + 1 }}</td>
                                                        <td>{{$pembelian->pembelian_id}}</td>

                                                        <td>{{ $pembelian->produk->nama_produk }}</td>
                                                        <td>{{ $pembelian->alamat ?? '-' }}</td>

                                                        <td>{{
                                                            \Carbon\Carbon::parse($pembelian->tanggal_pemasangan)->format('d
                                                            M Y') }}</td>
                                                        <td>
                                                            <span
                                                                class="badge {{ $pembelian->status_pembayaran == 'Sudah Dibayar' ? 'bg-success' : 'bg-warning' }}">
                                                                {{ $pembelian->status_pembayaran == 'Sudah Dibayar' ?
                                                                'Lunas' : 'Belum Lunas' }}
                                                            </span>
                                                            <span
                                                                class="badge {{ $pembelian->status_pemasangan == 'Sudah Dipasang' ? 'bg-primary' : 'bg-secondary' }}">
                                                                {{ $pembelian->status_pemasangan == 'Sudah Dipasang' ?
                                                                'Terpasang' : 'Belum Terpasang' }}
                                                            </span>
                                                        </td>


                                                        <td>
                                                            <a href="{{route('detailPerangkat', $pembelian->id)}}" class="btn btn-sm btn-info">Detail</a>
                                                        </td>

                                                    </tr>
                                                    @endforeach
                                                    @empty
                                                    <tr>
                                                        <td colspan="9" class="text-center">Belum ada perangkat yang
                                                            terdaftar.</td>
                                                    </tr>
                                                    @endforelse
                                                </tbody>
                                            </table>
                                        </div>

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
            $('#table-perangkat').DataTable({
                responsive: true,
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/id.json'
                }
            });
        });
    </script>
</body>

</html>