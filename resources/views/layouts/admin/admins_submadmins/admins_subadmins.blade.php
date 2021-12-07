@extends('layouts.admin_layouts.admin_layout')
@section('content')
<!-- Zero Configuration  Starts-->
<div class="page-body">
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="container">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-header bg-primary">
                                <h5 style="margin-top: 10px">Daftar Admin / Sub-Admins</h5>
                                <a href="{{ url('admin/add-edit-admin-subadmin')}}" class="btn btn-success" style="float: right; margin-top: -35px;">Tambah Admin / Sub-Admins</a>
                            </div>

                            <div class="card-body">
                                @if (Session::has('error_message'))
                            <div class="alert alert-danger dark alert-dismissible fade show" role="alert">
                                {{ Session::get('error_message')}}
                                <button class="btn-close" type="button" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                            @endif

                            @if (Session::has('success_message'))
                            <div class="p-3 alert alert-success dark alert-dismissible fade show" role="alert">
                                {{ Session::get('success_message')}}
                                <button class="btn-close" type="button" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                            @endif

                            @if ($errors->any())
                            <div class="alert alert-danger dark alert-dismissible fade show" role="alert">
                                @foreach ($errors->all() as $error)
                                    {{ $error }} <br>
                                @endforeach
                            </div>
                            @endif
                                <div class="table w-100">
                                    <table style="width:100%" class="table table-scrollable table-striped table-responsive table-bordered table-striped" id="userlist">
                                        <thead>
                                            <tr>
                                                <th>No. </th>
                                                <th>Nama</th>
                                                <th>Telepon</th>
                                                <th>Email</th>
                                                <th>Type</th>
                                                <th>Status</th>
                                                <th>Actions</th>
                                        </thead>
                                        <?php $no = 1;?>
                                        @foreach ($admins_subadmins as $admin)
                                        <tr>
                                            <td>{{ $no }}</td>
                                            <td>{{$admin['name']}}</td>
                                            <td>{{$admin['mobile']}}</td>
                                            <td>{{$admin['email']}}</td>
                                            <td>{{$admin['type']}}</td>
                                            <td style="text-align: center">
                                                @if ($admin->type != "superadmin")
                                                    @if ($admin['status'] == 1)
                                                    <a class="updateAdminStatus btn btn-primary btn-block"
                                                        id="admin-{{$admin['id']}}" admin_id="{{$admin['id']}}"
                                                        href="javascript:void(0)">Active</a>
                                                    @else
                                                    <a class="updateAdminStatus btn btn-danger btn-block"
                                                        id="admin-{{$admin['id']}}" admin_id="{{$admin['id']}}"
                                                        href="javascript:void(0)">Inactive</a>
                                                    @endif
                                                @endif
                                            </td>
                                            <td style="text-align: center">
                                                @if ($admin->type != "superadmin")
                                                    <a title="Atur Roles/Permissions" href="{{ url('admin/update-role/'.$admin->id)}}" class="btn btn-warning m-1"><i class="fa fa-unlock"></i></a>
                                                    <a title="Edit Admin/Sub-Admin" href="{{ url('admin/add-edit-admin-subadmin/'.$admin->id)}}" class="btn btn-success m-1"><i class="fa fa-edit"></i></a>
                                                    <a title="Hapus Admin" href="javascript:void(0)" record="admin" recordid="{{ $admin->id }}" class="confirmDelete btn btn-danger m-1"><i class="fa fa-trash"></i></a>
                                                @endif
                                            </td>
                                        </tr>
                                        <?php $no++?>
                                        @endforeach
                                        <tfoot>
                                            <tr>
                                                <th>No. </th>
                                                <th>Nama</th>
                                                <th>Telepon</th>
                                                <th>Email</th>
                                                <th>Type</th>
                                                <th>Status</th>
                                                <th>Actions</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
