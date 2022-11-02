@extends('layouts.admin')

@push('style')
    <!-- switchery css -->
    <link rel="stylesheet" type="text/css" href="/src/plugins/switchery/switchery.min.css" />
    <!-- bootstrap-tagsinput css -->
    <link rel="stylesheet" type="text/css" href="/src/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css" />
    <!-- bootstrap-touchspin css -->
    <link rel="stylesheet" type="text/css" href="/src/plugins/bootstrap-touchspin/jquery.bootstrap-touchspin.css" />
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
                                <li class="breadcrumb-item">
                                    <a href="/ncr">NCR</a>
                                </li>
                                <li aria-current="page" class="breadcrumb-item active">Validasi NCR</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col mb-20">
                    <div class="pd-20 card-box mb-30 row">
                        <div class="form-group col-lg-6">
                            <label>Nomor NCR</label>
                            <input type="text" class="form-control" value="{{ $ncr->nomor_ncr }}" disabled>
                        </div>
                        <div class="form-group col-lg-6">
                            <label>Nomor FPPP</label>
                            <input type="text" class="form-control" value="{{ $ncr->nomor_fppp }}" disabled>
                        </div>
                        <div class="form-group col-lg-5">
                            <label>Nama Mitra</label>
                            <input type="text" class="form-control" value="{{ $ncr->nama_mitra }}" disabled>
                        </div>
                        <div class="form-group col-lg-7">
                            <label>Nama Proyek</label>
                            <input type="text" class="form-control" value="{{ $ncr->nama_proyek }}" disabled>
                        </div>
                        <div class="form-group col-lg-2">
                            <label>Tanggal NCR</label>
                            <input type="text" class="form-control date-picker"
                                value="{{ $ncr->tanggal_ncr->format('j F Y') }}" disabled>
                        </div>
                        <div class="form-group col-lg-2">
                            <label>Pelapor</label>
                            <input type="text" class="form-control date-picker" value="{{ $ncr->pelapor }}" disabled>
                        </div>
                        <div class="form-group col-lg-8">
                            <label>Item</label>
                            <input type="text" class="form-control date-picker"
                                value="@foreach ($ncr->ItemNcr as $keys => $item) {{ $item->kode_item . '-' . $item->nama_item . ($keys < $ncr->ItemNcr->count() - 1 ? ', ' : '') }} @endforeach"
                                disabled>
                        </div>
                        <div class="form-group col-12">
                            <label>Deskripsi</label>
                            <textarea class="form-control" disabled>{{ $ncr->deskripsi }}</textarea>
                        </div>
                        <div class="form-group col-12">
                            <label>Analisa</label>
                            <textarea class="form-control" disabled>{{ $ncr->analisa }}</textarea>
                        </div>
                        <div class="form-group col-12">
                            <label>Perkiraan Solusi</label>
                            <textarea class="form-control" disabled>{{ $ncr->solusi }}</textarea>
                        </div>
                        <div class="form-group col-12">
                            <label>Bukti Kecacatan</label>
                            <div>
                                @if (explode('.', $ncr->bukti_kecacatan)[1] == 'jpg' ||
                                    explode('.', $ncr->bukti_kecacatan)[1] == 'png' ||
                                    explode('.', $ncr->bukti_kecacatan)[1] == 'jpeg')
                                    <center>
                                        <img style="max-width: 50%;" src="{{ asset('/storage/' . $ncr->bukti_kecacatan) }}"
                                            alt="">
                                    </center>
                                @else
                                    <a href="{{ asset('/storage/' . $ncr->bukti_kecacatan) }}"
                                        class="btn btn-primary">Open</a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-box mb-30 ">
                <div class="pd-20">
                    <div class="text-blue h5">Approved By</div>
                </div>
                <div class="pb-20">
                    <table class="data-table table stripe hover nowrap">
                        <thead>
                            <tr>
                                <th>
                                    <div class="d-flex justify-content-center">
                                        No
                                    </div>
                                </th>
                                <th>
                                    <div class="d-flex justify-content-center">
                                        Nama
                                    </div>
                                </th>
                                <th>
                                    <div class="d-flex justify-content-center">
                                        Divisi
                                    </div>
                                </th>
                                <th class="datatable-nosort">
                                    <div class="d-flex justify-content-center">
                                        Approved
                                    </div>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($validators as $nomor => $validator)
                                <tr>
                                    <td>
                                        <div class="d-flex justify-content-center">
                                            {{ $nomor + 1 }}
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-center">
                                            {{ $validator->nama }}
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-center">
                                            {{ $validator->divisi }}
                                        </div>
                                    </td>
                                    <td>
                                        <div class="custom-control custom-checkbox mb-5 d-flex justify-content-center">
                                            <input type="checkbox" class="custom-control-input"
                                                id="{{ $validator->pivot->id }}-{{ $nomor }}"
                                                onClick="validasi(this)"
                                                @if ($validator->pivot->validated == 1) checked disabled @endif>
                                            <label class="custom-control-label"
                                                for="{{ $validator->pivot->id }}-{{ $nomor }}">{{ $validator->pivot->validated == 1 ? 'validated' : 'validate' }}</label>
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
@endsection

@push('script')
    <!-- switchery js -->
    <script src="/src/plugins/switchery/switchery.min.js"></script>
    <!-- bootstrap-tagsinput js -->
    <script src="/src/plugins/bootstrap-tagsinput/bootstrap-tagsinput.js"></script>
    <!-- bootstrap-touchspin js -->
    <script src="/src/plugins/bootstrap-touchspin/jquery.bootstrap-touchspin.js"></script>
    <script src="/vendors/scripts/advanced-components.js"></script>
    <script>
        function validasi(checkbox) {
            let id = checkbox.id.split("-")[0];
            let posisi = checkbox.id.split("-")[1];
            let checked = checkbox.checked;
            let warning = window.confirm("apakah anda yaking memvalidasi NCR ini ?");
            if (warning) {
                $(document).ready(function() {
                    $.ajax({
                        url: "/ncr/validasi/" + id,
                        method: 'POST',
                        data: {
                            posisi: posisi,
                            id: id,
                            checked: 1,
                            ncr_id: "{{ $ncr->id }}",
                            user: "{{ auth()->user()->id }}",
                            _token: "{{ csrf_token() }}"
                        },
                        statusCode: {
                            200: function(data) {
                                alert('Validasi Berhasil');
                                checkbox.setAttribute("disabled", true);
                            },
                            403: function(data) {
                                alert(data.responseJSON.message);
                                checkbox.checked = false;
                            },
                            406: function(data) {
                                alert(data.responseJSON.message);
                                checkbox.checked = false;
                            }
                        }
                    });
                });
            } else {
                checkbox.checked = false;
            }
        }
    </script>
@endpush
