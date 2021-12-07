@extends('layouts.admin_layouts.admin_layout')
@section('content')
<!-- Zero Configuration  Starts-->
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
                        <li class="breadcrumb-item">Katalog</li>
                        <li class="breadcrumb-item active">Add Edit Kupon </li>
                    </ol>
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
                            <div class="card-header bg-danger">
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
                                    <form @if (empty($coupon['id'])) action="{{ url('admin/add-edit-coupon')}}" @else
                                    action="{{ url('admin/add-edit-coupon/'.$coupon['id'])}}" @endif name="couponForm" id="couponForm"
                                    method="post">@csrf
                                        <div class="row">
                                            <div class="col-md-6">
                                                @if (empty($coupon['coupon_code']))
                                                    <div class="form-group">
                                                        <label for="coupon_option"><b>Coupon Option : </b></label></br>
                                                        <span><input id="automaticCoupon" type="radio" name="coupon_option" id=""
                                                                value="Automatic" checked>&nbsp;Automatic</span>
                                                        &nbsp;&nbsp;
                                                        <span> <input id="manualCoupon" type="radio" name="coupon_option" id=""
                                                                value="Manual">&nbsp;Manual </span>
                                                    </div>
                                                    <div class="form-group mt-3" style="display: none" id="couponField">
                                                        <label for="coupon_code"><b>Coupon Code</b></label>
                                                        <input class="form-control" id="coupon_code" name="coupon_code"
                                                            placeholder="Enter Coupon Code">
                                                    </div>
                                                @else
                                                    <input type="hidden" name="coupon_option" value="{{ $coupon['coupon_option'] }}">
                                                    <input type="hidden" name="coupon_code" value="{{ $coupon['coupon_code'] }}">
                                                    <div class="form-group mt-3" id="couponField">
                                                        <label for="coupon_code"><b>Coupon Code : </b></label>
                                                        <span>{{$coupon['coupon_code']}}</span>
                                                    </div>
                                                @endif
                                                <div class="form-group mt-3">
                                                    <label><b>Expiry Date : </b></label>
                                                    <div class="mb-3">
                                                        <div class="input-group">
                                                            <input type="text" class="form-control" required
                                                                data-inputmask-alias="datetime"
                                                                data-inputmask-inputformat="yyyy/mm/dd" data-mask
                                                                id="datemask" value="{{ $coupon['expiry_date'] }}" name="expiry_date">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group mt-3">
                                                    <label for="coupon_option"><b>Select Users : </b></label><span
                                                        style="font-size: 15px; font-style: italic; margin-left: 10px">Select with
                                                        control key if multiple select</span></br>
                                                    <select data-placeholder="Select a Users" name="users[]" select
                                                        class="form-control select2" multiple="multiple">
                                                        @foreach ($users as $user)
                                                        <option @if (in_array($user['email'], $selUsers)) selected @endif
                                                            value="{{ $user['email'] }}">{{ $user['email'] }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                    <div class="input-group">
                                                    <label for="coupon_option"><b>Select Category : </b></label><span
                                                        style="font-size: 15px; font-style: italic; margin-left: 10px">Select with control key if multiple select</span></br>
                                                    <select data-placeholder="Select a Category" name="categories[]"
                                                        class="form-control js-example-placeholder-multiple" multiple size="10" required>
                                                        @foreach ($categories as $category)
                                                        <option style="font-weight: bold;" value="{{ $category['id'] }}" @if (in_array($category['id'], $selCats))
                                                            selected @endif>
                                                            &nbsp;&nbsp;&nbsp;--&nbsp;&nbsp; {{ $category['category_name'] }}
                                                        </option>
                                                        @foreach ($category['subcategories'] as $subcategory)
                                                        <option value="{{ $subcategory['id'] }}" @if (in_array($subcategory['id'],
                                                            $selCats)) selected @endif>
                                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;--&nbsp;
                                                            {{ $subcategory['category_name'] }}</option>
                                                        @endforeach
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group mt-3">
                                                    <label for="coupon_type"><b>Coupon Type</b></label><br>
                                                    <span><input type="radio" checked name="coupon_type"
                                                        @if (isset($coupon['coupon_type']) && $coupon['coupon_type'] == "Multiple Times")
                                                            checked
                                                            @elseif (!isset($coupon['coupon_type']))
                                                            checked
                                                        @endif
                                                            value="Multiple Times">&nbsp;Multiple Times</span>&nbsp;&nbsp;
                                                    <span><input type="radio" name="coupon_type"
                                                        @if (isset($coupon['coupon_type']) && $coupon['coupon_type'] == "Single Times")
                                                            checked
                                                            @elseif (!isset($coupon['coupon_type']))
                                                            checked
                                                        @endif
                                                        value="Single Times">&nbsp;Single
                                                        Times</span>
                                                </div>
                                                <div class="form-group mt-3">
                                                    <label for="amount_type"><b>Amount Type</b></label><br>
                                                    <span><input type="radio" checked name="amount_type"
                                                        @if (isset($coupon['amount_type']) && $coupon['amount_type'] == "Precentage")
                                                            checked
                                                        @endif
                                                            value="Precentage">&nbsp;Percentage (in %)</span>&nbsp;&nbsp;
                                                    <span><input type="radio" name="amount_type"
                                                        @if (isset($coupon['amount_type']) && $coupon['amount_type'] == "Fixed")
                                                        checked
                                                    @endif
                                                        value="Fixed">&nbsp;Fixed (in
                                                        Rupiah)</span>
                                                </div>
                                                <div class="form-group mt-3">
                                                    <label for="amount"><b>Amount</b></label>
                                                    <input class="form-control" type="number" id="amount" name="amount" value="{{ $coupon['amount'] }}"
                                                        placeholder="Enter Amount">
                                                </div>
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
