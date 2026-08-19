@extends('user._layout')
@section('content')
    <style>
        /* ==== Disamakan dengan style tabel admin ==== */
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

        .badge.bg-warning {
            color: #78350f !important;
            background-color: #fbbf24 !important;
            font-weight: 600;
        }

        /* ==== Perbaikan layout khusus halaman user (hanya CSS/struktur, tidak mengubah logika) ==== */
        .map-card {
            border-radius: 14px;
            overflow: hidden;
        }

        .map-box {
            position: relative;
            width: 100%;
            height: 100%;
            overflow: hidden;
        }

        .map-box iframe {
            border: 0;
        }

        .profile-card-header {
            padding: 28px 16px 18px;
            border-bottom: 1px solid #eef1f5;
        }

        .profile-avatar-wrap {
            display: flex;
            justify-content: center;
            margin-bottom: 14px;
        }

        .profile-avatar {
            width: 120px;
            height: 120px;
            object-fit: cover;
            border-radius: 50%;
            border: 3px solid #eef1f5;
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        }

        .profile-name {
            font-size: 19px;
            font-weight: 700;
            color: #2c3e63;
        }

        .profile-jabatan-badge {
            background-color: #eef1f5;
            color: #2c3e63;
            font-weight: 600;
            font-size: 12px;
            padding: 6px 14px;
            border-radius: 20px;
        }

        .profile-info-list .list-group-item {
            border: none;
            border-bottom: 1px solid #eef1f5;
            padding: 12px 4px;
        }

        .profile-info-list .list-group-item:last-child {
            border-bottom: none;
        }

        @media (max-width: 767.98px) {
            .table2-style {
                font-size: 12px;
            }

            .card-title {
                text-align: center;
            }
        }


         /* ...CSS lama tetap, tambahkan/ganti bagian kamera di bawah ini... */

    #modalKamera .modal-content {
        border-radius: 16px;
        overflow: hidden;
        border: none;
    }

    #modalKamera .modal-header {
        background-color: #2c3e63;
        color: #fff;
        border-bottom: none;
        padding: 16px 20px;
    }

    #modalKamera .modal-header .modal-title {
        color: #fff;
        font-weight: 600;
    }

    #modalKamera .modal-header .close {
        color: #fff;
        opacity: 0.85;
        text-shadow: none;
    }

    #modalKamera .modal-header .close:hover {
        opacity: 1;
    }

    /* Wrapper untuk menjaga rasio video/foto tetap konsisten */
    .camera-frame {
        position: relative;
        width: 100%;
        aspect-ratio: 4 / 3;
        background-color: #000;
        border-radius: 10px;
        overflow: hidden;
    }

    .camera-frame video,
    .camera-frame img#preview {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 0;
        display: block;
    }

    /* Mirror kamera depan supaya terasa natural seperti cermin */
    .camera-frame video {
        transform: scaleX(-1);
    }

    #infoLokasiKamera {
        position: absolute;
        top: 10px;
        left: 50%;
        transform: translateX(-50%);
        background: rgba(0, 0, 0, 0.65);
        color: #fff;
        padding: 8px 14px;
        border-radius: 8px;
        font-size: 12px;
        line-height: 1.5;
        text-align: center;
        z-index: 10;
        max-width: 90%;
        box-shadow: 0 2px 8px rgba(0,0,0,0.25);
    }

    #modalKamera .modal-body {
        padding: 20px;
        background-color: #f7f8fa;
    }

    #modalKamera .modal-footer {
        border-top: none;
        justify-content: center;
        gap: 8px;
        padding: 14px 20px 20px;
    }

    #modalKamera .modal-footer .btn {
        border-radius: 8px;
        font-weight: 600;
        padding: 8px 20px;
    }
    </style>

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

                <div class="col-12 col-lg-6 mb-3 mb-lg-0">
                    <div class="card map-card mb-2" style="height: 300px; border: none; background-color: #2c3e63; width: 100%;">
                        <div class="card-body d-flex justify-content-center align-items-center map-box" id="lokasidevices">

                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="card map-card mb-2" style="height: 300px; border: none; background-color: #2c3e63; width: 100%;">
                        <div class="card-body d-flex justify-content-center align-items-center map-box" id="lokasikantor">
                            <iframe class="p-3" style="left:0;top:0;height:100%;width:100%;position:absolute;"
                                src="https://maps.google.com/maps?q={{ $lat }}, {{ $long }}&output=embed"
                                width="800" height="600" allowfullscreen="" loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- Sales chart -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Recent comment and chats -->
            <!-- ============================================================== -->
            <div id="demo"></div>

            <div class="row">
                <!-- column -->
                <div class="col-12 col-lg-4">
                    <div class="card">
                        <div class="profile-card-header text-center">
                            <div class="profile-avatar-wrap">
                                <img src="{{ asset('image/'.Auth::user()->pegawai->foto) }}" alt="Foto Karyawan" class="profile-avatar">
                            </div>
                            <h4 class="profile-name mb-1">{{ Auth::user()->pegawai->nama }}</h4>
                            <span class="badge profile-jabatan-badge">{{ Auth::user()->pegawai->jabatan->nama_jabatan }}</span>
                        </div>

                        <div class="px-3">
                            <ul class="list-group list-group-flush profile-info-list">
                                <li class="list-group-item d-flex justify-content-between">
                                    <span class="text-muted">NIK</span>
                                    <strong>{{ Auth::user()->pegawai->nik }}</strong>
                                </li>
                            </ul>
                        </div>


                        <div class="card my-3 mx-3" style="border-radius: 12px; cursor: pointer;">
                            <form action="{{ route('absensi.masuk') }}" method="POST" id="absenForm">
                                @csrf
                                <input type="hidden" name="latitude" id="latitude">
                                <input type="hidden" name="longitude" id="longitude">
                                <input type="hidden" name="foto" id="fotoMasuk">

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
                                <input type="hidden" name="foto" id="fotoKeluar">

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

                    </div>
                    <!-- Card -->
                    <!-- card -->
                    <!-- card new -->
                </div>
                <!-- column -->

                <div class="col-12 col-lg-8">
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
                                <table id="zero_config" class="table table-striped table-bordered table2-style">
                                    <thead>
                                        <tr>
                                                    <th>Tanggal</th>
                                                    <th>Absen Masuk</th>
                                                    <th>Foto Masuk</th>
                                                    <th>Absen Keluar</th>
                                                    <th>Foto Keluar</th>
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
                                                        <span class="badge bg-danger rounded-0 text-white">{{ $y->absen_masuk }}</span>
                                                    @else  
                                                        <span class="badge bg-success rounded-0 text-white">{{ $y->absen_masuk }}</span>
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    @if ($y->foto_masuk)
                                                        <img src="{{ asset('image/'.$y->foto_masuk) }}" 
                                                            style="width:50px; height:50px; object-fit:cover; border-radius:6px; cursor:pointer;"
                                                            onclick="lihatFotoBesar('{{ asset('image/'.$y->foto_masuk) }}')">
                                                    @else
                                                        <span class="text-muted">-</span>
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    @if ($y->ket_keluar == 'cepat pulang')
                                                        <span class="badge bg-danger rounded-0 text-white">{{ $y->absen_keluar }}</span>
                                                    @else
                                                        <span class="badge bg-success rounded-0 text-white">{{ $y->absen_keluar }}</span>
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    @if ($y->foto_keluar)
                                                        <img src="{{ asset('image/'.$y->foto_keluar) }}" 
                                                            style="width:50px; height:50px; object-fit:cover; border-radius:6px; cursor:pointer;"
                                                            onclick="lihatFotoBesar('{{ asset('image/'.$y->foto_keluar) }}')">
                                                    @else
                                                        <span class="text-muted">-</span>
                                                    @endif
                                                </td>
                                                <td class="text-center">  
                                                    @if ($y->status == 'pending')
                                                        <span class="badge bg-warning rounded-0 text-white">{{ $y->status }}</span>
                                                    @elseif ($y->status == 'izin')
                                                        <span class="badge bg-info rounded-0 text-white">{{ $y->status }}</span>
                                                    @else
                                                        <span class="badge bg-success rounded-0 text-white">{{ $y->status }}</span>
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


            <div class="modal fade" id="modalKamera" tabindex="-1" style="z-index: 9999;">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Ambil Foto Absensi</h5>
                            <button type="button" class="close" onclick="tutupKamera()">&times;</button>
                        </div>
                        <div class="modal-body text-center">
                            <div class="camera-frame">
                                <div id="infoLokasiKamera"></div>
                                <video id="camera" autoplay playsinline></video>
                                <canvas id="snapshot" style="display:none;"></canvas>
                                <img id="preview" style="display:none;">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" id="btnAmbilFoto" class="btn btn-primary" onclick="ambilFoto()">Ambil Foto</button>
                            <button type="button" id="btnUlangFoto" class="btn btn-warning" style="display:none;" onclick="ulangFoto()">Ulangi</button>
                            <button type="button" id="btnKirimAbsen" class="btn btn-success" style="display:none;" onclick="kirimAbsen()">Kirim Absen</button>
                        </div>
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
    let stream;
    let currentAction = null;
    let lokasiValid = false; // status apakah lokasi memenuhi syarat

    const officeLat = {{ $lat }};
    const officeLng = {{ $long }};
    const batasJarak = {{ $batasJarak ?? 999999 }};
    const wajibSelfie = {{ Auth::user()->pegawai->wajib_selfie ? 'true' : 'false' }};

    function getLocationAndSubmit() {
        ambilLokasi('masuk');
    }

    function getLocationAndOut() {
        ambilLokasi('keluar');
    }

    function hitungJarak(lat1, lng1, lat2, lng2) {
        const R = 6371000;
        const toRad = (deg) => deg * Math.PI / 180;
        const dLat = toRad(lat2 - lat1);
        const dLng = toRad(lng2 - lng1);
        const a = Math.sin(dLat / 2) ** 2 +
                  Math.cos(toRad(lat1)) * Math.cos(toRad(lat2)) *
                  Math.sin(dLng / 2) ** 2;
        const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
        return R * c;
    }

    function ambilLokasi(tipe) {
        const demoDiv = document.getElementById('demo');
        currentAction = tipe;

        if (!navigator.geolocation) {
            alert("Browser Anda tidak mendukung Geolocation!");
            return;
        }

        demoDiv.innerHTML = "Mengambil lokasi...";

        navigator.geolocation.getCurrentPosition(
            function (position) {
                const lat = position.coords.latitude;
                const lng = position.coords.longitude;

                if (tipe === 'masuk') {
                    document.getElementById('latitude').value = lat;
                    document.getElementById('longitude').value = lng;
                } else {
                    document.getElementById('lat').value = lat;
                    document.getElementById('long').value = lng;
                }

                const jarak = Math.round(hitungJarak(officeLat, officeLng, lat, lng));
                lokasiValid = jarak <= batasJarak;

                demoDiv.innerHTML = `Lokasi ditemukan: ${lat.toFixed(6)}, ${lng.toFixed(6)} — Jarak dari kantor: ${jarak} meter`;

                if (wajibSelfie) {
                    bukaKamera(lat, lng, jarak);
                } else {
                    langsungAbsen(lat, lng, jarak);
                }
            },
            function (error) {
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
            }, {
                enableHighAccuracy: true,
                timeout: 10000,
                maximumAge: 0
            }
        );
    }

    // Dipakai untuk pegawai yang TIDAK wajib selfie: langsung submit
    // form absen (tanpa kamera) selama lokasi valid.
    function langsungAbsen(lat, lng, jarak) {
        if (!lokasiValid) {
            alert(`Anda terlalu jauh dari lokasi kantor (${jarak} m, batas ${batasJarak} m). Absen dibatalkan.`);
            return;
        }

        if (currentAction === 'masuk') {
            document.getElementById('absenForm').submit();
        } else {
            document.getElementById('absenOut').submit();
        }
    }

    async function bukaKamera(lat, lng, jarak) {
        const video = document.getElementById('camera');
        const preview = document.getElementById('preview');
        const info = document.getElementById('infoLokasiKamera');
        const btnAmbil = document.getElementById('btnAmbilFoto');

        preview.style.display = 'none';
        video.style.display = 'block';
        btnAmbil.style.display = 'inline-block';
        document.getElementById('btnUlangFoto').style.display = 'none';
        document.getElementById('btnKirimAbsen').style.display = 'none';

        if (lokasiValid) {
            info.style.background = 'rgba(0,0,0,0.65)';
            info.innerHTML = `Lat: ${lat.toFixed(6)}, Long: ${lng.toFixed(6)}<br>Jarak dari kantor: ${jarak} m`;
            btnAmbil.disabled = false;
            btnAmbil.classList.remove('btn-secondary');
            btnAmbil.classList.add('btn-primary');
        } else {
            info.style.background = 'rgba(220,53,69,0.85)'; // merah
            info.innerHTML = `Lat: ${lat.toFixed(6)}, Long: ${lng.toFixed(6)}<br>⚠️ Terlalu jauh dari kantor (${jarak} m, batas ${batasJarak} m)`;
            btnAmbil.disabled = true;
            btnAmbil.classList.remove('btn-primary');
            btnAmbil.classList.add('btn-secondary');
        }

        try {
            stream = await navigator.mediaDevices.getUserMedia({ video: { facingMode: 'user' } });
            video.srcObject = stream;
            $('#modalKamera').modal('show');
        } catch (err) {
            alert('Tidak bisa mengakses kamera: ' + err.message);
        }
    }

    function ambilFoto() {
    if (!lokasiValid) {
        alert('Anda terlalu jauh dari lokasi kantor. Tidak bisa mengambil foto.');
        return;
    }

    const video = document.getElementById('camera');
    const canvas = document.getElementById('snapshot');
    const preview = document.getElementById('preview');

    canvas.width = video.videoWidth;
    canvas.height = video.videoHeight;

    const ctx = canvas.getContext('2d');
    ctx.save();
    ctx.translate(canvas.width, 0);
    ctx.scale(-1, 1);          // <-- flip horizontal saat menggambar, supaya hasil tidak mirror
    ctx.drawImage(video, 0, 0);
    ctx.restore();

    const base64 = canvas.toDataURL('image/jpeg', 0.7);

    if (currentAction === 'masuk') {
        document.getElementById('fotoMasuk').value = base64;
    } else {
        document.getElementById('fotoKeluar').value = base64;
    }

    preview.src = base64;
    preview.style.display = 'block';
    video.style.display = 'none';

    document.getElementById('btnAmbilFoto').style.display = 'none';
    document.getElementById('btnUlangFoto').style.display = 'inline-block';
    document.getElementById('btnKirimAbsen').style.display = 'inline-block';
}
    function ulangFoto() {
        const video = document.getElementById('camera');
        const preview = document.getElementById('preview');
        preview.style.display = 'none';
        video.style.display = 'block';
        document.getElementById('btnAmbilFoto').style.display = 'inline-block';
        document.getElementById('btnUlangFoto').style.display = 'none';
        document.getElementById('btnKirimAbsen').style.display = 'none';
    }

    function tutupKamera() {
        if (stream) {
            stream.getTracks().forEach(t => t.stop());
        }
        $('#modalKamera').modal('hide');
    }

    function kirimAbsen() {
        if (stream) {
            stream.getTracks().forEach(t => t.stop());
        }
        if (currentAction === 'masuk') {
            document.getElementById('absenForm').submit();
        } else {
            document.getElementById('absenOut').submit();
        }
    }
</script>
@endsection