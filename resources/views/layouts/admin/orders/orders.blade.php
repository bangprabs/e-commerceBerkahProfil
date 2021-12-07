@extends('layouts.admin_layouts.admin_layout')
@section('content')
<!-- Zero Configuration  Starts-->
<div class="page-body">
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="container">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-header bg-info">
                                <h5 style="margin-top: 10px">Daftar Order Pelanggan</h5>
                                <a href="{{ url('admin/view-orders-charts')}}" class="btn btn-success" style="float: right; margin-top: -35px;">Cek Grafik Order</a>
                            </div>

                            <div class="card-body">
                                <div class="table table-striped table-responsive table-bordered">
                                    <table class="display" id="blog">
                                        <thead>
                                            <tr>
                                                <th>No. </th>
                                                <th>Order ID</th>
                                                <th>Tanggal</th>
                                                <th>Email Pelanggan</th>
                                                <th>Barang Order</th>
                                                <th>Jumlah Order</th>
                                                <th>Status Order</th>
                                                <th>Metode Pembayaran</th>
                                                <th>Aksi</th>
                                        </thead>
                                        <?php $no = 1;?>
                                        @foreach ($orders as $order)
                                        <tr>
                                            <td>{{ $no }}</td>
                                            <td>{{$order['id']}}</td>
                                            <td>{{ date('d-m-Y', strtotime($order['created_at'])) }}</td>
                                            <td>{{$order['name']}}</td>
                                            <td>
                                                @foreach ($order['orders_products'] as $code)
                                                    {{$code['product_code']}} ({{$code['product_qty']}})<br>
                                                @endforeach
                                            </td>
                                            <td>{{$order['grand_total']}}</td>
                                            <td>{{$order['order_status']}}</td>
                                            <td>{{$order['payment_method']}}</td>
                                            <td>
                                                @if ($orderModule['edit_access'] == 1 || $orderModule['full_access'] == 1)
                                                    <a style="margin: 10px;" title="Lihat Detail Pemesanan" href="{{ url('admin/orders/'.$order['id']) }}" class="btn btn-success "><i class="fa fa-eye"></i></a>
                                                    @if ($order['order_status'] == "Dikirim" || $order['order_status'] == "Sampai Tujuan")
                                                        <a style="margin: 10px;" title="Lihat Invoice" target="_blank" href="{{ url('admin/view-order-invoice/'.$order['id']) }}" class="btn btn-info "><i class="fa fa-print"></i></a>
                                                    @endif
                                                @endif
                                            </td>
                                        </tr>
                                        <?php $no++?>
                                        @endforeach
                                        <tfoot>
                                            <tr>
                                                <th>No. </th>
                                                <th>Order ID</th>
                                                <th>Tanggal</th>
                                                <th>Email Pelanggan</th>
                                                <th>Barang Order</th>
                                                <th>Jumlah Order</th>
                                                <th>Status Order</th>
                                                <th>Metode Pembayaran</th>
                                                <th>Aksi</th>
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
</div>

@endsection
