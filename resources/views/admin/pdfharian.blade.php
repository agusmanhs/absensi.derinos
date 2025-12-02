<!DOCTYPE html>
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
</html>

