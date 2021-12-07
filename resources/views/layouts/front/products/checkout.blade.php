@extends('layouts.front_layouts.front_layout')
@section('checkout')
<?php use App\Models\Product; ?>

<style>
    :root {
    --card-line-height: 1.2em;
    --card-padding: 1em;
    --card-radius: 0.5em;
    --color-green: #346cf9;
    --color-gray: #e2ebf6;
    --color-dark-gray: #c4d1e1;
    --radio-border-width: 2px;
    --radio-size: 1.5em;
    }

    .grid {
    display: grid;
    grid-gap: var(--card-padding);
    margin: 0 auto;
    max-width: 60em;
    padding: 0;
    }
    @media (min-width: 42em) {
    .grid {
        grid-template-columns: repeat(3, 1fr);
    }
    }

    .card {
    background-color: #fff;
    border-radius: 10px;
    position: relative;
    margin-top: 20px;
    }
    .card:hover {
    box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.15);
    }

    .radio {
    font-size: inherit;
    margin: 0;
    position: absolute;
    right: calc(var(--card-padding) + var(--radio-border-width));
    top: calc(var(--card-padding) + var(--radio-border-width));
    }

    @supports (-webkit-appearance: none) or (-moz-appearance: none) {
    .radio {
        -webkit-appearance: none;
        -moz-appearance: none;
        background: #fff;
        border: var(--radio-border-width) solid var(--color-gray);
        border-radius: 50%;
        padding: 0px;
        cursor: pointer;
        height: var(--radio-size);
        outline: none;
        transition: background 0.2s ease-out, border-color 0.2s ease-out;
        width: var(--radio-size);
    }
    .radio::after {
        border: var(--radio-border-width) solid #fff;
        border-top: 0;
        border-left: 0;
        content: "";
        display: block;
        height: 0.75rem;
        left: 25%;
        position: absolute;
        top: 50%;
        transform: rotate(45deg) translate(-50%, -50%);
        width: 0.375rem;
    }
    .radio:checked {
        background: var(--color-green);
        border-color: var(--color-green);
    }

    .card:hover .radio {
        border-color: var(--color-dark-gray);
    }
    .card:hover .radio:checked {
        border-color: var(--color-green);
    }
    }
    .plan-details {
    border: var(--radio-border-width) solid var(--color-gray);
    border-top-left-radius: var(--card-radius);
    border-top-right-radius: var(--card-radius);
    cursor: pointer;
    display: flex;
    flex-direction: column;
    padding: var(--card-padding);
    transition: border-color 0.2s ease-out;
    }

    .card:hover .plan-details {
    border-color: var(--color-dark-gray);
    }

    .radio:checked ~ .plan-details {
    border-color: var(--color-green);
    }

    .radio:focus ~ .plan-details {
    box-shadow: 0 0 0 2px var(--color-dark-gray);
    }

    .radio:disabled ~ .plan-details {
    color: var(--color-dark-gray);
    cursor: default;
    }

    .radio:disabled ~ .plan-details .plan-type {
    color: var(--color-dark-gray);
    }

    .card:hover .radio:disabled ~ .plan-details {
    border-color: var(--color-gray);
    box-shadow: none;
    }

    .card:hover .radio:disabled {
    border-color: var(--color-gray);
    }

    .plan-type {
    color: var(--color-green);
    font-size: 1.5rem;
    font-weight: bold;
    line-height: 1em;
    }

    .plan-cost {
    font-size: 2.5rem;
    font-weight: bold;
    padding: 0.5rem 0;
    }

    .slash {
    font-weight: normal;
    }

    .plan-cycle {
    font-size: 2rem;
    font-variant: none;
    border-bottom: none;
    cursor: inherit;
    text-decoration: none;
    }

    .hidden-visually {
    border: 0;
    clip: rect(0, 0, 0, 0);
    height: 1px;
    margin: -1px;
    overflow: hidden;
    padding: 0;
    position: absolute;
    white-space: nowrap;
    width: 1px;
    }

    .selectt {
            color: #fff;
            padding: 30px;
            display: none;
            margin-top: 30px;
            width: 60%;
            background: green
        }
</style>

<!-- checkout area start -->
<div class="checkout-area" style="margin-bottom: 70px;">
    <div class="container">
        @if (Session::has('error_message'))
        <div class="mr-3 ml-3 mb-5" style="margin-bottom: -10px">
            <div class="mt-4 alert alert-danger mb-5" role="alert">
                {{ Session::get('error_message')}}
            </div>
        </div>
        @endif

        @if (Session::has('success_message'))
        <div class="mr-3 ml-3 mb-5" style="margin-bottom: -10px">
            <div class="mt-4 alert alert-success mb-5" role="alert">
                {{ Session::get('success_message')}}
            </div>
        </div>
        @endif

        <form action="" name="checkoutForm" id="checkoutForm" action="{{ url('/checkout') }}" method="post">@csrf
            <div class="row mt-3">
                <div class="col-lg-6">
                    <div class="billing-info-wrap">
                        <h3>Alamat Pengiriman</h3>
                        @foreach ($deliveryAddresses as $address)
                        <label class="card">
                        <input class="radio" id="address{{ $address['id'] }}" name="address_id" value="{{ $address['id'] }}" type="radio" shipping_charges="{{ $address['shipping_charges'] }}" total_price="{{ $total_price }}" coupon_amount="{{Session::get('couponAmount')}}" codpincodeCount="{{ $address['codpincodeCount'] }}">
                        <span class="hidden-visually"></span>
                        <span class="plan-details" aria-hidden="true">
                            <span class="plan-type mb-3">{{$address['subject']}}</span>
                            <span><b>Penerima</b> : {{$address['name']}}</span>
                            <span><b>Nomor Telepon</b> : {{$address['mobile']}}</span>
                            <span><b>Alamat</b> : {{$address['address']}}, {{$address['city']}}, {{$address['state']}}, {{$address['country']}}</span>
                            <span><b>Ongkos Kirim</b> : {{ $address['shipping_charges'] }}</span>
                        </span>
                        <div class="your-order-area" style="padding: 0; ">
                            <div class="Place-order" style="margin-top: 0px !important;">
                                <div class="row" style="margin: 0px !important; padding: 0px !important;">
                                    <div class="col-md-6" style="margin: 0px !important; padding: 0px !important;">
                                        <a class="btn-hover w-100" style="border-bottom-left-radius: 10px;" href="{{url('/add-edit-delivery-address/'.$address['id'])}}">Edit Alamat</a>
                                    </div>
                                    <div class="col-md-6" style="margin: 0px !important; padding: 0px !important;">
                                        <a class="btn-hover addressDelete w-100" style="border-bottom-right-radius: 10px; background-color: rgb(170, 22, 22);" href="{{url('/delete-delivery-address/'.$address['id'])}}">Hapus Alamat</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </label>
                        @endforeach
                    </div>
                    <div class="your-order-area" style="padding: 0; ">
                        <div class="Place-order mt-25">
                            <a class="btn-hover" href="{{ url('/add-edit-delivery-address') }}">Tambah Alamat</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 mt-md-30px mt-lm-30px ">
                    <div class="your-order-area">
                        <h3>Pesanan Anda</h3>
                        <div class="your-order-wrap gray-bg-4">
                            <div class="your-order-product-info">
                                <div class="your-order-top">
                                    <ul>
                                        <li>Produk</li>
                                        <li>Total</li>
                                    </ul>
                                </div>
                                <div class="your-order-middle">
                                    <?php $total_price = 0; ?>
                                    @foreach ($userCartItems as $item)
                                    <?php $attrPrice = Product::getDiscountedAttrPrice($item['product_id'], $item['size']); ?>
                                    <ul>
                                        <li><span class="order-middle-left">{{ $item['product']['product_name'] }} x
                                                ({{$item['quantity']}})</span> <span
                                                class="order-price">@currency($attrPrice['final_price'] * $item['quantity'])
                                            </span></li>
                                    </ul>
                                    <?php $total_price = $total_price + ($attrPrice['final_price'] * $item['quantity']) ?>
                                    @endforeach
                                </div>
                                <div class="your-order-total">
                                    <ul>
                                        <li class="order-total">Total</li>
                                        <li class="grand_total">@currency( $grand_total =  $total_price - Session::get('couponAmount'))</li>
                                        <?php Session::put('grand_total', $grand_total); ?>
                                    </ul>
                                </div>
                            </div>
                            <div class="payment-method">
                                <div class="payment-accordion element-mrg">
                                    <div id="faq" class="panel-group">
                                        <div class="transfer_bank panel panel-default single-my-account m-0">
                                            <label for=""><b style="font-size: 20px; float: right !important;">Metode Pembayaran</b></label>
                                            <hr style="margin-top: -10px;">
                                            <div class="panel-heading my-account-title">
                                                <h4 class="panel-title"><a data-bs-toggle="collapse" href="#my-account-1"
                                                        class="collapsed" aria-expanded="true">Transfer Bank</a>
                                                </h4>
                                            </div>
                                            <div id="my-account-1" class="panel-collapse collapse show"
                                                data-bs-parent="#faq">
                                                <div class="panel-body">
                                                    <div class="row">
                                                        <div class="col-md-10">
                                                            <p>Transfer bank tersedia pada Bank BCA dan Bank Mandiri, upload bukti transfer pada halaman detail barang yang di order.</p>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <input type="radio" name="payment_gateway" id="transfer_bank" value="transfer_bank">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="cod_payment panel panel-default single-my-account m-0">
                                            <div class="panel-heading my-account-title">
                                                <h4 class="panel-title"><a data-bs-toggle="collapse"
                                                        href="#my-account-3">Cash on delivery (COD)</a></h4>
                                            </div>
                                            <div id="my-account-3" class="panel-collapse collapse" data-bs-parent="#faq">
                                                <div class="panel-body">
                                                    <div class="row">
                                                        <div class="col-md-10">
                                                            <p>Harap sediakan uang pas pada saat melakukan pembayaran dengan metode COD</p>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <input type="radio" name="payment_gateway" id="COD" value="COD">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="Place-order mt-25">
                            <button type="submit" class="btn-hover w-100" href="#">Selesaikan Pesanan</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- checkout area end -->

@endsection



























































{{-- <div class="panel panel-default single-my-account m-0">
    <div class="panel-heading my-account-title">
        <h4 class="panel-title"><a data-bs-toggle="collapse" href="#my-account-2"
                aria-expanded="false" class="collapsed">Paypal</a></h4>
    </div>
    <div id="my-account-2" class="panel-collapse collapse" data-bs-parent="#faq">
        <div class="panel-body">
            <div class="row">
                <div class="col-md-10">
                    <p>Please send a check to Store Name, Store Street, Store Town,
                        Store State / County, Store Postcode.</p>
                </div>
                <div class="col-md-2">
                    <input type="radio" name="payment_gateway" id="PayPal" value="paypal">
                </div>
            </div>
        </div>
    </div>
</div>
<div class="panel panel-default single-my-account m-0">
    <div class="panel-heading my-account-title">
        <h4 class="panel-title"><a data-bs-toggle="collapse" href="#payu"
                aria-expanded="false" class="collapsed">PayU Money</a></h4>
    </div>
    <div id="payu" class="panel-collapse collapse" data-bs-parent="#faq">
        <div class="panel-body">
            <div class="row">
                <div class="col-md-10">
                    <p>Please send a check to Store Name, Store Street, Store Town,
                        Store State / County, Store Postcode.</p>
                </div>
                <div class="col-md-2">
                    <input type="radio" name="payment_gateway" id="Payumoney" value="Payumoney">
                </div>
            </div>
        </div>
    </div>
</div> --}}
