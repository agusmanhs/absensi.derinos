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
                                <div class="d-flex justify-content-end align-items-center" style="margin-bottom: 20px;">
                                    {{-- <h5 class="card-title">History Absensi</h5> --}}
                                    <div class="d-flex align-items-center gap-2">
                                            {{-- <button type="button" class="btn btn-info text-white">
                                                Tambah Pegawai
                                            </button> --}}
                                            <a href="{{ route('admin.pdf.harian') }}" target="_blank" class="btn btn-secondary btn-sm">
                                                        Cetak PDF
                                            </a>
                                    </div>


                                </div>
                                <div class="table-responsive">
                                    <table id="zero_config" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Nama</th>
                                                <th>Absen Masuk</th>
                                                <th>Absen Keluar</th>
                                                <th>Status</th>
                                                <th>Keterangan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($absen as $y)
                                                @if ($y->level == 'User')
                                                    <tr>
                                                        <td>{{ $y->name }}</td>
                                                        <td class="text-center">
                                                            @if ($y->absen_masuk)
                                                                <span class="badge bg-success rounded-0 text-white"">{{ $y->absen_masuk }}</span>
                                                            @else
                                                                <span class="badge bg-warning rounded-0 text-white"">Belum Absen</span>
                                                            @endif
                                                        </td>
                                                        <td class="text-center">
                                                            @if ($y->absen_keluar)
                                                                <span class="badge bg-success rounded-0 text-white"">{{ $y->absen_keluar }}</span>
                                                            @else
                                                                <span class="badge bg-warning rounded-0 text-white"">Belum Absen</span>
                                                            @endif
                                                        </td>
                                                        <td class="text-center">
                                                            @if ($y->status)
                                                                @if ($y->status == 'pending')
                                                                    <span style="cursor:pointer;" class="badge bg-danger rounded-0" data-toggle="modal" data-target="#add-new-event{{ $y->id }}">{{ $y->status }}</span>
                                                                @else
                                                                    <span class="badge bg-info rounded-0 text-white">{{ $y->status }}</span>
                                                                @endif
                                                            @else
                                                                <span>-</span>
                                                            @endif  
                                                        </td>
                                                        <td>{{ $y->ket_izin }}</td>
                                                    </tr>
                                                    <div class="modal fade none-border" id="add-new-event{{ $y->id }}">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h4 class="modal-title"><strong>Pengajuan Izin</strong></h4>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                                </div>
                                                                <form action="{{ route('admin.terima.izin') }}" method="POST" enctype="multipart/form-data">
                                                                    <div class="modal-body">
                                                                        @csrf
                                                                        <div class="row">
                                                                            <div class="col-md-12">
                                                                                <label for="tanggal" class="control-label">Nama</label>
                                                                                <input class="form-control form-white" type="text" name="name" value="{{ $y->name }}"/>
                                                                            </div>
                                                                        </div>
                                                                        <input type="hidden" name="user_id" value="{{ $y->user_id }}">
                                                                        <div class="row">
                                                                            <div class="col-md-12">
                                                                                <label class="control-label">Tanggal</label>
                                                                                <input class="form-control form-white" type="date" name="tanggal" value="{{ $y->tanggal }}"/>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-md-12">
                                                                                <label class="control-label">Alasan</label>
                                                                                <input class="form-control form-white" type="text" name="ket_izin" value="{{ $y->ket_izin }}" />
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-md-12">
                                                                                <label for="alasan" class="control-label">Pengajuan Izin</label>
                                                                                <select class="form-control form-white" data-placeholder="Pilih pengajuan..." name="alasan">
                                                                                    <option value="">-- Pilih --</option>
                                                                                    <option value="izin">izin disetujui</option>
                                                                                    <option value="absen">izin ditolak</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="submit" class="btn btn-danger waves-effect waves-light save-category">Save</button>
                                                                        <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
            <!-- Recent comment and chats -->
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