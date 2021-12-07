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
                                    <form  @if (empty($productdata['id'])) action="{{ url('admin/add-edit-product')}}" @else
                                    action="{{ url('admin/add-edit-product/'.$productdata['id'])}}" @endif enctype="multipart/form-data"
                                    name="productForm" id="productForm" method="post">@csrf
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group mt-3">
                                                    <label for="product_name"><b>Product Name</b></label>
                                                    <input class="form-control" id="product_name" name="product_name"
                                                        placeholder="Enter product Name" @if(!empty($productdata['product_name'])) {
                                                        value="{{ $productdata['product_name'] }}" } @else {
                                                        value="{{ old('product_name') }}" } @endif>
                                                </div>
                                                <div class="form-group mt-3">
                                                    <label><b>Select Category</b></label>
                                                    <select required name="category_id" id="category_id"
                                                        class="form-control select2" style="width: 100%;">
                                                        <option value="">Select</option>
                                                        @foreach ($categories as $category)
                                                        <option style="font-weight: bold;" value="{{ $category['id'] }}"
                                                            @if (!empty(@old('category_id')) &&
                                                                $category['id']==@old('category_id'))
                                                            @elseif(!empty($productdata['category_id']) &&
                                                                $productdata['category_id']==$category['id']) selected
                                                            @endif> {{ $category['category_name'] }}</option>
                                                        @foreach ($category['subcategories'] as $subcategory)
                                                        <option value="{{ $subcategory['id'] }}" @if(!empty(@old('category_id')) && $subcategory['id']==@old('category_id'))
                                                            @elseif(!empty($productdata['category_id']) &&
                                                            $productdata['category_id']==$subcategory['id']) selected
                                                            @endif>
                                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;--&nbsp;
                                                            {{ $subcategory['category_name'] }}</option>
                                                        @endforeach
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group mt-3">
                                                    <label for="product_code"><b>Product Code</b></label>
                                                    <input class="form-control" id="product_code" name="product_code"
                                                        placeholder="Enter Product Code" @if(!empty($productdata['product_code'])) {
                                                        value="{{ $productdata['product_code'] }}" } @else {
                                                        value="{{ old('product_code') }}" } @endif>
                                                </div>
                                                <div class="form-group mt-3">
                                                    <label for="product_weight"><b>Product Weight</b></label><span style="font-weight: bold; font-style: italic; font-size: 13px; margin-left: 5px;">(in Gram)</span>
                                                    <input class="form-control" id="product_weight"
                                                        name="product_weight" placeholder="Enter product Color" @if(!empty($productdata['product_weight'])) {
                                                        value="{{ $productdata['product_weight'] }}" } @else {
                                                        value="{{ old('product_weight') }}" } @endif>
                                                </div>
                                                <div class="form-group mt-3">
                                                    <label for="product_price"><b>Product Price</b></label>
                                                    <input class="form-control" id="product_price" name="product_price"
                                                        placeholder="Enter Product Price" @if(!empty($productdata['product_price'])) {
                                                        value="{{ $productdata['product_price'] }}" } @else {
                                                        value="{{ old('product_price') }}" } @endif>
                                                </div>
                                                <div class="form-group mt-3">
                                                    <label for="meta_description">Meta Description</label>
                                                    <textarea name="meta_description" id="meta_description"
                                                        class="ckeditor form-control" rows="3"
                                                        placeholder="Enter product Meta Description">@if (!empty($productdata['meta_description'])) {{ $productdata['meta_description'] }} @else {{ old('meta_description') }} @endif
                                                    </textarea>
                                                </div>
                                                <div class="form-group mt-3">
                                                    <label for="meta_keywords">Meta Keywords</label>
                                                    <textarea name="meta_keywords" id="meta_keywords"
                                                        class="ckeditor form-control" rows="3"
                                                        placeholder="Enter product Meta Keywords">@if (!empty($productdata['meta_keywords'])) {{ $productdata['meta_keywords'] }} @else {{ old('meta_keywords') }} @endif
                                                    </textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="product_color"><b>Product Color</b></label>
                                                    <input class="form-control" id="product_color" name="product_color"
                                                        placeholder="Enter Product Color" @if(!empty($productdata['product_color'])) {
                                                        value="{{ $productdata['product_color'] }}" } @else {
                                                        value="{{ old('product_color') }}" } @endif>
                                                </div>
                                                <div class="mt-3">
                                                    <label><b>Product Image : </b></label>
                                                    <input class="form-control" placeholder="" type="file"
                                                        aria-label="file example" name="main_image"
                                                        @if(isset($categorydata['category_image'])) value="" @else
                                                        value="" @endif>
                                                    @if (!empty($categorydata['category_image']))
                                                    <p>Current Image : {{ $categorydata['category_image'] }}</p>
                                                    @endif
                                                    @if (!empty($productdata['main_image']))
                                                    <button type="button" class="btn btn-primary ml-2"
                                                        data-bs-toggle="modal" data-bs-target="#exampleModalCenterMain">
                                                        View Main Image
                                                    </button>
                                                    @endif
                                                </div>
                                                <div class="mt-3">
                                                    <label><b>Product Video : </b></label>
                                                    <input class="form-control" placeholder="" type="file"
                                                        aria-label="file example" name="product_video"
                                                        @if(isset($productdata['product_video'])) value="" @else
                                                        value="" @endif>
                                                    @if (!empty($productdata['product_video']))
                                                    @endif
                                                    @if (!empty($productdata['product_video']))
                                                    <button type="button" class="btn btn-primary ml-2"
                                                        data-bs-toggle="modal" data-bs-target="#exampleModalCenterVideo">
                                                        View Product Video
                                                    </button>
                                                    @endif
                                                </div>
                                                <div class="form-group mt-2">
                                                    <label for="product_discount"><b>Product Discount (%)</b></label>
                                                    <input class="form-control" id="product_discount"
                                                        name="product_discount" placeholder="Enter product Color" @if(!empty($productdata['product_discount'])) {
                                                        value="{{ $productdata['product_discount'] }}" } @else {
                                                        value="{{ old('product_discount') }}" } @endif>
                                                </div>
                                                <div class="form-group mt-3">
                                                    <label><b>Material</b></label>
                                                    <input class="form-control" id="material" name="product_material"
                                                        placeholder="Enter product Color" @if(!empty($productdata['material'])) {
                                                        value="{{ $productdata['material'] }}" } @else {
                                                        value="{{ old('material') }}" } @endif>
                                                </div>
                                                <div class="form-group mt-3">
                                                    <label><b>Group Code</b></label>
                                                    <input class="form-control" id="group_code" name="group_code"
                                                        placeholder="Enter product Group Code" @if(!empty($productdata['group_code'])) {
                                                        value="{{ $productdata['group_code'] }}" } @else {
                                                        value="{{ old('group_code') }}" } @endif>
                                                </div>
                                                <div class="form-group mt-3">
                                                    <label for="meta_title">Meta Title</label>
                                                    <textarea name="meta_title" id="meta_title"
                                                        class="ckeditor form-control" rows="3"
                                                        placeholder="Enter product Meta Title">@if (!empty($productdata['meta_title'])) {{ $productdata['meta_title'] }} @else {{ old('meta_title') }} @endif
                                                        </textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label for="product_description">Product Description</label>
                                                    <textarea name="description" id="description"
                                                    class="ckeditor form-control" rows="3" placeholder="">
                                                        @if (!empty($productdata['description']))
                                                            {{ $productdata['description'] }}
                                                        @else
                                                            {{ old('description')}}
                                                        @endif
                                                        </textarea>
                                                </div>
                                            </div>
                                            <div class="form-group mt-3 form-inline">
                                                <label class="col-form-label m-r-10"><b>Is Featured ? : </b></label>
                                                <label class="switch">
                                                <input name="is_featured" type="checkbox"
                                                    @if(!empty($productdata['is_featured']) &&
                                                    $productdata['is_featured']=="Yes" ) checked @endif value="Yes"><span
                                                    class="switch-state"></span>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <div class="text-end mt-5"><button type="submit"
                                                        class="btn btn-success">{{ $title }}</button>
                                                </div>
                                            </div>
                                        </div>

                                        @if (!empty($productdata['main_image']))
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
                                                            src="{{ asset('images/admin_images/product_images/large/' . $productdata['main_image']) }}">
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button class="btn btn-secondary" type="button"
                                                            data-bs-dismiss="modal">Close</button>
                                                            <a href="javascript:void(0)" record="product-image"
                                                            recordid="{{ $productdata['id'] }}"
                                                            class="confirmDelete btn btn-danger">Delete Image</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endif

                                        @if (!empty($productdata['product_video']))
                                        <div class="modal fade" id="exampleModalCenterVideo" tabindex="-1" role="dialog"
                                            aria-labelledby="exampleModalCenterMain" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Video Product</h5>
                                                        <button class="btn-close" type="button" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="embed-responsive embed-responsive-16by9 w-100">
                                                            <video controls style="width: 100%" src="{{ asset('videos/products_videos/' . $productdata['product_video'])}}"  />
                                                          </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button class="btn btn-secondary" type="button"
                                                            data-bs-dismiss="modal">Close</button>
                                                            <a href="javascript:void(0)" record="product-video"
                                                            recordid="{{ $productdata['id'] }}"
                                                            class="confirmDelete btn btn-danger">Delete Videos</a>
                                                        <a href="{{ url('videos/products_videos/' . $productdata['product_video']) }}" download=""
                                                        class="btn btn-success">Download</a>
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
