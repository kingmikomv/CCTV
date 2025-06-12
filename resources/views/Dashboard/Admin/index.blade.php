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
              <div class="col-lg-12 mb-4">
                <div class="card">
                  <div class="d-flex align-items-end row">
                    @php
                      $jam = \Carbon\Carbon::now()->format('H');
                      $waktu = match (true) {
                          $jam >= 5 && $jam < 12 => 'Selamat pagi',
                          $jam >= 12 && $jam < 15 => 'Selamat siang',
                          $jam >= 15 && $jam < 18 => 'Selamat sore',
                          default => 'Selamat malam',
                      };
                    @endphp
            
                    <div class="col-sm-7">
                      <div class="card-body">
                        <h5 class="card-title text-primary">
                          {{ $waktu }}, {{ Auth::user()->name }}! 👋
                        </h5>
                        <p class="mb-4">
                          Sekarang pukul <span class="fw-bold">{{ \Carbon\Carbon::now()->format('H:i') }}</span>.
                          Semoga harimu menyenangkan 🎉
                        </p>
                      </div>
                    </div>
            
                    <div class="col-sm-5 text-center text-sm-left">
                      <div class="card-body pb-0 px-0 px-md-4">
                        <img src="{{ asset('DHS/assets/img/illustrations/man-with-laptop-light.png') }}"
                          height="140" alt="View Badge User"
                          data-app-dark-img="illustrations/man-with-laptop-dark.png"
                          data-app-light-img="illustrations/man-with-laptop-light.png" />
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            
              {{-- Kartu Total Pelanggan --}}
              <div class="col-lg-6 col-md-6 col-4 mb-4">
                <div class="card">
                  <div class="card-body">
                    <div class="card-title d-flex align-items-start justify-content-between">
                      <div class="avatar flex-shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" id="user-check"><path fill="#6563FF" d="M13.3,12.22A4.92,4.92,0,0,0,15,8.5a5,5,0,0,0-10,0,4.92,4.92,0,0,0,1.7,3.72A8,8,0,0,0,2,19.5a1,1,0,0,0,2,0,6,6,0,0,1,12,0,1,1,0,0,0,2,0A8,8,0,0,0,13.3,12.22ZM10,11.5a3,3,0,1,1,3-3A3,3,0,0,1,10,11.5ZM21.71,9.13a1,1,0,0,0-1.42,0l-2,2-.62-.63a1,1,0,0,0-1.42,0,1,1,0,0,0,0,1.41l1.34,1.34a1,1,0,0,0,1.41,0l2.67-2.67A1,1,0,0,0,21.71,9.13Z"></path></svg>
                      </div>
                      <div class="dropdown">
                        <button class="btn p-0" type="button" data-bs-toggle="dropdown">
                          <i class="bx bx-dots-vertical-rounded"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end">
                          <a class="dropdown-item" href="">Lihat Semua</a>
                        </div>
                      </div>
                    </div>
                    <span class="fw-semibold d-block mb-1">Total Pelanggan</span>
                    <h3 class="card-title mb-2">{{ $totalPelanggan }}</h3>
                  </div>
                </div>
              </div>
              
              <div class="col-lg-6 col-md-6 col-4 mb-4">
                <div class="card">
                  <div class="card-body">
                    <div class="card-title d-flex align-items-start justify-content-between">
                      <div class="avatar flex-shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" data-name="Layer 1" viewBox="0 0 24 24" id="shopping-cart"><path fill="#6563FF" d="M8.5,19A1.5,1.5,0,1,0,10,20.5,1.5,1.5,0,0,0,8.5,19ZM19,16H7a1,1,0,0,1,0-2h8.49121A3.0132,3.0132,0,0,0,18.376,11.82422L19.96143,6.2749A1.00009,1.00009,0,0,0,19,5H6.73907A3.00666,3.00666,0,0,0,3.92139,3H3A1,1,0,0,0,3,5h.92139a1.00459,1.00459,0,0,1,.96142.7251l.15552.54474.00024.00506L6.6792,12.01709A3.00006,3.00006,0,0,0,7,18H19a1,1,0,0,0,0-2ZM17.67432,7l-1.2212,4.27441A1.00458,1.00458,0,0,1,15.49121,12H8.75439l-.25494-.89221L7.32642,7ZM16.5,19A1.5,1.5,0,1,0,18,20.5,1.5,1.5,0,0,0,16.5,19Z"></path></svg>                      </div>
                      <div class="dropdown">
                        <button class="btn p-0" type="button" data-bs-toggle="dropdown">
                          <i class="bx bx-dots-vertical-rounded"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end">
                          <a class="dropdown-item" href="">Lihat Pembelian</a>
                        </div>
                      </div>
                    </div>
                    <span class="fw-semibold d-block mb-1">Total Produk Dibeli</span>
                    <h3 class="card-title mb-2">{{ $totalProdukDibeli }}</h3>
                  </div>
                </div>
              </div>
              
              <!-- Total Revenue -->
              <div class="col-12 col-lg-12 order-2 order-md-3 order-lg-2 mb-4">
                <div class="card">
                  <div class="row row-bordered g-0">
                    <div class="col-md-8">
                      <h5 class="card-header m-0 me-2 pb-3">Total Revenue</h5>
                      <div id="totalRevenueChart" class="px-2"></div>
                    </div>
                    <div class="col-md-4">
                      <div class="card-body">
                        <div class="text-center">
                          <div class="dropdown">
                            <button class="btn btn-sm btn-outline-primary dropdown-toggle" type="button"
                              id="growthReportId" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              2022
                            </button>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="growthReportId">
                              <a class="dropdown-item" href="javascript:void(0);">2021</a>
                              <a class="dropdown-item" href="javascript:void(0);">2020</a>
                              <a class="dropdown-item" href="javascript:void(0);">2019</a>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div id="growthChart"></div>
                      <div class="text-center fw-semibold pt-3 mb-2">62% Company Growth</div>

                      <div class="d-flex px-xxl-4 px-lg-2 p-4 gap-xxl-3 gap-lg-1 gap-3 justify-content-between">
                        <div class="d-flex">
                          <div class="me-2">
                            <span class="badge bg-label-primary p-2"><i class="bx bx-dollar text-primary"></i></span>
                          </div>
                          <div class="d-flex flex-column">
                            <small>2022</small>
                            <h6 class="mb-0">$32.5k</h6>
                          </div>
                        </div>
                        <div class="d-flex">
                          <div class="me-2">
                            <span class="badge bg-label-info p-2"><i class="bx bx-wallet text-info"></i></span>
                          </div>
                          <div class="d-flex flex-column">
                            <small>2021</small>
                            <h6 class="mb-0">$41.2k</h6>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!--/ Total Revenue -->

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