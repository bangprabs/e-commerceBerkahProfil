@extends('layouts.front_layouts.front_layout')
@section('contact')
<!-- Contact Area Start -->
<div class="contact-area" style="margin-bottom: -100px; margin-top: -80px">
    <div class="container">
        @if (Session::has('error_message'))
        <div class="mr-3 ml-3">
            <div class="mt-4 alert alert-danger alert-dismissible fade show" role="alert">
                {{ Session::get('error_message')}}
            </div>
        </div>
        @endif

        @if (Session::has('success_message'))
            <div class="mr-3 ml-3">
                <div class="mt-4 alert alert-success alert-dismissible fade show" role="alert">
                    {{ Session::get('success_message')}}
                </div>
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger dark alert-dismissible fade show" role="alert">
                @foreach ($errors->all() as $error)
                {{ $error }} <br>
                @endforeach
            </div>
        @endif
        <div class="contact-wrapper">
            <div class="row">
                <div class="col-12">
                    <div class="contact-form">
                        <div class="contact-title mb-30">
                            <h2 class="title">Kirimkan Pertanyaan</h2>
                        </div>
                        <form class="contact-form-style"
                            action="{{ url('/contact') }}" method="post">@csrf
                            <div class="row">
                                <div class="col-lg-6">
                                    <input name="name" placeholder="Masukkan Nama" type="text" />
                                </div>
                                <div class="col-lg-6">
                                    <input name="email" placeholder="Masukkan Email" type="email" />
                                </div>
                                <div class="col-lg-12">
                                    <input name="subject" placeholder="Subject*" type="text" />
                                </div>
                                <div class="col-lg-12 text-center">
                                    <textarea name="message" placeholder="Masukkan Pesan*"></textarea>
                                    <button class="btn btn-primary" type="submit">Kirim Message</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-12">
                    <div class="contact-info">
                        <div class="single-contact">
                            <div class="icon-box">
                                <img src="{{url('front_assets/images/icons/contact-1.png')}}" alt="">
                            </div>
                            <div class="info-box">
                                <h5 class="title">Alamat</h5>
                                <p>Your address goes here. <br>
                                    123 Your Location</p>
                            </div>
                        </div>
                        <div class="single-contact">
                            <div class="icon-box">
                                <img src="{{url('front_assets/images/icons/contact-2.png')}}" alt="">
                            </div>
                            <div class="info-box">
                                <h5 class="title">Telepon</h5>
                                <p><a href="tel:0123456789">+012 345 67 89</a></p>
                                <p><a href="tel:0123456789">+012 345 67 89</a></p>
                            </div>
                        </div>
                        <div class="single-contact m-0">
                            <div class="icon-box">
                                <img src="{{url('front_assets/images/icons/contact-3.png')}}" alt="">
                            </div>
                            <div class="info-box">
                                <h5 class="title">Email/Web</h5>
                                <p><a href="mailto:demo@example.com">demo@example.com</a></p>
                                <p><a href="https://www.example.com">www.example.com</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Contact Area End -->
<!-- map Area Start -->
@section('maps')
<div class="contact-map">
    <div id="mapid">
        <div class="mapouter">
            <div class="gmap_canvas">
                <iframe id="gmap_canvas"
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d833.4692926971333!2d106.85203500998323!3d-6.436355690481916!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69eb7768ee34cd%3A0xe25a76f7f43d387b!2sSimpang%20Cilodong!5e0!3m2!1sid!2sid!4v1636774175331!5m2!1sid!2sid"></iframe>
                <a href="https://sites.google.com/view/maps-api-v2/mapv2"></a>
            </div>
        </div>
    </div>
</div>
@endsection
<!-- map Area End -->
<!-- Product Area End -->
@endsection
