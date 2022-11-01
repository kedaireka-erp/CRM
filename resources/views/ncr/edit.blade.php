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
                    <form action="/ncr/{{ $ncr->id }}" method="post" class="clearfix" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>Mitra : </label>
                                    <input class="form-control" value="{{ $ncr->nama_mitra }}" type="text"
                                        id="nama_mitra" name="nama_mitra" readonly />
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>Nama Project : </label>
                                    <input class="form-control" value="{{ $ncr->nama_proyek }}" type="text"
                                        id="nama_proyek" name="nama_proyek" readonly />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label>No NCR : </label>
                                    <input class="form-control" type="string" id="nomor_ncr" name="nomor_ncr"
                                        value="{{ $ncr->nomor_ncr }}" readonly />
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
                                        @foreach ($fppp as $fp)
                                            <option value="{{ $fp['nomor_fppp'] }}"
                                                {{ $fp['nomor_fppp'] == $ncr->nomor_fppp ? 'selected' : '' }}>
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
                                            <select class="custom-select2 d-block w-100 form-control" name="kontak_id[]">
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
                                    @error('kontak_id')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group" id="itemm">
                                    <label>Item : </label>
                                    <div class="row mb-4" id="form_item">
                                        <div class="col" id="items">
                                            <select class="custom-select2 d-block w-100 form-control" name="item_id[]">
                                                <option selected hidden disabled>
                                                    Pilih Item
                                                </option>
                                                @foreach ($fppps['item'] as $item)
                                                    <option
                                                        value="{{ $item['kode_item'] . '_' . $item['nama_item'] . '_' . $item['daun'] . '_' . $item['panjang'] . '_' . $item['lebar'] . '_' . $item['warna'] }}"
                                                        {{ $item['kode_item'] . '_' . $item['nama_item'] == $ncr->ItemNcr[0]->kode_item . '_' . $ncr->ItemNcr[0]->nama_item ? 'selected' : '' }}>
                                                        {{ $item['kode_item'] }} - {{ $item['nama_item'] }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-lg-1">
                                            <button onclick="add_item()" type="button" class="btn btn-outline-primary">
                                                +
                                            </button>
                                        </div>
                                    </div>
                                    @error('item_id')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-4 col-sm-12">
                                <div class="form-group">
                                    <label>Dilaporkan Oleh :</label>
                                    <input value="{{ $ncr->pelapor }}" class="form-control" type="string" id="pelapor"
                                        name="pelapor" readonly />
                                </div>
                            </div>
                            <div class="col-md-8 col-sm-12">
                                <div class="form-group">
                                    <label>Jenis Ketidaksesuaian : </label>
                                    <input class="form-control" type="string" id="#"
                                        name="jenis_ketidaksesuaian" value="{{ $ncr->jenis_ketidaksesuaian }}" />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Deskripsi Ketidaksesuaian : </label>
                            <textarea class="form-control" name="deskripsi" placeholder="Enter text ...">{{ $ncr->deskripsi }}</textarea>
                        </div>
                        <div class="row">
                            <div class="col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label for="bukti_kecacatan">Bukti Kecacatan : </label>
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <a href="{{ asset('/storage/' . $ncr->bukti_kecacatan) }}"
                                                class="btn btn-primary" download>Unduh Bukti
                                                Kecacatan</a>
                                        </div>
                                        <div class="col-lg-8">
                                            <input
                                                class="form-control-file form-control height-auto @error('bukti_kecacatan') is-invalid @enderror"
                                                value="" type="file" id="bukti_kecacatan"
                                                name="bukti_kecacatan" />
                                        </div>
                                    </div>
                                    @error('bukti_kecacatan')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    <small class="form-text text-muted" style="color: red">* Lampiran file berformat PDF
                                        maks
                                        2MB</small>
                            </div>
                        </div>
                    </div>
                    @role('QC|Admin')
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label>Analisa : </label>
                                    <textarea class="form-control" name="analisa" placeholder="Enter text ...">{{ $ncr->analisa }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label>Solusi : </label>
                                    <textarea class="form-control" name="solusi" placeholder="Enter text ...">{{ $ncr->solusi }}</textarea>
                                </div>
                            </div>
                        </div>
                    @endrole
                    <input type="hidden" id="alamat_pengiriman" name="alamat_pengiriman"
                        value="{{ $fppps['alamat'] }}">
                    <button type="submit" class="btn btn-success float-right">
                        Submit
                    </button>
                </form>
            </div>
        </div>
    </div>
    <!-- horizontal Basic Forms End -->
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

    let kontak = {!! $ncr->Kontak !!}.sort(function(a, b) {
        return a.pivot.id - b.pivot.id;
    });

    $('#form_kontak').children()[0].children[0].children[kontak[0].id - 1].selected = true;

    $("#form_kontak").on("click", "button", function() {
        add_kontak();
    })

    if (kontak.length >= 1) {
        kontak.forEach(function(kontaks, index) {
            if (index != 0) {
                add_kontak(kontaks)
            }
        })
    }

    function add_kontak(kontaks = undefined) {
        $(document).ready(function() {
            let select = document.createElement("select");
            let kontak = {!! $Kontak !!};
            let option = undefined;
            $(select).append(`<option value="" selected hidden disabled>Pilih Validator</option>`)
            kontak.forEach(function(kontak) {
                option = document.createElement("option");
                option.value = kontak.id;
                option.innerHTML = kontak.nama + ' - ' + kontak.divisi;
                if (kontaks != undefined && kontaks.id == kontak.id) {
                    option.setAttribute("selected", true)
                }
                select.appendChild(option)
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

    let itemmm = {!! $ncr->ItemNcr !!};
    console.log(itemmm);

    if (itemmm.length >= 1) {
        itemmm.forEach(function(itemss, index) {
            if (index != 0) {
                add_item(itemss)
            }
        })
    }


    function add_item(itemss = undefined) {
        $(document).ready(function() {
            let select = document.createElement("select");
            let fppps = {!! $fppp !!}
            let option = undefined;
            let fppp = fppps.filter(function(elemen) {
                return elemen["nomor_fppp"] == $("#nomor_fppp").val()
            })
            $(select).append('<option value="" selected hidden disabled>Pilih Item</option>')
            fppp[0]["item"].forEach(function(item) {
                option = document.createElement("option");
                option.value = item.kode_item + '_' + item.nama_item + '_' + item.daun + '_' + item
                    .panjang + "_" + item.lebar + "_" + item.warna;
                option.innerHTML = item.kode_item + ' - ' + item.nama_item;
                if (itemss != undefined && (itemss.kode_item + "_" + itemss.nama_item) == item
                    .kode_item + "_" + item.nama_item) {
                    option.setAttribute('selected', true)
                }
                select.appendChild(option)
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
            fppp[0]["item"].forEach(function(item) {
                $("#item").append(`
                    <option value="${item["kode_item"]}_${item["nama_item"]}_${item["daun"]}_${item["panjang"]}_${item["lebar"]}_${item["warna"]}">${item["kode_item"]} - ${item["nama_item"]}</option>
                `)
            })
        })
    }
</script>
@endpush
