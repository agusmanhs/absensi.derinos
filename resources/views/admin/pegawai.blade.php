@extends('admin._layout')
@section('content')
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">Daftar Pegawai</h4>
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
                                                            <i class="ti-plus"></i> Tambah Pegawai
                                            </a>
                                        </div>
                                </div>
                                <div class="table-responsive">
                                    <table id="zero_config" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Nama</th>
                                                <th>Nik</th>
                                                <th>Jabatan</th>
                                                <th>Username</th>
                                                <th>No telp</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($data as $y)    
                                                <tr>
                                                    <td>{{ $y->nama }}</td>
                                                    <td>{{ $y->nik }}</td>
                                                    <td>{{ $y->jabatan->nama_jabatan }}</td>
                                                    <td>{{ $y->user->email }}</td>
                                                    <td>{{ $y->notelp }}</td>
                                                    <td class="text-center">
                                                        <button class="btn btn-sm me-1" data-toggle="modal" data-target="#detail{{ $y->id }}">
                                                            <i class="mdi mdi-eye"></i>
                                                        </button>
                                                        
                                                        <button class="btn btn-sm me-1" data-toggle="modal" data-target="#edit{{ $y->id }}">
                                                            <i class="mdi mdi-pencil"></i>
                                                        </button>
                                                        
                                                        <button class="btn btn-sm me-1" onclick="hapusPegawai({{ $y->id }})">
                                                            <i class="mdi mdi-delete"></i>
                                                        </button>
                                                    </td>
                                                </tr>

                                                
                                                {{-- edit --}}
                                                <div class="modal fade none-border" id="edit{{ $y->id }}">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h4 class="modal-title"><strong>Edit Pegawai</strong></h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                            </div>
                                                            <form action="{{ route('admin.update.pegawai', $y->id) }}" method="POST" enctype="multipart/form-data">
                                                                @csrf @method('PUT')
                                                                <div class="modal-body">
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <label class="control-label">Nama</label>
                                                                            <input class="form-control form-white" placeholder="Masukkan nama" type="text" name="nama" value="{{ $y->nama }}"/>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <label class="control-label">Nik</label>
                                                                            <input class="form-control form-white" placeholder="Masukkan nik" type="text" name="nik" value="{{ $y->nik }}" />
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <label class="control-label">Foto</label>
                                                                            <input class="form-control form-white" accept="image/jpeg, image/png" placeholder="Masukkan foto" type="file" name="foto"/>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <label class="control-label">Jenis Kelamin</label>
                                                                            <select class="form-control form-white" data-placeholder="Choose a color..." name="jenisKelamin">
                                                                                <option value="Laki-laki" {{ $y->jenisKelamin == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                                                                <option value="Perempuan" {{ $y->jenisKelamin == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                                                            </select>                                        
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <label class="control-label">Alamat</label>
                                                                            <input class="form-control form-white" placeholder="Masukkan alamat" type="text" name="alamat" value="{{ $y->alamat }}" />
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <label class="control-label">Jabatan</label>
                                                                            <select class="form-control form-white" data-placeholder="Choose a color..." name="jabatan">
                                                                                @foreach ($jabatan as $a)
                                                                                <option value="{{ $a->id }}">{{ $a->nama_jabatan }}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <label class="control-label">No telp</label>
                                                                            <input class="form-control form-white" placeholder="Masukkan telepon" type="text" name="notelp" value="{{ $y->notelp }}" />
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <label class="control-label">Email</label>
                                                                            <input class="form-control form-white" placeholder="Masukkan email" type="email" name="email" value="{{ $y->email }}" />
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <label class="control-label">Password</label>
                                                                            <input class="form-control form-white" placeholder="Masukkan password" type="password" name="password"/>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="submit" class="btn btn-danger waves-effect waves-light save-category">Simpan</button>
                                                                    <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <!-- Modal Detail -->
                                                <div class="modal fade none-border" id="detail{{ $y->id }}">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h4 class="modal-title"><strong>Detail Pegawai</strong></h4>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                    aria-hidden="true">&times;</button>
                                                            </div>

                                                            <div class="modal-body">

                                                            <div class="row">
                                                                    <div class="col-md-4 text-center">
                                                                        <img src="{{ asset('image/'.$y->foto) }}" alt="Foto Karyawan" class="img-fluid rounded" width="250">
                                                                    </div>

                                                                <div class="col-md-8">
                                                                    <ul class="list-group list-group-flush">
                                                                        <li class="list-group-item"><strong>NIK:</strong> {{ $y->nik }}</li>
                                                                        <li class="list-group-item"><strong>Nama:</strong> {{ $y->nama }}</li>
                                                                        <li class="list-group-item"><strong>Jenis Kelamin:</strong> {{ $y->jenisKelamin }}</li>
                                                                        <li class="list-group-item"><strong>Alamat:</strong> {{ $y->alamat }}</li>
                                                                        <li class="list-group-item"><strong>Jabatan:</strong> {{ $y->jabatan->nama_jabatan }}</li>
                                                                        <li class="list-group-item"><strong>No Telp:</strong> {{ $y->notelp }}</li>
                                                                        <li class="list-group-item"><strong>Email:</strong> {{ $y->user->email }}</li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                            {{-- <div class="col-md-12">
                                                                    <ul class="list-group list-group-flush">
                                                                        <li></li>
                                                                        
                                                                        <li></li>
                                                                    </ul>
                                                            </div> --}}
                                                        </div>

                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Nama</th>
                                                <th>Nik</th>
                                                <th>Jabatan</th>
                                                <th>Username</th>
                                                <th>No telp</th>
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


            {{-- Tambah --}}
                <div class="modal fade none-border" id="add-new-event">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title"><strong>Tambah Pegawai</strong></h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            </div>
                            <form action="{{ route('admin.tambah.pegawai') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label class="control-label">Nama</label>
                                            <input class="form-control form-white" placeholder="Masukkan nama" type="text" name="nama" />
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label class="control-label">Nik</label>
                                            <input class="form-control form-white" placeholder="Masukkan nik" type="text" name="nik" />
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label class="control-label">Foto</label>
                                            <input class="form-control form-white" accept="image/jpeg, image/png" placeholder="Masukkan foto" type="file" name="foto" />
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label class="control-label">Jenis Kelamin</label>
                                            <select class="form-control form-white" data-placeholder="Choose a color..." name="jenisKelamin">
                                                <option value="Laki-laki">Laki-laki</option>
                                                <option value="Perempuan">Perempuan</option>
                                            </select>                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label class="control-label">Alamat</label>
                                            <input class="form-control form-white" placeholder="Masukkan alamat" type="text" name="alamat" />
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label class="control-label">Jabatan</label>
                                            <select class="form-control form-white" data-placeholder="Choose a color..." name="jabatan">
                                                @foreach ($jabatan as $a)
                                                    <option value="{{ $a->id }}">{{ $a->nama_jabatan }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label class="control-label">No telp</label>
                                            <input class="form-control form-white" placeholder="Masukkan telepon" type="text" name="notelp" />
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="control-label">Email</label>
                                            <input class="form-control form-white" placeholder="Masukkan email" type="email" name="email" />
                                        </div>
                                        <div class="col-md-6">
                                            <label class="control-label">Password</label>
                                            <input class="form-control form-white" placeholder="Masukkan password" type="password" name="password" />
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

                <form id="form-hapus" method="POST" action="" style="display: none;">
                    @csrf
                    @method('DELETE')
                  </form>
                  
                  <script>
                    function hapusPegawai(id) {
                        if (confirm('Apakah anda yakin ingin menghapus?')) {
                    
                            let url = "{{ route('admin.delete.pegawai', ':id') }}";
                            url = url.replace(':id', id);
                    
                            const form = document.getElementById('form-hapus');
                            form.action = url;
                            form.submit();
                        }
                    }
                    </script>
                    

@endsection