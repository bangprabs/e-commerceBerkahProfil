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
                        <li class="breadcrumb-item">Catalogue</li>
                        <li class="breadcrumb-item active">Categories </li>
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
                        <div class="alert alert-success dark alert-dismissible fade show" style="margin: 15px;"
                            role="alert">
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
                            <form
                            @if (empty($categorydata['id']))
                                action="{{ url('admin/add-edit-category')}}"
                            @else
                                action="{{ url('admin/add-edit-category/'.$categorydata['id'])}}"
                            @endif
                            enctype="multipart/form-data" name="blogForm" id="blogForm" method="post">@csrf
                            @csrf
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label style="font-weight:bold;" for="category_name">Category Name</label>
                                            <input class="form-control" id="category_name" name="category_name"
                                                placeholder="Enter Category Name" @if(!empty($categorydata['category_name'])) {
                                                value="{{ $categorydata['category_name'] }}" } @else {
                                                value="{{ old('category_name') }}" } @endif>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label style="font-weight:bold;">Select Category Level</label>
                                            <select name="parent_id" id="parent_id" class="form-control select2"
                                                style="width: 100%;">
                                                <option value="0" @if (isset($categorydata['parent_id']) &&
                                                    $categorydata['parent_id']==0) selected="" @endif>Main Category
                                                </option>
                                                @if (!empty($getCategories))
                                                @foreach ($getCategories as $category)
                                                <option value="{{ $category['id'] }}" @if(isset($categorydata['parent_id']) &&
                                                    $categorydata['parent_id']==$category['id'] ) selected="" @endif>
                                                    {{ $category['category_name'] }}</option>
                                                @if (!empty($category['subcategories']))
                                                @foreach ($category['subcategories'] as $subcategory)
                                                <option value="{{ $subcategory['id'] }}">
                                                    &nbsp;&raquo;&nbsp;{{ $subcategory['category_name'] }}</option>
                                                @endforeach
                                                @endif
                                                @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label style="font-weight:bold;" for="category_discount">Category
                                                Discount</label>
                                            <input class="form-control" name="category_discount" id="category_discount"
                                                placeholder="Enter Category Discount"
                                                @if(!empty($categorydata['category_discount'])) {
                                                value="{{ $categorydata['category_discount'] }}" } @else {
                                                value="{{ old('category_discount') }}" } @endif>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label style="font-weight:bold;" for="category_url">Category URL</label>
                                            <input name="url" class="form-control" id="url"
                                                placeholder="Enter Category URL" @if(!empty($categorydata['url'])) {
                                                value="{{ $categorydata['url'] }}" } @else { value="{{ old('url') }}" }
                                                @endif>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label style="font-weight:bold;">Categories Images</label>
                                            <input class="form-control" placeholder="" type="file"
                                                aria-label="file example" name="category_image" @if(isset($categorydata['category_image']))
                                                value="" @else value="" @endif>
                                            @if (!empty($categorydata['category_image']))
                                            <p>Current Image : {{ $categorydata['category_image'] }}</p>
                                            @endif
                                            @if (!empty($categorydata['category_image']))
                                            <button type="button" class="btn btn-primary ml-2" data-bs-toggle="modal"
                                                data-bs-target="#exampleModalCenter">
                                                View Categories Image
                                            </button>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <label style="font-weight:bold;" for="category_description">Category
                                            Description</label>
                                        <textarea id="editor1" class="ckeditor" name="description" cols="30" rows="10" rows="10">
                                        @if (!empty($categorydata['description']))
                                            {{ $categorydata['description'] }}
                                        @else
                                            {{ old('description')}}
                                        @endif
                                        </textarea>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <label style="font-weight:bold;" for="meta_title">Meta Title</label>
                                        <textarea id="editor1" name="meta_title" cols="30" rows="10" class="ckeditor"
                                            rows="10">
                                            @if (!empty($categorydata['meta_title'])) {{ $categorydata['meta_title'] }} @else {{ old('meta_title') }} @endif
                                        </textarea>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <label style="font-weight:bold;" for="meta_description">Meta Description</label>
                                        <textarea name="meta_description" class="ckeditor" cols="30" rows="10"
                                            rows="10">
                                            @if (!empty($categorydata['meta_description'])) {{ $categorydata['meta_description'] }} @else {{ old('meta_description') }} @endif
                                        </textarea>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <label style="font-weight:bold;" for="meta_keywords">Meta Keywords</label>
                                        <textarea name="meta_keywords" class="ckeditor" cols="30" rows="10" rows="10">
                                            @if (!empty($categorydata['meta_keywords'])) {{ $categorydata['meta_keywords'] }} @else {{ old('meta_keywords') }} @endif
                                        </textarea>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col">
                                        <div class="text-end"><button type="submit"
                                                class="btn btn-success">{{$title}}</button>
                                        </div>
                                    </div>
                                </div>
                                <!-- Vertically centered modal-->
                                @if (!empty($categorydata['category_image']))
                                <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalCenter" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Image Categories</h5>
                                                <button class="btn-close" type="button" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <img class="img-thumbnail rounded mx-auto d-block w-100"
                                                    src="{{ asset('/images/admin_images/category_images/' . $categorydata['category_image']) }}">
                                            </div>
                                            <div class="modal-footer">
                                                <button class="btn btn-danger" type="button"
                                                    data-bs-dismiss="modal">Close</button>
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
