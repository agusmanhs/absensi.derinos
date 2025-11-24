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

                <div class="card mb-2 col-lg-6" style="height: 300px; border: none; background-color: #B3A6DD; width: 100%;">
                    <div class="card-body d-flex justify-content-center align-items-center" id="lokasidevices">
                        
                    </div>
                </div>
                <div class="card mb-2 col-lg-6" style="height: 300px; border: none; background-color: #B3A6DD; width: 100%;">
                    <div class="card-body d-flex justify-content-center align-items-center" id="lokasikantor">
                        <iframe class="p-3" style="left:0;top:0;height:100%;width:100%;position:absolute;"
                            src="https://maps.google.com/maps?q={{$lat}}, {{ $long }}&output=embed"
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
            {{-- @if(session('warning'))
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
                                <img src="{{ asset('images/') }}" alt="Foto Karyawan" class="img-fluid rounded" width="250">
                            </div>

                            <div class="col-md-6">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item"><strong>NIK:</strong> {{ Auth::user()->pegawai->nik }}</li>
                                    <li class="list-group-item"><strong>Nama:</strong> {{ Auth::user()->pegawai->nama }}</li>
                                    <li class="list-group-item"><strong>Jabatan:</strong> {{ Auth::user()->pegawai->jabatan->nama_jabatan }}</li>
                                </ul>
                            </div>
                    </div>

                    <div class="card my-3 ml-3 mr-3" style="height: 50px; background-color:antiquewhite;">
                        
                        <form action="{{ route('absensi.masuk') }}" method="POST" id="absenForm">
                            @csrf
                            <input type="hidden" name="latitude" id="latitude">
                            <input type="hidden" name="longitude" id="longitude">
                            
                            <button type="button" class="box bg-success card-body p-0 d-flex align-items-center justify-content-center" onclick="getLocationAndSubmit()"
                                style="width: 100%; height: 100px; border: none; box-shadow: none; background-color: #a6f29c;">
                                <div class="card-body d-flex justify-content-center align-items-center">
                                    <h5 class="card-title fs-4">ABSEN MASUK</h5>
                                </div>
                            </button>
                        </form>
                    </div>
                    <div class="card my-3 ml-3 mr-3" style="height: 50px; background-color:antiquewhite;">
                        <form action="{{ route('absensi.keluar') }}" method="POST" id="absenOut">
                            @csrf
                            <input type="hidden" name="latitude" id="latitude">
                            <input type="hidden" name="longitude" id="longitude">
                            
                            <button type="button" class="box bg-danger card-body p-0 d-flex align-items-center justify-content-center" onclick="getLocationAndOut()"
                                style="width: 100%; height: 100px; border: none; box-shadow: none; background-color: #a6f29c;">
                                <div class="card-body d-flex justify-content-center align-items-center">
                                    <h5 class="card-title fs-4">ABSEN KELUAR</h5>
                                </div>
                            </button>
                        </form>
                    </div>
                    <div class="card my-3 ml-3 mr-3" style="height: 50px; background-color:antiquewhite;">
                        <div class="box bg-info card-body p-0 d-flex align-items-center justify-content-center">
                            <div class="px-3">
                                <i class="bi bi-person-vcard text-white fs-4"></i>
                            </div>
                            <span class="text-white">Izin</span>
                        </div>
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
                                @if(session('error'))
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
                                                    <td>{{ $y->tanggal}}</td>
                                                    <td>{{ $y->absen_masuk}}</td>
                                                    <td>{{ $y->absen_keluar}}</td>
                                                    <td>{{ $y->status}}</td>
                                                    <td>{{ $y->ket_ijin}}</td>
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
                switch(error.code) {
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
            },
            {
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
                        document.getElementById('absenOut').submit();
                    } else {
                        alert('Gagal mengisi data lokasi!');
                    }
                },
                function(error) {
                    let errorMessage = '';
                    switch(error.code) {
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
                },
                {
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
