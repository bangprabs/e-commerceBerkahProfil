@extends('layouts.front_layouts.front_layout')
@section('thanks')
 <!-- Thank You area start -->
 <div class="thank-you-area">
    <div class="container">
        <div class="row justify-content-center align-items-center">
            <div class="col-md-8">
                <div class="inner_complated">
                    <div class="img_cmpted"><img src="{{('front_assets/images/icons/cmpted_logo.png')}}" alt=""></div>
                    <h3>Terima kasih telah membeli produk di website kami, Pesanan anda berhasil ditempatkan</h3>
                    <h3>Harap check Email untuk melihat detail pembayaran nya.</h3>
                    <p class="dsc_cmpted">Nomor orderan anda adalah {{Session::get('order_id')}}, dan Total Keseluruhan @currency(Session::get('grand_total'))</p>
                    <div class="btn_cmpted">
                        <a href="{{ url('/') }}" class="shop-btn" title="Go To Shop">Cari Barang Lain </a>
                    </div>
                </div>
                <div class="main_quickorder text-align-center">
                    <h3 class="title">Hubungi kami jika ada kendala</h3>
                    <div class="cntct typewriter-effect"><span class="call_desk"><a href="tel:+6282110984618" id="typewriter_num">0821 1098 4618</a></span></div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Thank You area end -->
<?php
    Session::forget('grand_total');
    Session::forget('order_id');
    Session::forget('couponCode');
    Session::forget('couponAmount');
?>
@endsection
