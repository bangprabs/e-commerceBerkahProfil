<?php use App\Models\Product; ?>
<div class="cart-main-area">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                <form action="#">
                    <div class="table-content cart-table-content">
                        <table>
                            <thead>
                                <tr>
                                    <th>Produk</th>
                                    <th>Rincian Product</th>
                                    <th>Satuan Harga</th>
                                    <th>Jumlah & Aksi</th>
                                    <th>Diskon</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $total_price = 0; ?>
                                @foreach ($userCartItems as $item)
                                <?php $attrPrice = Product::getDiscountedAttrPrice($item['product_id'], $item['size']); ?>
                                <tr>


                                    <td class="product-thumbnail">
                                        <a href="#"><img style="width: 75%;" src="{{ asset('images/admin_images/product_images/small/' . $item['product']['main_image']) }}"</a>
                                    </td>
                                    <td class="product-name" style="font-size: 15px; text-align: left; padding-left:11px;">
                                        <b>Name : </b>{{ $item['product']['product_name'] }} <br />
                                        <b>Code : </b>({{ $item['product']['product_code'] }}) <br>
                                        <b>Color : </b>{{ $item['product']['product_color'] }}<br />
                                        <b>Size : </b>{{ $item['size'] }}
                                    </td>
                                    <td class="product-price-cart"><span class="amount">@currency($attrPrice['product_price'] * $item['quantity'])</span></td>
                                    <td class="product-quantity" style="text-align: center">
                                        <div class="input-group plus-minus-input" style="margin-left: 5px;">
                                            <div class="input-append" style="margin-left: 5px;">
                                                <input readonly class="span1 border-radius-10px text-center" style="padding: 0px; width: 80px; height: 35px;" id="appendedInputButtons" type="text" value="{{ $item['quantity'] }}">
                                                <button class="btnItemUpdate qtyMinus border-radius-10px" data-cartid="{{ $item['id'] }}" type="button"><i class="fa fa-minus"></i></button>
                                                <button class="btnItemUpdate qtyPlus border-radius-10px" data-cartid="{{ $item['id'] }}" type="button"><i class="fa fa-plus"></i></button>
                                                <button class="btnItemDelete border-radius-10px" data-cartid="{{ $item['id'] }}" type="button"><i class="fa fa-trash"></i></button>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="product-subtotal">- @currency($attrPrice['discount'] * $item['quantity'])</td>
                                    <td class="product-subtotal">@currency($attrPrice['final_price'] * $item['quantity'])</td>
                                </tr>
                                <?php $total_price = $total_price + ($attrPrice['final_price'] * $item['quantity']) ?>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="cart-shiping-update-wrapper">
                                <div class="cart-shiping-update">
                                </div>
                                <div class="cart-clear">
                                    <a href="{{ url('/') }}">Cari Barang Lain</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="row">
                    <div class="col-lg-6 col-md-12 mb-lm-30px">
                        <div class="discount-code-wrapper">
                            <div class="title-wrap">
                                <h4 class="cart-bottom-title section-bg-gray">Gunakan Kode Kupon</h4>
                            </div>
                            <form method="post" action="javascript:void(0);" class="form-horizontal" id="applyCoupon" @if (Auth::check()) user="1" @endif>@csrf
                                <div class="discount-code">
                                    <p>Masukkan kode jika mempunyai voucher kode.</p>
                                    <form>
                                        <input name="code" id="code" type="text" class="input-medium" required placeholder="Masukan Kode Kupon">
                                        <button class="cart-btn-2" type="submit">Submit Kupon</button>
                                    </form>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12 mt-md-30px">
                        <div class="grand-totall">
                            <div class="title-wrap">
                                <h4 class="cart-bottom-title section-bg-gary-cart">Total Belanja</h4>
                            </div>
                            <h5 class="">Nominal Diskon <span class="couponAmount">
                                @if (Session::has('couponAmount'))
                                    @currency(Session::get('couponAmount'))
                                @else
                                    Rp. 0
                                @endif
                            </span></h5>
                            <h5>Total Sub Harga Produk <span>@currency($total_price)</span></h5>
                            <h5>Rincian Hitung Harga<span>(@currency($total_price) - &nbsp;<span class="couponAmount"> @currency( Session::get('couponAmount')))</span></span></h5>
                            <h4 class="grand-totall-title">Total Keseluruhan <span class="grand_total">@currency($total_price - Session::get('couponAmount'))</span></h4>
                            <a href="{{ url('/checkout') }}">Lanjut ke Checkout</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<!-- Cart Area End -->
