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
                                <li class="breadcrumb-item"><a href="/">Home</a></li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 mb-20">
                    <div class="row">
                        <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
                            <div class="card-box height-100-p widget-style3">
                                <div class="d-flex flex-wrap">
                                    <div class="widget-data">
                                        <div class="weight-700 font-24 text-dark">{{ $ncr_open }}</div>
                                        <div class="font-14 text-secondary weight-500">
                                            Open Ncr
                                        </div>
                                    </div>
                                    <div class="widget-icon bg-warning">
                                        <div class="icon">
                                            <span class="icon-copy bi bi-door-open"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
                            <div class="card-box height-100-p widget-style3">
                                <div class="d-flex flex-wrap">
                                    <div class="widget-data">
                                        <div class="weight-700 font-24 text-dark">{{ $ncr_closed }}</div>
                                        <div class="font-14 text-secondary weight-500">
                                            Closed NCR
                                        </div>
                                    </div>
                                    <div class="widget-icon bg-danger">
                                        <div class="icon">
                                            <span class="icon-copy bi bi-door-closed"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
                            <div class="card-box height-100-p widget-style3">
                                <div class="d-flex flex-wrap">
                                    <div class="widget-data">
                                        <div class="weight-700 font-24 text-dark">{{ $ncr_confirmed }}</div>
                                        <div class="font-14 text-secondary weight-500">
                                            Confirmed Report
                                        </div>
                                    </div>
                                    <div class="widget-icon bg-success">
                                        <div class="icon">
                                            <i class="icon-copy dw dw-presentation-2"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
                            <div class="card-box height-100-p widget-style3">
                                <div class="d-flex flex-wrap">
                                    <div class="widget-data">
                                        <div class="weight-700 font-24 text-dark">{{ $memo }}</div>
                                        <div class="font-14 text-secondary weight-500">Memo</div>
                                    </div>
                                    <div class="widget-icon bg-primary">
                                        <div class="icon">
                                            <i class="bi bi-card-heading" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 mb-20">
                    <div class="card-box mb-30">
                        <div class="pd-20">
                            <div class="text-blue h3" style="font-weight:900">Need Approval</div>
                            <small class="mb-0" style="font-weight: 500; color: lightsteelblue;">
                                List NCR yang memerlukan approval Anda
                            </small>
                        </div>
                        <div class="pb-20" style="margin-right:15px; margin-left:15px;">
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
                                            <td class="table-plus">{{ $nomor + 1 }}</td>
                                            <td>{{ $ncr->nomor_ncr }}</td>
                                            <td>{{ $ncr->nomor_fppp }}</td>
                                            <td>{{ $ncr->nama_mitra }}</td>
                                            <td>{{ $ncr->nama_proyek }}</td>
                                            <td>
                                                @foreach ($ncr->ItemNcr as $item)
                                                    {{ $item->nama_item }},
                                                @endforeach
                                            </td>
                                            <td>{{ $ncr->tanggal_ncr->format('j F Y') }}</td>
                                            <td>
                                                <a href="/ncr/{{ $ncr->id }}"><i class="dw dw-eye"></i> View to
                                                    Approve</a>
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
@endpush
