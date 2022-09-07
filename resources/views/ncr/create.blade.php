@extends('layouts.admin')
@section('content')
    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">
                <div class="page-header">
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <div class="title">
                                <h4>Form</h4>
                            </div>
                            <nav aria-label="breadcrumb" role="navigation">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="index.html">Home</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">
                                        add NCR
                                    </li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
                <!-- horizontal Basic Forms Start -->
                <div class="pd-20 card-box mb-30">
                    <div class="clearfix">
                        <div class="pull-left">
                            <h4 class="text-blue h4">Form NCR</h4>
                        </div>
                    </div>
                    <form action="/ncr" method="post" class="clearfix">
                      @csrf
                        <div class="row">
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>Mitra</label>
                                    <input class="form-control" type="text" id="nama_mitra" name="nama_mitra" disabled />
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>Nama Project</label>
                                    <input class="form-control" type="text" id="nama_proyek" name="nama_proyek"
                                        disabled />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label>No NCR</label>
                                    <input class="form-control" type="string" id="nomor_ncr" name="nomor_ncr" disabled />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>Tanggal</label>
                                    <input class="form-control datetimepicker-range" type="date" id="tanggal_ncr"
                                        name="tanggal_ncr"disabled />
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>No FPPP</label>
                                    <select class="custom-select d-block w-100 form-control" id="nomor_fppp"
                                        name="nomor_fppp">
                                        {{-- @foreach ($itemTypes as $itemType)
                                            <option value="{{ $itemType->id }}">{{ $itemType->name }}</option>
                                        @endforeach --}}
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group " id="kontak">
                                    <label>Kepada (validator)</label>
                                    <div class="row" >
                                        <div class="col">
                                            <select class="custom-select d-block w-100 form-control" id="Kontak"
                                                name="kontak_id[]">
                                                @foreach ($Kontak as $con)
                                                    <option value="{{ $con->id }}">{{ $con->nama }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-lg-1">
                                            <button onclick="add_kontak(this)" type="button"
                                                class="btn btn-outline-primary">+</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group" id="itemm">
                                    <label>Item</label>
                                    <div class="row">
                                        <div class="col">
                                            <select class="custom-select d-block w-100 form-control" id="item" name="item_id[]">
                                                @foreach ($ItemNcr as $Itemncr)
                                                    <option value="{{ $Itemncr->id }}">{{ $Itemncr->nama_item }}</option>
                                                    @endforeach
                                            </select>
                                        </div>
                                        <div class="col-lg-1">
                                            <button onclick="add_item(this)" type="button" class="btn btn-outline-primary">+</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 col-sm-12">
                                <div class="form-group">
                                    <label>Dilaporkan Oleh :</label>
                                    <input class="form-control" type="string" id="pelapor" name="pelapor" disabled />
                                </div>
                            </div>
                            <div class="col-md-8 col-sm-12">
                                <div class="form-group">
                                    <label>Jenis Ketidaksesuaian</label>
                                    <input class="form-control" type="string" id="#" name="#" />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Deskripsi Ketidaksesuaian</label>
                            <input class="form-control" type="string" id="deskripsi" name="deskripsi" />
                        </div>
                        <div class="row">
                            <div class="col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label>Bukti Kecacatan</label>
                                    <input class="form-control-file form-control height-auto" type="file" id="bukti_kecacatan"
                                        name="bukti_kecacatan" />
                                    <small class="form-text text-muted" style="color: red">* Lampiran file berformat PDF
                                        maks 2MB</small>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success float-right">Send</button>
                    </form>
                </div>
            </div>
        </div>
        <!-- horizontal Basic Forms End -->
    </div>
@endsection

@push('script')
    <script type="text/javascript">
        function add_kontak(element) {
            $(document).ready(function(){
                $('#kontak').append(`<div class="row mt-4" >
                                        <div class="col">
                                            <select class="custom-select d-block w-100 form-control" id="Kontak"
                                                name="kontak_id[]">
                                                @foreach ($Kontak as $con)
                                                    <option value="{{ $con->id }}">{{ $con->nama }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-lg-1">
                                            <button onclick="add_kontak(this)" type="button"
                                                class="btn btn-outline-primary">+</button>
                                        </div>
                                    </div>`)
            })
            element.parentElement.remove();
        };

        function add_item(element) {
          $(document).ready(function(){
            $('#itemm').append(` <div class="row mt-4">
                                        <div class="col">
                                            <select class="custom-select d-block w-100 form-control" id="item" name="item_id[]">
                                                @foreach ($ItemNcr as $Itemncr)
                                                    <option value="{{ $Itemncr->id }}">{{ $Itemncr->nama_item }}</option>
                                                    @endforeach
                                            </select>
                                        </div>
                                        <div class="col-lg-1">
                                            <button onclick="add_item(this)" type="button" class="btn btn-outline-primary">+</button>
                                        </div>
                                    </div>`)
          })
          element.parentElement.remove();
        }
    </script>
@endpush
