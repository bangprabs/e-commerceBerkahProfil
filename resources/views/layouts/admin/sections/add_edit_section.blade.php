@extends('layouts.admin_layouts.admin_layout')
@section('content')
<div class="page-body">
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-6">
                    <h3>
                        {{$title}}</h3>
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
                            <form method="post" role="form"  @if (empty($sectiondata['id'])) action="{{ url('admin/add-edit-section')}}" @else
                                action="{{ url('admin/add-edit-section/'.$sectiondata['id'])}}" @endif
                                name="updateAdminDetails" enctype="multipart/form-data" id="updatePasswordForm">
                                @csrf
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label>Section Name</label>
                                            <input class="form-control" type="text" value="{{ $sectiondata->name}}"
                                                id="section_name" name="section_name">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="text-end"><button type="submit" class="btn btn-success">{{$title}}</button>
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
        <div class="container-fluid">
            <div class="page-title">
                <div class="row">
                    <div class="container">
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-header bg-secondary">
                                    <h5 style="margin-top: 10px">Current List Sections</h5>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive ">
                                        <table class="hover" id="blog">
                                            <thead>
                                                <tr>
                                                    <th>No. </th>
                                                    <th>Section Name</th>
                                            </thead>
                                            <tbody>
                                                <?php $no = 1;?>
                                                @foreach ($listsection as $section)
                                                <tr>
                                                    <td>{{ $no }}</td>
                                                    <td>{{$section['name']}}</td>
                                                </tr>
                                                <?php $no++?>
                                                @endforeach
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>No. </th>
                                                    <th>Section Name</th>
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
