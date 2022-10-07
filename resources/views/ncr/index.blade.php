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
                                <h4>NCR</h4>
                            </div>
                            <nav aria-label="breadcrumb" role="navigation">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="/" style="color: grey;">Home</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">
                                        NCR
                                    </li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
                <!-- Simple Datatable start -->
                <div class="card-box mb-30 ">
                    <div class="pd-20 d-flex justify-content-between align-items-center">
                        <h4 class="text-blue h3" style="margin-left:15px;">List NCR</h4>
                        <div class="mr-2">
                            <a href="#" class="btn btn-warning fa-pull-right" data-toggle="modal"
                                data-target="#Medium-modal" type="button">
                                <i class="micon dw dw-warning-1"></i> Report
                            </a>
                            <div class="modal fade" id="Medium-modal" tabindex="-1" role="dialog"
                                aria-labelledby="myLargeModalLabel" style="display: none;" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="myLargeModalLabel">
                                                Pilih Bulan
                                            </h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                                ×
                                            </button>
                                        </div>
                                        <form action="/ncr/report" method="post">
                                            @csrf
                                            <input type="hidden" id="bulan" name="bulan">
                                            <input type="hidden" id="tahun" name="tahun">
                                            <div class="modal-body" id="form_tanggal">
                                                <input class="form-control" name="tanggal" id="tanggal"
                                                    placeholder="Select Month" type="month" oninput="pilihTanggal(this)">
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                                    Close
                                                </button>
                                                <button type="submit" class="btn btn-primary">
                                                    Get Report
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            @can('add-ncr')
                                @hasanyrole('Admin|Sales')
                                    <a href="/ncr/create" class=" btn btn-primary fa-pull-right mr-2">
                                        <i class="micon bi bi-plus-lg"></i> Add
                                    </a>
                                @endhasanyrole
                            @endcan

                        </div>
                    </div>
                    <div class="pb-20" style="margin-right:15px; margin-left:15px;">
                        <table class="data-table-excel table stripe hover nowrap">
                            <thead>
                                <tr>
                                    <th class="table-plus">No</th>
                                    <th>No NCR</th>
                                    <th>No FPPP</th>
                                    <th>Mitra</th>
                                    <th>Nama Project</th>
                                    <th>Tanggal</th>
                                    <th>Item</th>
                                    <th>Status</th>
                                    <th class="datatable-nosort">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($ncrs as $no => $ncr)
                                    <tr>
                                        <td class="table-plus">{{ $no + 1 }}</td>
                                        <td>{{ $ncr->nomor_ncr }}</td>
                                        <td>{{ $ncr->nomor_fppp }}</td>
                                        <td>{{ $ncr->nama_mitra }}</td>
                                        <td>{{ $ncr->nama_proyek }}</td>
                                        <td>{{ $ncr->tanggal_ncr->format('j F Y') }}</td>
                                        <td>
                                            @foreach ($ncr->ItemNcr as $keys => $item)
                                                {{ $item->kode_item . '-' . $item->nama_item . ($keys < $ncr->ItemNcr->count() - 1 ? ', ' : '') }}
                                            @endforeach
                                        </td>
                                        <td>{{ $ncr->status }}</td>
                                        <td>

                                            <div class="dropdown">
                                                <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle"
                                                    href="#" role="button" data-toggle="dropdown">
                                                    <i class="dw dw-more"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                                    @if ($ncr->Kontak->every(function ($kontak) {
                                                        return $kontak->pivot->validated == 0;
                                                    }) && $ncr->status == 'open')
                                                        @can('edit-ncr')
                                                            <a class="dropdown-item" href="/ncr/{{ $ncr->id }}/edit"><i
                                                                    class="dw dw-edit2"></i>
                                                                Edit</a>
                                                        @endcan
                                                    @endif
                                                    <a class="dropdown-item" href="/ncr/{{ $ncr->id }}"><i
                                                            class="dw dw-eye"></i>
                                                        Show</a>
                                                    @if (($ncr->nomor_memo == null || $ncr->delete_memo != null) && $ncr->status == 'closed')
                                                        @can('add-memo')
                                                            <a class="dropdown-item"
                                                                href="/memo/{{ $ncr->id }}/create"><i
                                                                    class="icon-copy dw dw-chat3"></i>Create Memo</a>
                                                        @endcan
                                                    @endif
                                                    <form action="/ncr/{{ $ncr->id }}" method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        @can('delete-ncr')
                                                            <button class="dropdown-item" type="submit"><i
                                                                    class="dw dw-delete-3">
                                                                </i>
                                                                Delete</button>
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

                <div class="card-box mb-30 ">
                    <div class="pd-20 d-flex justify-content-between align-items-center">
                        <h4 class="text-blue h3" style="margin-left:10px;">Confirmed Report</h4>
                    </div>
                    <div class="pb-20" style="margin-right:15px; margin-left:15px;">
                        <table class="data-table-excel table stripe hover nowrap">
                            <thead>
                                <tr>
                                    <th class="table-plus">No</th>
                                    <th>No NCR</th>
                                    <th>No FPPP</th>
                                    <th>Mitra</th>
                                    <th>Nama Project</th>
                                    <th>Tanggal</th>
                                    <th>Item</th>
                                    <th>Status</th>
                                    <th class="datatable-nosort">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($confirms as $no => $ncr)
                                    <tr>
                                        <td class="table-plus">{{ $no + 1 }}</td>
                                        <td>{{ $ncr->nomor_ncr }}</td>
                                        <td>{{ $ncr->nomor_fppp }}</td>
                                        <td>{{ $ncr->nama_mitra }}</td>
                                        <td>{{ $ncr->nama_proyek }}</td>
                                        <td>{{ $ncr->tanggal_ncr->format('l jS \\of F Y') }}</td>
                                        <td>
                                            @foreach ($ncr->ItemNcr as $keys => $item)
                                                {{ $item->nama_item . ($keys < $ncr->ItemNcr->count() - 1 ? ', ' : '') }}
                                            @endforeach
                                        </td>
                                        <td class="text-green" style="font-weight:700">{{ $ncr->status }}</td>
                                        <td>

                                            <div class="dropdown">
                                                <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle"
                                                    href="#" role="button" data-toggle="dropdown">
                                                    <i class="dw dw-more"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                                    <a class="dropdown-item" href="/ncr/{{ $ncr->id }}"><i
                                                            class="dw dw-eye"></i>
                                                        Show</a>
                                                    @if ($ncr->nomor_memo == null || $ncr->delete_memo != null)
                                                        @can('add-memo')
                                                            <a class="dropdown-item"
                                                                href="/memo/{{ $ncr->id }}/create"><i
                                                                    class="icon-copy dw dw-chat3"></i>Create Memo</a>
                                                        @endcan
                                                    @endif
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
        </div>
    </div>
    <!-- Simple Datatable End -->
@endsection
<!-- welcome modal end -->
<!-- js -->
@push('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
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
    <script>
        function pilihTanggal(value) {
            $("#bulan").val(value.value.split("-")[1]);
            $("#tahun").val(value.value.split("-")[0]);
        }
    </script>
@endpush
