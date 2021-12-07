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
                                <h5 style="margin-top: 10px">List User</h5>
                                <a href="{{ url('admin/view-users-charts')}}" class="btn btn-success" style="float: right; margin-top: -35px;">Cek Grafik User</a>
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
                                                <th>Alamat</th>
                                                <th>Kota</th>
                                                <th>Provinsi</th>
                                                <th>Kodepos</th>
                                                <th>Telepon</th>
                                                <th>Email</th>
                                                <th>Status</th>
                                                <th>Actions</th>
                                        </thead>
                                        <?php $no = 1;?>
                                        @foreach ($users as $user)
                                        <tr>
                                            <td>{{ $no }}</td>
                                            <td>{{$user['name']}}</td>
                                            <td>{{$user['address']}}</td>
                                            <td>{{$user['city']}}</td>
                                            <td>{{$user['state']}}</td>
                                            <td>{{$user['pincode']}}</td>
                                            <td>{{$user['mobile']}}</td>
                                            <td>{{$user['email']}}</td>
                                            <td>
                                                @if ($user['status'] == 1)
                                                <a class="updateUserStatus btn btn-primary btn-block"
                                                    id="user-{{$user['id']}}" user_id="{{$user['id']}}"
                                                    href="javascript:void(0)">Active</a>
                                                @else
                                                <a class="updateUserStatus btn btn-danger btn-block"
                                                    id="user-{{$user['id']}}" user_id="{{$user['id']}}"
                                                    href="javascript:void(0)">Inactive</a>
                                                @endif
                                            </td>
                                            <td style="text-align: center">
                                                <a title="Delete User" href="javascript:void(0)" record="coupon" recordid="" class="confirmDelete btn btn-danger ml-3"><i class="fa fa-trash"></i></a>
                                            </td>
                                        </tr>
                                        <?php $no++?>
                                        @endforeach
                                        <tfoot>
                                            <tr>
                                                <th>No. </th>
                                                <th>Nama</th>
                                                <th>Alamat</th>
                                                <th>Kota</th>
                                                <th>Provinsi</th>
                                                <th>Kodepos</th>
                                                <th>Telepon</th>
                                                <th>Email</th>
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
