@extends('admin._layout')
@section('content')
    <style>
        .table2-style {
            font-size: 13px;
        }

        .table2-style thead th {
            background-color: #2c3e63;
            color: #ffffff;
            font-weight: 600;
            text-align: left;
            padding: 12px 10px;
            border-color: #2c3e63;
        }

        .table2-style tfoot th {
            background-color: #eef1f5;
            color: #2c3e63;
            font-weight: 600;
            text-align: left;
            padding: 10px;
        }

        .table2-style tbody td {
            padding: 10px;
            vertical-align: middle;
        }

        .table2-style tbody tr:hover td {
            background-color: #eef2ff;
        }

        .btn-info {
            background-color: #2c3e63 !important;
            border-color: #2c3e63 !important;
        }

        .btn-info:hover,
        .btn-info:focus {
            background-color: #23324f !important;
            border-color: #23324f !important;
        }

        .dataTables_wrapper .pagination .page-item.active .page-link,
        .dataTables_wrapper .paginate_button.current,
        .dataTables_wrapper .paginate_button.current:hover {
            background: #2c3e63 !important;
            border-color: #2c3e63 !important;
            color: #ffffff !important;
        }

        .dataTables_wrapper .pagination .page-link,
        .dataTables_wrapper .paginate_button {
            color: #2c3e63;
        }

        .dataTables_wrapper .pagination .page-link:hover,
        .dataTables_wrapper .paginate_button:hover {
            background: #eef1f5 !important;
            border-color: #2c3e63 !important;
            color: #2c3e63 !important;
        }

        .btn-action-edit,
        .btn-action-delete {
            width: 34px;
            height: 34px;
            border-radius: 6px;
            border: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            transition: transform 0.15s ease;
        }

        .btn-action-edit {
            background-color: #fef3c7;
            color: #b45309;
        }

        .btn-action-delete {
            background-color: #fee2e2;
            color: #b91c1c;
        }

        .btn-action-edit:hover,
        .btn-action-delete:hover {
            transform: translateY(-2px);
            filter: brightness(0.95);
        }
    </style>
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">Jabatan</h4>
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
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-12">

                        <div class="card">
                            <div class="card-body">
                                @if(session('error'))
                                    <div class="alert alert-danger">
                                        {{ session('error') }}
                                    </div>
                                @endif
                                <div class="d-flex justify-content-end align-items-center" style="margin-bottom: 20px;">
                                    {{-- <h5 class="card-title">Daftar Karyawan</h5> --}}

                                        <div class="d-flex align-items-center gap-2">
                                            {{-- <button type="button" class="btn btn-info text-white">
                                                Tambah Pegawai
                                            </button> --}}
                                            <a href="javascript:void(0)" data-toggle="modal" data-target="#add-new-event" class="btn m-t-20 btn-info btn-block waves-effect waves-light">
                                                            <i class="ti-plus"></i> Tambah Jabatan
                                            </a>
                                        </div>
                                </div>
                                <div class="table-responsive">
                                    <table id="zero_config" class="table table-striped table-bordered table2-style">
                                        <thead>
                                            <tr>
                                                <th>Kode Jabatan</th>
                                                <th>Nama Jabatan</th>
                                                <th>Lokasi Absen</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($data as $y)    
                                                <tr>
                                                    <td>{{ $y->kode_jabatan }}</td>
                                                    <td>{{ $y->nama_jabatan }}</td>
                                                    <td>{{ $y->lokasi->nama_lokasi }}</td>
                                                    <td class="text-center">
                                                        <button class="btn btn-sm btn-action-edit me-1" data-toggle="modal" data-target="#edit{{ $y->id }}">
                                                            <i class="mdi mdi-pencil"></i>
                                                        </button>
                                                        
                                                        <button class="btn btn-sm btn-action-delete me-1" onclick="hapusJabatan({{ $y->id }})">
                                                            <i class="mdi mdi-delete"></i>
                                                        </button>
                                                    </td>
                                                </tr>


                                                <div class="modal fade none-border" id="edit{{ $y->id }}">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h4 class="modal-title"><strong>Edit Jabatan</strong></h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                            </div> 
                                                            <form action="{{ route('admin.update.jabatan', $y->id) }}" method="POST" enctype="multipart/form-data">
                                                                <div class="modal-body">
                                                                    @csrf
                                                                    @method('PUT')
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <label class="control-label">Kode Jabatan</label>
                                                                            <input class="form-control form-white" placeholder="Masukkan kode jabatan" type="text" name="kode_jabatan" value="{{ $y->kode_jabatan }}" />
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <label class="control-label">Nama Jabatan</label>
                                                                            <input class="form-control form-white" placeholder="Masukkan jabatan" type="text" name="nama_jabatan" value="{{ $y->nama_jabatan }}" />
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <label class="control-label">Lokasi Absen</label>
                                                                            <select class="form-control form-white" data-placeholder="Choose a color..." name="lokasi_id">
                                                                                @foreach ($lokasi as $y)
                                                                                <option value="{{ $y->id }}">{{ $y->nama_lokasi }}</option>
                                                                                @endforeach
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
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Kode Jabatan</th>
                                                <th>Nama Jabatan</th>
                                                <th>Lokasi Absen</th>
                                                <th>Action</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Right sidebar -->
                <!-- ============================================================== -->
                <!-- .right-sidebar -->
                <!-- ============================================================== -->
                <!-- End Right sidebar -->
                <!-- ============================================================== -->
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

                <div class="modal fade none-border" id="add-new-event">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title"><strong>Tambah Jabatan</strong></h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            </div>
                            <form action="{{ route('admin.tambah.jabatan') }}" method="POST" enctype="multipart/form-data">
                                <div class="modal-body">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label class="control-label">Kode Jabatan</label>
                                            <input class="form-control form-white" placeholder="Masukkan kode jabatan" type="text" name="kode_jabatan" />
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label class="control-label">Nama Jabatan</label>
                                            <input class="form-control form-white" placeholder="Masukkan jabatan" type="text" name="nama_jabatan" />
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label class="control-label">Lokasi Absen</label>
                                            <select class="form-control form-white" data-placeholder="Choose a color..." name="lokasi_id">
                                                @foreach ($lokasi as $y)
                                                <option value="{{ $y->id }}">{{ $y->nama_lokasi }}</option>
                                                @endforeach
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

            </div>

            <form id="form-hapus" method="POST" action="" style="display: none;">
                @csrf
                @method('DELETE')
            </form>
            
            <script>
                function hapusJabatan(id) {
                    if (confirm('Apakah anda yakin ingin menghapus?')) {
                
                        let url = "{{ route('admin.delete.jabatan', ':id') }}";
                        url = url.replace(':id', id);
                
                        const form = document.getElementById('form-hapus');
                        form.action = url;
                        form.submit();
                    }
                }
                </script>

@endsection