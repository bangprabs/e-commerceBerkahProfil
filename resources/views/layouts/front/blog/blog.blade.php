<!-- Blog area start from here -->
 <!-- Brand area start -->
 @if (isset($page_name) && $page_name=="index")
 <div class="brand-area pt-100px pb-100px" style="margin-top: 50px;">
    <div class="container">
        <div class="brand-slider swiper-container">
            <div class="swiper-wrapper align-items-center">
                <div class="swiper-slide brand-slider-item text-center">
                    <a href="#"><img class=" img-fluid" src="{{url('front_assets/images/partner/1.png')}}" alt="" /></a>
                </div>
                <div class="swiper-slide brand-slider-item text-center">
                    <a href="#"><img class=" img-fluid" src="{{url('front_assets/images/partner/2.png')}}" alt="" /></a>
                </div>
                <div class="swiper-slide brand-slider-item text-center">
                    <a href="#"><img class=" img-fluid" src="{{url('front_assets/images/partner/3.png')}}" alt="" /></a>
                </div>
                <div class="swiper-slide brand-slider-item text-center">
                    <a href="#"><img class=" img-fluid" src="{{url('front_assets/images/partner/4.png')}}" alt="" /></a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Brand area end -->

<div class="main-blog-area pb-100px">
    <div class="container">
        <!-- section title start -->
        <div class="row">
            <div class="col-md-12">
                <div class="section-title text-center mb-30px0px">
                    <h2 class="title">Blog Artikel</h2>
                    <p> Membahas Artikel Blog tentang Desain Rumah dan lainnya !</p>
                </div>
            </div>
        </div>
        <!-- section title start -->
        <div class="row">
            @foreach ($blog as $item)
            <div class="col-lg-6 col-sm-6 mb-xs-30px">
                <div class="single-blog">
                    <div class="blog-image">
                        <a href="blog-single-left-sidebar.html"><img src="{{asset('images/admin_images/blog_main_images/'.$item['main_image'])}}" class="img-responsive w-100" alt=""></a>
                    </div>
                    <div class="blog-text">
                        <div class="blog-athor-date line-height-1">
                            <span class="blog-date"><i class="fa fa-calendar" aria-hidden="true"></i> {{\Carbon\Carbon::parse($item['blog_date'])->format('d M Y')}}</span>
                            <a class="blog-author font-weight-bold" href="blog-grid.html"><i style="color: #266bf9" class="fa fa-user" aria-hidden="true"></i> {{$item['blog_author']}}</a>
                        </div>
                        <h5 class="blog-heading" style="margin-bottom: -10px;"><a class="blog-heading-link" href="blog-single-left-sidebar.html">{{$item['blog_title']}}</a></h5>
                        <p>{!! \Illuminate\Support\Str::words($item['blog_content'], 10, '...') !!}</p>
                        <a href="{{ url('blog/'. $item['id']) }}" class="btn btn-primary blog-btn"> Read More</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endif
<!-- Blog area end here -->
