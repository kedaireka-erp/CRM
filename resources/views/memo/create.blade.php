@extends('layouts.admin')
@push('style')
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="vendors/styles/core.css" />
    <link rel="stylesheet" type="text/css" href="vendors/styles/icon-font.min.css"/>
    <link rel="stylesheet" type="text/css" href="vendors/styles/style.css" />
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
                                    <li class="breadcrumb-item" aria-current="page">
                                        Memo
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">
                                        Add Memo
                                    </li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
                <!-- Simple Datatable start -->
                <div class="card-box mb-30 " style="padding: 20px">
                    <div class="pd-20 d-flex justify-content-between align-items-center">
                        <h4 class="text-black h4">Add Memo</h4>
                        {{-- <div class="mr-2">
                            <a href="#" class=" btn btn-primary fa-pull-right mr-2">
                                <i class="micon bi bi-plus-lg"></i> Add
                            </a>

                        </div> --}}
                    </div>
                    
                    <form>
                        <div class="row">
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>Nama Mitra</label>
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>No. Memo</label>
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>Nama Project</label>
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>Alamat</label>
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4 col-sm-12">
                                <div class="form-group">
                                    <label>Tanggal Memo</label>
                                    <input type="text" class="form-control datetimepicker-range" placeholder="Select Date">
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-12">
                                <div class="form-group">
                                    <label>Deadline Pengambilan</label>
                                    <input type="text" class="form-control datetimepicker-range" placeholder="Select Date">
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-12">
                                <div class="form-group">
                                    <label>No FPPP</label>
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4 col-sm-12">
                                <div class="form-group">
                                    <label>Charge</label>
                                    <select class="form-control" name="charge" id="charge">
                                        <option>Ya</option>
                                        <option>Tidak</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-8 col-sm-12">
                                <div class="form-group">
                                    <label>Alasan</label>
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label>Lampiran</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input">
                                        <label class="custom-file-label">Choose file</label>
                                    </div>
                                    <small class="form-text text-muted" style="color: red">
                                        * Lampiran file berformat PDF maks 2MB
                                    </small>
                                </div>
                            </div>
                        </div>
                    </form>

                    <button class="btn btn-primary" type="submit">Process</button>
							
                </div>
            </div>
        @endsection
        <!-- welcome modal end -->
        <!-- js -->
        @push('script')
            <script src="vendors/scripts/core.js"></script>
            <script src="vendors/scripts/script.min.js"></script>
            <script src="vendors/scripts/process.js"></script>
            <script src="vendors/scripts/layout-settings.js"></script>
        @endpush
