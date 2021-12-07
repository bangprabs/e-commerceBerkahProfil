@if (isset($page_name) && $page_name=="listing" || $page_name=="detail" || $page_name=="account" || $page_name=="cart" || $page_name=="checkout" || $page_name=="delivery_address" || $page_name=="orderdetails" || $page_name=="Search" || $page_name=="cms_page" || $page_name=="contact" || $page_name=="wishlist")
<div class="breadcrumb-area" style="object-fit: contain; width: 100%;
@if (Request::is('product/*'))
    background-image: url({{url('images/admin_images/category_images/'.$productDetails['category']['category_image'])}});
@elseif(Request::is('account'))
    background-image: url({{url('front_assets/images/banner/myaccount.png')}});
@elseif(Request::is('cart'))
    background-image: url({{url('front_assets/images/banner/cart.png')}});
@elseif(Request::is('checkout'))
    background-image: url({{url('front_assets/images/banner/checkout.png')}});
@elseif(Request::is('add-edit-delivery-address', 'add-edit-delivery-address/*'))
    background-image: url({{url('front_assets/images/banner/bannerdelivery.jpg')}});
@elseif(Request::is('orders/*'))
    background-image: url({{url('front_assets/images/banner/ordersbanner.png')}});
@elseif($page_name == "wishlist")
    background-image: url({{url('front_assets/images/banner/myaccount.png')}});
@else
    background-image: url({{url('front_assets/images/about/bannerproduct.jpg')}});"
@endif>
    <div class="container">
        <div class="row align-items-center justify-content-center">
            <div class="col-12 text-center">
                <h2 class="breadcrumb-title" style="color: #fff;">
                    @if (Request::is('product/*'))
                        {{ $productDetails['category']['category_name'] }}
                    @elseif(Request::is('account'))
                        Your Account
                    @elseif(Request::is('cart'))
                        Keranjang Belanja
                    @elseif(Request::is('checkout'))
                        Checkout
                    @elseif(Request::is('add-edit-delivery-address', 'add-edit-delivery-address/*'))
                        Delivery Address
                    @elseif(Request::is('orders/*'))
                        Detail Order Produk
                    @elseif($page_name == "Search")
                        {{$categoryDetails['catDetails']['description']}}
                    @elseif($page_name == "cms_page")
                        {{$cmsPageDetails['title']}}
                    @elseif($page_name == "listing")
                        {{$categoryDetails['catDetails']['category_name']}}
                    @elseif($page_name == "contact")
                        Kontak
                    @elseif($page_name == "wishlist")
                        Wishlist Barang
                    @endif
                </h2>
                <!-- breadcrumb-list start -->
                <ul class="breadcrumb-list">
                    <li class="breadcrumb-item"><a style="color: #fff;" href="index.html">Berkah Profil E - Commerce</a></li>
                </ul>
                <!-- breadcrumb-list end -->
            </div>
        </div>
    </div>
</div>
@endif
