@extends('admin._layout')
@section('content')

<div class="page-wrapper">
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">Lokasi Kantor</h4>
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
    <!-- Container fluid  -->
    <!-- ============================================================== -->
    <div class="container-fluid">

        <div class="row">
            <div class="col-12">

                <div class="card">
                    <div class="card-body">

                        @if(session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif

                        <div class="d-flex justify-content-end align-items-center mb-3">
                            <a href="javascript:void(0)" data-toggle="modal" data-target="#add-new-event"
                                class="btn btn-info text-white">
                                <i class="ti-plus"></i> Tambah Lokasi
                            </a>
                        </div>

                        <div class="table-responsive">
                            <table id="zero_config" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Nama</th>
                                        <th>Jam Masuk</th>
                                        <th>Jam Keluar</th>
                                        <th>Jarak Toleransi</th>
                                        <th>Latitude Longitude</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($data as $y)
                                        <tr>
                                            <td>{{ $y->nama_lokasi }}</td>
                                            <td>{{ \Carbon\Carbon::parse($y->jam_masuk)->format('H.i') }}</td>
                                            <td>{{ \Carbon\Carbon::parse($y->jam_keluar)->format('H.i') }}</td>
                                            <td>{{ $y->batas_jarak }}</td>
                                            <td>{{ $y->lokasi }}</td>
                                            <td class="text-center">
                                                <button class="btn btn-sm" data-toggle="modal"
                                                    data-target="#edit{{ $y->id }}">
                                                    <i class="mdi mdi-pencil"></i>
                                                </button>

                                                <button class="btn btn-sm" onclick="hapusLokasi({{ $y->id }})">
                                                    <i class="mdi mdi-delete"></i>
                                                </button>
                                            </td>
                                        </tr>

                                        {{-- edit modal --}}
                                        <div class="modal fade none-border" id="edit{{ $y->id }}">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title"><strong>Edit Lokasi</strong></h4>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-hidden="true">&times;</button>
                                                    </div>

                                                    <form action="{{ route('admin.update.lokasi', $y->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="modal-body">

                                                            <label>Nama Lokasi</label>
                                                            <input type="text" name="nama_lokasi"
                                                                class="form-control"
                                                                value="{{ $y->nama_lokasi }}">

                                                            <div class="row mt-3">
                                                                <div class="col-md-6">
                                                                    <label>Jam Masuk</label>
                                                                    <input type="time" name="jam_masuk"
                                                                        class="form-control"
                                                                        value="{{ \Carbon\Carbon::parse($y->jam_masuk)->format('H:i') }}">
                                                                </div>

                                                                <div class="col-md-6">
                                                                    <label>Jam Keluar</label>
                                                                    <input type="time" name="jam_keluar"
                                                                        class="form-control"
                                                                        value="{{ \Carbon\Carbon::parse($y->jam_keluar)->format('H:i') }}">
                                                                </div>
                                                            </div>

                                                            <label class="mt-3">Latitude Longitude</label>
                                                            <input type="text" name="lokasi" class="form-control"
                                                                value="{{ $y->lokasi }}">

                                                            <label class="mt-3">Jarak Toleransi</label>
                                                            <input type="text" name="batas_jarak"
                                                                class="form-control"
                                                                value="{{ $y->batas_jarak }}">
                                                        </div>

                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-danger">Save</button>
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">Close</button>
                                                        </div>
                                                    </form>

                                                </div>
                                            </div>
                                        </div>
                                        

                                    @endforeach
                                </tbody>

                                <tfoot>
                                    <tr>
                                        <th>Nama</th>
                                        <th>Jam Masuk</th>
                                        <th>Jam Keluar</th>
                                        <th>Jarak Toleransi</th>
                                        <th>Latitude Longitude</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>

                    </div>
                </div>

            </div>
        </div>

    </div>

    <footer class="footer text-center">
        All Rights Reserved.
    </footer>
</div>


{{-- tambah modal --}}
<div class="modal fade none-border" id="add-new-event">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title"><strong>Tambah Lokasi</strong></h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <form action="{{ route('admin.tambah.lokasi') }}" method="POST">
                @csrf

                <div class="modal-body">

                    <label>Nama Lokasi</label>
                    <input type="text" name="nama_lokasi" class="form-control">

                    <div class="row mt-3">
                        <div class="col-md-6">
                            <label>Jam Masuk</label>
                            <input type="time" name="jam_masuk" class="form-control">
                        </div>

                        <div class="col-md-6">
                            <label>Jam Keluar</label>
                            <input type="time" name="jam_keluar" class="form-control">
                        </div>
                    </div>

                    <label class="mt-3">Latitude Longitude</label>
                    <input type="text" name="lokasi" class="form-control">

                    <label class="mt-3">Jarak Toleransi</label>
                    <input type="text" name="batas_jarak" class="form-control">

                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger">Save</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>

            </form>

        </div>
    </div>
</div>




<form id="form-hapus" method="POST" action="" style="display:none;">
    @csrf
    @method('DELETE')
</form>

<script>
    function hapusLokasi(id) {
        if (confirm('Apakah anda yakin ingin menghapus?')) {
            let url = "{{ route('admin.delete.lokasi', ':id') }}";
            url = url.replace(':id', id);

            const form = document.getElementById('form-hapus');
            form.action = url;
            form.submit();
        }
    }
</script>


@if (session('success'))
<script>
    Swal.fire({
        title: 'Berhasil!',
        text: "{{ session('success') }}",
        icon: 'success'
    });
</script>
@endif

@if (session('error'))
<script>
    Swal.fire({
        title: 'Gagal!',
        text: "{{ session('error') }}",
        icon: 'error'
    });
</script>
@endif

@if (session('delete'))
<script>
    Swal.fire({
        title: 'Terhapus!',
        text: "{{ session('delete') }}",
        icon: 'warning'
    });
</script>
@endif


@endsection
