@extends('layouts.admin_layouts.admin_layout')
@section('content')
<div class="page-body">
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-6">
                    <h3>
                        Change Password</h3>
                </div>
                <div class="col-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html"> <i data-feather="user"></i></a></li>
                        <li class="breadcrumb-item">Settings User</li>
                        <li class="breadcrumb-item active">Change Password </li>
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
                    <form method="post" role="form" action="{{ url('/admin/update-current-pwd') }}"
                        name="updatePasswordForm" id="updatePasswordForm">
                        @csrf
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
                            <div class="form theme-form">
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
                                            <label>Admin Type</label>
                                            <input class="form-control" type="text" value="{{ $adminDetails->type}}"
                                                readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label>Current Password</label>
                                            <input class="form-control" type="password" id="current_pwd" name="current_pwd"
                                                placeholder="Enter Current Password">
                                                <span id="chkCurrentPwd"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label>New Password</label>
                                            <input class="form-control" type="password" placeholder="Enter New Password"  id="exampleInputPassword1" id="new_pwd"
                                            name="new_pwd">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label>Confirm Password</label>
                                            <input class="form-control" id="confirm_pwd"
                                            name="confirm_pwd" type="password" placeholder="Confirm New Password">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="text-end"><button type="submit" class="btn btn-success">Change Password</button>
                                    </div>
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
@endsection
