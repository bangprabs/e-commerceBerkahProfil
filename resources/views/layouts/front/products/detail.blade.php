<?php
    use App\Models\Product;
    use App\Models\Wishlist;
?>
@extends('layouts.front_layouts.front_layout')
@section('content')

<style>
    .rate {
        float: left;
        height: 46px;
    }
    .rate:not(:checked) > input {
        position:fixed;
        top:-9999px;
    }
    .rate:not(:checked) > label {
        float:right;
        width:1em;
        overflow:hidden;
        white-space:nowrap;
        cursor:pointer;
        font-size:30px;
        color:#ccc;
    }
    .rate:not(:checked) > label:before {
        content: '★ ';
    }
    .rate > input:checked ~ label {
        color: #ffc700;
    }
    .rate:not(:checked) > label:hover,
    .rate:not(:checked) > label:hover ~ label {
        color: #deb217;
    }
    .rate > input:checked + label:hover,
    .rate > input:checked + label:hover ~ label,
    .rate > input:checked ~ label:hover,
    .rate > input:checked ~ label:hover ~ label,
    .rate > label:hover ~ input:checked ~ label {
        color: #c59b08;
    }
</style>

<!-- Product Details Area Start -->
@if (Session::has('error_messages'))
<div class="mb-3 mr-3 ml-3" style="margin-bottom: -10px">
    <div class="mb-3 alert alert-danger alert-dismissible fade show" role="alert">
        {{ Session::get('error_messages')}}
    </div>
</div>
@endif

@if (Session::has('success_messages'))
<div class="mb-3 mr-3 ml-3" style="margin-bottom: -10px">
    <div class="mb-3 alert alert-success alert-dismissible fade show" role="alert">
        {{ Session::get('success_messages')}}
    </div>
</div>
@endif

<div class="product-details-area pb-100px">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-sm-12 col-xs-12 mb-lm-30px mb-md-30px mb-sm-30px">
                <!-- Swiper -->
                <div class="swiper-container zoom-top">
                    <div class="swiper-wrapper">
                        @foreach ($productDetails['images'] as $image)
                        <div class="swiper-slide">
                            <img class="img-responsive m-auto"
                                src="{{asset('images/admin_images/product_images/large/'.$image['image'])}}" alt="">
                            <a class="venobox full-preview" data-gall="myGallery"
                                href="{{asset('images/admin_images/product_images/large/'.$image['image'])}}">
                                <i class="fa fa-arrows-alt" aria-hidden="true"></i>
                            </a>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="swiper-container mt-20px zoom-thumbs slider-nav-style-1 small-nav">
                    <div class="swiper-wrapper">
                        @foreach ($productDetails['images'] as $image)
                        <div class="swiper-slide">
                            <img class="img-responsive m-auto"
                                src="{{asset('images/admin_images/product_images/small/'.$image['image'])}}" alt="">
                        </div>
                        @endforeach
                    </div>
                    <!-- Add Arrows -->
                    <div class="swiper-buttons">
                        <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div>
                    </div>
                </div>

                <div class="description-review-wrapper mt-5">
                    <div class="description-review-topbar nav">
                        <button data-bs-toggle="tab" class="active"
                        data-bs-target="#desc-details2">Informasi Barang</button>
                        <button class="" data-bs-toggle="tab" data-bs-target="#desc-details3">Ulasan</button>
                    </div>
                    <div class="tab-content description-review-bottom">
                        <div id="desc-details2" class="tab-pane active">
                            <div class="product-anotherinfo-wrapper text-start">
                                <ul>
                                    <li>
                                        <div class="row">
                                            <div class="col-4">
                                                <span>Bobot</span>
                                            </div>
                                            <div class="col">
                                                {{ number_format($productDetails['product_weight']) }} g
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="row">
                                            <div class="col-4">
                                                <span>Dimensi</span>
                                            </div>
                                            <div class="col">
                                                @foreach ($productDetails['attributes'] as $size)
                                                {{$size['size']}} <br>
                                                @endforeach
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="row">
                                            <div class="col-4">
                                                <span>Bahan</span>
                                            </div>
                                            <div class="col">
                                                {{ $productDetails['material'] }}
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="row">
                                            <div class="col-5">
                                                <span>Info Lainnya</span>
                                            </div>
                                            <div class="col">
                                                -
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div id="desc-details3" class="tab-pane">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="ratting-form-wrapper" style="margin-bottom: 30px; padding-top: 0px !important;">
                                        <h3 class="mb-3">Berikan Ulasan </h3>
                                        <div class="ratting-form">
                                            <form action="{{ url('/add-rating') }}" name="ratingForm" id="ratingForm" method="POST">@csrf
                                                <input type="hidden" name="product_id" value="{{$productDetails['id']}}">
                                                <div class="star-box">
                                                    <span>Rating Anda : </span>
                                                    <div class="rate" style="margin-top: -9px;">
                                                        <input type="radio" id="star5" name="rate" value="5" />
                                                        <label for="star5" title="text">5 stars</label>
                                                        <input type="radio" id="star4" name="rate" value="4" />
                                                        <label for="star4" title="text">4 stars</label>
                                                        <input type="radio" id="star3" name="rate" value="3" />
                                                        <label for="star3" title="text">3 stars</label>
                                                        <input type="radio" id="star2" name="rate" value="2" />
                                                        <label for="star2" title="text">2 stars</label>
                                                        <input type="radio" id="star1" name="rate" value="1" />
                                                        <label for="star1" title="text">1 star</label>
                                                      </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="rating-form-style form-submit">
                                                            <textarea name="review" style="line-height: 0.7cm"
                                                                placeholder="Berikan Ulasan"></textarea>
                                                            <button class="btn btn-primary btn-hover-color-primary "
                                                                type="submit" value="Submit">Submit</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <hr class="mb-3">
                                <div class="col-lg-12" style="margin-top: -10px;">
                                    @if (count($ratings) > 0)
                                    @foreach ($ratings as $rating)
                                    <div class="review-wrapper">
                                        <div class="single-review mt-3">
                                            <div class="review-content">
                                                <div class="review-top-wrap">
                                                    <div class="review-left">
                                                        <div class="review-name">
                                                            <h4>{{ $rating['user']['name'] }}</h4>
                                                        </div>
                                                        <div class="rating-product">
                                                            <?php
                                                            $count = 1;
                                                                while($count <= $rating['rating']) { ?>
                                                                    <span>⭐</span>
                                                                 <?php $count++; } ?>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="review-bottom">
                                                    <p style="text-align: justify">
                                                        {{ $rating['review'] }}
                                                    </p>
                                                    <p style="margin-top: 5px;"><b>Pada : </b> {{ date("d-m-Y", strtotime($rating['created_at'])) }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                    @else
                                        <p><b>Belum ada ulasan pada barang/produk ini.</b></p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-sm-12 col-xs-12" data-aos="fade-up" data-aos-delay="200">
                <div class="product-details-content quickview-content ml-25px">
                    <h2>{{$productDetails['product_name']}}</h2>
                    <div class="pricing-meta">
                        <ul class="d-flex">
                            <li class="new-price">
                                <h3 class="getAttrPrice">
                                    <?php $discounted_price = Product::getDiscountedPrice($productDetails['id']); ?>
                                    @if ($discounted_price >0)
                                    <del>@currency($productDetails['product_price'])</del> @currency($discounted_price)
                                    @else
                                    @currency($productDetails['product_price'])
                                    @endif
                                </h2>
                            </li>
                        </ul>
                    </div>
                    <div class="pro-details-rating-wrap">
                        <div class="rating-product">
                            <div class="stars-example-fontawesome-o">
                                <select id="u-rating-fontawesome-o" name="rating"
                                @if ($avgRating == 0)
                                data-current-rating="0.0"
                                @else
                                data-current-rating="{{$avgRating}}"
                                @endif
                                disabled>
                                  <option value="1">1</option>
                                  <option value="2">2</option>
                                  <option value="3">3</option>
                                  <option value="4">4</option>
                                  <option value="5">5</option>
                                </select>
                              </div>
                        </div>
                        <span class="read-review"><a class="reviews" href="#">({{$avgRating}}) dari {{ $ratingCount }} Ulasan</a></span>
                    </div>

                    <small>{{$total_stock}} Stok Tersedia</small>

                    @if (Session::has('error_message'))
                    <div class="mr-3 ml-3" style="margin-bottom: -10px">
                        <div class="mt-4 alert alert-danger alert-dismissible fade show" role="alert">
                            {{ Session::get('error_message')}}
                        </div>
                    </div>
                    @endif

                    @if (Session::has('success_message'))
                    <div class="mr-3 ml-3" style="margin-bottom: -10px">
                        <div class="mt-4 alert alert-success alert-dismissible fade show" role="alert">
                            {{ Session::get('success_message')}}
                        </div>
                    </div>
                    @endif

                    <form action="{{ url('add-to-cart') }}" method="POST" class="form-horizontal qtyFrm">@csrf
                        <div class="control-group">
                            <input type="hidden" name="product_id" value="{{ $productDetails['id'] }}">
                            <div class="pro-details-quality">
                                <div class="cart-plus-minus">
                                    <input class="cart-plus-minus-box" type="text" name="quantity" value="1" />
                                </div>
                                <div class="select-shoing-wrap d-flex align-items-center" style="margin-left: 7px;">
                                    <!-- Single Wedge End -->
                                    <div class="header-bottom-set dropdown">
                                        <div class="control-group">
                                            <select required name="size" style="border-color: transparent" id="getPrice"
                                                product-id="{{$productDetails['id']}}" class="span2 pull-left">
                                                <option value="">Pilih Ukuran Produk</option>
                                                @foreach ($productDetails['attributes'] as $attribute)
                                                <option value="{{ $attribute['size'] }}">{{ $attribute['size'] }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                @php
                                    $countWishlist = 0
                                @endphp
                                @if (Auth::check())
                                    @php
                                        $countWishlist = Wishlist::countWishlist($productDetails['id'])
                                    @endphp
                                    <div style="margin-left: 5px;" class="pro-details-compare-wishlist pro-details-wishlist">
                                        <a data-productid="{{$productDetails['id']}}" class="updateWishlist"><i
                                            @if ($countWishlist > 0)
                                                class="fa fa-heart"
                                            @else
                                                class="fa fa-heart-o"
                                            @endif
                                            ></i></a>
                                    </div>
                                @else
                                    <div style="margin-left: 5px;" class="userLogin pro-details-compare-wishlist pro-details-wishlist ">
                                        <a><i class="fa fa-heart-o"></i></a>
                                    </div>
                                @endif
                            </div>
                            <div style="margin-top: 10px; margin-left: 10px;" class="pro-details-quality w-100">
                                <div class="pro-details-cart w-100">
                                    <button class="add-cart w-100" type="submit"
                                        style="margin-left:-10px;font-size: 15px;">
                                        Tambah Ke Kerajang</button>
                                    </div>
                            </div>
                        </div>
                    </form>
                    <div class="row">
                        <div class="col-md-9">
                            <div class="rating-form-style">
                                <input style="border-radius: 5px;" type="text" name="pincode" placeholder="Check Pincode" id="pincode" />
                            </div>
                        </div>
                        <div class="col-md-4 pro-details-quality" style="margin-top: -1px;width: 0px;margin-left: -25px;">
                            <div class="pro-details-cart">
                                <button class="add-cart p-0" id="checkPincode"
                                style="font-size: 13px;width: 90px;">
                                Cek</button>
                            </div>
                        </div>
                    </div>
                    <div class="pro-details-categories-info pro-details-same-style d-flex m-0">
                        <span>Kode Produk:</span>
                        <ul class="d-flex">
                            <li>
                                <a href="#">{{$productDetails['product_code']}}</a>
                            </li>
                        </ul>
                    </div>
                    <div class="pro-details-categories-info pro-details-same-style d-flex m-0">
                        <span>Kategori Produk: </span>
                        <ul class="d-flex">
                            <li>
                                <a href="{{ '/'.$productDetails['category']['url'] }}">{{ $productDetails['category']['category_name'] }}
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="pro-details-categories-info pro-details-same-style d-flex m-0">
                        <span>Warna Produk: </span>
                        <ul class="d-flex">
                            <li>
                                <a href="#">{{$productDetails['product_color']}} </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="description-review-wrapper">
                    <div class="description-review-topbar nav">
                        <button class="active" data-bs-toggle="tab" data-bs-target="#des-details1">Deskripsi</button>
                        @if (isset($productDetails['product_video']) && !empty($productDetails['product_video']))
                            <button data-bs-toggle="tab" data-bs-target="#des-details3">Produk Video</button>
                        @endif
                    </div>
                    <div class="tab-content description-review-bottom" style="margin-top: -17px;">
                        <div id="des-details1" class="tab-pane active">
                            <div class="product-description-wrapper">
                                <p class="text-justify">
                                    {!!$productDetails['description']!!}
                                </p>
                            </div>
                        </div>
                        @if (isset($productDetails['product_video']) && !empty($productDetails['product_video']))
                            <div id="des-details3" class="tab-pane">
                                <div class="row">
                                <video class="afterglow" id="myvideo" width="100%" height="250">
                                <source type="video/mp4" src="{{ url('videos/products_videos/'.$productDetails['product_video']) }}" />
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr>
</div>
<!-- Product Area Start -->
<div class="product-area related-product">

    <div class="container">
        <!-- Section Title & Tab Start -->
        <div class="row">
            <div class="col-12">
                <div class="section-title text-center m-0">
                    <h2 class="title" style="float: left;">Rekomendasi Produk Unggulan</h2>
                    <p style="float: left; font-style: italic;">Rekomendasi produk unggulan menggunakan metode up selling.</p>
                </div>
            </div>
        </div>
        <!-- Section Title & Tab End -->
        <div class="row">
            <div class="col">
                <div class="new-product-slider swiper-container slider-nav-style-1">
                    <div class="swiper-wrapper">
                        @foreach ($upSelling as $item)
                        <div class="swiper-slide">
                            <!-- Single Prodect -->
                            <div class="product">
                                <span class="badges">
                                    <span class="new">Baru</span>
                                </span>
                                <div class="thumb">
                                    <a href="{{url('product/'. $item['id'])}}" class="image">
                                        <img src="{{asset('images/admin_images/product_images/medium/'.$item['main_image'])}}"
                                            alt="Product" />
                                        <img class="hover-image"
                                            src="{{asset('images/admin_images/product_images/medium/'.$item['main_image'])}}"
                                            alt="Product" />
                                    </a>
                                </div>
                                <div class="content">
                                    <span class="category mt-2"><a
                                            href="#">{{$item['category']['category_name']}}</a></span>
                                    <h5 class="title text-center"><a
                                            href="{{ url('product/'. $item['id']) }}">{{$item['product_name']}}
                                        </a>
                                    </h5>
                                    <span class="price">
                                        <span class="new">@currency($item['product_price'])</span>
                                    </span>
                                </div>
                                <div class="actions">
                                    <button title="Add To Cart" class="action add-to-cart" data-bs-toggle="modal"
                                        data-bs-target="#exampleModal-Cart"><i class="pe-7s-shopbag"></i></button>
                                    <button class="action wishlist" title="Wishlist" data-bs-toggle="modal"
                                        data-bs-target="#exampleModal-Wishlist"><i class="pe-7s-like"></i></button>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <!-- Add Arrows -->
                    <div class="swiper-buttons">
                        <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Product Area End -->

@endsection
