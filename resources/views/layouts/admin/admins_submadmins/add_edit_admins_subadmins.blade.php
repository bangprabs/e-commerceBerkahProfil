@extends('layouts.admin_layouts.admin_layout')
@section('content')
<!-- Zero Configuration  Starts-->
<div class="page-body">
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-6">
                </div>
                <div class="col-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html"> <i data-feather="user"></i></a></li>
                        <li class="breadcrumb-item">Admin</li>
                        <li class="breadcrumb-item active">{{$title}}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="container">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-header bg-danger">
                                <h5 style="margin-top: 10px">{{$title}}</h5>
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
                                <div class="alert alert-success dark alert-dismissible fade show" role="alert">
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
                                <div class="form theme-form">
                                    <form @if (empty($admindata['id'])) action="{{ url('admin/add-edit-admin-subadmin')}}" @else
                                    action="{{ url('admin/add-edit-admin-subadmin/'.$admindata['id'])}}" @endif name="adminForm" id="adminForm"  enctype="multipart/form-data"
                                    method="post">@csrf
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="admin_name"><b>Nama Admin</b></label>
                                                    <input class="form-control" type="text" id="admin_name"
                                                        name="admin_name" @if (!empty($admindata['name'])) value="{{ $admindata['name'] }}" @else value="{{ old('name') }}" @endif placeholder="Masukkan Nama Admin">
                                                </div>
                                                <div class="form-group mt-3">
                                                    <label for="email"><b>Email Admin</b></label>
                                                    <input class="form-control" type="email" id="email"
                                                        name="email" @if (!empty($admindata['email'])) value="{{ $admindata['email'] }}" @else value="{{ old('email') }}" @endif placeholder="Masukkan Email Admin">
                                                </div>
                                                <div class="form-group mt-3">
                                                    <label for="mobile"><b>Nomor Telepon</b></label>
                                                    <input class="form-control" type="number" id="mobile"
                                                        name="mobile" @if (!empty($admindata['mobile'])) value="{{ $admindata['mobile'] }}" @else value="{{ old('mobile') }}" @endif placeholder="Masukkan Nomor Admin">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="input-group">
                                                    <label class="mt-3" for="coupon_option"><b>Role Admin : </b></label>
                                                    <select data-placeholder="Pilih Role Admin" name="admin_type" class="form-control select2" required>
                                                        <option value="">Select..</option>
                                                            <option value="admin" @if(!empty($admindata['type']) && $admindata['type'] == "admin") selected @endif>
                                                                Admin
                                                            </option>
                                                            <option value="subadmin" @if(!empty($admindata['type']) && $admindata['type'] == "subadmin") selected @endif>
                                                                Sub-Admin
                                                            </option>
                                                    </select>
                                                </div>
                                                <div class="form-group mt-3">
                                                    <label for="admin_password"><b>Password</b></label>
                                                    <input class="form-control" id="admin_password"
                                                        name="admin_password" type="password" @if (!empty($admindata['admin_password'])) value="{{ $admindata['password'] }}" @else value="{{ old('password') }}" @endif placeholder="Password Admin">
                                                </div>
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="mt-3">
                                                            <label><b>Foto Profil : </b></label>
                                                            <input class="form-control" placeholder="" type="file"
                                                                aria-label="file example" name="image"
                                                                @if(isset($admindata['image'])) value="" @else
                                                                value="" @endif>
                                                            @if (!empty($admindata['image']))
                                                            <button type="button" class="btn btn-primary ml-2"
                                                                data-bs-toggle="modal" data-bs-target="#exampleModalCenterMain">
                                                                Lihat Foto Profil
                                                            </button>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <div class="text-end mt-5"><button type="submit"
                                                        class="btn btn-success">{{$title}}</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                @if (!empty($admindata['image']))
                                <div class="modal fade" id="exampleModalCenterMain" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalCenterMain" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Foto Profil</h5>
                                                <button class="btn-close" type="button" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <img class="img-thumbnail rounded mx-auto d-block"
                                                    src="{{ asset('images/admin_images/admin_photos/' . $admindata['image']) }}">
                                            </div>
                                            <div class="modal-footer">
                                                <button class="btn btn-secondary" type="button"
                                                    data-bs-dismiss="modal">Close</button>
                                                    <a href="javascript:void(0)" record="product-image"
                                                    recordid="{{ $admindata['id'] }}"
                                                    class="confirmDelete btn btn-danger">Delete Image</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endif

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
