@extends('layouts.front_layouts.front_layout')
@section('wishlist')
 <!-- Cart Area Start -->
 <div class="cart-main-area pb-100px">
    <div class="container">
        <h3 class="cart-page-title" style="margin-left: -14px;">Wishlist</h3>

        @if (Session::has('error_message'))
        <div class="mr-3 ml-3" style="margin-bottom: -10px">
            <div class="mt-4 alert alert-danger alert-dismissible fade show" role="alert">
                {{ Session::get('error_message')}}
            </div>
        </div>
        @php
            Session::forget('error_message');
        @endphp
        @endif

        <div class="AjaxWishlistItem">
            @include('layouts.front.products.wishlist_item')
        </div>
    </div>
</div>
<!-- Cart Area End -->
@endsection
