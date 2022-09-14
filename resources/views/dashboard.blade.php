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
                                    <th>No NCR</th>
                                    <th>No FPPP</th>
                                    <th>Mitra</th>
                                    <th>Nama Project</th>
                                    <th>Item</th>
                                    <th class="table-plus">Tanggal NCR</th>
                                    <th class="datatable-nosort">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($need_approval as $nomor => $ncr) 
                                    <tr>
                                        <td class="table-plus">{{$nomor+1}}</td>
                                        <td>{{ $ncr->nomor_ncr }}</td>
                                        <td>{{ $ncr->nomor_fppp }}</td>
                                        <td>{{ $ncr->nama_mitra }}</td>
                                        <td>{{ $ncr->nama_proyek }}</td>
                                        <td>
                                            @foreach ($ncr->ItemNcr as $item)
                                                {{ $item->nama_item }},
                                            @endforeach
                                        </td>
                                        <td>{{$ncr->tanggal_ncr->format('l jS \\of F Y')}}</td>
                                        <td>
                                            <a href="/ncr/{{$ncr->id}}"><i class="dw dw-eye"></i> View to Approve</a>
                                        </td>
                                    </tr>
                                @endforeach
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
                            return 300
                        }
                    }
                },
            },
        },
        labels: ['Closed', 'Open']
    };
    var chart4 = new ApexCharts(document.querySelector("#diseases-chart"), options4);
    chart4.render();
</script>
@endpush
