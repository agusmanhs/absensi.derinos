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

</html> --}}


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Absensi</title>
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
            max-width: 100%;
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

        .table-bln {
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
            font-size: 12px;
        }

        .table2 th {
            background-color: #0a399e;
            color: #ffffff;
            text-align: center;
            font-weight: 600;
            padding: 10px 6px;
            font-size: 11px;
            letter-spacing: 0.3px;
        }

        .table2 th:first-child {
            text-align: left;
            padding-left: 14px;
            min-width: 140px;
        }

        .table2 td {
            background-color: #ffffff;
            color: #1e293b;
            text-align: center;
            font-weight: 400;
            padding: 8px 6px;
            border-bottom: 1px solid #e5e7eb;
            font-size: 11px;
        }

        .table2 td:first-child {
            text-align: left;
            padding-left: 14px;
            font-weight: 600;
            color: #0a399e;
        }

        .table2 tbody tr:nth-child(even) td {
            background-color: #f8f9fb;
        }

        .table2 tbody tr:nth-child(even) td:first-child {
            background-color: #f8f9fb;
        }

        .table2 tr:hover td {
            background-color: #eef2ff;
        }

        .header-libur {
            background-color: #dc2626 !important;
            color: #ffffff !important;
            font-weight: 700;
        }

        .libur {
            background-color: #fee2e2 !important;
            color: #b91c1c !important;
            font-weight: 600;
        }

        .total-col {
            background-color: #eef4ff !important;
            color: #0a399e !important;
            font-weight: 700 !important;
        }

        th, td {
            text-align: center;
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

                        <td class="total-col">{{ $totalHadir }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>