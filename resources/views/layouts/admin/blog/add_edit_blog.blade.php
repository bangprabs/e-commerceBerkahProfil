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
                            <div class="card-header">
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
                                    <form @if (empty($blogdata['id'])) action="{{ url('admin/add-edit-blog')}}" @else
                                        action="{{ url('admin/add-edit-blog/'.$blogdata['id'])}}" @endif
                                        enctype="multipart/form-data" name="blogForm" id="blogForm" method="post">@csrf
                                        @csrf
                                        <div class="row">
                                            <div class="col">
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="mb-3">
                                                            <label><b>Blog Author : </b></label>
                                                            <input class="form-control" type="text" name="author"
                                                                value="{{ ucwords(Auth::guard('admin')->user()->name)}}"
                                                                readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="mb-3">
                                                            <label><b>Blog Title : </b></label>
                                                            <input class="form-control" type="text" name="blog_title"
                                                                @if (!empty($blogdata['blog_title'])) {
                                                                value="{{ $blogdata['blog_title'] }}" } @else {
                                                                value="{{ old('blog_title') }}" } @endif value="">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="editor"><b>Category Blog : </b></label>
                                                    <select class="js-example-basic-single col-sm-12"
                                                        name="blog_category">
                                                        <option value="">Select</option>
                                                        @foreach ($getCategory as $category)
                                                        <option value="{{$category->id}}" @if(!empty($blogdata['catblog_id']) &&
                                                            $blogdata['catblog_id']==$category->id) selected @endif
                                                            >{{$category->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <div class="mb-3">
                                                    <label><b>Main Image : </b></label>
                                                    <input class="form-control" placeholder="" type="file"
                                                        aria-label="file example" name="main_image" @if(isset($categorydata['category_image']))
                                                        value="" @else value="" @endif>
                                                        @if (!empty($categorydata['category_image']))
                                                        <p>Current Image : {{ $categorydata['category_image'] }}</p>
                                                        @endif
                                                    @if (!empty($blogdata['main_image']))
                                                    <button type="button" class="btn btn-primary ml-2"
                                                        data-bs-toggle="modal" data-bs-target="#exampleModalCenterMain">
                                                        View Main Image
                                                    </button>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <label><b>Blog Date : </b></label>
                                                <div class="mb-3">
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" required
                                                            data-inputmask-alias="datetime"
                                                            data-inputmask-inputformat="yyyy/mm/dd" data-mask
                                                            id="datemask" @if (!empty($blogdata['blog_date'])) {
                                                            value="{{ $blogdata['blog_date'] }}" } @else {
                                                            value="{{ old('blog_date') }}" } @endif value=""
                                                            name="blog_date">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <div class="mb-3">
                                                    <label><b>Cover Image Blog : </b></label>
                                                    <input class="form-control" placeholder="" type="file"
                                                        aria-label="file example" name="front_image">
                                                    @if (!empty($categorydata['front_image']))
                                                    <p>Current Image : {{ $blogdata['front_image'] }}</p>
                                                    @endif
                                                        @if (!empty($blogdata['front_image']))
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
                                                <label for="editor"><b>Content Blog : </b></label>
                                                <textarea id="editor" name="content_blog" cols="30" rows="10"
                                                    rows="10">
                                                    @if (!empty($blogdata['blog_content'])) {{ $blogdata['blog_content'] }} @else {{ old('blog_content') }} @endif
                                                </textarea>
                                            </div>
                                        </div>
                                        <div class="media mb-2">
                                            <label class="col-form-label m-r-10"><b>Is Featured : </b></label>
                                            <label class="switch">
                                                <input name="is_featured" type="checkbox"
                                                    @if(!empty($blogdata['is_featured']) &&
                                                    $blogdata['is_featured']=="Yes" ) checked @endif value="Yes"><span
                                                    class="switch-state"></span>
                                            </label>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <div class="text-end"><button type="submit"
                                                        class="btn btn-success">{{ $title }}</button>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Vertically centered modal-->
                                        @if (!empty($blogdata['front_image']))
                                        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
                                            aria-labelledby="exampleModalCenter" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Cover Blog
                                                            Image</h5>
                                                        <button class="btn-close" type="button" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <img class="img-thumbnail rounded mx-auto d-block"
                                                            src="{{ asset('images/admin_images/blog_cover_images/' . $blogdata['front_image']) }}">
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button class="btn btn-secondary" type="button"
                                                            data-bs-dismiss="modal">Close</button>
                                                        <a href="javascript:void(0)" record="banner-image"
                                                            recordid="{{ $blogdata['id'] }}"
                                                            class="confirmDelete btn btn-danger">Delete Cover
                                                            Image</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endif

                                        @if (!empty($blogdata['main_image']))
                                        <div class="modal fade" id="exampleModalCenterMain" tabindex="-1" role="dialog"
                                            aria-labelledby="exampleModalCenterMain" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Main Blog Image</h5>
                                                        <button class="btn-close" type="button" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <img class="img-thumbnail rounded mx-auto d-block"
                                                            src="{{ asset('images/admin_images/blog_main_images/' . $blogdata['main_image']) }}">
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button class="btn btn-secondary" type="button"
                                                            data-bs-dismiss="modal">Close</button>
                                                        <a href="javascript:void(0)" record="banner-image"
                                                            recordid="{{ $blogdata['id'] }}"
                                                            class="confirmDelete btn btn-danger">Delete Main
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
    </div>
</div>
@endsection
