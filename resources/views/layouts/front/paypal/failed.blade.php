@extends('layouts.front_layouts.front_layout')
@section('thanks')
 <!-- Thank You area start -->
 <div class="thank-you-area">
    <div class="container">
        <div class="row justify-content-center align-items-center">
            <div class="col-md-8">
                <div class="inner_complated">
                    <div class="img_cmpted"><img src="{{('front_assets/images/icons/failed.jpg')}}" alt=""></div>
                    <h3>Pesanan anda mengalami kegagalan dalam transaksi</h3>
                    <p class="dsc_cmpted">Harap dicoba lagi dalam beberapa menit kedepan, dan hubungi kontak yang tertera dibawah.</p>
                </div>
                <div class="main_quickorder text-align-center">
                    <h3 class="title">Hubungi kami jika ada kendala</h3>
                    <div class="cntct typewriter-effect"><span class="call_desk"><a href="tel:+6282110984618" id="typewriter_num">0821 1098 4618</a></span></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
