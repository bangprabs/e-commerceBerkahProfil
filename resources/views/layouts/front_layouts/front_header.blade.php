@php
use App\Models\Category;
$categories = Category::getCategories();
// dd($categories); die;
@endphp

<header>
    <!-- Header top area start -->
    <div class="header-top">
        <div class="container">
            <div class="row justify-content-between align-items-center">
                <div class="col">
                    <div class="welcome-text">
                        <p>Website E-Commerce Ornamen Eksterior Rumah Anda</p>
                    </div>
                </div>
                <div class="col d-none d-lg-block">
                    <div class="top-nav">
                        <ul>
                            <li><a href="tel:0123456789"><i class="fa fa-phone"></i> +62 821 1098 4618</a></li>
                            <li><a href="mailto:demo@example.com"><i class="fa fa-envelope-o"></i>
                                    berkahprofil@gmail.com</a></li>
                            @if (Auth::check())
                                <li><a href="{{ url('/account') }}"><i class="fa fa-user"></i> {{ Auth::user()->name }}</a></li>
                            @else
                                <li><a href="{{ url('/login-area') }}"><i class="fa fa-user"></i> Login / Register</a></li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Header top area end -->
    <!-- Header action area start -->
    <div class="header-bottom  d-none d-lg-block">
        <div class="container">
            <div class="row justify-content-between align-items-center">
                <div class="col-lg-3 col">
                    <div class="header-logo">
                        <a href="{{ url('/') }}"><img src="{{url('front_assets/images/logo/logo-light.png')}}" alt="Site Logo"
                                class="w-75" /></a>
                    </div>
                </div>
                <div class="col-lg-6 d-none d-lg-block">
                    <div class="search-element">
                        <form action="{{ url('/search-products') }}" method="GET"> @csrf
                            <input type="text" placeholder="Cari Produk" name="search"/>
                            <button><i class="pe-7s-search"></i></button>
                        </form>
                    </div>
                </div>
                <div class="col-lg-3 col">
                    <div class="header-actions">
                        <!-- Single Wedge Start -->
                        <a href="{{ url('/wishlist')}}" class="header-action-btn">
                            <i class="pe-7s-like"></i>
                            <span class="header-action-num totalWishlistItems">{{totalWishlistItems()}}</span>
                        </a>
                        <!-- Single Wedge End -->
                        <a href="{{url('/cart')}}"
                            class="header-action-btn header-action-btn-cart pr-0">
                             <i class="pe-7s-shopbag"></i>
                            <span class="header-action-num totalCartItems">{{totalCartItems()}}</span>
                        </a>
                        @if (Auth::check())
                        <a href="{{url('/logout')}}"
                            class="header-action-btn header-action-btn-cart pr-0">
                             <i class="pe-7s-power"></i>
                        </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Header action area end -->
    <!-- Header action area start -->
    <div class="header-bottom d-lg-none sticky-nav style-1">
        <div class="container">
            <div class="row justify-content-between align-items-center">
                <div class="col-lg-3 col">
                    <div class="header-logo">
                        <a href="index.html"><img src="{{url('front_assets/images/logo/logo.png')}}" alt="Site Logo" /></a>
                    </div>
                </div>
                <div class="col-lg-6 d-none d-lg-block">
                    <div class="search-element">
                        <form action="#">
                            <input type="text" placeholder="Search" />
                            <button><i class="pe-7s-search"></i></button>
                        </form>
                    </div>
                </div>
                <div class="col-lg-3 col">
                    <div class="header-actions">
                        <!-- Single Wedge Start -->
                        <a href="#offcanvas-wishlist" class="header-action-btn offcanvas-toggle">
                            <i class="pe-7s-like"></i>
                        </a>
                        <!-- Single Wedge End -->
                        <a href="#offcanvas-cart"
                            class="header-action-btn header-action-btn-cart offcanvas-toggle pr-0">
                            <i class="pe-7s-shopbag"></i>
                            <span class="header-action-num">01</span>
                            <!-- <span class="cart-amount">€30.00</span> -->
                        </a>
                        <a href="#offcanvas-mobile-menu"
                            class="header-action-btn header-action-btn-menu offcanvas-toggle d-lg-none">
                            <i class="pe-7s-menu"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Header action area end -->
    <!-- header navigation area start -->
    <div class="header-nav-area d-none d-lg-block sticky-nav">
        <div class="container">
            <div class="header-nav">
                <div class="main-menu position-relative">
                    <ul>
                        <li class="dropdown"><a href="{{ url('/') }}">Beranda </i></a></li>
                        <li class="dropdown position-static"><a href="about.html">Produk <i class="fa fa-angle-down"></i></a>
                            <ul class="mega-menu d-block">
                                <li class="d-flex">
                                    @foreach ($categories as $category)
                                    <ul class="d-block">
                                        <li class="title"><a href="{{ url($category['url'])}}">{{$category['category_name']}}</a></li>
                                        @foreach ($category['subcategories'] as $subcategory)
                                        <li><a href="{{ url($subcategory['url'])}}">{{ $subcategory['category_name'] }}</a></li>
                                        @endforeach
                                    </ul>
                                    @endforeach
                                    <ul class="d-flex align-items-center p-0 border-0 flex-column justify-content-center">
                                        <li>
                                            <a class="p-0" href="shop-left-sidebar.html"><img class="img-responsive w-100" src="{{url('front_assets/images/banner/menu-banner.png')}}" alt=""></a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li class="dropdown "><a href="#">Blog <i class="fa fa-angle-down"></i></a>
                            <ul class="sub-menu">
                                @foreach ($blogCategory as $categories)
                                <li class="dropdown position-static"><a href="">{{ $categories['name'] }}</a></li>
                                @endforeach
                            </ul>
                        </li>
                        <li><a href="{{ url('/contact') }}">Kontak Kami</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- header navigation area end -->
    <div class="mobile-search-box d-lg-none">
        <div class="container">
            <!-- mobile search start -->
            <div class="search-element max-width-100">
                <form action="#">
                    <input type="text" placeholder="Cari Produk" />
                    <button><i class="pe-7s-search"></i></button>
                </form>
            </div>
            <!-- mobile search start -->
        </div>
    </div>
</header>

<div class="offcanvas-overlay"></div>


<div id="offcanvas-mobile-menu" class="offcanvas offcanvas-mobile-menu">
    <button class="offcanvas-close"></button>
    <div class="user-panel">
        <ul>
            <li><a href="tel:0123456789"><i class="fa fa-phone"></i> +012 3456 789</a></li>
            <li><a href="mailto:demo@example.com"><i class="fa fa-envelope-o"></i> demo@example.com</a></li>
            <li><a href="my-account.html"><i class="fa fa-user"></i> Account</a></li>
        </ul>
    </div>
    <div class="inner customScroll">
        <div class="offcanvas-menu mb-4">
            <ul>
                <li><a href="#"><span class="menu-text">Home</span></a>
                    <ul class="sub-menu">
                        <li><a href="index.html"><span class="menu-text">Home 1</span></a></li>
                        <li><a href="index-2.html"><span class="menu-text">Home 2</span></a></li>
                    </ul>
                </li>
                <li><a href="about.html">About</a></li>
                <li>
                    <a href="#"><span class="menu-text">Pages</span></a>
                    <ul class="sub-menu">
                        <li>
                            <a href="#"><span class="menu-text">Inner Pages</span></a>
                            <ul class="sub-menu">
                                <li><a href="404.html">404 Page</a></li>
                                <li><a href="order-tracking.html">Order Tracking</a></li>
                                <li><a href="faq.html">Faq Page</a></li>
                                <li><a href="coming-soon.html">Coming Soon Page</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="#"><span class="menu-text"> Other Shop Pages</span></a>
                            <ul class="sub-menu">
                                <li><a href="cart.html">Cart Page</a></li>
                                <li><a href="checkout.html">Checkout Page</a></li>
                                <li><a href="compare.html">Compare Page</a></li>
                                <li><a href="wishlist.html">Wishlist Page</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="#"><span class="menu-text">Related Shop Page</span></a>
                            <ul class="sub-menu">
                                <li><a href="my-account.html">Account Page</a></li>
                                <li><a href="login.html">Login & Register Page</a></li>
                                <li><a href="empty-cart.html">Empty Cart Page</a></li>
                                <li><a href="thank-you-page.html">Thank You Page</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li><a href="#"><span class="menu-text">Shop</span></a>
                    <ul class="sub-menu">
                        <li>
                            <a href="#"><span class="menu-text">Shop Page</span></a>
                            <ul class="sub-menu">
                                <li><a href="shop-3-column.html">Shop 3 Column</a></li>
                                <li><a href="shop-4-column.html">Shop 4 Column</a></li>
                                <li><a href="shop-left-sidebar.html">Shop Left Sidebar</a></li>
                                <li><a href="shop-right-sidebar.html">Shop Right Sidebar</a></li>
                                <li><a href="shop-list-left-sidebar.html">Shop List Left Sidebar</a>
                                </li>
                                <li><a href="shop-list-right-sidebar.html">Shop List Right Sidebar</a>
                                </li>
                                <li><a href="cart.html">Cart Page</a></li>
                                <li><a href="checkout.html">Checkout Page</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="#"><span class="menu-text">product Details Page</span></a>
                            <ul class="sub-menu">
                                <li><a href="single-product.html">Product Single</a></li>
                                <li><a href="single-product-variable.html">Product Variable</a></li>
                                <li><a href="single-product-affiliate.html">Product Affiliate</a></li>
                                <li><a href="single-product-group.html">Product Group</a></li>
                                <li><a href="single-product-tabstyle-2.html">Product Tab 2</a></li>
                                <li><a href="single-product-tabstyle-3.html">Product Tab 3</a></li>
                                <li><a href="single-product-slider.html">Product Slider</a></li>
                                <li><a href="single-product-gallery-left.html">Product Gallery Left</a>
                            </ul>
                        </li>
                        <li>
                            <a href="#"><span class="menu-text">Single Product Page</span></a>
                            <ul class="sub-menu">
                                <li><a href="single-product-gallery-right.html">Product Gallery
                                        Right</a> </li>
                                <li><a href="single-product-sticky-left.html">Product Sticky Left</a>
                                </li>
                                <li><a href="single-product-sticky-right.html">Product Sticky Right</a>
                                </li>
                                <li><a href="compare.html">Compare Page</a></li>
                                <li><a href="wishlist.html">Wishlist Page</a></li>
                                <li><a href="my-account.html">Account Page</a></li>
                                <li><a href="login.html">Login & Register Page</a></li>
                                <li><a href="empty-cart.html">Empty Cart Page</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li><a href="#"><span class="menu-text">Blog</span></a>
                    <ul class="sub-menu">
                        <li><a href="blog-grid.html">Blog Grid Page</a></li>
                        <li><a href="blog-grid-left-sidebar.html">Grid Left Sidebar</a></li>
                        <li><a href="blog-grid-right-sidebar.html">Grid Right Sidebar</a></li>
                        <li><a href="blog-list.html">Blog List Page</a></li>
                        <li><a href="blog-list-left-sidebar.html">List Left Sidebar</a></li>
                        <li><a href="blog-list-right-sidebar.html">List Right Sidebar</a></li>
                        <li><a href="blog-single.html">Blog Single Page</a></li>
                        <li><a href="blog-single-left-sidebar.html">Single Left Sidebar</a></li>
                        <li><a href="blog-single-right-sidebar.html">Single Right Sidbar</a>
                    </ul>
                </li>
                <li><a href="contact.html">Contact Us</a></li>
            </ul>
        </div>
        <!-- OffCanvas Menu End -->
        <div class="offcanvas-social mt-auto">
            <ul>
                <li>
                    <a href="#"><i class="fa fa-facebook"></i></a>
                </li>
                <li>
                    <a href="#"><i class="fa fa-twitter"></i></a>
                </li>
                <li>
                    <a href="#"><i class="fa fa-google"></i></a>
                </li>
                <li>
                    <a href="#"><i class="fa fa-youtube"></i></a>
                </li>
                <li>
                    <a href="#"><i class="fa fa-instagram"></i></a>
                </li>
            </ul>
        </div>
    </div>
</div>

@include('layouts.front.breadcrumb.breadcrumb')

