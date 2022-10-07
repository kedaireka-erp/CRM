@extends('layouts.admin') @section('content')
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
                                        <a href="/" style="color: grey;">Home</a>
                                    </li>
                                    <li class="breadcrumb-item">
                                        <a href="/ncr" style="color: grey;">NCR</a>
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
                            <h4 class="text-blue h3" style="padding-bottom: 20px;">Form NCR</h4>
                        </div>
                    </div>
                    <form action="/ncr" method="post" class="clearfix" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>Mitra : </label>
                                    <input class="form-control" type="text" id="nama_mitra" name="nama_mitra" readonly />
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>Nama Project : </label>
                                    <input class="form-control" type="text" id="nama_proyek" name="nama_proyek"
                                        readonly />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label>No NCR : </label>
                                    <input
                                        value="{{ $jumlah_ncr }}/NCR/AST/{{ Carbon\Carbon::now()->format('m') }}/{{ Carbon\Carbon::now()->year }}"
                                        class="form-control" type="string" id="nomor_ncr" name="nomor_ncr" readonly />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>Tanggal : </label>
                                    <input value="{{ Carbon\Carbon::now()->toDateString() }}"
                                        class="form-control datetimepicker-range" type="date" id="tanggal_ncr"
                                        name="tanggal_ncr" readonly />
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>No FPPP : </label>
                                    <select onchange="inputFppp(this)" class="custom-select2 d-block w-100 form-control"
                                        id="nomor_fppp" name="nomor_fppp">
                                        <option value="" selected hidden disabled>
                                            Pilih Nomor FPPP
                                        </option>
                                        @foreach ($fppp as $fp)
                                            <option value="{{ $fp['nomor_fppp'] }}">
                                                {{ $fp['nomor_fppp'] }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group" id="kontak">
                                    <label>Kepada (validator) : </label>
                                    <div class="row mb-4" id="form_kontak">
                                        <div class="col">
                                            <select class="custom-select2 d-block w-100 form-control" id="Kontak"
                                                name="kontak_id[]">
                                                <option value="" selected hidden disabled>
                                                    Pilih Validator
                                                </option>
                                                @foreach ($Kontak as $con)
                                                    <option value="{{ $con->id }}">
                                                        {{ $con->nama }} - {{ $con->divisi }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-lg-1">
                                            <button type="button" class="btn btn-outline-primary">
                                                +
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group" id="itemm">
                                    <label>Item : </label>
                                    <div class="row mb-4">
                                        <div class="col" id="items">
                                            <select class="custom-select2 d-block w-100 form-control" id="item"
                                                name="item_id[]">
                                                <option value="" selected hidden disabled>
                                                    Pilih Item
                                                </option>
                                            </select>
                                        </div>
                                        <div class="col-lg-1">
                                            <button onclick="add_item(this)" type="button" class="btn btn-outline-primary">
                                                +
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 col-sm-12">
                                <div class="form-group">
                                    <label>Dilaporkan Oleh : </label>
                                    <input value="{{ auth()->user()->name }}" class="form-control" type="string"
                                        id="pelapor" name="pelapor" readonly />
                                </div>
                            </div>
                            <div class="col-md-8 col-sm-12">
                                <div class="form-group">
                                    <label>Jenis Ketidaksesuaian : </label>
                                    <input class="form-control" type="string" id="#"
                                        name="jenis_ketidaksesuaian" />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Deskripsi Ketidaksesuaian : </label>
                            <textarea class="form-control" name="deskripsi" placeholder="Enter text ..."></textarea>
                        </div>
                        <div class="row">
                            <div class="col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label for="bukti_kecacatan">Bukti Kecacatan : </label>
                                    <input class="form-control-file form-control height-auto" type="file"
                                        id="bukti_kecacatan" name="bukti_kecacatan" />
                                    <small class="form-text text-muted" style="color: red">* Lampiran file berformat PDF
                                        maks
                                        2MB</small>
                                </div>
                            </div>
                        </div>
                        <div class="row d-none">
                            <div class="col">
                                <div class="form-group">
                                    <label>Analisa : </label>
                                    <textarea class="form-control" name="analisa" placeholder="Enter text ..."></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row d-none">
                            <div class="col">
                                <div class="form-group">
                                    <label>Solusi : </label>
                                    <textarea class="form-control" name="solusi" placeholder="Enter text ..."></textarea>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" id="alamat_pengiriman" name="alamat_pengiriman">
                        <button type="submit" class="btn btn-success float-right">
                            Create NCR
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endsection @push('script')
    <script type="text/javascript">
        (function() {
            $(document).ready(function() {
                document.querySelectorAll("textarea").forEach(function(elemen) {
                    $(elemen).wysihtml5()
                })
            })
        })();

        function add_kontak() {
            $(document).ready(function() {
                let select = document.createElement("select");
                let kontak = {!! $Kontak !!};
                $(select).append(`<option value="" selected hidden disabled>Pilih Validator</option>`)
                kontak.forEach(function(kontak) {
                    $(select).append(
                        `<option value="${kontak.id}">${kontak.nama} - ${ kontak.divisi }</option>`)
                })
                $("#kontak").append(`<div class="row mb-4" >
                                        <div class="col">
                                            <select class="custom-select form-control"
                                                name="kontak_id[]">
                                                ${select.innerHTML}
                                            </select>
                                        </div>
                                        <div class="col-lg-1">
                                            <button onclick="hapus_elemen(this)" type="button" class="btn btn-outline-danger"> - </button>
                                        </div>
                                    </div>`);
                $("#kontak .row:last-child select").select2();
            });
        }

        function add_item(element) {
            $(document).ready(function() {
                let select = document.createElement("select");
                let fppps = {!! $fppp !!}
                let fppp = fppps.filter(function(elemen) {
                    return elemen["nomor_fppp"] == $("#nomor_fppp").val()
                })
                $(select).append('<option value="" selected hidden disabled>Pilih Item</option>')
                fppp[0]["item"].forEach(function(item) {
                    $(select).append(`
                <option value="${item["kode_item"]}_${item["nama_item"]}_${item["daun"]}_${item["panjang"]}_${item["lebar"]}_${item["warna"]}">${item["kode_item"]} - ${item["nama_item"]}</option>
                `)
                })
                $("#itemm").append(` <div class="row mb-4">
                                        <div class="col">
                                            <select class="custom-select form-control" name="item_id[]">
                                                ${select.innerHTML}
                                            </select>
                                        </div>
                                        <div class="col-lg-1">
                                            <button onclick="hapus_elemen(this)" type="button" class="btn btn-outline-danger"> - </button>
                                        </div>
                                    </div>`);
                $("#itemm .row:last-child select").select2();
            });
        }
        $("#form_kontak").on("click", "button", function() {
            add_kontak();
        })

        function hapus_elemen(element) {
            element.parentElement.parentElement.remove();
        }

        let fppps = {!! $fppp !!}

        function inputFppp(element) {
            let fppp = fppps.filter(function(elemen) {
                return elemen["nomor_fppp"] == element.value
            })
            $(document).ready(function() {
                document.getElementById("item").innerHTML = "";

                $("#nama_mitra").val(`${fppp[0]["nama_mitra"]}`)
                $("#nama_proyek").val(`${fppp[0]["nama_proyek"]}`)
                $("#alamat_pengiriman").val(`${fppp[0]["alamat"]}`)
                $("#item").append(`<option value="" selected hidden disabled>
                                                    Pilih Item
                                                </option>`);
                fppp[0]["item"].forEach(function(item) {
                    $("#item").append(`
                    <option value="${item["kode_item"]}_${item["nama_item"]}_${item["daun"]}_${item["panjang"]}_${item["lebar"]}_${item["warna"]}">${item["kode_item"]} - ${item["nama_item"]}</option>
                `)
                })
            })
        }
    </script>
@endpush
