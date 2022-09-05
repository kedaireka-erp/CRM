@extends('layouts.admin')
@push('style')
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="/vendors/styles/core.css" />
    <link rel="stylesheet" type="text/css" href="/vendors/styles/icon-font.min.css" />
    <link rel="stylesheet" type="text/css" href="/src/plugins/datatables/css/dataTables.bootstrap4.min.css" />
    <link rel="stylesheet" type="text/css" href="/src/plugins/datatables/css/responsive.bootstrap4.min.css" />
    <link rel="stylesheet" type="text/css" href="/vendors/styles/style.css" />
@endpush

@section('content')
    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">
                <div class="page-header">
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <div class="title">
                                <h4>Memo</h4>
                            </div>
                            <nav aria-label="breadcrumb" role="navigation">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="/">Home</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">
                                        Memo
                                    </li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
                <!-- Simple Datatable start -->
                <div class="card-box mb-30 ">
                    <div class="pd-20 d-flex justify-content-between align-items-center">
                        <h4 class="text-black h4">List Memo</h4>
                        <div class="mr-2">
                            <a href="/memo/create" class=" btn btn-primary fa-pull-right mr-2">
                                <i class="micon bi bi-plus-lg"></i> Add
                            </a>

                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="data-table table stripe hover wrap">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th class="table-plus datatable-nosort">Mitra</th>
                                    <th class="datatable-nosort">No Memo</th>
                                    <th>Nama Project</th>
                                    <th class="datatable-nosort">Alamat Project</th>
                                    <th class="datatable-nosort">Tanggal Memo</th>
                                    <th class="datatable-nosort">Deadline Pengambilan</th>
                                    <th class="datatable-nosort">No FPPP</th>
                                    <th class="datatable-nosort">Charge</th>
                                    <th class="datatable-nosort">Alasan</th>
                                    <th class="datatable-nosort">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <td>1</td>
                                <td class="table-plus">CV. GRAHA SUKSES MANDIRI</td>
                                <td>1/memo/8/2022</td>
                                <td>RT Decil</td>
                                <td>Gunung Himalaya no 20 dan 62 Karawaci</td>
                                <td>2022-08-08</td>
                                <td>2022-08-08</td>
                                <td>1/fppp/8/2022</td>
                                <td>Tidak</td>
                                <td>Kirim Jendela Baru</td>
                                <td>
                                    <a href="#" class="btn btn-info" style="display: inline-block">Edit</a>
                                    <a href="#" class="btn btn-warning" style="display: inline-block">Cetak</a>
                                </td>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @endsection
        <!-- welcome modal end -->
        <!-- js -->
        @push('script')
            <script src="/src/plugins/datatables/js/jquery.dataTables.min.js"></script>
            <script src="/src/plugins/datatables/js/dataTables.bootstrap4.min.js"></script>
            <script src="/src/plugins/datatables/js/dataTables.responsive.min.js"></script>
            <script src="/src/plugins/datatables/js/responsive.bootstrap4.min.js"></script>
            <!-- buttons for Export datatable -->
            <script src="/src/plugins/datatables/js/dataTables.buttons.min.js"></script>
            <script src="/src/plugins/datatables/js/buttons.bootstrap4.min.js"></script>
            <script src="/src/plugins/datatables/js/buttons.print.min.js"></script>
            <script src="/src/plugins/datatables/js/buttons.html5.min.js"></script>
            <script src="/src/plugins/datatables/js/buttons.flash.min.js"></script>
            <script src="/src/plugins/datatables/js/pdfmake.min.js"></script>
            <script src="/src/plugins/datatables/js/vfs_fonts.js"></script>
            <!-- Datatable Setting js -->
            <script src="/vendors/scripts/datatable-setting.js"></script>
        @endpush
