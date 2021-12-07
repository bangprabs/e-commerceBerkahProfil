@extends('layouts.admin_layouts.admin_layout')
@section('content')
<?php use App\Models\Product; ?>
<!-- Zero Configuration  Starts-->
<div class="page-body">
    <div class="container-fluid">
        <div class="page-title">
            @if (Session::has('success_message'))
            <div class="alert alert-success dark alert-dismissible fade show" role="alert">
                {{ Session::get('success_message')}}
                <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
            <div class="row">
                <div class="col-6">
                    <h3>Detail Pesanan Produk</h3>
                </div>
                <div class="col-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html"> <i data-feather="home"></i></a></li>
                        <li class="breadcrumb-item"> Order</li>
                        <li class="breadcrumb-item active">Rincian Order</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12 col-xl-6">
                <div class="card">
                    <div class="card-header b-l-secondary border-2">
                        <h5>Detail Pemesanan</h5>
                    </div>
                    <div class="card-body">
                        <div class="card-block row">
                            <div class="col-sm-12 col-lg-12 col-xl-12">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead class="bg-primary" colspan="2">
                                            <tr>
                                                <th colspan="2" class="text-center">Detail Pesanan</th>
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
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header b-l-info border-4">
                        <h5>Update Status Order</h5>
                    </div>
                    <div class="card-body">
                        <div class="card-block row">
                            <div class="col-sm-12 col-lg-12 col-xl-12">
                                <div class="table-responsive table-borderless">
                                    <table class="table border-0 table-borderless">
                                        <tbody>
                                            <tr>
                                                <td colspan="2">
                                                    <form action="{{ url('admin/update-order-status') }}" method="post">
                                                        @csrf
                                                        <div class="row">
                                                                <input type="hidden" name="order_id"
                                                                    value="{{ $orderDetails['id'] }}">
                                                                <select style="width: 25%" name="order_status" id="order_status"
                                                                    class="custom-select form-select d-inline-block">
                                                                    <option selected="">Pilih Status</option>
                                                                    @foreach ($orderStatuses as $status)
                                                                    <option value="{{ $status['name'] }}"
                                                                        @if(isset($orderDetails['order_status']) &&
                                                                        $orderDetails['order_status']==$status['name'])
                                                                        selected @endif>{{ $status['name'] }}
                                                                    </option>
                                                                    @endforeach
                                                                </select>
                                                                <input style="width: 25%; margin-left: 10px;" class="form-control"
                                                                @if (empty($orderDetails['courier_name']))
                                                                id="courier_name"
                                                                @endif
                                                                name="courier_name" placeholder="Nama Pengirim" value="{{ $orderDetails['courier_name'] }}"
                                                                    style="display: inline !important;" type="text">
                                                                <input style="width: 25%; margin-left: 10px;"  value="{{ $orderDetails['tracking_number'] }}" class="form-control" name="tracking_number"  @if (empty($orderDetails['courier_name']))
                                                                id="tracking_number"
                                                                @endif placeholder="Nomor Pengiriman"
                                                                    style="display: inline !important;" type="text">
                                                                <button class="btn-info"
                                                                    style="width: 18%; margin-left: 10px; padding: 7px; border-radius: 5px; display: inline !important;"
                                                                    type="submit">Update</button>
                                                        </div>
                                                    </form>
                                                </td>
                                                <table class="table" style="margin-top: 20px;">
                                                    <thead class="bg-success mt-3" colspan="2">
                                                        <tr>
                                                            <th colspan="2" class="text-center text-white">Riwayat
                                                                Status Order</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                @foreach ($orderLog as $log)
                                                                Status Order :
                                                                <strong>{{$log['order_status']}}</strong><br>
                                                                Pada
                                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                :
                                                                {{ date('j F, Y, g:i a', strtotime($log['created_at'])) }}
                                                                <hr>
                                                                @endforeach
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-xl-6">
                <div style="margin-bottom: 50px;" class="card">
                    <div class="card-header b-l-primary border-3">
                        <h5>Detail Pelanggan</h5>
                    </div>
                    <div class="card-body">
                        <div class="card-block row">
                            <div class="col-sm-12 col-lg-12 col-xl-12">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead class="bg-danger" colspan="2">
                                            <tr>
                                                <th colspan="2" class="text-center text-white">Detail Pelanggan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Nama Pelanggan</td>
                                                <td>{{ $userDetails['name'] }}</td>
                                            </tr>
                                            <tr>
                                                <td>Email Pelanggan</td>
                                                <td>{{$userDetails['email']}}</td>
                                            </tr>
                                        </tbody>
                                    </table>

                                    <table class="table">
                                        <thead class="bg-warning" colspan="2">
                                            <tr>
                                                <th colspan="2" class="text-center">Alamat Pelanggan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Nama Pemesan</td>
                                                <td>{{ $orderDetails['name'] }}</td>
                                            </tr>
                                            <tr>
                                                <td>Alamat Pemesan</td>
                                                <td>{{ $orderDetails['address'] }}</td>
                                            </tr>
                                            <tr>
                                                <td>Kota</td>
                                                <td>{{ $orderDetails['city'] }}</td>
                                            </tr>
                                            <tr>
                                                <td>Provinsi</td>
                                                <td>{{$orderDetails['state']}}</td>
                                            </tr>
                                            <tr>
                                                <td>Negara</td>
                                                <td>{{ $orderDetails['country'] }}</td>
                                            </tr>
                                            <tr>
                                                <td>Kode Pos</td>
                                                <td>{{ $orderDetails['pincode'] }}</td>
                                            </tr>
                                            <tr>
                                                <td>Nomor Telepon</td>
                                                <td>{{ $orderDetails['mobile'] }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card card-absolute">
                    <div class="card-header bg-success">
                        <h5 class="text-white">Bukti Pembayaran</h5>
                    </div>
                    <div class="card-body">
                        <div class="card-block row">
                            <img src="{{ asset('images/admin_images/product_images/small/' . $orderDetails['transfer_image']) }}" alt="" srcset="">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-xl-12">
                <div class="card card-absolute">
                    <div class="card-header bg-secondary">
                        <h5 class="text-white">Produk Yang Dipesan</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive table-bordered">
                            <table class="display" id="blog">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Product Image</th>
                                        <th>Product Code</th>
                                        <th>Product Name</th>
                                        <th>Product Size</th>
                                        <th>Product Color</th>
                                        <th>Product Qty</th>
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
                                <tfoot>
                                    <tr>
                                        <th>No.</th>
                                        <th>Product Image</th>
                                        <th>Product Code</th>
                                        <th>Product Name</th>
                                        <th>Product Size</th>
                                        <th>Product Color</th>
                                        <th>Product Qty</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

@endsection
