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
        border-radius: var(--card-radius);
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
        border-radius: var(--card-radius);
        cursor: pointer;
        display: flex;
        flex-direction: column;
        padding: var(--card-padding);
        transition: border-color 0.2s ease-out;
    }

    .card:hover .plan-details {
        border-color: var(--color-dark-gray);
    }

    .radio:checked~.plan-details {
        border-color: var(--color-green);
    }

    .radio:focus~.plan-details {
        box-shadow: 0 0 0 2px var(--color-dark-gray);
    }

    .radio:disabled~.plan-details {
        color: var(--color-dark-gray);
        cursor: default;
    }

    .radio:disabled~.plan-details .plan-type {
        color: var(--color-dark-gray);
    }

    .card:hover .radio:disabled~.plan-details {
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

</style>

<!-- checkout area start -->
<div class="checkout-area pb-40px">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="billing-info-wrap">
                    <h3>Delivery Address</h3>
                    @foreach ($deliveryAddresses as $address)
                    <label class="card">
                        <input class="radio" id="address{{ $address['id'] }}" name="address_id"
                            value="{{ $address['id'] }}" type="radio">
                        <span class="hidden-visually"></span>
                        <span class="plan-details" aria-hidden="true">
                            <span class="plan-type mb-3">{{$address['subject']}}</span>
                            <span><b>Receiver</b> : {{$address['name']}}</span>
                            <span><b>Phone Number</b> : {{$address['mobile']}}</span>
                            <span><b>Address</b> : {{$address['address']}}, {{$address['city']}}, {{$address['state']}},
                                {{$address['country']}}</span>
                            {{-- <div class="your-order-area" style="padding: 0; ">
                            <div class="Place-order mt-25">
                                <a class="btn-hover" href="#">Edit Address</a>
                            </div>
                        </div> --}}
                        </span>
                    </label>
                    @endforeach
                </div>
            </div>
            <div class="col-lg-6">
                <div class="">
                    <h3>{{$title}}</h3>
                    @if (Session::has('error_message'))
                    <div class="mr-3 ml-3 mb-5">
                        <div class="mt-4 alert alert-danger mb-5" role="alert">
                            {{ Session::get('error_message')}}
                        </div>
                    </div>
                    @endif

                    @if (Session::has('success_message'))
                    <div class="mr-3 ml-3 mb-5">
                        <div class="mt-4 alert alert-success mb-5" role="alert">
                            {{ Session::get('success_message')}}
                        </div>
                    </div>
                    @endif

                    @if ($errors->any())
                    <div class="alert alert-danger dark alert-dismissible fade show mb-5" role="alert">
                        @foreach ($errors->all() as $error)
                        {{ $error }} <br>
                        @endforeach
                    </div>
                    @endif
                    <div class="account_login_form">
                        <form @if(empty($addressData['id'])) action="{{ url('/add-edit-delivery-address/') }}" @else action="{{ url('/add-edit-delivery-address/'.$addressData['id']) }}" @endif name="deliveryAddressForm" id="productForm" method="post">@csrf
                            <label class="control-label" for="name">Subject Address</label>
                            <div class="default-form-box controls">
                                <input class="span3" type="text" id="subject" name="subject" placeholder="Enter Subject (House, Office, Apartement)" @if (!empty($addressData['subject'])) {
                                    value="{{ $addressData['subject'] }}" } @else {
                                    value="{{ old('subject') }}" } @endif>
                            </div>
                            <label class="control-label" for="name">Receiver Name</label>
                            <div class="default-form-box controls">
                                <input class="span3" type="text" id="name" name="name" placeholder="Enter Name" @if (!empty($addressData['name'])) {
                                    value="{{ $addressData['name'] }}" } @else {
                                    value="{{ old('name') }}" } @endif>
                            </div>
                            <label class="control-label" for="address">Address</label>
                            <div class="default-form-box controls">
                                <input class="span3" type="text" id="address" name="address" @if (!empty($addressData['address'])) {
                                    value="{{ $addressData['address'] }}" } @else {
                                    value="{{ old('address') }}" } @endif
                                    placeholder="Enter Address">
                            </div>
                            <label class="control-label" for="city">City</label>
                            <div class="default-form-box controls w-100">
                                <select class="default-form-box w-100" id="state" name="city">
                                    <option value="">Select Kota</option>
                                    @foreach ($city as $cities)
                                    <option value="{{$cities['city']}}"
                                    @if (!empty(@old('province')) &&
                                        $cities['city']==@old('city'))
                                    @elseif(!empty($addressData['city']) &&
                                        $addressData['city']==$cities['city']) selected
                                    @endif
                                        > {{$cities['city']}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <label class="control-label" for="state">Provinsi</label>
                            <div class="default-form-box controls w-100">
                                <select class="default-form-box w-100" id="state" name="state">
                                    <option value="">Select Provinsi</option>
                                    @foreach ($province as $prov)
                                    <option value="{{$prov['province']}}"
                                    @if (!empty(@old('province')) &&
                                        $prov['province']==@old('state'))
                                    @elseif(!empty($addressData['state']) &&
                                        $addressData['state']==$prov['province']) selected
                                    @endif
                                        > {{$prov['province']}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <label class="control-label" for="country">Country</label>
                            <div class="default-form-box controls w-100">
                                <select class="default-form-box w-100" id="country" name="country">
                                    <option value="">Select Contries</option>
                                    @foreach ($countries as $country)
                                    <option value="{{$country['country_name']}}"
                                    @if (!empty(@old('country')) &&
                                        $country['country_name']==@old('country'))
                                    @elseif(!empty($addressData['country']) &&
                                        $addressData['country']==$country['country_name']) selected
                                    @endif
                                        > {{$country['country_name']}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <label class="control-label" for="pincode">Pincode</label>
                            <div class="default-form-box controls">
                                <input class="span3" type="text" id="pincode" name="pincode"
                                @if (!empty($addressData['pincode'])) {
                                    value="{{ $addressData['pincode'] }}"
                                } @else {
                                    value="{{ old('pincode') }}"
                                }
                                @endif
                                placeholder="Enter Pincode">
                            </div>
                            <label class="control-label" for="mobile">Mobile</label>
                            <div class="default-form-box controls">
                                <input class="span3" type="number" name="mobile" id="mobile" placeholder="Enter Mobile" @if (!empty($addressData['mobile'])) {
                                    value="{{ $addressData['mobile'] }}" } @else {
                                    value="{{ old('mobile') }}" } @endif>
                            </div>
                            <div class="your-order-area" style="padding: 0; ">
                                <div class="Place-order">
                                    <button type="submit" class="btn-hover" href="#">Add Address</button>
                                </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<!-- checkout area end -->

@endsection
