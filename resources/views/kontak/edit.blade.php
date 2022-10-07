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
                                <li class="breadcrumb-item"><a href="/" style="color: grey;">Home</a></li>
                                <li class="breadcrumb-item">
                                    <a href="/kontak" style="color: grey;">Kontak</a>
                                </li>
                                <li aria-current="page" class="breadcrumb-item active">Edit Kontak</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col mb-20">
                    <div class="pd-20 card-box mb-30">
                        <form action="/kontak/{{ $kontak->id }}" method="post">
                            @csrf
                            @method('put')
                            <div class="form-group">
                                <label>Nama</label>
                                <select class="custom-select2 form-control" name="kontak" style="width: 100%; height: 38px"
                                    required>
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}"
                                            @if ($kontak->user_id == $user->id) selected @endif>
                                            {{ $user->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Nomor Whatsapp</label>
                                <input value="{{ $kontak->nomor_whatsapp }}" type="text" class="form-control"
                                    name="nomor_whatsapp" required placeholder="08888....">
                            </div>
                            <div class="form-group">
                                <label>Divisi</label>
                                <input value="{{ $kontak->divisi }}" type="text" class="form-control" name="divisi"
                                    placeholder="Manajer">
                                <small class="form-text text-muted">Kolom ini tidak wajib diisi</small>
                            </div>
                            <a href="/kontak" class="btn btn-warning">Cancel</a>
                            <button type="reset" class="btn btn-secondary">Reset</button>
                            <button type="submit" class="btn btn-primary">Edit Kontak</button>
                        </form>
                    </div>
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
@endpush
