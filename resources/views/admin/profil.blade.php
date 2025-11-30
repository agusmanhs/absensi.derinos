@extends('admin._layout')
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

                    <div class="col-md-12">
                        <div class="card">
                            <form class="form-horizontal" action="{{ route('admin.update.profil') }}" method="POST" enctype="multipart/form-data">
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
                                    {{-- <div class="form-group row">
                                        <label for="fname"
                                            class="col-sm-2 text-right control-label col-form-label">Foto Profile</label>
                                        <div class="col-md-10">
                                            <input type="file" class="form-control" id="foto" name="foto"
                                                placeholder="Masukkan foto">
                                        </div>
                                    </div> --}}
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