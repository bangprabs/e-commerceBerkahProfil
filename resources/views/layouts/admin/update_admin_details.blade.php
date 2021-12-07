@extends('layouts.admin_layouts.admin_layout')
@section('content')
<div class="page-body">
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-6">
                    <h3>
                        Update Admin Details</h3>
                </div>
                <div class="col-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html"> <i data-feather="user"></i></a></li>
                        <li class="breadcrumb-item">Settings User</li>
                        <li class="breadcrumb-item active">Update Admin Details </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        @if (Session::has('error_message'))
                        <div class="alert alert-danger dark alert-dismissible fade show" role="alert">
                            {{ Session::get('error_message')}}
                            <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif
                        @if (Session::has('success_message'))
                        <div class="alert alert-success dark alert-dismissible fade show" role="alert">
                            {{ Session::get('success_message')}}
                            <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
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
                            <form method="post" role="form" action="{{ url('/admin/update-admin-details') }}"
                                name="updateAdminDetails" enctype="multipart/form-data" id="updatePasswordForm">
                                @csrf
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label>Admin Email</label>
                                            <input class="form-control" type="text" value="{{ $adminDetails->email}}"
                                                readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label>Admin Name</label>
                                            <input class="form-control" type="text" value="{{ $adminDetails->name}}"
                                                id="admin_name" name="admin_name">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label>Admin Type</label>
                                            <input class="form-control" type="text" value="{{ $adminDetails->type}}"
                                                readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label>Mobile</label>
                                            <input class="form-control" type="text" value="{{ $adminDetails->mobile}}"
                                                id="admin_mobile" name="admin_mobile">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label>Update Images Profile</label>
                                            <input class="form-control" placeholder="{{ $adminDetails->image}}" type="file" aria-label="file example" name="admin_image">
                                            <p>Current Image : {{ $adminDetails->image}}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="text-end"><button type="submit" class="btn btn-success">Update
                                                Details</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    @endsection
