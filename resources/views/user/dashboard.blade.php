@extends('user._layout')
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
            <!-- Sales Cards  -->
            <!-- ============================================================== -->
            <div class="row">

                <div class="card mb-2 col-lg-6"
                    style="height: 300px; border: none; background-color: #424144; width: 100%;">
                    <div class="card-body d-flex justify-content-center align-items-center" id="lokasidevices">

                    </div>
                </div>
                <div class="card mb-2 col-lg-6"
                    style="height: 300px; border: none; background-color: #424144; width: 100%;">
                    <div class="card-body d-flex justify-content-center align-items-center" id="lokasikantor">
                        <iframe class="p-3" style="left:0;top:0;height:100%;width:100%;position:absolute;"
                            src="https://maps.google.com/maps?q={{ $lat }}, {{ $long }}&output=embed"
                            width="800" height="600" allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- Sales chart -->
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
            <!-- Sales chart -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Recent comment and chats -->
            <!-- ============================================================== -->
            {{-- @if (session('warning'))
                <div class="alert alert-danger" id="demo">
                    {{ session('warning') }}
                    jarak Anda dari kantor {{ session('jaraknya') }} meter
                </div>
            @endif --}}
            <div id="demo"></div>

            <div class="row">
                <!-- column -->
                <div class="col-lg-4">
                    <div class="card">
                        <div class="mt-2 ml-3">
                            <h4 class="card-title"></h4>
                        </div>

                        <div class="row">
                            <div class="col-md-4 text-center ml-3">
                                <img src="{{ asset('image/'.Auth::user()->pegawai->foto) }}" alt="Foto Karyawan" class="img-fluid"
                                    width="250">
                            </div>

                            <div class="col-md-6">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item"><strong>NIK:</strong> {{ Auth::user()->pegawai->nik }}</li>
                                    <li class="list-group-item"><strong>Nama:</strong> {{ Auth::user()->pegawai->nama }}
                                    </li>
                                    <li class="list-group-item"><strong>Jabatan:</strong>
                                        {{ Auth::user()->pegawai->jabatan->nama_jabatan }}</li>
                                </ul>
                            </div>
                        </div>

                    
                        <div class="card my-3 mx-3" style="border-radius: 12px; cursor: pointer;">
                            <form action="{{ route('absensi.masuk') }}" method="POST" id="absenForm">
                                @csrf
                                <input type="hidden" name="latitude" id="latitude">
                                <input type="hidden" name="longitude" id="longitude">

                                <button type="button" class="box bg-success w-100 py-3" onclick="getLocationAndSubmit()"
                                    style="
                                            color: white;
                                            border: none;
                                            font-size: 15px;
                                            font-weight: bold;
                                            border-radius: 10px;
                                        ">
                                    ABSEN MASUK
                                </button>
                            </form>
                        </div>

                    
                        <div class="card my-3 mx-3" style="border-radius: 12px; cursor: pointer;">
                            <form action="{{ route('absensi.keluar') }}" method="POST" id="absenOut">
                                @csrf
                                <input type="hidden" name="latitude" id="lat">
                                <input type="hidden" name="longitude" id="long">

                                <button type="button" class="box bg-danger w-100 py-3" onclick="getLocationAndOut()"
                                    style="
                                            color: white;
                                            border: none;
                                            font-size: 15px;
                                            font-weight: bold;
                                            border-radius: 10px;
                                        ">
                                    ABSEN KELUAR
                                </button>
                            </form>
                        </div>

                    
                        <div class="card my-3 mx-3" style="border-radius: 12px; cursor: pointer;" data-toggle="modal" data-target="#add-new-event">
                            <button type="button" class="box bg-info w-100 py-3"
                                style="
                                            color: white;
                                            border: none;
                                            font-size: 15px;
                                            font-weight: bold;
                                            border-radius: 10px;
                                        ">
                                IZIN
                            </button>
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

                <div class="col-lg-8">
                    <!-- Card -->
                    <div class="card">
                        <div class="card-body">
                            @if (session('error'))
                                <div class="alert alert-danger">
                                    {{ session('error') }}
                                </div>
                            @endif
                            <div class="d-flex justify-content-start align-items-center" style="margin-bottom: 20px;">
                                <h5 class="card-title">History Absensi</h5>
                            </div>
                            <div class="table-responsive">
                                <table id="zero_config" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Tanggal</th>
                                            <th>Absen Masuk</th>
                                            <th>Absen Keluar</th>
                                            <th>Status</th>
                                            <th>Keterangan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $y)
                                            <tr>
                                                <td>{{ $y->tanggal }}</td>
                                                <td class="text-center">
                                                    @if ($y->ket_masuk=='terlambat')
                                                        <span class="badge bg-danger rounded-0 text-white"">{{ $y->absen_masuk }}</span>
                                                    @else  
                                                        <span class="badge bg-success rounded-0 text-white"">{{ $y->absen_masuk }}</span>
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    @if ($y->ket_keluar == 'cepat pulang')
                                                        <span class="badge bg-danger rounded-0 text-white"">{{ $y->absen_keluar }}</span>
                                                    @else
                                                        <span class="badge bg-success rounded-0 text-white"">{{ $y->absen_keluar }}</span>
                                                    @endif
                                                </td>
                                                <td class="text-center">  
                                                    @if ($y->status == 'pending')
                                                        <span class="badge bg-warning rounded-0 text-white"">{{ $y->status }}</span>
                                                    @elseif ($y->status == 'izin')
                                                        <span class="badge bg-info rounded-0 text-white"">{{ $y->status }}</span>
                                                    @else
                                                        <span class="badge bg-success rounded-0 text-white"">{{ $y->status }}</span>
                                                    @endif
                                                </td>
                                                <td>{{ $y->ket_izin }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                    <!-- card -->
                    <!-- accoridan part -->
                    <!-- toggle part -->
                    <!-- Tabs -->
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- Recent comment and chats -->
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
                                <h4 class="modal-title"><strong>Pengajuan Izin</strong></h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            </div>
                            <form action="{{ route('user.izin') }}" method="POST" enctype="multipart/form-data">
                                <div class="modal-body">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label for="tanggal" class="control-label">Tanggal</label>
                                            <input class="form-control form-white" placeholder="Masukkan tanggal" type="date" name="tanggal"/>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label class="control-label">Keterangan</label>
                                            <input class="form-control form-white" placeholder="Masukkan keterangan" type="text" name="ket_izin" />
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

    @if (session('warning'))
        <script>
            Swal.fire({
                title: 'Gagal',
                text: 'Anda terlalu jauh dari lokasi kantor untuk melakukan absensi. Jarak Anda ke kantor: {{ session('jaraknya') }} meter',
                icon: 'error'
            });
        </script>
    @endif


    <script>
        const x = document.getElementById("lokasidevices");
        window.onload = getLocation;

        function getLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(success, error);
            } else {
                x.innerHTML = "Geolocation is not supported by this browser.";
            }
        }

        function success(position) {
            x.innerHTML =
                "<iframe class='p-3' style='left:0;top:0;height:100%;width:100%;position:absolute;' src='https://maps.google.com/maps?q=" +
                position.coords.latitude + ", " + position.coords.longitude +
                "&output=embed' width='800' height='600' loading='lazy' referrerpolicy='no-referrer-when-downgrade'></iframe>";
        }

        function error() {
            alert("Sorry, no position available.");
        }
    </script>

    <script>
        function getLocationAndSubmit() {
            const demoDiv = document.getElementById('demo');

            if (navigator.geolocation) {
                demoDiv.innerHTML = "Mengambil lokasi...";

                navigator.geolocation.getCurrentPosition(
                    function(position) {
                        // Set nilai latitude dan longitude
                        const lat = position.coords.latitude;
                        const lng = position.coords.longitude;

                        document.getElementById('latitude').value = lat;
                        document.getElementById('longitude').value = lng;

                        // Debug: tampilkan nilai
                        console.log('Latitude:', lat);
                        console.log('Longitude:', lng);
                        console.log('Form Latitude:', document.getElementById('latitude').value);
                        console.log('Form Longitude:', document.getElementById('longitude').value);

                        demoDiv.innerHTML = `Lokasi ditemukan: ${lat}, ${lng}`;

                        // Pastikan nilai sudah terisi sebelum submit
                        if (document.getElementById('latitude').value && document.getElementById('longitude').value) {
                            document.getElementById('absenForm').submit();
                        } else {
                            alert('Gagal mengisi data lokasi!');
                        }
                    },
                    function(error) {
                        let errorMessage = '';
                        switch (error.code) {
                            case error.PERMISSION_DENIED:
                                errorMessage = "Izin akses lokasi ditolak!";
                                break;
                            case error.POSITION_UNAVAILABLE:
                                errorMessage = "Informasi lokasi tidak tersedia!";
                                break;
                            case error.TIMEOUT:
                                errorMessage = "Waktu permintaan lokasi habis!";
                                break;
                            default:
                                errorMessage = "Terjadi kesalahan: " + error.message;
                                break;
                        }

                        demoDiv.innerHTML = errorMessage;
                        alert(errorMessage);
                        console.error('Error Geolocation:', error);
                    }, {
                        enableHighAccuracy: true,
                        timeout: 10000,
                        maximumAge: 0
                    }
                );
            } else {
                demoDiv.innerHTML = "Browser tidak mendukung Geolocation!";
                alert("Browser Anda tidak mendukung Geolocation!");
            }
        }
    </script>

    <script>
        function getLocationAndOut() {
            const demoDiv = document.getElementById('demo');

            if (navigator.geolocation) {
                demoDiv.innerHTML = "Mengambil lokasi...";

                navigator.geolocation.getCurrentPosition(
                    function(position) {
                        // Set nilai latitude dan longitude
                        const lat = position.coords.latitude;
                        const lng = position.coords.longitude;

                        document.getElementById('lat').value = lat;
                        document.getElementById('long').value = lng;

                        // Debug: tampilkan nilai
                        console.log('Latitude:', lat);
                        console.log('Longitude:', lng);
                        console.log('Form Latitude:', document.getElementById('lat').value);
                        console.log('Form Longitude:', document.getElementById('long').value);

                        demoDiv.innerHTML = `Lokasi ditemukan: ${lat}, ${lng}`;

                        // Pastikan nilai sudah terisi sebelum submit
                        if (document.getElementById('lat').value && document.getElementById('long').value) {
                            document.getElementById('absenOut').submit();
                        } else {
                            alert('Gagal mengisi data lokasi!');
                        }
                    },
                    function(error) {
                        let errorMessage = '';
                        switch (error.code) {
                            case error.PERMISSION_DENIED:
                                errorMessage = "Izin akses lokasi ditolak!";
                                break;
                            case error.POSITION_UNAVAILABLE:
                                errorMessage = "Informasi lokasi tidak tersedia!";
                                break;
                            case error.TIMEOUT:
                                errorMessage = "Waktu permintaan lokasi habis!";
                                break;
                            default:
                                errorMessage = "Terjadi kesalahan: " + error.message;
                                break;
                        }

                        demoDiv.innerHTML = errorMessage;
                        alert(errorMessage);
                        console.error('Error Geolocation:', error);
                    }, {
                        enableHighAccuracy: true,
                        timeout: 10000,
                        maximumAge: 0
                    }
                );
            } else {
                demoDiv.innerHTML = "Browser tidak mendukung Geolocation!";
                alert("Browser Anda tidak mendukung Geolocation!");
            }
        }
    </script>
@endsection
