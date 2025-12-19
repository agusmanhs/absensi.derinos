<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan {{ $pegawai->name }}</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            font-size: 11px;
            margin: 20px;
        }

        .table1 {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        .table-head {
            color: #48494a;
            text-align: center;
            font-family: '', sans-serif;
            font-weight: 700;
            font-size: 20px;
            padding: 5px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .table-subhead {
            color: #48494a;
            text-align: center;
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
            font-size: 20px;
            padding: 5px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .table-bln {
            color: #48494a;
            text-align: center;
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
            padding: 5px;
            letter-spacing: 1px;
            border-bottom: 1px solid #48494a;
        }

        .nama-pegawai {
            color: #48494a;
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
            text-transform: capitalize;
            font-size: 10px;
            letter-spacing: 1px;
        }

        .info-pegawai {
            margin: 15px 0;
            background-color: #f5f5f5;
            padding: 10px;
            border-left: 4px solid #0a399e;
        }

        .info-pegawai p {
            margin: 5px 0;
            font-weight: 600;
            color: #48494a;
        }

        .table2 {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .table2 th {
            background-color: #0a399e;
            color: rgb(255, 255, 255);
            text-align: center;
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
            padding: 7px 5px;
            font-size: 9px;
        }

        .table2 td {
            background-color: #d9dcdf;
            color: #1e293b;
            text-align: center;
            font-family: 'Poppins', sans-serif;
            font-weight: 400;
            padding: 5px;
            border-bottom: 1px solid #0b0b0b;
            font-size: 9px;
        }

        .table2 tbody tr:nth-child(even) td {
            background-color: #ffffff;
        }

        .row-libur td {
            background-color: #fcaeae !important;
            color: #cc0000 !important;
        }

        .text-left {
            text-align: left !important;
        }

        tfoot {
            background-color: #e9ecef;
            font-weight: bold;
        }

        tfoot td {
            background-color: #0a399e !important;
            color: #ffffff !important;
            padding: 10px;
        }

        .footer {
            margin-top: 30px;
            text-align: right;
            font-size: 10px;
        }

        .signature {
            margin-top: 50px;
            text-align: center;
        }

        .signature p {
            margin: 5px 0;
        }
    </style>
</head>

<body>

    <table class="table1">
        <tr>
            <td class="table-head">LAPORAN ABSENSI</td>
        </tr>
        <tr>
            <td class="table-subhead">DERINOS</td>
        </tr>
        <tr>
            <td class="table-bln">{{ $bulan1 }}</td>
        </tr>
    </table>

    <div class="info-pegawai">
        <p class="nama-pegawai">Nama Pegawai: {{ $pegawai->name }}</p>
    </div>

    <table class="table2" border="1">
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Absen Masuk</th>
                <th>Ket Masuk</th>
                <th>Absen Keluar</th>
                <th>Ket Keluar</th>
                <th>Status</th>
                <th>Keterangan</th>
                <th>Ket Lembur</th>
            </tr>
        </thead>
        <tbody>
            @php
                $totalHadir = 0;
                $totalIzin = 0;
                $totalSakit = 0;
                $totalTidakHadir = 0;
                $totalJamLembur = 0;
            @endphp

            @foreach ($rekap as $data)
                @php
                    $isLibur = $data['is_libur'];

                    if ($data['status'] == 'hadir') {
                        $totalHadir++;
                    } elseif ($data['status'] == 'izin') {
                        $totalIzin++;
                    } elseif ($data['status'] == 'sakit') {
                        $totalSakit++;
                    } elseif ($data['status'] == 'tidak hadir' && !$isLibur) {
                        $totalTidakHadir++;
                    }
                    
                    // Hitung total jam lembur
                    $totalJamLembur += $data['jam_lembur'];
                @endphp

                <tr class="{{ $isLibur ? 'row-libur' : '' }}">
                    <td>
                        {{ \Carbon\Carbon::parse($data['tanggal'])->format('d') }}
                    </td>
                    <td>{{ $data['absen_masuk'] }}</td>
                    <td>{{ $data['ket_masuk'] }}</td>
                    <td>{{ $data['absen_keluar'] }}</td>
                    <td>{{ $data['ket_keluar'] }}</td>
                    <td>
                        @if ($isLibur && $data['status'] == 'tidak hadir')
                            Libur
                        @else
                            {{ ucfirst($data['status']) }}
                        @endif
                    </td>
                    <td>{{ $data['ket_izin'] }}</td>
                    <td>{{ $data['ket_lembur'] }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="8" class="text-left">
                    <strong>Ringkasan:</strong>
                    Hadir: {{ $totalHadir }} hari |
                    Izin: {{ $totalIzin }} hari |
                    Sakit: {{ $totalSakit }} hari |
                    Tidak Hadir: {{ $totalTidakHadir }} hari |
                    Total Lembur: {{ $totalJamLembur }} jam
                </td>
            </tr>
        </tfoot>
    </table>
</body>

</html>