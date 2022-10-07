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
                                <h4>Kontak</h4>
                            </div>
                            <nav aria-label="breadcrumb" role="navigation">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="/" style="color: grey;">Home</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">
                                        Kontak
                                    </li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
                <!-- Simple Datatable start -->
                <div class="card-box mb-30 ">
                    <div class="pd-20 d-flex justify-content-between align-items-center">
                        <h4 class="text-blue h3">List Kontak</h4>
                        <div class="mr-2">
                            @can('add-kontak')
                                <a href="/kontak/create" class=" btn btn-primary fa-pull-right mr-2">
                                    <i class="micon bi bi-plus-lg"></i> Add
                                </a>
                            @endcan
                        </div>
                    </div>
                    <div class="pb-20" style="margin-right:15px; margin-left:15px; padding: 0px 0px 30px 0px;">
                        <table class="data-table table stripe hover nowrap">
                            <thead>
                                <tr>
                                    <th class="table-plus">No</th>
                                    <th class="table-plus">Nama</th>
                                    <th class="table-plus">No Whatsapp</th>
                                    <th class="table-plus">Divisi</th>
                                    <th class="datatable-nosort">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($kontaks as $no => $kontak)
                                    <tr>
                                        <td class="table-plus">{{ $no + 1 }}</td>
                                        <td>{{ $kontak->nama }}</td>
                                        <td>{{ $kontak->nomor_whatsapp }}</td>
                                        <td>{{ $kontak->divisi }}</td>
                                        <td>
                                            <div class="dropdown">
                                                <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle"
                                                    href="#" role="button" data-toggle="dropdown">
                                                    <i class="dw dw-more"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                                    @can('edit-kontak')
                                                        <a class="dropdown-item" href="/kontak/{{ $kontak->id }}/edit"><i
                                                                class="dw dw-eye"></i>
                                                            Edit</a>
                                                    @endcan
                                                    <form action="/kontak/{{ $kontak->id }}" method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        @can('delete-kontak')
                                                            @role('Admin')
                                                                <button class="dropdown-item" type="submit"><i
                                                                        class="dw dw-delete-3">
                                                                    </i>
                                                                    Delete</button>
                                                            @endrole
                                                        @endcan
                                                    </form>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
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
