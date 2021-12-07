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
                            <div class="card-header bg-success">
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
                                @if (Session::has('success_message_edit_attr'))
                                <div class="alert alert-success dark alert-dismissible fade show" role="alert">
                                    {{ Session::get('success_message_edit_attr')}}
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
                                    <form enctype="multipart/form-data" name="addImageForm" id="addImageForm" method="post"
                                    action="{{ url('admin/add-images/'.$productdata['id']) }}">@csrf
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="product_name"><b>Product Name</b></label>
                                                    <input class="form-control" id="product_name" name="product_name" readonly
                                                        placeholder="Enter product Name" @if(!empty($productdata['product_name'])) {
                                                        value="{{ $productdata['product_name'] }}" } @else {
                                                        value="{{ old('product_name') }}" } @endif>
                                                </div>
                                                <div class="form-group mt-3">
                                                    <label for="product_code"><b>Product Code</b></label>
                                                    <input class="form-control" id="product_code" name="product_code" readonly
                                                        placeholder="Enter Product Code" @if(!empty($productdata['product_code'])) {
                                                        value="{{ $productdata['product_code'] }}" } @else {
                                                        value="{{ old('product_code') }}" } @endif>
                                                </div>
                                                <div class="mt-3">
                                                    <label><b>Add Product Image : </b></label>
                                                    <input class="form-control" placeholder="" type="file" id="image" name="image[]"
                                                    aria-label="file example">
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group mt-3">
                                                    <label for="product_color"><b>Product Color</b></label>
                                                    <input class="form-control" id="product_color" name="product_color" readonly
                                                        placeholder="Enter Product Color" @if(!empty($productdata['product_color'])) {
                                                        value="{{ $productdata['product_color'] }}" } @else {
                                                        value="{{ old('product_color') }}" } @endif>
                                                </div>
                                                <div class="mt-3">
                                                    <label><b>Product Main Image : </b></label>
                                                    <img class="img-thumbnail rounded mx-auto d-block"
                                                            src="{{ asset('images/admin_images/product_images/large/' . $productdata['main_image']) }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <div class="text-end mt-5"><button type="submit"
                                                        class="btn btn-success">Add Attributes</button>
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
    </div>

    <div class="container-fluid" style="margin-top: -60px;">
        <div class="page-title">
            <div class="row">
                <div class="container">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-header bg-primary">
                                <h5 style="margin-top: 10px">Added Images Attributes</h5>
                            </div>

                            <div class="card-body">
                                @if (Session::has('error_message'))
                            <div class="alert alert-danger dark alert-dismissible fade show" role="alert">
                                {{ Session::get('error_message')}}
                                <button class="btn-close" type="button" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                            @endif
                            @if (Session::has('success_message_edit_attr'))
                            <div class="p-3 alert alert-success dark alert-dismissible fade show" role="alert">
                                {{ Session::get('success_message_edit_attr')}}
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
                                <div class="table-responsive table-bordered">
                                    <table class="display" id="blog">
                                        <thead>
                                            <tr>
                                                <th>Num. </th>
                                                <th>Images Name</th>
                                                <th>Images</th>
                                                <th>Status</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php $no = 1;?>
                                            @foreach ($productdata['images'] as $image)
                                            <input style="display: none" type="text" name="attrId[]"
                                                value="{{$image['id']}}">
                                            <tr>
                                                <td>{{ $no }}</td>
                                                <td>{{$image['image']}}</td>
                                                <td>
                                                    <?php $product_image_path = "images/admin_images/product_images/small/" . $image['image']; ?>
                                                    @if (!empty($image['image'] && file_exists($product_image_path)))
                                                        <img class="w-25 img-thumbnail rounded mx-auto d-block" src="{{ asset('images/admin_images/product_images/small/' . $image['image']) }}" alt="">
                                                    @else
                                                        <img class="w-25 img-thumbnail rounded mx-auto d-block" src="{{ asset('images/admin_images/product_images/small/no-image.png') }}" alt="">
                                                    @endif
                                                </td>
                                                <td style="width: 12%; text-align: center">
                                                    @if ($image['status'] == 1)
                                                    <a class="updateImageStatus btn btn-primary"
                                                        id="image-{{$image['id']}}"
                                                        image_id="{{$image['id']}}"
                                                        href="javascript:void(0)">Active</a>
                                                    @else
                                                    <a class="updateImageStatus btn btn-danger"
                                                        id="image-{{$image['id']}}"
                                                        image_id="{{$image['id']}}"
                                                        href="javascript:void(0)">Inactive</a>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a title="Delete Image" href="javascript:void(0)" record="image"
                                                        recordid="{{ $image['id'] }}"
                                                        class="confirmDelete btn btn-danger w-100"><i
                                                            class="fa fa-trash"></i></a>
                                                </td>
                                            </tr>
                                            <?php $no++?>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Num. </th>
                                                <th>Images Name</th>
                                                <th>Images</th>
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
