@extends('layouts.admin_layouts.admin_layout')
@section('content')
<div class="page-body">
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-6">
                    <h3>
                        {{ $title }}</h3>
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
                        <div class="alert alert-success dark alert-dismissible fade show" style="margin: 15px;" role="alert">
                            {{ Session::get('success_message')}}
                            <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif

                        @if ($errors->any())
                        <div class="alert alert-danger dark alert-dismissible fade show" role="alert">
                            @foreach ($errors->all() as $error)
                            {{ $error }} <br>
                            @endforeach
                        </div>he
                        @endif
                        <div class="form theme-form">
                            <form method="post" role="form" @if (empty($bannerdata['id'])) action="{{ url('admin/add-edit-banner')}}" @else
                            action="{{ url('admin/add-edit-banner/'.$bannerdata['id'])}}" @endif
                                name="updateAdminDetails" enctype="multipart/form-data" id="updatePasswordForm">
                                @csrf
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label><b>Banner Link</b></label>
                                            <input class="form-control" type="text" value="" id="banner_link" name="banner_link"
                                            @if (!empty($bannerdata['link'])) {
                                                value="{{ $bannerdata['link'] }}" } @else {
                                                value="{{ old('link') }}" } @endif value="">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label><b>Banner Title</b></label>
                                            <input class="form-control" type="text"
                                                id="banner_title" name="banner_title"
                                                @if (!empty($bannerdata['title'])) {
                                                    value="{{ $bannerdata['title'] }}" } @else {
                                                    value="{{ old('title') }}" } @endif value="">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label><b>Banner Alt Text</b></label>
                                            <input class="form-control" type="text" id="banner_alt" name="banner_alt"
                                            @if (!empty($bannerdata['alt'])) {
                                                value="{{ $bannerdata['alt'] }}" } @else {
                                                value="{{ old('alt') }}" } @endif value="">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <label for="editor"><b>Description Banner : </b></label>
                                        <textarea id="editor" class="editor" name="banner_description" cols="30" rows="10"
                                            rows="10">
                                            @if (!empty($bannerdata['description'])) {{ $bannerdata['description'] }} @else {{ old('description') }} @endif
                                        </textarea>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label><b>Images Banner</b></label>
                                            <input class="form-control" placeholder="" type="file" aria-label="file example" name="image"
                                            @if (isset($bannerdata['image']))
                                                value="{{ $bannerdata['image'] }}"
                                            @else
                                                value=""
                                            @endif
                                            >
                                            <p>Current Image : {{ $bannerdata['image'] }}</p>
                                            @if (!empty($bannerdata['image']))
                                            <button type="button" class="btn btn-primary ml-2"
                                                data-bs-toggle="modal" data-bs-target="#exampleModalCenter">
                                                View Cover Image
                                            </button>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="text-end"><button type="submit" class="btn btn-success">{{$title}}</button>
                                        </div>
                                    </div>
                                </div>
                                <!-- Vertically centered modal-->
                                @if (!empty($bannerdata['image']))
                                <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalCenter" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Image Banner</h5>
                                                <button class="btn-close" type="button" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <img class="img-thumbnail rounded mx-auto d-block w-100"
                                                    src="{{ asset('images/admin_images/banner_images/' . $bannerdata['image']) }}">
                                            </div>
                                            <div class="modal-footer">
                                                <button class="btn btn-secondary" type="button"
                                                    data-bs-dismiss="modal">Close</button>
                                                <a href="javascript:void(0)" record="banner-image"
                                                    recordid="{{ $bannerdata['id'] }}"
                                                    class="confirmDelete btn btn-danger">Delete Banner
                                                    Image</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endif
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    @endsection
