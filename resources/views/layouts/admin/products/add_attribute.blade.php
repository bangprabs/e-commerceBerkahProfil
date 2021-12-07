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
                                    <form  enctype="multipart/form-data" name="addAttributeForm" id="addAttributeForm" method="post"
                                    action="{{ url('admin/add-attributes/'.$productdata['id']) }}">@csrf
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
                                                <div class="form-group mt-3">
                                                    <label for="product_price"><b>Product Price</b></label>
                                                    <input class="form-control" id="product_price" name="product_price" readonly
                                                        placeholder="Enter Product Price" @if(!empty($productdata['product_price'])) {
                                                        value="{{ $productdata['product_price'] }}" } @else {
                                                        value="{{ old('product_price') }}" } @endif>
                                                </div>
                                                <div class="input-group field_wrapper mt-3">
                                                    <label for="product_color"><b>Add Attributes</b></label>
                                                    <span>
                                                    <div class="row g-2 input-group-append">
                                                        <div class="col">
                                                            <input id="size" name="size[]" name="size[]" required placeholder="Size"
                                                            type="text" type="text" class="form-control mr-2 ">
                                                        </div>
                                                        <div class="col">
                                                          <input id="sku" name="sku[]" name="sku[]" required placeholder="SKU" type="text"
                                                          type="text" class="form-control mr-2 ">
                                                        </div>
                                                        <div class="col">
                                                            <input id="price" name="price[]" name="price[]" required placeholder="Price"
                                                            type="text" type="number" class="form-control mr-2 ">
                                                        </div>
                                                        <div class="col">
                                                            <input id="stock" name="stock[]" name="stock[]" required placeholder="Stock"
                                                            type="text" type="numer" class="form-control mr-2">
                                                        </div>
                                                            <button class="w-100 add_button btn btn-success rounded"><a href="javascript:void(0);" title="Add field"
                                                                ><i class="fa fa-plus"
                                                                    style="color: #fff"></i></a></button>
                                                    </span>
                                                    </div>
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
                                                    <label><b>Product Image : </b></label>
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

    <form action="{{ url('admin/edit-attributes/' . $productdata['id']) }}" method="post" name="editAttributeForm"
            id="editAttributeForm">@csrf
    <div class="container-fluid" style="margin-top: -60px;">
        <div class="page-title">
            <div class="row">
                <div class="container">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-header bg-primary">
                                <h5 style="margin-top: 10px">Added Product Attributes</h5>
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
                                                <th>Size</th>
                                                <th>SKU</th>
                                                <th>Price</th>
                                                <th>Stock</th>
                                                <th>Status</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $no = 1;?>
                                            @foreach ($productdata['attributes'] as $attribute)
                                            <input style="display: none" type="text" name="attrId[]"
                                                value="{{$attribute['id']}}">
                                            <tr>
                                                <td>{{ $no }}</td>
                                                <td> <input type="text" class="form-control" name="size[]"
                                                    value="{{$attribute['size']}}"</td>
                                                <td> <input type="text" class="form-control" name="sku[]"
                                                    value="{{$attribute['sku']}}"</td>
                                                <td>
                                                    <input type="number" class="form-control" name="price[]"
                                                        value="{{$attribute['price']}}" required>
                                                </td>
                                                <td>
                                                    <input type="number" class="form-control" name="stock[]"
                                                        value="{{$attribute['stock']}}" required>
                                                </td>
                                                <td style="width: 12%; text-align: center">
                                                    @if ($attribute['status'] == 1)
                                                    <a class="updateAttributesStatus btn btn-primary"
                                                        id="attribute-{{$attribute['id']}}"
                                                        attribute_id="{{$attribute['id']}}"
                                                        href="javascript:void(0)">Active</a>
                                                    @else
                                                    <a class="updateAttributesStatus btn btn-danger"
                                                        id="attribute-{{$attribute['id']}}"
                                                        attribute_id="{{$attribute['id']}}"
                                                        href="javascript:void(0)">Inactive</a>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a title="Delete Products" href="javascript:void(0)" record="attribute"
                                                        recordid="{{ $attribute['id'] }}"
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
                                                <th>Size</th>
                                                <th>SKU</th>
                                                <th>Price</th>
                                                <th>Stock</th>
                                                <th>Status</th>
                                                <th>Actions</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                                <div class="row">
                                    <div class="col float-left">
                                        <div class="text-end mt-5"><button type="submit"
                                                class="btn btn-success">Update Attributes</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </form>
</div>
@endsection
