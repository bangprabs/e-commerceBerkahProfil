<!DOCTYPE html>
<html lang="zxx" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @if (!empty($meta_title))
        <title>{{strip_tags($meta_title)}}</title>
    @else
        <title>Berkah Profil Commerce - Mart</title>
    @endif
    @if (!empty($meta_description))
        <meta name="description" content="{{$meta_description}}">
    @else
        <meta name="description" content="Hmart-Smart Product eCommerce html Template">
    @endif
    @if (!empty($meta_description))
        <meta name="keywords" content="{{$meta_keywords}}">
    @else
        <meta name="keywords" content="belanja e-commerce, berkah profil, lis beton, batu alam, roster">
    @endif
    <meta name="robots" content="index, follow" />
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('front_assets/images/favicon.ico')}}" />
    <!-- CSS
    ============================================ -->
    <link rel="stylesheet" href="{{asset('front_assets/css/bootstrap.min.css')}}" />
    <link rel="stylesheet" href="{{asset('front_assets/css/font.awesome.css')}}" />
    <link rel="stylesheet" href="{{asset('front_assets/css/pe-icon-7-stroke.css')}}" />
    <link rel="stylesheet" href="{{asset('front_assets/css/animate.min.css')}}">
    <link rel="stylesheet" href="{{asset('front_assets/css/swiper-bundle.min.css')}}">
    <link rel="stylesheet" href="{{asset('front_assets/css/venobox.css')}}">
    <link rel="stylesheet" href="{{asset('front_assets/css/jquery-ui.min.css')}}">
    <link href="{{asset('https://vjs.zencdn.net/7.17.0/video-js.css')}}" rel="stylesheet" />
    <link href="{{asset('https://unpkg.com/@videojs/themes@1/dist/city/index.css')}}" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="{{asset('admin_assets/css/vendors/rating.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('admin_assets/css/vendors/sweetalert2.css')}}">

    {{-- Sweet Alert --}}
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">

    {{-- <link href="{{ asset('front_assets/css/front-responsive.min.css') }}" rel="stylesheet"/> --}}
    <!-- Style CSS -->
    <link rel="stylesheet" href="{{asset('front_assets/css/style.css')}}">

</head>

<body>

    @include('layouts.front_layouts.front_header')

    @include('layouts.front.banners.home_page_banner')

    <div class="main-wrapper">
        <div class="shop-category-area pt-100px">
            <div class="container">
                <div class="row mb-10">
                    <div class="col-lg-9 order-lg-last col-md-12 order-md-first">
                        @yield('content')
                    </div>
                    <!-- Sidebar Area Start -->
                    <div class="col-lg-3 order-lg-first col-md-12 order-md-last">
                     @include('layouts.front_layouts.front_sidebar')
                    <!-- Sidebar Area End -->
                    </div>
                </div>
                @yield('checkout')

                @yield('cart')

                @yield('wishlist')

                @yield('thanks')

                @yield('cms_page')

                @yield('contact')

                @include('sweet::alert')

                @yield('thanks_trf')

                @include('layouts.front.blog.blog')
            </div>
        </div>

        @yield('maps')
        @include('layouts.front_layouts.front_footer')
        <!-- Footer Area End -->
    </div>

    @include('layouts.front.modals.modal')


    <!-- Global Vendor, plugins JS -->
    <!-- JS Files
    ============================================ -->
    <script src="{{asset('front_assets/js/vendor/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('front_assets/js/vendor/jquery-3.6.0.min.js')}}"></script>
    <script src="{{asset('front_assets/js/vendor/jquery-migrate-3.3.2.min.js')}}"></script>
    <script src="{{asset('front_assets/js/vendor/modernizr-3.11.2.min.js')}}"></script>
    <script src="{{asset('front_assets/js/plugins/jquery.countdown.min.js')}}"></script>
    <script src="{{asset('front_assets/js/plugins/swiper-bundle.min.js')}}"></script>
    <script src="{{asset('front_assets/js/plugins/scrollUp.js')}}"></script>
    <script src="{{asset('front_assets/js/plugins/venobox.min.js')}}"></script>
    <script src="{{asset('front_assets/js/plugins/jquery-ui.min.js')}}"></script>
    <script src="{{asset('front_assets/js/plugins/mailchimp-ajax.js')}}"></script>
    <script src="{{asset('front_assets/js/jquery.validate.js')}}"></script>
    <script type="text/javascript" src="{{asset('//cdn.jsdelivr.net/afterglow/latest/afterglow.min.js')}}"></script>
    <script src="{{asset('admin_assets/js/rating/jquery.barrating.js')}}"></script>
    <script src="{{asset('admin_assets/js/rating/rating-script.js')}}"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <style>
        form.cmxform label.error, label.error {
            color: red;
            font-style: italic;
            font-weight: bold;
            margin-top: -20px;
        }
    </style>

    <!-- Minify Version -->
    <!-- <script src="assets/js/vendor.min.js"></script>
    <script src="assets/js/plugins.min.js"></script>
    <script src="assets/js/main.min.js"></script> -->

    <!--Main JS (Common Activation Codes)-->
    <script src="{{asset('front_assets/js/main.js')}}"></script>

    <script src="{{url('/js/front_script.js')}}"></script>

    <script>
        $(document).ready(function(){
            $( "#slider-range" ).slider({
            range: true,
            min: 0,
            max: 100000,
            values: [ 1000, 1000000 ],
            slide: function( event, ui ) {
                $( "#amount" ).val( "Rp. " + ui.values[ 0 ] + " - Rp." + ui.values[ 1 ] );
            }
            });
            $( "#amount" ).val( "Rp. " + $( "#slider-range" ).slider( "values", 0 ) +
            " - Rp. " + $( "#slider-range" ).slider( "values", 1 ) );

        });

    </script>

    <script>
        var player = videojs('#my-video');

        player.addClass('vjs-matrix');
    </script>

</body>

</html>
