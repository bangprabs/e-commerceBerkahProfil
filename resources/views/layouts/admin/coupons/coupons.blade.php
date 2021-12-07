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
                                <h5 style="margin-top: 10px">Daftar Kupon</h5>
                                <a href="{{ url('admin/add-edit-coupon')}}" class="btn btn-success" style="float: right; margin-top: -35px;">Tambah Kupon</a>
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
                                                <th>Kode</th>
                                                <th>Tipe Kupon</th>
                                                <th>Nilai</th>
                                                <th>Kadaluwarsa</th>
                                                <th>Status</th>
                                                <th>Aksi</th>
                                        </thead>
                                        <?php $no = 1;?>
                                        @foreach ($coupons as $coupon)
                                        <tr>
                                            <td>{{ $no }}</td>
                                            <td>
                                                {{$coupon['coupon_code']}}
                                            </td>
                                            <td>{{$coupon['coupon_type']}}</td>
                                            <td>
                                                @if ($coupon['amount_type'] == "Precentage")
                                                    {{$coupon['amount']}} %
                                                @else
                                                    @currency($coupon['amount'])
                                                @endif
                                            </td>
                                            <td>{{$coupon['expiry_date']}}</td>
                                            <td>
                                                @if ($couponModule['edit_access'] == 1 || $couponModule['full_access'] == 1)
                                                    @if ($coupon['status'] == 1)
                                                        <a class="updateCouponStatus btn btn-primary btn-block"
                                                            id="coupon-{{$coupon['id']}}" coupon_id="{{$coupon['id']}}"
                                                            href="javascript:void(0)">Active</a>
                                                    @else
                                                        <a class="updateCouponStatus btn btn-danger btn-block"
                                                            id="coupon-{{$coupon['id']}}" coupon_id="{{$coupon['id']}}"
                                                            href="javascript:void(0)">Inactive</a>
                                                    @endif
                                                @endif
                                            </td>
                                            <td style="text-align: center">
                                                @if ($couponModule['edit_access'] == 1 || $couponModule['full_access'] == 1)
                                                    <a title="Edit coupon" href="{{ url('admin/add-edit-coupon/'.$coupon['id'])}}" class="btn btn-success "><i class="fa fa-edit"></i></a>
                                                    @if ($couponModule['full_access'] == 1)
                                                        <a title="Delete coupon" href="javascript:void(0)" record="coupon" recordid="{{ $coupon['id'] }}" class="confirmDelete btn btn-danger ml-3"><i class="fa fa-trash"></i></a>
                                                    @endif
                                                @endif
                                            </td>
                                        </tr>
                                        <?php $no++?>
                                        @endforeach
                                        <tfoot>
                                            <tr>
                                                <th>No. </th>
                                                <th>Kode</th>
                                                <th>Tipe Kupon</th>
                                                <th>Nilai</th>
                                                <th>Kadaluwarsa</th>
                                                <th>Status</th>
                                                <th>Aksi</th>
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
