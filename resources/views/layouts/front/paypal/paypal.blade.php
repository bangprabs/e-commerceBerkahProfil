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
                    <p class="dsc_cmpted">Nomor orderan anda adalah {{Session::get('order_id')}}, dan Total Keseluruhan @currency(Session::get('grand_total'))</p>
                    <h3>Harap lakukan pembayaran dengan menekan tombol pembayaran Dibawah Ini.</h3>
                    <form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">
                        <input type="hidden" name="cmd" value="_xclick">
                        <input type="hidden" name="business" value="sb-tzeo67450911@business.example.com">
                        <input type="hidden" name="currency_code" value="USD">
                        <input type="hidden" name="item_name" value="{{Session::get('order_id')}}">
                        <input type="hidden" name="amount" value="{{round(Session::get('grand_total'), 2)}}">
                        <input type="hidden" name="first_name" value="{{$nameArr[0]}}">
                        <input type="hidden" name="last_name" value="{{$nameArr[1]}}">
                        <input type="hidden" name="address1" value="{{$orderDetails['address']}}">
                        <input type="hidden" name="address2" value="">
                        <input type="hidden" name="city" value="{{$orderDetails['city']}}">
                        <input type="hidden" name="state" value="{{$orderDetails['state']}}">
                        <input type="hidden" name="zip" value="{{$orderDetails['pincode']}}">
                        <input type="hidden" name="email" value="{{$orderDetails['email']}}">
                        <input type="hidden" name="country" value="{{$orderDetails['country']}}">
                        <input type="hidden" name="return" value="{{ url('paypal/success') }}">
                        <input type="hidden" name="cancel_return" value="{{url('paypal/fail')}}">
                        <input type="hidden" name="notify_url" value="{{url('paypal/ipn')}}">
                        <input style="width: 30%;" type="image" name="submit"
                          src="https://www.paypalobjects.com/en_US/i/btn/btn_buynow_LG.gif"
                          alt="PayPal - The safer, easier way to pay online">
                      </form>
                    <div class="btn_cmpted">
                        <a href="{{ url('/') }}" class="shop-btn" title="Go To Shop">Continue Shopping </a>
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
