@extends('user._layout')
@section('content')

        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">Profil</h4>
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
                <!-- column -->
                <div class="col-lg-4">
                    <div class="card">
                        <div class="mt-2 ml-3">
                            <h4 class="card-title"></h4>
                        </div>

                            <div class="text-center pt-4">
                                <img src="{{ asset('image/'.Auth::user()->pegawai->foto) }}" alt="Foto" class="img-fluid" style="max-width: 250px; width: 100%;">
                            </div>

                            <div class="col-md-12">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item py-4"><strong>NIK:</strong> {{ Auth::user()->pegawai->nik }}</li>
                                    <li class="list-group-item py-4"><strong>Nama:</strong> {{ Auth::user()->name }}
                                    </li>
                                    <li class="list-group-item py-4"><strong>Jabatan:</strong>
                                        {{ Auth::user()->pegawai->jabatan->nama_jabatan }}</li>
                                </ul>
                            </div>


                        {{-- <div class="comment-widgets scrollable">
                            <!-- Comment Row -->
                            <div class="d-flex flex-row comment-row m-t-0">
                                <div class="p-2"><img src="{{ asset('/matrix-admin/') }}/assets/images/users/1.jpg"
                                        alt="user" width="50" class="rounded-circle"></div>
                                <div class="comment-text w-100">
                                    <h6 class="font-medium">James Anderson</h6>
                                    <span class="m-b-15 d-block">Lorem Ipsum is simply dummy text of the printing and type
                                        setting industry. </span>
                                    <div class="comment-footer">
                                        <span class="text-muted float-right">April 14, 2016</span>
                                        <button type="button" class="btn btn-cyan btn-sm">Edit</button>
                                        <button type="button" class="btn btn-success btn-sm">Publish</button>
                                        <button type="button" class="btn btn-danger btn-sm">Delete</button>
                                    </div>
                                </div>
                            </div>
                            <!-- Comment Row -->
                            <div class="d-flex flex-row comment-row">
                                <div class="p-2"><img src="{{ asset('/matrix-admin/') }}/assets/images/users/4.jpg"
                                        alt="user" width="50" class="rounded-circle"></div>
                                <div class="comment-text active w-100">
                                    <h6 class="font-medium">Michael Jorden</h6>
                                    <span class="m-b-15 d-block">Lorem Ipsum is simply dummy text of the printing and type
                                        setting industry. </span>
                                    <div class="comment-footer">
                                        <span class="text-muted float-right">May 10, 2016</span>
                                        <button type="button" class="btn btn-cyan btn-sm">Edit</button>
                                        <button type="button" class="btn btn-success btn-sm">Publish</button>
                                        <button type="button" class="btn btn-danger btn-sm">Delete</button>
                                    </div>
                                </div>
                            </div>
                            <!-- Comment Row -->
                            <div class="d-flex flex-row comment-row">
                                <div class="p-2"><img src="{{ asset('/matrix-admin/') }}/assets/images/users/5.jpg"
                                        alt="user" width="50" class="rounded-circle"></div>
                                <div class="comment-text w-100">
                                    <h6 class="font-medium">Johnathan Doeting</h6>
                                    <span class="m-b-15 d-block">Lorem Ipsum is simply dummy text of the printing and type
                                        setting industry. </span>
                                    <div class="comment-footer">
                                        <span class="text-muted float-right">August 1, 2016</span>
                                        <button type="button" class="btn btn-cyan btn-sm">Edit</button>
                                        <button type="button" class="btn btn-success btn-sm">Publish</button>
                                        <button type="button" class="btn btn-danger btn-sm">Delete</button>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                    </div>
                    <!-- Card -->
                    <!-- card -->
                    <!-- card new -->
                </div>
                <!-- column -->


                    <div class="col-md-8">
                        <div class="card">
                            <form class="form-horizontal" action="{{ route('user.update.profil') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    <h4 class="card-title">Update Profil</h4>
                                    <div class="form-group row">
                                        <label for="fname"
                                        class="col-sm-2 text-right control-label col-form-label">Nama</label>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', Auth::user()->name) }}"
                                                placeholder="Masukkan nama">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="email" class="col-sm-2 text-right control-label col-form-label">Email</label>
                                        <div class="col-md-10">
                                            <input type="email" class="form-control" id="email" name="email" value="{{ old('email', Auth::user()->email) }}"
                                                placeholder="Masukkan Email">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="fname"
                                            class="col-sm-2 text-right control-label col-form-label">Foto Profile</label>
                                        <div class="col-md-10">
                                            <input type="file" class="form-control" id="foto" name="foto"
                                                placeholder="Masukkan foto">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="lname"
                                            class="col-sm-2 text-right control-label col-form-label">Password</label>
                                        <div class="col-md-10">
                                            <input type="password" class="form-control" id="password" name="password"
                                                placeholder="Kosongkan jika tidak ingin mengubah password">
                                        </div>
                                    </div>
                                </div>
                                <div class="border-top">
                                    <div class="card-body">
                                        <button type="submit" class="btn btn-info">Submit</button>
                                    </div>
                                </div>
                            </form>
                    </div>

            </div>

                </div>
                <!-- editor -->

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
                All Rights Reserved by Matrix-admin. Designed and Developed by <a
                    href="https://wrappixel.com">WrapPixel</a>.
            </footer>
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
        </div>
        

@endsection