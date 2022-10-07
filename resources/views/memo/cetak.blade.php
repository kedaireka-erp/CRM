<!DOCTYPE HTML>
<html>

<head>
    <title>Cetak Memo</title>
    <style>
        @page {
            size: A4;
        }

        body {
            width: 100%;
            height: 100%;
            margin: 0;
            padding: 0;
        }

        * {
            box-sizing: border-box;
            -moz-box-sizing: border-box;
        }

        .container {
            position: relative;
        }

        .logo {
            display: block;
            justify-items: left;
            width: 600px;
            margin-top: 10px;
        }

        p {
            padding: 5px;
        }

        .oval {
            background-color: #cfcfcf;
            width: 120px;
            height: 1px;
            border-radius: 40px;
        }

        .keterangan {
            width: 700px;
            border-collapse: collapse;
            margin-left: auto;
            margin-right: auto;
            margin-top: 90px;
        }

        .keterangan tr {
            background-color: white;
        }

        .table_item {
            margin-top: 20px;
            border-collapse: collapse;
            border-spacing: 0;
            width: 710px;
            border: 1px solid #ddd;
            margin-left: auto;
            margin-right: auto;
        }

        th,
        td {
            text-align: left;
            padding: 16px;
        }

        .table_item tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .table_item tr {
            border-bottom: 1px solid #ddd;
        }
    </style>
</head>

<body>
    <div class="container">
        <div>
            <img src="https://allureindustries.com/files/uploads/2016/03/600.png" alt=""
                style="width: 350px; height: 50px">

            <table style="margin-top: 20px">
                <tr>
                    <td>Memo &nbsp;&nbsp;&nbsp;&nbsp;</td>
                    <td class="oval">{{ $ncrs->nomor_memo }}</td>
                </tr>
            </table>
        </div>

        <table class="keterangan">
            <tr>
                <td>Nama Mitra &nbsp;&nbsp; :</td>
                <td>{{ $ncrs->nama_mitra }}</td>

                <td>Alamat &nbsp;&nbsp;&nbsp;&nbsp; :</td>
                <td>{{ $ncrs->alamat_pengiriman }}</td>
            </tr>

            <tr>
                <td>Nomor Fppp &nbsp; :</td>
                <td>{{ $ncrs->nomor_fppp }}</td>

                <td>Deadline &nbsp; :</td>
                <td>{{ $ncrs->deadline_pengambilan->format('d-m-Y') }}</td>
            </tr>
        </table>

        <table class="table_item">
            <tr>
                <th>Item</th>
                <th>Ukuran (p x l)</th>
                <th>Return</th>
                <th>Charge</th>
                <th>Bukaan</th>
                <th>Daun</th>
                <th>Kode Warna</th>
                <th>Jumlah</th>
            </tr>

            @foreach ($items as $item)
                <tr>
                    <td>{{ $item->kode_item }} - {{ $item->nama_item }}</td>
                    <td>{{ $item->lebar }} mm x {{ $item->tinggi }} mm</td>
                    <td>{{ $item->return_barang }}</td>
                    <td>{{ $item->charge }}</td>
                    <td>{{ $item->bukaan }}</td>
                    <td>{{ $item->daun }}</td>
                    <td>{{ $item->warna }}</td>
                    <td>{{ $item->jumlah }}</td>
                </tr>
            @endforeach

        </table>
    </div>
</body>

</html>
