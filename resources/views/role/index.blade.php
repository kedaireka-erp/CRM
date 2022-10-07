@extends('layouts.admin')

@push('style')
    <link rel="stylesheet" type="text/css" href="/src/plugins/datatables/css/dataTables.bootstrap4.min.css" />
    <link rel="stylesheet" type="text/css" href="/src/plugins/datatables/css/responsive.bootstrap4.min.css" />
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
                                <li class="breadcrumb-item active" aria-current="page">
                                    Role
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 mb-20">
                    <div class="card-box mb-30">
                        <div class="pd-20">
                            <div class="text-blue h5">User Role</div>
                            <small class="mb-0">
                                list User beserta role-nya
                            </small>
                        </div>
                        <div class="pb-20">
                            <table class="data-table table stripe hover nowrap">
                                <thead>
                                    <tr>
                                        <th class="table-plus">Nomor</th>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $nomor => $user)
                                        <tr id="role">
                                            <td class="table-plus">{{ $nomor + 1 }}</td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>
                                                <select name="role" class="custom-select" id="{{ $user->id }}">
                                                    @foreach ($roles as $role)
                                                        <option value="{{ $role->name }}"
                                                            {{ $user->roles[0]->id == $role->id ? 'selected' : '' }}>
                                                            {{ $role->name }}</option>
                                                    @endforeach
                                                </select>
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
    </div>
@endsection
@push('script')
    <script src="/src/plugins/datatables/js/dataTables.buttons.min.js"></script>
    <script src="/src/plugins/datatables/js/buttons.bootstrap4.min.js"></script>
    <script src="/src/plugins/datatables/js/buttons.print.min.js"></script>
    <script src="/src/plugins/datatables/js/buttons.html5.min.js"></script>
    <script src="/src/plugins/datatables/js/buttons.flash.min.js"></script>
    <script src="/vendors/scripts/datatable-setting.js"></script>
    <script src="/src/plugins/datatables/js/vfs_fonts.js"></script>
    <script>
        $("#role select").on("change", function() {
            $.ajax({
                url: '/role/' + $(this).attr('id'),
                type: 'POST',
                data: {
                    _token: "{{ csrf_token() }}",
                    roles: $(this).val(),
                    user_id: $(this).attr("id")
                }
            });
        });
    </script>
@endpush
