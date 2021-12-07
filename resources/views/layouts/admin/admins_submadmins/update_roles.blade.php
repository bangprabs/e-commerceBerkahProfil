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
                        <li class="breadcrumb-item">Admin Sub-Admin</li>
                        <li class="breadcrumb-item active">{{$title}} </li>
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
                                    <form name="adminForm" id="adminForm" method="post" action={{url('admin/update-role/'.$adminDetails['id'])}}>@csrf
                                        <div class="row">
                                            <div class="col-md-6">
                                                @if (!empty($adminRoles))
                                                    @foreach ($adminRoles as $role)
                                                        @if ($role['module'] == "categories")
                                                            @if ($role['view_access'] == 1)
                                                                @php $viewCategories = "checked"; @endphp
                                                            @else
                                                                @php $viewCategories = ""; @endphp
                                                            @endif
                                                            @if ($role['edit_access'] == 1)
                                                                @php $editCategories = "checked"; @endphp
                                                            @else
                                                                @php $editCategories = ""; @endphp
                                                            @endif
                                                            @if ($role['full_access'] == 1)
                                                                @php $fullCategories = "checked"; @endphp
                                                            @else
                                                                @php $fullCategories = ""; @endphp
                                                            @endif
                                                        @endif
                                                    @endforeach
                                                @endif
                                                <div class="form-group mt-3">
                                                    <label><b>Data Kategori : </b></label>
                                                    <div class="col-md-9">
                                                        <input type="checkbox" name="categories[view]"  value="1" @if(isset($viewCategories)) {{$viewCategories}} @endif>&nbsp;Lihat Saja &nbsp; &nbsp;
                                                        <input type="checkbox" name="categories[edit]"  value="1" @if(isset($editCategories)) {{$editCategories}} @endif>&nbsp;Lihat Saja / Dapat Edit &nbsp; &nbsp;
                                                        <input type="checkbox" name="categories[full]"  value="1" @if(isset($fullCategories)) {{$fullCategories}} @endif>&nbsp;Full Akses &nbsp; &nbsp;
                                                    </div>
                                                </div>
                                                @if (!empty($adminRoles))
                                                    @foreach ($adminRoles as $role)
                                                        @if ($role['module'] == "products")
                                                            @if ($role['view_access'] == 1)
                                                                @php $viewProducts = "checked"; @endphp
                                                            @else
                                                                @php $viewProducts = ""; @endphp
                                                            @endif
                                                            @if ($role['edit_access'] == 1)
                                                                @php $editProducts = "checked"; @endphp
                                                            @else
                                                                @php $editProducts = ""; @endphp
                                                            @endif
                                                            @if ($role['full_access'] == 1)
                                                                @php $fullProducts = "checked"; @endphp
                                                            @else
                                                                @php $fullProducts = ""; @endphp
                                                            @endif
                                                        @endif
                                                    @endforeach
                                                @endif
                                                <div class="form-group mt-3">
                                                    <label><b>Data Barang/Produk : </b></label>
                                                    <div class="col-md-9">
                                                        <input type="checkbox" name="products[view]" value="1" @if(isset($viewProducts)) {{$viewProducts}} @endif>&nbsp;Lihat Saja &nbsp; &nbsp;
                                                        <input type="checkbox" name="products[edit]" value="1" @if(isset($editProducts)) {{$editProducts}} @endif>&nbsp;Lihat Saja / Dapat Edit &nbsp; &nbsp;
                                                        <input type="checkbox" name="products[full]" value="1" @if(isset($fullProducts)) {{$fullProducts}} @endif>&nbsp;Full Akses &nbsp; &nbsp;
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                @if (!empty($adminRoles))
                                                    @foreach ($adminRoles as $role)
                                                        @if ($role['module'] == "coupon")
                                                            @if ($role['view_access'] == 1)
                                                                @php $viewCoupon = "checked"; @endphp
                                                            @else
                                                                @php $viewCoupon = ""; @endphp
                                                            @endif
                                                            @if ($role['edit_access'] == 1)
                                                                @php $editCoupon = "checked"; @endphp
                                                            @else
                                                                @php $editCoupon = ""; @endphp
                                                            @endif
                                                            @if ($role['full_access'] == 1)
                                                                @php $fullCoupon = "checked"; @endphp
                                                            @else
                                                                @php $fullCoupon = ""; @endphp
                                                            @endif
                                                        @endif
                                                    @endforeach
                                                @endif
                                                <div class="form-group mt-3">
                                                    <label><b>Data Kupon/Voucher : </b></label>
                                                    <div class="col-md-9">
                                                        <input type="checkbox" name="coupon[view]" value="1" @if(isset($viewCoupon)) {{$viewCoupon}} @endif>&nbsp;Lihat Saja &nbsp; &nbsp;
                                                        <input type="checkbox" name="coupon[edit]" value="1" @if(isset($editCoupon)) {{$editCoupon}} @endif>&nbsp;Lihat Saja / Dapat Edit &nbsp; &nbsp;
                                                        <input type="checkbox" name="coupon[full]" value="1" @if(isset($fullCoupon)) {{$fullCoupon}} @endif>&nbsp;Full Akses &nbsp; &nbsp;
                                                    </div>
                                                </div>
                                                @if (!empty($adminRoles))
                                                    @foreach ($adminRoles as $role)
                                                        @if ($role['module'] == "order")
                                                            @if ($role['view_access'] == 1)
                                                                @php $viewOrder = "checked"; @endphp
                                                            @else
                                                                @php $viewOrder = ""; @endphp
                                                            @endif
                                                            @if ($role['edit_access'] == 1)
                                                                @php $editOrder = "checked"; @endphp
                                                            @else
                                                                @php $editOrder = ""; @endphp
                                                            @endif
                                                            @if ($role['full_access'] == 1)
                                                                @php $fullOrder = "checked"; @endphp
                                                            @else
                                                                @php $fullOrder = ""; @endphp
                                                            @endif
                                                        @endif
                                                    @endforeach
                                                @endif
                                                <div class="form-group mt-3">
                                                    <label><b>Data Order Pelanggan : </b></label>
                                                    <div class="col-md-9">
                                                        <input type="checkbox" name="order[view]" value="1" @if(isset($viewOrder)) {{$viewOrder}} @endif>&nbsp;Lihat Saja &nbsp; &nbsp;
                                                        <input type="checkbox" name="order[edit]" value="1" @if(isset($editOrder)) {{$editOrder}} @endif>&nbsp;Lihat Saja / Dapat Edit &nbsp; &nbsp;
                                                        <input type="checkbox" name="order[full]" value="1" @if(isset($fullOrder)) {{$fullOrder}} @endif>&nbsp;Full Akses &nbsp; &nbsp;
                                                    </div>
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
