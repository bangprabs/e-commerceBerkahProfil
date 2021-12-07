@extends('layouts.front.users.login_register')
@section('login_regist')
<section class="fxt-template-animation fxt-template-layout29">
    <div class="container-fluid">
        <div class="row">
            <div class="vegas-container col-md-6 col-12 fxt-bg-img" id="vegas-slide" data-vegas-options='{"delay":5000, "timer":false,"animation":"kenburns", "transition":"swirlLeft", "slides":[{"src": "https://arsitagx-master-article.s3.ap-southeast-1.amazonaws.com/article-photo/533/gbr-2-facade-rumah-sela.jpeg"}, {"src": "http://lh3.googleusercontent.com/-jcuH5XYXIjo/VrFEemlNiEI/AAAAAAAAIao/yS9YjhdWmvw/s1600/IMG20151215140132.jpg"}, {"src": "https://www.realoka.com/pictures/11/rumah-pondok-indah-94585q0m9p.jpg"}]}'>
                <div class="fxt-page-switcher">
                    <a href="{{ url('/login-area') }}" class="switcher-text1 active">Login</a>
                    <a href="{{ url('/register-area') }}" class="switcher-text1">Register</a>
                </div>
            </div>
            <div class="col-md-6 col-12 fxt-bg-color">
                <div class="fxt-content">
                    <div class="fxt-header">
                        <a href="{{ url('/login') }}" class="fxt-logo"><img src="{{asset('front_assets/images/logo/logo_login/logo.png')}}" alt="Logo"></a>
                    </div>
                    <div class="fxt-transformY-50 fxt-transition-delay-1">
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
                    </div>
                    <div class="fxt-form">
                        <div class="fxt-transformY-50 fxt-transition-delay-1">
                            <h2>Log In</h2>
                        </div>
                        <div class="fxt-transformY-50 fxt-transition-delay-2">
                            <p>Log in untuk melanjutkan belanja</p>
                        </div>
                        <form id="loginForm" action="{{ url('/login') }}" method="post">@csrf
                            <div class="form-group">
                                <div class="fxt-transformY-50 fxt-transition-delay-4">
                                    <input class="form-control" type="text" id="email" name="email" placeholder="Enter Email">
                                    <i class="flaticon-envelope"></i>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="fxt-transformY-50 fxt-transition-delay-5">
                                    <input class="form-control" type="password" name="password" id="password" placeholder="Enter Password">
                                    <i class="flaticon-padlock"></i>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="fxt-transformY-50 fxt-transition-delay-6">
                                    <div class="fxt-content-between">
                                        <button type="submit" class="fxt-btn-fill">Log in</button>
                                        <a href="{{ url('/forgot-password') }}" class="switcher-text2">Lupa Password ? </a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
