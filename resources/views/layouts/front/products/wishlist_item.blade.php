<style>
    .btn.blue {
        opacity: 1;
        color: #fff;
        background: #266bf9;
        padding: 0px !important;
        width: 70px;
        border-color: #1b55c9;
    }
    .btn.red {
        visibility:visible;
        opacity: 1;
        margin-left: 10px;
        color: #fff;
        width: 70px;
        padding: 0px !important;
        background: #dc3545;
        border-color: #dc3545;
    }
</style>

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
                                <th>Harga Barang</th>
                                <th>Lihat / Hapus</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($userWishlistItems as $item)
                            <tr>
                                <td class="product-thumbnail">
                                    <a href="#"><img style="width: 75%;" src="{{ asset('images/admin_images/product_images/small/' . $item['product']['main_image']) }}"</a>
                                </td>
                                <td style="text-align: left">
                                    <b>Name : </b>{{ $item['product']['product_name'] }} <br />
                                    <b>Code : </b>({{ $item['product']['product_code'] }}) <br>
                                    <b>Color : </b>{{ $item['product']['product_color'] }}<br />
                                </td>
                                <td class="product-subtotal">
                                    @currency($item['product']['product_price'])
                                </td>
                                <td style="text-align: center">
                                        <div class="row" style="display: inline-flex">
                                        <a href="{{url('product/'. $item['product']['id'])}}" class="btn btn-primary blue"><i
                                            class="fa fa-eye"
                                            ></i></a>
                                        <button type="button" data-wishlistid = "{{ $item['id'] }}" class="wishlistItemDelete action wishlist btn btn-danger red" title="Hapus Barang"><i
                                            class="fa fa-trash"
                                            ></i></button>
                                        </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Cart Area End -->
