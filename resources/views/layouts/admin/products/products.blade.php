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
                            <div class="card-header bg-info">
                                <h5 style="margin-top: 10px">Daftar Produk</h5>
                                <a href="{{ url('admin/add-edit-product')}}" class="btn btn-success" style="float: right; margin-top: -35px;">Tambah Product</a>
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
                            <div class="p-3 alert alert-success dark alert-dismissible fade show" role="alert">
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

                            <div class="table w-100">
                                <table style="width:100%" class="table table-scrollable table-striped table-responsive table-bordered table-striped" id="userlist">
                                        <thead>
                                            <tr>
                                                <th>Num. </th>
                                                <th>Nama Produk</th>
                                                <th>Kode Produk</th>
                                                <th>Warna Produk</th>
                                                <th>Gambar Produk</th>
                                                <th>Kategori</th>
                                                <th>Status</th>
                                                <th>Aksi</th>
                                        </thead>
                                        <tbody>
                                            <?php $no = 1;?>
                                            @foreach ($products as $product)
                                            <tr>
                                                <td>{{ $no }}</td>
                                                <td>{{$product->product_name}}</td>
                                                <td>{{$product->product_code}}</td>
                                                <td>{{$product->product_color}}</td>
                                                <td style="width: 10%; text-align: center">
                                                    <?php $product_image_path = "images/admin_images/product_images/small/" . $product->main_image; ?>
                                                    @if (!empty($product->main_image && file_exists($product_image_path)))
                                                        <img class="w-75 img-thumbnail rounded mx-auto d-block" src="{{ asset('images/admin_images/product_images/small/' . $product->main_image) }}" alt="">
                                                    @else
                                                        <img class="w-75 img-thumbnail rounded mx-auto d-block" src="{{ asset('images/admin_images/product_images/small/no-image.png') }}" alt="">
                                                    @endif
                                                </td>
                                                <td>{{$product->category->category_name}}</td>
                                                <td class="align-middle">
                                                    @if ($productModule['edit_access'] == 1 || $productModule['full_access'] == 1)
                                                        @if ($product->status == 1)
                                                        <a class="updateProductsStatus btn btn-primary btn-block w-100" id="product-{{$product->id}}"
                                                        product_id="{{$product->id}}" href="javascript:void(0)">Active</a>
                                                        @else
                                                        <a class="updateProductsStatus btn btn-danger btn-block w-100"
                                                            id="product-{{$product->id}}" product_id="{{$product->id}}"
                                                            href="javascript:void(0)">Inactive</a>
                                                        @endif
                                                    @endif
                                                </td>
                                                <td style="width: 18%; text-align: center">
                                                    @if ($productModule['edit_access'] == 1 || $productModule['full_access'] == 1)
                                                        <a title="Edit Categories" href="{{ url('admin/add-edit-product/'.$product->id)}}" class="btn btn-success m-1"><i class="fa fa-edit"></i></a>
                                                        <a title="Add/Edit Attributes" href="{{ url('admin/add-attributes/'.$product->id)}}" class="btn btn-primary m-1"><i class="fa fa-plus-circle"></i></a>
                                                        <a title="Add Images" href="{{ url('admin/add-images/'.$product->id)}}" class="btn btn-warning m-1"><i class="fa fa-image "></i></a>
                                                        @if ($productModule['full_access'] == 1)
                                                            <a title="Delete Categories" href="javascript:void(0)" record="product" recordid="{{ $product->id }}" class="confirmDelete btn btn-danger m-1"><i class="fa fa-trash"></i></a>
                                                        @endif
                                                    @endif
                                                </td>
                                            </tr>
                                            <?php $no++?>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Num. </th>
                                                <th>Product Name</th>
                                                <th>Product Code</th>
                                                <th>Product Color</th>
                                                <th>Product Image</th>
                                                <th>Category</th>
                                                <th>Status</th>
                                                <th>Action</th>
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
