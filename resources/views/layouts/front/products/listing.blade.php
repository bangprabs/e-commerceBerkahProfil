@extends('layouts.front_layouts.front_layout')
@section('content')

<div class="product-area">

    <div class="shop-top-bar d-flex">
        <!-- Left Side End -->
        <div class="shop-tab nav">
            <button class="active" data-bs-target="#shop-grid" data-bs-toggle="tab">
                <i class="fa fa-th" aria-hidden="true"></i>
            </button>
            <button data-bs-target="#shop-list" data-bs-toggle="tab">
                <i class="fa fa-list" aria-hidden="true"></i>
            </button>
        </div>
        <!-- Right Side Start -->
        @if (!isset($_REQUEST['search']))
        <div class="select-shoing-wrap d-flex align-items-center">
            <div class="shot-product">
                <p style="font-size: 15px; margin-left: -10px;">Sort By:</p>
            </div>
            <!-- Single Wedge End -->
            <div class="header-bottom-set dropdown">
                <form name="sortProducts" id="sortProducts" class="form-horizontal span6">
                    <input type="hidden" id="url" name="url" value="{{$url}}">
                    <div class="control-group">
                        <select name="sort" id="sort" style="border-color: #fff transparent transparent transparent;">
                            <option value="">Select</option>
                            <option value="product_latest" @if (isset($_GET['sort']) && $_GET['sort'] =="product_latest") selected="" @endif>Latest Products</option>
                            <option value="product_name_a_z" @if (isset($_GET['sort']) && $_GET['sort'] =="product_name_a_z") selected="" @endif>Product name A - Z</option>
                            <option value="product_name_z_a" @if (isset($_GET['sort']) && $_GET['sort'] =="product_name_z_a") selected="" @endif>Product name Z - A</option>
                            <option value="price_lowest" @if (isset($_GET['sort']) && $_GET['sort'] =="price_lowest") selected="" @endif>Lowest Price First</option>
                            <option value="price_highest" @if (isset($_GET['sort']) && $_GET['sort'] =="price_highest") selected="" @endif>Highest Price First</option>
                        </select>
                    </div>
                </form>
            </div>
            <!-- Single Wedge Start -->
        </div>
        @endif
        <!-- Right Side End -->
    </div>
    <!-- Shop Top Area End -->
    <!-- Shop Bottom Area Start -->
    <div class="shop-bottom-area filter_products">
        <!-- Tab Content Area Start -->
        @include('layouts.front.products.ajax_products_listing')
        <!-- Tab Content Area End -->
    </div>
    @if (!isset($_REQUEST['search']))
        <div class="pro-pagination-style text-center text-lg-end float-right" style="margin-top: 100px; float: right"  data-aos="fade-up" data-aos-delay="200">
            <div class="pages">
                @if (isset($_GET['sort']) && !empty($_GET['sort']))
                {{ $categoryProducts->appends(['sort' => $_GET['sort']])->links() }}
                @else
                {{ $categoryProducts->links() }}
                @endif
            </div>
        </div>
    @endif
</div>

@endsection
