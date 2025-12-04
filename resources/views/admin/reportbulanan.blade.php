@extends('admin._layout')
@section('content')
       <div class="page-wrapper">
        <!-- ============================================================== -->
        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <div class="page-breadcrumb">
            <div class="row">
                <div class="col-12 d-flex no-block align-items-center">
                    <h4 class="page-title">Dashboard</h4>
                    <div class="ml-auto text-right">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Library</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- End Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Container fluid  -->
        <!-- ============================================================== -->
        <div class="container-fluid">
            <!-- ============================================================== -->
            <!-- Widget nya -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Chart nya -->
            <!-- ============================================================== -->
            {{-- <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-md-flex align-items-center">
                                <div>
                                    <h4 class="card-title">Site Analysis</h4>
                                    <h5 class="card-subtitle">Overview of Latest Month</h5>
                                </div>
                            </div>
                            <div class="row">
                                <!-- column -->
                                <div class="col-lg-9">
                                    <div class="flot-chart">
                                        <div class="flot-chart-content" id="flot-line-chart"></div>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="bg-dark p-10 text-white text-center">
                                                <i class="fa fa-user m-b-5 font-16"></i>
                                                <h5 class="m-b-0 m-t-5">2540</h5>
                                                <small class="font-light">Total Users</small>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="bg-dark p-10 text-white text-center">
                                                <i class="fa fa-plus m-b-5 font-16"></i>
                                                <h5 class="m-b-0 m-t-5">120</h5>
                                                <small class="font-light">New Users</small>
                                            </div>
                                        </div>
                                        <div class="col-6 m-t-15">
                                            <div class="bg-dark p-10 text-white text-center">
                                                <i class="fa fa-cart-plus m-b-5 font-16"></i>
                                                <h5 class="m-b-0 m-t-5">656</h5>
                                                <small class="font-light">Total Shop</small>
                                            </div>
                                        </div>
                                        <div class="col-6 m-t-15">
                                            <div class="bg-dark p-10 text-white text-center">
                                                <i class="fa fa-tag m-b-5 font-16"></i>
                                                <h5 class="m-b-0 m-t-5">9540</h5>
                                                <small class="font-light">Total Orders</small>
                                            </div>
                                        </div>
                                        <div class="col-6 m-t-15">
                                            <div class="bg-dark p-10 text-white text-center">
                                                <i class="fa fa-table m-b-5 font-16"></i>
                                                <h5 class="m-b-0 m-t-5">100</h5>
                                                <small class="font-light">Pending Orders</small>
                                            </div>
                                        </div>
                                        <div class="col-6 m-t-15">
                                            <div class="bg-dark p-10 text-white text-center">
                                                <i class="fa fa-globe m-b-5 font-16"></i>
                                                <h5 class="m-b-0 m-t-5">8540</h5>
                                                <small class="font-light">Online Orders</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- column -->
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
            <!-- ============================================================== -->
            <!-- Recent comment and chats -->
            <div class="row">
                <div class="col-lg-12">
                        <!-- Card -->
                        <div class="card">
                            <div class="card-body">
                                @if (session('error'))
                                    <div class="alert alert-danger">
                                        {{ session('error') }}
                                    </div>
                                @endif
                                {{-- <div class="d-flex justify-content-end align-items-center mb-3">

                                    <form action="{{ route('admin.report.bulanan') }}" method="GET" class="d-flex align-items-center gap-2">
                                        <input type="month" name="bulan" 
                                               class="form-control"
                                               value="{{ request('bulan') }}">
                                        <button class="btn btn-info">Filter</button>
                                    </form>
                                
                                    <div class="d-flex align-items-center gap-2">

                                        <a href="{{ route('admin.pdf.bulanan', ['bulan' => request('bulan')]) }}" 
                                           target="_blank" 
                                           class="btn btn-secondary m-t-20 btn-block waves-effect waves-light">
                                            Cetak PDF
                                        </a>
                                    </div>
                                
                                </div> --}}
                                <div class="d-flex justify-content-end align-items-center mb-3 gap-3">

                                    <form action="{{ route('admin.report.bulanan') }}" method="GET" 
                                          class="d-flex align-items-center gap-2">
                                        
                                        <input type="month" name="bulan" 
                                               class="form-control form-control-sm"
                                               value="{{ request('bulan') }}">
                                        
                                        <button class="btn btn-info btn-sm">Filter</button>
                                    </form>
                                
                                    <a href="{{ route('admin.pdf.bulanan', ['bulan' => request('bulan')]) }}" 
                                       target="_blank" 
                                       class="btn btn-secondary btn-sm ml-2">
                                        Cetak PDF
                                    </a>
                                
                                </div>
                                
                                
                                
                                <div class="table-responsive">
                                    <table id="zero_config1" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Tanggal</th>
                                                <th>Nama</th>
                                                <th>Absen Masuk</th>
                                                <th>Absen Keluar</th>
                                                <th>Status</th>
                                                <th>Keterangan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($riwayat as $a) 
                                                <tr>
                                                    <td>{{ $a->tanggal }}</td>
                                                    <td>{{ $a->name }}</td>
                                                    <td class="text-center">
                                                        <span class="badge bg-success rounded-0 text-white">{{ $a->absen_masuk }}</span>
                                                    </td>
                                                    <td class="text-center">
                                                        <span class="badge bg-success rounded-0 text-white">{{ $a->absen_keluar }}</span>
                                                    </td>
                                                    <td>{{ $a->status }}</td>
                                                    <td>{{ $a->ket_izin }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                </div>
            </div>

        </div>
        <!-- ============================================================== -->
        <!-- End Container fluid  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- footer -->
        <!-- ============================================================== -->
        <footer class="footer text-center">
            All Rights Reserved by Matrix-admin. Designed and Developed by <a href="https://wrappixel.com">WrapPixel</a>.
        </footer>
        <!-- ============================================================== -->
        <!-- End footer -->
        <!-- ============================================================== -->
    </div>
@endsection