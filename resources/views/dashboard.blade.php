@extends('layouts.admin')

@push('style')
<link rel="stylesheet" type="text/css" href="/src/plugins/datatables/css/dataTables.bootstrap4.min.css" />
<link rel="stylesheet" type="text/css" href="/src/plugins/datatables/css/responsive.bootstrap4.min.css" />
@endpush

@section('content')
<div class="main-container">
    <div class="xs-pd-20-10 pd-ltr-20">
        <div class="page-header">
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="title">
                        <h4>Dashboard</h4>
                    </div>
                    <nav aria-label="breadcrumb" role="navigation">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Dashboard
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 mb-20">
                <div class="card-box pd-20">
                    <div class="d-flex justify-content-between">
                        <div class="h5">NCR Status Diagram</div>
                    </div>

                    <div id="diseases-chart"></div>
                </div>
            </div>
            <div class="col-12 mb-20">
                <div class="card-box mb-30">
                    <div class="pd-20">
                        <div class="text-blue h5">Need Approval</div>
                        <small class="mb-0">
                            list NCR yang memerlukan approval anda
                        </small>
                    </div>
                    <div class="pb-20">
                        <table class="data-table table stripe hover nowrap">
                            <thead>
                                <tr>
                                    <th class="table-plus">Nomor</th>
                                    <th>Nama Mitra</th>
                                    <th>Nama Proyek</th>
                                    <th>Item</th>
                                    <th>Tanggal NCR</th>
                                    <th class="datatable-nosort">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="table-plus">1</td>
                                    <td>Universitas Negeri Semarang</td>
                                    <td>Bangun Digital Center</td>
                                    <td>Jendela, Pintu</td>
                                    <td>29-08-2022</td>
                                    <td>
                                        <a href="#"><i class="dw dw-eye"></i> View to Validate</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="table-plus">2</td>
                                    <td>Universitas Negeri Semarang</td>
                                    <td>Bangun Digital Center</td>
                                    <td>Jendela, Pintu</td>
                                    <td>29-08-2022</td>
                                    <td>
                                        <a href="#"><i class="dw dw-eye"></i> View to Validate</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="table-plus">3</td>
                                    <td>Universitas Negeri Semarang</td>
                                    <td>Bangun Digital Center</td>
                                    <td>Jendela, Pintu</td>
                                    <td>29-08-2022</td>
                                    <td>
                                        <a href="#"><i class="dw dw-eye"></i> View to Validate</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="table-plus">4</td>
                                    <td>Universitas Negeri Semarang</td>
                                    <td>Bangun Digital Center</td>
                                    <td>Jendela, Pintu</td>
                                    <td>29-08-2022</td>
                                    <td>
                                        <a href="#"><i class="dw dw-eye"></i> View to Validate</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="table-plus">5</td>
                                    <td>Universitas Negeri Semarang</td>
                                    <td>Bangun Digital Center</td>
                                    <td>Jendela, Pintu</td>
                                    <td>29-08-2022</td>
                                    <td>
                                        <a href="#"><i class="dw dw-eye"></i> View to Validate</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="table-plus">6</td>
                                    <td>Universitas Negeri Semarang</td>
                                    <td>Bangun Digital Center</td>
                                    <td>Jendela, Pintu</td>
                                    <td>29-08-2022</td>
                                    <td>
                                        <a href="#"><i class="dw dw-eye"></i> View to Validate</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="table-plus">7</td>
                                    <td>Universitas Negeri Semarang</td>
                                    <td>Bangun Digital Center</td>
                                    <td>Jendela, Pintu</td>
                                    <td>29-08-2022</td>
                                    <td>
                                        <a href="#"><i class="dw dw-eye"></i> View to Validate</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="table-plus">8</td>
                                    <td>Universitas Negeri Semarang</td>
                                    <td>Bangun Digital Center</td>
                                    <td>Jendela, Pintu</td>
                                    <td>29-08-2022</td>
                                    <td>
                                        <a href="#"><i class="dw dw-eye"></i> View to Validate</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="table-plus">9</td>
                                    <td>Universitas Negeri Semarang</td>
                                    <td>Bangun Digital Center</td>
                                    <td>Jendela, Pintu</td>
                                    <td>29-08-2022</td>
                                    <td>
                                        <a href="#"><i class="dw dw-eye"></i> View to Validate</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="table-plus">10</td>
                                    <td>Universitas Negeri Semarang</td>
                                    <td>Bangun Digital Center</td>
                                    <td>Jendela, Pintu</td>
                                    <td>29-08-2022</td>
                                    <td>
                                        <a href="#"><i class="dw dw-eye"></i> View to Validate</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="table-plus">11</td>
                                    <td>Universitas Negeri Semarang</td>
                                    <td>Bangun Digital Center</td>
                                    <td>Jendela, Pintu</td>
                                    <td>29-08-2022</td>
                                    <td>
                                        <a href="#"><i class="dw dw-eye"></i> View to Validate</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="table-plus">12</td>
                                    <td>Universitas Negeri Semarang</td>
                                    <td>Bangun Digital Center</td>
                                    <td>Jendela, Pintu</td>
                                    <td>29-08-2022</td>
                                    <td>
                                        <a href="#"><i class="dw dw-eye"></i> View to Validate</a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('script')
<script src="/src/plugins/datatables/js/dataTables.buttons.min.js"></script>
<script src="/src/plugins/datatables/js/buttons.bootstrap4.min.js"></script>
<script src="/src/plugins/datatables/js/buttons.print.min.js"></script>
<script src="/src/plugins/datatables/js/buttons.html5.min.js"></script>
<script src="/src/plugins/datatables/js/buttons.flash.min.js"></script>
<script src="/vendors/scripts/datatable-setting.js"></script>
<script src="/src/plugins/datatables/js/vfs_fonts.js"></script>
<script>
    var options4 = {
        series: [50, 60],
        chart: {
            height: 300,
            type: 'radialBar',
        },
        colors: ['#003049', '#d62828'],
        plotOptions: {
            radialBar: {
                dataLabels: {
                    name: {
                        fontSize: '22px',
                    },
                    value: {
                        fontSize: '16px',
                    },
                    total: {
                        show: true,
                        label: 'Total',
                        formatter: function (w) {
                            return 260
                        }
                    }
                },
            },
        },
        labels: ['Closed', 'Open'],
        legend: {
            show: true,
            position: 'right',
            offsetY: 100,
            offsetX: 100,
            labels: {
                useSeriesColors: true,
            },
            markers: {
                size: 0
            },
            formatter: function (seriesName, opts) {
                return seriesName + ":  " + opts.w.globals.series[opts.seriesIndex]
            },
        }
    };
    var chart4 = new ApexCharts(document.querySelector("#diseases-chart"), options4);
    chart4.render();
</script>
@endpush