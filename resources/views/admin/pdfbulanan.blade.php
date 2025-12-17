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

        .table-bln {
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
            font-size: 10px;
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

        .table2 tr:hover td {
            background-color: #f6f4f4;
        }

        .table2 tbody tr:nth-child(even) td {
            background-color: #ffffff;
        }

        th,
        td {
            text-align: left;
        }

        .header-libur {
            background-color: #fd5050 !important;
            color: #ffffff !important;
            font-weight: bold;
        }

        .libur {
            background-color: #fcaeae !important;
            color: #cc0000 !important;
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

    <table class="table2" border="1">
        <tr>
            <th>Nama</th>

            @foreach ($dates as $date)
                <th class="{{ $date['is_libur'] ? 'header-libur' : '' }}">
                    {{ $date['day'] }}
                </th>
            @endforeach

            <th>Total Hadir</th>
        </tr>
        <tbody>
            @foreach ($pegawai as $p)
                <tr>
                    <td>{{ $p->name }}</td>

                    @php
                        $totalHadir = 0;
                    @endphp

                    @foreach ($dates as $date)
                        @php
                            $status = $rekap[$p->id][$date['full_date']] ?? '-';

                            if ($status === 'hadir') {
                                $totalHadir++;
                            }

                            $symbol = '-';

                            if ($status === 'hadir') {
                                $symbol = 'H';
                            } elseif ($status === 'izin') {
                                $symbol = 'I';
                            }
                        @endphp

                        <td class="{{ $date['is_libur'] ? 'libur' : '' }}">
                            {{ $symbol }}
                        </td>
                    @endforeach

                    <td>{{ $totalHadir }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>