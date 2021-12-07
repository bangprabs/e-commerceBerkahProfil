@php
    use App\Models\Banner;
    $getBanner = Banner::getBanners();
@endphp
@if (isset($page_name) && $page_name=="index")
<div class="section ">
    <div class="hero-slider swiper-container slider-nav-style-1 slider-dot-style-1">
        <!-- Hero slider Active -->
        <div class="swiper-wrapper">
            <!-- Single slider item -->
            @foreach ($getBanner as $key => $banner)
            <div class="hero-slide-item slider-height swiper-slide bg-color1"
                data-bg-image="{{ url('/images/admin_images/banner_images/' . $banner['image'])}}">
                <div class="container h-100">
                    <div class="row h-100">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 align-self-center sm-center-view">
                            <div class="hero-slide-content slider-animated-1">
                                <span class="category">{{$banner['title']}}</span>
                                <h2 class="title-1">{!!$banner['description']!!}</h2>
                                <a href="{{ url($banner['link']) }}" class="btn btn-primary text-capitalize">Kunjungi</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <!-- Add Pagination -->
        <div class="swiper-pagination swiper-pagination-white"></div>
        <!-- Add Arrows -->
        <div class="swiper-buttons">
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
    </div>
</div>
@endif
