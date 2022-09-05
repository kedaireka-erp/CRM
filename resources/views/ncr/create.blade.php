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
                    <form action="ncr/store" method="post" class="clearfix">
                        <div class="row">
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>Mitra</label>
                                    <input class="form-control" type="text" id="nama_mitra" name="nama_mitra" />
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>Nama Project</label>
                                    <input class="form-control" type="text" id="nama_proyek" name="nama_proyek" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>No NCR</label>
                                    <input class="form-control" type="string" id="nomor_ncr" name="nomor_ncr" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>Tanggal</label>
                                    <input class="form-control datetimepicker-range" type="date" id="tanggal_ncr"
                                        name="tanggal_ncr" />
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>No FPPP</label>
                                    <input class="form-control" type="string" id="nomor_fppp" name="nomor_fppp" />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Kepada (validator)</label>
                            <input class="form-control" type="string" id="kontak" name="kontak_id" />
                        </div>
                        <div class="form-group">
                            <label>Item</label>
                            <input class="form-control" type="string" id="item" name="item_id" />
                        </div>
                        <div class="row">
                            <div class="col-md-4 col-sm-12">
                                <div class="form-group">
                                    <label>Dilaporkan Oleh :</label>
                                    <input class="form-control" type="string" id="pelapor" name="pelapor" />
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
                            <input class="form-control" type="string" id="#" name="#" />
                        </div>
                        <div class="row">
                            <div class="col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label>Bukti Kecacatan</label>
                                    <input class="form-control-file form-control height-auto" type="file" id="#"
                                        name="#" />
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
