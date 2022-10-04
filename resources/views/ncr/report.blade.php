<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style type="text/css">
        @page {
            size: A4;
        }

        table {
            border: 1px solid #ddd;
            border-collapse: collapse;
            width: 100%;
            table-layout: fixed;
            word-wrap: break-word;

        }

        tr {
            border-bottom: 1px solid #ddd;
        }

        th,
        td {
            text-align: left;
            padding: 8px 5px;
            width: 10%;
        }

        tbody tr:nth-child(odd) {
            background-color: #f2f2f2;
        }

        .tgl {
            width: 70px;
            height: 40px;
            padding: 10px 40px;
            background-color: lightgrey;
            text-align: center;
            border-radius: 20px;
            align-items: center;
            font-weight: normal;
        }

        nav {
            font-weight: bold;
            margin-left: -40px;
            margin-bottom: 50px;
            margin-top: -10px;
        }

        li {
            display: inline;
            margin-right: 10px;
        }

        .rp {
            font-size: 20px;
            font-weight: bold;
        }

        hr {
            background-color: orange;
            border-color: orange;
            margin-top: -10px;
            height: 3px;

        }
    </style>
</head>

<body>
    <div>
        <img src="https://allureindustries.com/files/uploads/2016/03/600.png" alt="" style="width: 350px; height: 50px">
        <h1>PT. ALLURE ALLUMINIO</h1>
        <hr>
        <nav>
            <ul>
                <li class="rp">Report NCR</li>
                <li class="tgl">{{$tanggal}}</li>
            </ul>
        </nav>
    </div>
    <h4>Status : Open</h4>
    <div>
        <table>
            <tr>
                <th>No NCR</th>
                <th>No FPPP</th>
                <th>Mitra</th>
                <th>Nama Project</th>
                <th>Tanggal</th>
                <th>Item</th>
            </tr>
            @if ($ncr_open->count() > 0)
            @foreach ($ncr_open as $ncr)
            <tr>
                <td>{{ $ncr->nomor_ncr }}</td>
                <td>{{ $ncr->nomor_fppp }}</td>
                <td>{{ $ncr->nama_mitra }}</td>
                <td>{{ $ncr->nama_proyek }}</td>
                <td>{{ $ncr->tanggal_ncr->format('d-m-Y') }}</td>
                <td>
                    @foreach ($ncr->ItemNcr as $keys => $item)
                    {{ $item->nama_item . ($keys < $ncr->ItemNcr->count() - 1 ? ', ' : "") }}
                    @endforeach
                </td>
            </tr>
            @endforeach
            @else
            <tr>
                <td colspan="6" style="color: grey; text-align: center;">Tidak Ada Data</td>
            </tr>
            @endif
            </tbody>
        </table>
    </div>
    <h4>Status : Closed</p>
    </h4>
    <div>
        <table>
            <tr>
                <th>No NCR</th>
                <th>No FPPP</th>
                <th>Mitra</th>
                <th>Nama Project</th>
                <th>Tanggal</th>
                <th>Item</th>
            </tr>
            @if ($ncr_closed->count() > 0)
            @foreach ($ncr_closed as $ncr)
            <tr>
                <td>{{ $ncr->nomor_ncr }}</td>
                <td>{{ $ncr->nomor_fppp }}</td>
                <td>{{ $ncr->nama_mitra }}</td>
                <td>{{ $ncr->nama_proyek }}</td>
                <td>{{ $ncr->tanggal_ncr->format('d-m-Y') }}</td>
                <td>
                    @foreach ($ncr->ItemNcr as $keys => $item)
                    {{ $item->nama_item . ($keys < $ncr->ItemNcr->count() - 1 ? ', ' : "") }}
                    @endforeach
                </td>
            </tr>
            @endforeach
            @else
            <tr>
                <td colspan="6" style="color: grey;">Tidak Ada Data</td>
            </tr>
            @endif
            </tbody>
        </table>
    </div>
    <h4>Status : Confirmed</h4>
    <div>
        <table>
            <tr>
                <th>No NCR</th>
                <th>No FPPP</th>
                <th>Mitra</th>
                <th>Nama Project</th>
                <th>Tanggal</th>
                <th>Item</th>
            </tr>

            @if ($ncr_confirmed->count() > 0)
            @foreach ($ncr_confirmed as $ncr)
            <tr>
                <td>{{ $ncr->nomor_ncr }}</td>
                <td>{{ $ncr->nomor_fppp }}</td>
                <td>{{ $ncr->nama_mitra }}</td>
                <td>{{ $ncr->nama_proyek }}</td>
                <td>{{ $ncr->tanggal_ncr->format('d-m-Y') }}</td>
                <td>
                    @foreach ($ncr->ItemNcr as $keys => $item)
                    {{ $item->nama_item . ($keys < $ncr->ItemNcr->count() - 1 ? ', ' : "") }}
                    @endforeach
                </td>
            </tr>
            @endforeach
            @else
            <tr>
                <td colspan="6" style="color: grey; text-align:center;">Tidak Ada Data</td>
            </tr>
            @endif
        </table>
    </div>
</body>

</html>