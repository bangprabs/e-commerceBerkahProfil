@extends('layouts.front_layouts.front_layout')
@section('checkout')
<?php
    use App\Models\Product;
    use App\Models\Order;
    $getOrderStatus = Order::getOrderStatus($orderDetails['id'])
?>

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

    .file-upload-wrapper {
        position: relative;
        width: 100%;
        margin-top: 30px;
        height: 60px;
    }

    .file-upload-wrapper:after {
        content: attr(data-text);
        font-size: 18px;
        position: absolute;
        top: 0;
        left: 0;
        background: rgb(226, 223, 223);
        padding-left: 12px;
        display: block;
        width: calc(100% - 40px);
        pointer-events: none;
        z-index: 20;
        height: 60px;
        line-height: 60px;
        color: #999;
        border-radius: 5px 10px 10px 5px;
        font-weight: 300;
    }

    .file-upload-wrapper:before {
        content: "Pilih File";
        position: absolute;
        top: 0;
        right: 0;
        display: inline-block;
        height: 60px;
        background: #345ec7;
        color: #fff;
        font-weight: 700;
        z-index: 25;
        font-size: 16px;
        line-height: 60px;
        padding: 0 15px;
        text-transform: uppercase;
        pointer-events: none;
        border-radius: 0 5px 5px 0;
    }

    .file-upload-wrapper:hover:before {
        background: #346cf9;
    }

    .file-upload-wrapper input {
        opacity: 0;
        position: absolute;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        z-index: 99;
        height: 40px;
        margin: 0;
        padding: 0;
        display: block;
        cursor: pointer;
        width: 100%;
    }

    .uploadbukti,
    input[type=submit],
    input[type=reset] {
        font-family: sans-serif;
        font-size: 15px;
        background: #22a4cf;
        color: white;
        border: white 3px solid;
        border-radius: 5px;
        padding: 10px 10px;
        margin-top: 10px;
    }

    .batalpesanans,
    input[type=submit],
    input[type=reset] {
        font-size: 15px;
        background: #266bf9;
        color: white;
        border: white 3px solid;
        border-radius: 10px;
        padding: 10px 10px;
        margin-top: 10px;
    }

    a {
        text-decoration: none;
    }

    a:hover,
    button:hover,
    input[type=submit]:hover,
    input[type=reset]:hover {
        opacity: 0.9;
    }

</style>

<!-- checkout area start -->
<div class="checkout-area pb-40px">
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

        <div class="row mt-3">
            <div class="col-lg-6">
                <div class="billing-info-wrap">
                    <h3>Alamat Pengiriman</h3>
                    <label class="card">
                        <input class="radio" type="radio" checked>
                        <span class="hidden-visually"></span>
                        <span class="plan-details" aria-hidden="true">
                            <span class="plan-type mb-3">Detail Alamat</span>
                            <span><b>Email</b> : {{$orderDetails['email']}}</span>
                            <span><b>Penerima</b> : {{$orderDetails['name']}}</span>
                            <span><b>Nomor Telepon</b> : {{$orderDetails['mobile']}}</span>
                            <span><b>Alamat</b> : {{$orderDetails['address']}}, {{$orderDetails['city']}},
                                {{$orderDetails['state']}}, {{$orderDetails['country']}}</span>
                        </span>
                    </label>
                </div>
                @if ($orderDetails['payment_method'] == "Transfer Bank")
                <div class="billing-info-wrap" style="margin-top: 45px;">
                    <h3>Upload Bukti Pembayaran</h3>
                    <div class="row">
                        <div class="col-6">
                            <div class="row">
                                <div class="col">
                                    <img style="width: 100%; margin-top: 5px;"
                                        src="{{ asset('front_assets/images/icons/bca.png') }}" alt="">
                                </div>
                                <div class="col" style="border-right-style: dotted;">
                                    <p style="font-weight: bold; font-size: 12px; margin-top: -10px;">Bank Central Asia
                                    </p>
                                    <p style="font-weight: bold; font-size: 12px; margin-top: -10px;">1405 2000
                                    </p>
                                    <p style="font-weight: bold; font-size: 12px; margin-top: -10px;">Agung Prabowo
                                    </p>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col">
                                    <img style="width: 121%;" src="{{ asset('front_assets/images/icons/mandiri.png') }}"
                                        alt="">
                                </div>
                                <div class="col" style="border-right-style: dotted;">
                                    <p style="font-weight: bold; font-size: 12px; margin-top: -10px;">Bank Mandiri
                                    </p>
                                    <p style="font-weight: bold; font-size: 12px; margin-top: -10px;">1405 1940
                                    </p>
                                    <p style="font-weight: bold; font-size: 12px; margin-top: -10px;">Afrian Wibowo
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <p style="margin-top: 4px;">Rincian Yang Harus Di Transfer</p>
                            <strong>Order : </strong> @currency($orderDetails['grand_total'])<br>
                            <strong>Ongkos Kirim : </strong> @currency($orderDetails['shipping_charges'])<br>
                            <strong>Total Bayar : </strong> @currency($orderDetails['grand_total'] +
                            $orderDetails['shipping_charges'])
                        </div>
                    </div>
                    @if (empty($orderDetails['transfer_image']))
                    <form action="{{url('update-transfer-bank')}}" class="form" enctype="multipart/form-data"
                        method="post">@csrf
                        <input type="hidden" name="order_id" value="{{ $orderDetails['id'] }}">
                        <div class="file-upload-wrapper" data-text="Input">
                            <input name="transfer_image" type="file" class="file-upload-field" value="">
                        </div>
                        <button class="uploadbukti" type="submit" style="width: 100%;" class="button">Upload Bukti
                            Transfer</button>
                    </form>
                    @endif
                </div>
                @endif
            </div>
            <div class="col-lg-6">
                <h3>Detail Order Produk #{{ $orderDetails['id'] }}</h3>
                <div class="table_page mt-2">
                    <table>
                        <thead>
                            <tr>
                                <th colspan="2">Detail Pesanan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Tanggal Order</td>
                                <td>{{ date('d-m-Y', strtotime($orderDetails['created_at'])) }}</td>
                            </tr>
                            <tr>
                                <td>Order Status</td>
                                <td>{{ $orderDetails['order_status'] }}</td>
                            </tr>
                            <tr>
                                <td>Total Order</td>
                                <td>@currency($orderDetails['grand_total'])</td>
                            </tr>
                            @if (!empty($orderDetails['courier_name']))
                            <tr>
                                <td>Nama Pengirim</td>
                                <td>{{$orderDetails['courier_name']}}</td>
                            </tr>
                            @endif
                            @if (!empty($orderDetails['tracking_number']))
                            <tr>
                                <td>Nomor Pengiriman</td>
                                <td>{{$orderDetails['tracking_number']}}</td>
                            </tr>
                            @endif
                            <tr>
                                <td>Ongkos Kirim</td>
                                <td>@currency($orderDetails['shipping_charges'])</td>
                            </tr>
                            <tr>
                                <td>Kupon Code</td>
                                <td>{{ $orderDetails['coupon_code'] }}</td>
                            </tr>
                            <tr>
                                <td>Potongan Kupon</td>
                                <td>{{ $orderDetails['coupon_amount'] }}</td>
                            </tr>
                            <tr>
                                <td>Metode Pembayaran</td>
                                <td>{{ $orderDetails['payment_method'] }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                @if ($getOrderStatus == "Baru")
                    <button data-bs-toggle="modal" data-bs-target="#exampleModalCenter" class="batalpesanans" type="submit" style="width: 100%;">Batalkan Pesanan</button></a>
                @endif
            </div>
        </div>
        <div class="row" style="margin-top: 40px;">
            <h4>Daftar Order</h4>
            <div class="table_page table-responsive mt-2">
                <table>
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Product Image</th>
                            <th>Product Code</th>
                            <th>Product Name</th>
                            <th>Product Size</th>
                            <th>Product Color</th>
                            <th>Product Qty</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;?>
                        @foreach ($orderDetails['orders_products'] as $product)
                        <tr>
                            <td>{{ $no }}</td>
                            <td>
                                <?php $getProductImage = Product::getProductImage($product['product_id']) ?>
                                <a href="{{ url('product/'.$product['product_id']) }}"><img width="75"
                                        src="{{ asset('images/admin_images/product_images/small/' . $getProductImage) }}"
                                        alt=""></a>
                            </td>
                            <td>{{ $product['product_code'] }}</td>
                            <td>{{ $product['product_name'] }}</td>
                            <td>{{ $product['product_size'] }}</td>
                            <td>{{ $product['product_color'] }}</td>
                            <td>{{ $product['product_qty'] }}</td>
                        </tr>
                        <?php $no++?>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

{{-- Modal --}}
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Pembatalan Pemesanan</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{ url('orders/'.$orderDetails['id'].'/cancel') }}">@csrf
                <div class="modal-body">
                    <select required class="form-select" name="reason" id="cancelReason">
                        <option value="">Berikan alasan pembatalan order</option>
                        <option value="Pesanan yang dilakukan terjadi kesalahan">Pesanan yang dilakukan terjadi kesalahan</option>
                        <option value="Barang tidak sampai tepat waktu">Barang tidak sampai tepat waktu</option>
                        <option value="Biaya pengiriman terlalu mahal">Biaya pengiriman terlalu mahal</option>
                        <option value="Ingin mengganti model barang">Ingin mengganti model barang</option>
                        <option value="Lainnya">Lainnya</option>
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="button" style="visibility: visible;" class="btn btn-secondary active" data-bs-dismiss="modal">Tutup</button>
                    <button id="cancelpesanan" type="submit" class="btn btn-primary active batalpesanan">Batalkan Pesanan</button>
                </div>
            </form>
            </div>
    </div>
</div>

@endsection
