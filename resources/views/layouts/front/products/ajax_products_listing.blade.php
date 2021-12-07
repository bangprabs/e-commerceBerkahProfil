<?php
    use App\Models\Wishlist;
?>
<div class="row">
    <div class="col">
        <div class="tab-content">
            <div class="tab-pane fade show active" id="shop-grid">
                <div class="row mb-n-30px">
                    @foreach ($categoryProducts as $product)
                    <div class="col-lg-4 col-md-6 col-sm-6 col-xs-6 mb-30px">
                        <!-- Single Prodect -->
                        <div class="product">
                            <span class="badges">
                                <span class="new">New</span>
                            </span>
                            <div class="thumb">
                                <a href="{{ url('product/'.$product['id']) }}" class="image">
                                    <img src="{{ asset('/images/admin_images/product_images/small/'.$product['main_image']) }}"
                                        alt="Product" />
                                    <img class="hover-image"
                                        src="{{ asset('/images/admin_images/product_images/small/'.$product['main_image']) }}"
                                        alt="Product" />
                                </a>
                            </div>
                            <div class="content">
                                <span class="category mt-3"><a
                                        href="#">{{$product['category']['category_name']}}</a></span>
                                <h5 class="title"><a href="{{ url('product/'.$product['id']) }}">{{$product['product_name']}}
                                    </a>
                                </h5>
                                <span class="price">
                                    <span class="new">@currency($product['product_price'])</span>
                                </span>
                            </div>
                            <div class="actions">
                                <button title="Detail Barang" onclick="location.href='{{url('product/'. $product['id'])}}'" class="action add-to-cart"><i
                                    class="fa fa-eye"></i></button>
                            @php
                                $countWishlist = 0
                            @endphp
                            @if (Auth::check())
                                @php
                                    $countWishlist = Wishlist::countWishlist($product['id'])
                                @endphp
                                <button data-productid="{{$product['id']}}" class="updateWishlist action wishlist" title="Wishlist"><i
                                    @if ($countWishlist > 0)
                                    class="fa fa-heart"
                                    @else
                                    class="fa fa-heart-o"
                                    @endif
                                    ></i></button>
                            @else
                                <button class="userLogin action wishlist" title="Wishlist"><i
                                    class="fa fa-heart-o"
                                    ></i></button>
                            @endif
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="tab-pane fade mb-n-30px" id="shop-list">
                @foreach ($categoryProducts as $product)
                <div class="shop-list-wrapper mb-30px">
                    <div class="row">
                        <div class="col-md-5 col-lg-5 col-xl-4 mb-lm-30px">
                            <div class="product">
                                <div class="thumb">
                                    <a href="{{ url('product/'.$product['id']) }}" class="image">
                                        <img src="{{ asset('/images/admin_images/product_images/small/'.$product['main_image']) }}"
                                            alt="Product" />
                                        <img class="hover-image"
                                            src="{{ asset('/images/admin_images/product_images/small/'.$product['main_image']) }}"
                                            alt="Product" />
                                    </a>
                                    <span class="badges">
                                        <span class="new">New</span>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-7 col-lg-7 col-xl-8">
                            <div class="content-desc-wrap">
                                <div class="content">
                                    <span class="category"><a
                                            href="#">{{$product['category']['category_name']}}</a></span>
                                    <h5 class="title"><a
                                            href="{{ url('product/'.$product['id']) }}">{{$product['product_name']}}</a></h5>
                                    <p>{!! \Illuminate\Support\Str::words($product['description'], 50, '...')
                                        !!} </p>
                                </div>
                                <div class="box-inner">
                                    <span class="price">
                                        <span class="new">@currency($product['product_price'])</span>
                                    </span>
                                    <div class="actions">
                                        <button title="Add To Cart" class="action add-to-cart"
                                            data-bs-toggle="modal" data-bs-target="#exampleModal-Cart"><i
                                                class="pe-7s-shopbag"></i></button>
                                        <button class="action wishlist" title="Wishlist" data-bs-toggle="modal"
                                            data-bs-target="#exampleModal-Wishlist"><i
                                                class="pe-7s-like"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
