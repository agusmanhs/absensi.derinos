{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>

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
        .table-tgl {
            color: #48494a;
            text-align: center;
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
            padding: 5px;
            letter-spacing: 1px;
            border-bottom: 1px solid #48494a;

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
        }
    
        .table2 td {
        background-color: #d9dcdf; 
        color: #1e293b; 
        text-align: center;
        font-family: 'Poppins', sans-serif;
        font-weight: 400; 
        padding: 5px;
        border-bottom: 1px solid #0b0b0b;
        }  
    
        .table2 tr:hover td {
            background-color: #f6f4f4;
        }
    
        .table2 tbody tr:nth-child(even) td {
            background-color: #ffffff;
        }
        th, td {
            /* padding: 8px 10px; */
            text-align: left;
        }
    </style>
    

</head>
<body>

    <table class="table1">
        <tr >
            <td class="table-head">LAPORAN ABSENSI</td>
        </tr>
        <tr >
            <td class="table-subhead">DERINOS</td>
        </tr>
        <tr>
            <td class="table-tgl">{{ $tanggal1 }}</td>
        </tr>
    </table>

    <table class="table2" border="1">
        <tr>
            <th >Nama</th>
            <th>Absen Masuk</th>
            <th>Ket Masuk</th>
            <th>Absen Keluar</th>
            <th>Ket Keluar</th>
            <th>Status</th>
            <th>Ket Izin</th>
        </tr>
        @foreach ($absen as $y)
            <tr>
                <td>{{ $y->name }}</td>
                <td>{{ $y->absen_masuk }}</td>
                <td>{{ $y->ket_masuk }}</td>
                <td>{{ $y->absen_keluar }}</td>
                <td>{{ $y->ket_keluar }}</td>
                <td>{{ $y->status }}</td>
                <td>{{ $y->ket_izin }}</td>
            </tr>
        @endforeach
    </table>
    
</body>
</html> --}}

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Absensi Harian</title>
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', Arial, sans-serif;
            margin: 0;
            padding: 24px;
            background-color: #f4f5f7;
            color: #1e293b;
        }

        .report-container {
            background: #ffffff;
            padding: 30px 24px;
            border-radius: 10px;
            box-shadow: 0 1px 4px rgba(0,0,0,0.08);
        }

        .table1 {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 4px;
        }

        .table-head {
            color: #0a399e;
            text-align: center;
            font-weight: 800;
            font-size: 24px;
            padding: 4px;
            text-transform: uppercase;
            letter-spacing: 1.5px;
        }

        .table-subhead {
            color: #48494a;
            text-align: center;
            font-weight: 700;
            font-size: 18px;
            padding: 2px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .table-tgl {
            color: #6b7280;
            text-align: center;
            font-weight: 500;
            font-size: 14px;
            padding: 6px 0 14px 0;
            letter-spacing: 0.5px;
            border-bottom: 2px solid #0a399e;
        }

        .table2 {
            width: 100%;
            border-collapse: collapse;
            margin-top: 18px;
            font-size: 13px;
            table-layout: fixed;
        }

        .table2 th {
            background-color: #0a399e;
            color: #ffffff;
            text-align: center;
            font-weight: 600;
            padding: 10px 8px;
            font-size: 12px;
            letter-spacing: 0.3px;
        }

        .table2 th:first-child {
            text-align: left;
            padding-left: 14px;
            width: 18%;
        }

        .table2 td {
            background-color: #ffffff;
            color: #1e293b;
            text-align: center;
            font-weight: 400;
            padding: 10px 8px;
            border-bottom: 1px solid #e5e7eb;
            font-size: 12px;
            overflow: hidden;
            word-wrap: break-word;
        }

        .table2 td:first-child {
            text-align: left;
            padding-left: 14px;
            font-weight: 600;
            color: #0a399e;
            white-space: nowrap;
        }

        .table2 tbody tr:nth-child(even) td {
            background-color: #f8f9fb;
        }

        .table2 tr:hover td {
            background-color: #eef2ff;
        }

        /* Badge warna status */
        .status-hadir {
            display: inline-block;
            background-color: #16a34a;
            color: #ffffff;
            font-weight: 600;
            padding: 3px 10px;
            border-radius: 4px;
            font-size: 11px;
        }

        .status-izin {
            display: inline-block;
            background-color: #0891b2;
            color: #ffffff;
            font-weight: 600;
            padding: 3px 10px;
            border-radius: 4px;
            font-size: 11px;
        }

        .status-pending {
            display: inline-block;
            background-color: #d97706;
            color: #ffffff;
            font-weight: 600;
            padding: 3px 10px;
            border-radius: 4px;
            font-size: 11px;
        }

        .status-default {
            display: inline-block;
            background-color: #6b7280;
            color: #ffffff;
            font-weight: 600;
            padding: 3px 10px;
            border-radius: 4px;
            font-size: 11px;
        }
    </style>
</head>
<body>
    <div class="report-container">
        <table class="table1">
            <tr>
                <td class="table-head">LAPORAN ABSENSI</td>
            </tr>
            <tr>
                <td class="table-subhead">DERINOS</td>
            </tr>
            <tr>
                <td class="table-tgl">{{ $tanggal1 }}</td>
            </tr>
        </table>

        <table class="table2" border="1">
            <tr>
                <th>Nama</th>
                <th>Absen Masuk</th>
                <th>Ket Masuk</th>
                <th>Absen Keluar</th>
                <th>Ket Keluar</th>
                <th>Status</th>
                <th>Ket Izin</th>
            </tr>
            @foreach ($absen as $y)
                <tr>
                    <td>{{ $y->name }}</td>
                    <td>{{ $y->absen_masuk }}</td>
                    <td>{{ $y->ket_masuk }}</td>
                    <td>{{ $y->absen_keluar }}</td>
                    <td>{{ $y->ket_keluar }}</td>
                    <td>
                        @if ($y->status == 'hadir')
                            <span class="status-hadir">{{ $y->status }}</span>
                        @elseif ($y->status == 'izin')
                            <span class="status-izin">{{ $y->status }}</span>
                        @elseif ($y->status == 'pending')
                            <span class="status-pending">{{ $y->status }}</span>
                        @else
                            <span class="status-default">{{ $y->status }}</span>
                        @endif
                    </td>
                    <td>{{ $y->ket_izin }}</td>
                </tr>
            @endforeach
        </table>
    </div>
</body>
</html>

