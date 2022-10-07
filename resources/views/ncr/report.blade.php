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
            margin-top: 20px;
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
            background-color: black;
            border-color: black;
            margin-top: 10px;
            height: 2px;

        }
    </style>
</head>

<body>
    <div>
        <div>
            <div class="col-md-6" style="float:left;">
                <img src="https://allureindustries.com/files/uploads/2016/03/600.png" alt=""
                    style="width: 350px; height: 50px">
            </div>
            <div class="col" style="text-align:justify;">
                <h3 class="d-flex" style="text-align: right;">PT. ALLURE ALLUMINIO</h3>
            </div>
        </div>

        <hr>
        <nav>
            <ul>
                <li class="rp">Report NCR</li>
                <li class="tgl">{{ $tanggal }}</li>
            </ul>
        </nav>
    </div>
    <h4>Status : Open</h4>
    <h4>Jumlah : {{ $ncr_open->count() }}</h4>
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
                                {{ $item->kode_item . '-' . $item->nama_item . ($keys < $ncr->ItemNcr->count() - 1 ? ', ' : '') }}
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
    <h4>Status : Closed</h4>
    <h4>Jumlah : {{ $ncr_closed->count() }}</h4>
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
                                {{ $item->kode_item . '-' . $item->nama_item . ($keys < $ncr->ItemNcr->count() - 1 ? ', ' : '') }}
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
    <h4>Jumlah : {{ $ncr_confirmed->count() }}</h4>
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
                                {{ $item->kode_item . '-' . $item->nama_item . ($keys < $ncr->ItemNcr->count() - 1 ? ', ' : '') }}
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
