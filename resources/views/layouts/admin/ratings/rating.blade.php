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
                            <div class="card-header bg-primary">
                                <h5 style="margin-top: 10px">Daftar Ulasan</h5>
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
                                                <th>No. </th>
                                                <th>Nama Produk/Barang</th>
                                                <th>Email Pengguna</th>
                                                <th>Ulasan</th>
                                                <th>Rating</th>
                                                <th>Status</th>
                                        </thead>
                                        <?php $no = 1;?>
                                        @foreach ($ratings as $rating)
                                        <tr>
                                            <td>{{ $no }}</td>
                                            <td>{{$rating['product']['product_name']}}</td>
                                            <td>{{$rating['user']['email']}}</td>
                                            <td>{{$rating['review']}}</td>
                                            <td>{{$rating['rating']}}</td>
                                            <td>
                                                @if ($rating['status'] == 1)
                                                <a class="updateRatingStatus btn btn-primary btn-block"
                                                    id="rating-{{$rating['id']}}" rating_id="{{$rating['id']}}"
                                                    href="javascript:void(0)">Active</a>
                                                @else
                                                <a class="updateRatingStatus btn btn-danger btn-block"
                                                    id="rating-{{$rating['id']}}" rating_id="{{$rating['id']}}"
                                                    href="javascript:void(0)">Inactive</a>
                                                @endif
                                            </td>
                                        </tr>
                                        <?php $no++?>
                                        @endforeach
                                        <tfoot>
                                            <tr>
                                                <th>No. </th>
                                                <th>Nama Produk/Barang</th>
                                                <th>Email Pengguna</th>
                                                <th>Ulasan</th>
                                                <th>Rating</th>
                                                <th>Status</th>
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
