@extends('admin._layout')
@section('content')

    <style>
        /* Styling event kalender untuk hari libur */
        .fc-event {
            background: #dc2626 !important;
            border: none !important;
        }

        .fc-event .fc-title {
            color: #ffffff;
            font-weight: bold;
        }
    </style>

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

        .btn-action-delete {
            width: 34px;
            height: 34px;
            border-radius: 6px;
            border: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            transition: transform 0.15s ease;
            background-color: #fee2e2;
            color: #b91c1c;
        }

        .btn-action-delete:hover {
            transform: translateY(-2px);
            filter: brightness(0.95);
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
    </style>

    <div class="page-wrapper">
        <!-- ============================================================== -->
        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <div class="page-breadcrumb">
            <div class="row">
                <div class="col-12 d-flex no-block align-items-center">
                    <h4 class="page-title">Hari Libur</h4>
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
                <div class="col-md-12">
                    <div class="card">
                        <div class="">
                            <div class="row">
                                {{-- <div class="col-lg-3 border-right p-r-0">
                                        <div class="card-body border-bottom">
                                            <h4 class="card-title m-t-10">Drag & Drop Event</h4>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div id="calendar-events" class="">
                                                        <div class="calendar-events m-b-20" data-class="bg-info"><i class="fa fa-circle text-info m-r-10"></i>Event One</div>
                                                        <div class="calendar-events m-b-20" data-class="bg-success"><i class="fa fa-circle text-success m-r-10"></i> Event Two</div>
                                                        <div class="calendar-events m-b-20" data-class="bg-danger"><i class="fa fa-circle text-danger m-r-10"></i>Event Three</div>
                                                        <div class="calendar-events m-b-20" data-class="bg-warning"><i class="fa fa-circle text-warning m-r-10"></i>Event Four</div>
                                                    </div>
                                                    <!-- checkbox -->
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input" id="drop-remove">
                                                        <label class="custom-control-label" for="drop-remove">Remove after drop</label>
                                                    </div>
                                                    <a href="javascript:void(0)" data-toggle="modal" data-target="#add-new-event" class="btn m-t-20 btn-info btn-block waves-effect waves-light">
                                                            <i class="ti-plus"></i> Tambah Hari Libur
                                                        </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div> --}}
                                <div class="col-lg-12">
                                    <div class="card-body b-l calender-sidebar">
                                        <div id="calendar"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- BEGIN MODAL -->
            <div class="modal none-border" id="my-event">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title"><strong>Add Event</strong></h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        </div>
                        <div class="modal-body"></div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary waves-effect"
                                data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-success save-event waves-effect waves-light">Create
                                event</button>
                            <button type="button" class="btn btn-danger delete-event waves-effect waves-light"
                                data-dismiss="modal">Delete</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->

            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-12">

                        <div class="card">
                            <div class="card-body">
                                @if (session('error'))
                                    <div class="alert alert-danger">
                                        {{ session('error') }}
                                    </div>
                                @endif
                                <div class="d-flex justify-content-end align-items-center" style="margin-bottom: 20px;">
                                    <div class="d-flex align-items-center gap-2">

                                        <a href="javascript:void(0)" data-toggle="modal" data-target="#add-new-event"
                                            class="btn m-t-20 btn-info btn-block waves-effect waves-light">
                                            <i class="ti-plus"></i> Tambah Libur
                                        </a>
                                    </div>

                                </div>
                                <div class="table-responsive">
                                    <table id="zero_config" class="table table-striped table-bordered table2-style">
                                        <thead>
                                            <tr>
                                                <th>Tanggal</th>
                                                <th>Keterangan</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @foreach ($liburs as $a)
                                                <tr>
                                                    <td>{{ $a->tanggal }}</td>
                                                    <td>{{ $a->keterangan }}</td>
                                                    <td class="text-center">
                                                        <button class="btn btn-sm btn-action-delete"
                                                            onclick="hapusLibur({{ $a->id }})">
                                                            <i class="mdi mdi-delete"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>

                                        <tfoot>
                                            <tr>
                                                <th>Tanggal</th>
                                                <th>Keterangan</th>
                                                <th>Action</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                                <!-- End PAge Content -->
                                <!-- ============================================================== -->
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
                    <h4 class="modal-title"><strong>Hari Libur</strong></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.tambah.libur') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <label class="control-label">Tanggal</label>
                                <input class="form-control form-white" placeholder="Masukkan tanggal" type="date"
                                    name="tanggal" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label class="control-label">Keterangan</label>
                                <input class="form-control form-white" placeholder="Masukkan keterangan" type="text"
                                    name="keterangan" />
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit"
                                class="btn btn-danger waves-effect waves-light save-category">Save</button>
                            <button type="button" class="btn btn-secondary waves-effect"
                                data-dismiss="modal">Close</button>
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
        function hapusLibur(id) {
            if (confirm('Apakah anda yakin ingin menghapus?')) {

                let url = "{{ route('admin.delete.libur', ':id') }}";
                url = url.replace(':id', id);

                const form = document.getElementById('form-hapus');
                form.action = url;
                form.submit();
            }
        }
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            var events = [
                @foreach ($liburs as $libur)

                    // BACKGROUND FULL (menandai seluruh kotak tanggal warna merah)
                    {
                        start: '{{ $libur->tanggal }}',
                        allDay: true,
                        rendering: 'background',
                        backgroundColor: '#dc2626'
                    },

                    // TITLE (keterangan hari libur muncul di kotak tanggal)
                    {
                        title: '{{ $libur->keterangan }}',
                        start: '{{ $libur->tanggal }}',
                        allDay: true,
                        textColor: '#ffffff'
                    },
                @endforeach
            ];

            $('#calendar').fullCalendar({
                height: 650,
                events: events
            });

        });
    </script>
@endsection