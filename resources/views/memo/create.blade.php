@extends('layouts.admin')
@push('style')
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="vendors/styles/core.css" />
    <link rel="stylesheet" type="text/css" href="vendors/styles/icon-font.min.css"/>
    <link rel="stylesheet" type="text/css" href="vendors/styles/style.css" />
    <link rel="stylesheet" type="text/css" href="src/plugins/bootstrap-touchspin/jquery.bootstrap-touchspin.css">
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
                <!-- Add Memo -->
                <div class="card-box mb-30 " style="padding: 20px">
                    <div class="pd-20 d-flex justify-content-between align-items-center">
                        <h4 class="text-black h4">Add Memo</h4>
                    </div>
                    
                    <form>
                        <div class="row">
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>Nama Mitra</label>
                                    <input type="text" class="form-control" oninput="Inputmitra(this)">
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
                            <div class="col-md-4 col-sm-12">
                                <div class="form-group">
                                    <label>Nama Project</label>
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-8 col-sm-12">
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

                        
                        {{-- <div class="row">
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
                        </div> --}}
                    </form>

                    <button class="btn btn-primary" type="submit">Process</button>
							
                </div>

                {{-- Add Item --}}
                <div class="card-box mb-30 " style="padding: 20px">
                    <div class="pd-20 d-flex justify-content-between align-items-center">
                        <h4 class="text-black h4">Add Item</h4>
                    </div>
                    
                    <div class="row">
                        <div class="col-lg-4">
                            <form>
                                <div class="row">
                                    <div class="col-md-4 col-md-12">
                                        <div class="form-group">
                                            <label>Tipe Item :</label>
                                            <select class="form-control" name="charge" id="charge">
                                                <option value="" disabled selected hidden>Pilih</option>
                                                <option>Besi</option>
                                                <option>Kaca</option>
                                                <option>Baja</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4 col-md-12">
                                        <div class="form-group">
                                            <label>Item :</label>
                                            <select class="form-control" name="charge" id="charge">
                                                <option value="" disabled selected hidden>Pilih</option>
                                                <option>Pintu</option>
                                                <option>Jendela</option>
                                                <option>Kerangka Bangunan</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4 col-md-12">
                                        <div class="form-group">
                                            <label>Warna :</label>
                                            <select class="form-control" name="charge" id="charge">
                                                <option value="" disabled selected hidden>Pilih</option>
                                                <option>Hijau</option>
                                                <option>Biru</option>
                                                <option>Hitam</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4 col-md-12">
                                        <div class="form-group">
                                            <label>Bukaan :</label>
                                            <select class="form-control" name="charge" id="charge">
                                                <option value="" disabled selected hidden>Pilih</option>
                                                <option>1</option>
                                                <option>2</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4 col-md-12">
                                        <div class="form-group">
                                            <label>Lebar(mm) :</label>
                                            <input type="text" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4 col-md-12">
                                        <div class="form-group">
                                            <label>Tinggi(mm) :</label>
                                            <input type="text" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4 col-md-12">
                                        <div class="form-group">
                                            <label>Alasan :</label>
                                            <textarea class="form-control"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4 col-md-12">
                                        <div class="form-group">
                                            <label>Charge :</label>
                                            <select class="form-control" name="charge" id="charge">
                                                <option value="" disabled selected hidden>Pilih</option>
                                                <option>Ya</option>
                                                <option>Tidak</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4 col-md-12">
                                        <div class="form-group">
                                            <label>Barang dikembalikan :</label>
                                            <select class="form-control" name="charge" id="charge">
                                                <option value="" disabled selected hidden>Pilih</option>
                                                <option>Ya</option>
                                                <option>Tidak</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4 col-md-12">
                                        <div class="form-group">
                                            <label>Keterangan :</label>
                                            <textarea class="form-control"></textarea>
                                        </div>
                                    </div>
                                </div>
        
                              
                            </form>
                        </div>

                        <div class="col-lg-8">
                            <table class="table table-striped hover wrap">
                                <thead>
                                    <tr>
                                        <th class="datatable-nosort">Act</th>
                                        <th class="datatable-nosort">Item</th>
                                        <th class="datatable-nosort">Alasan</th>
                                        <th class="datatable-nosort">Charge</th>
                                        <th class="datatable-nosort">Barang dikembalikan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <td>
                                    <div class="dropdown">
                                        <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle"
                                            href="#" role="button" data-toggle="dropdown">
                                            <i class="dw dw-more"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                            <a class="dropdown-item" href="#"><i class="dw dw-edit2"></i>
                                                Edit </a>
                                            <a class="dropdown-item" href="#"><i class="dw dw-delete-3"></i>
                                                Delete </a>
                                        </div>
                                    </div>
                                </td>
                                    <td>item1</td>
                                    <td>Kaca pecah</td>
                                    <td>Tidak</td>
                                    <td>Dikembalikan</td>
                                </tbody>
                                
                            </table>
                        </div>
                    </div>

                    <button class="btn btn-primary" type="submit">Add Item</button>
							
                </div>
            </div>
        @endsection
        <!-- welcome modal end -->
        <!-- js -->
        @push('script')
            <script>
                var inputNamaMitra = document.getElementById('inputNamaMitra');
                var valueNamaMitra = document.getElementById('valueNamaMitra');

                function Inputmitra(mitra) {
                    valueNamaMitra.innerHTML = mitra.value;
                }

            </script>
            <script src="/src/plugins/bootstrap-touchspin/jquery.bootstrap-touchspin.js"></script>
            <script src="/vendors/scripts/advanced-components.js"></script>
        @endpush
