@extends('layouts.front.users.login_register')
@section('login_regist')
<section class="fxt-template-animation fxt-template-layout29">
    <div class="container-fluid">
        <div class="row">
            <div class="vegas-container col-md-6 col-12 fxt-bg-img" id="vegas-slide" data-vegas-options='{"delay":5000, "timer":false,"animation":"kenburns", "transition":"swirlLeft", "slides":[{"src": "https://arsitagx-master-article.s3.ap-southeast-1.amazonaws.com/article-photo/533/gbr-2-facade-rumah-sela.jpeg"}, {"src": "http://lh3.googleusercontent.com/-jcuH5XYXIjo/VrFEemlNiEI/AAAAAAAAIao/yS9YjhdWmvw/s1600/IMG20151215140132.jpg"}, {"src": "https://www.realoka.com/pictures/11/rumah-pondok-indah-94585q0m9p.jpg"}]}'>
                <div class="fxt-page-switcher">
                    <a href="{{ url('/login-area') }}" class="switcher-text1">Login</a>
                    <a href="{{ url('/register-area') }}" class="switcher-text1">Register</a>
                </div>
            </div>
            <div class="col-md-6 col-12 fxt-bg-color">
                <div class="fxt-content">
                    <div class="fxt-header">
                        <a href="{{ url('/login') }}" class="fxt-logo"><img src="{{asset('front_assets/images/logo/logo_login/logo.png')}}" alt="Logo"></a>
                    </div>
                    <div class="fxt-form">
                        <div class="fxt-transformY-50 fxt-transition-delay-1">
                            <h2>Forgot Password</h2>
                        </div>
                        <div class="fxt-transformY-50 fxt-transition-delay-2">
                            <p>For recover your password</p>
                        </div>
                        <form method="POST">
                            <div class="form-group">
                                <div class="fxt-transformY-50 fxt-transition-delay-1">
                                    <input type="email" class="form-control" name="email" placeholder="Email Address" required="required">
                                    <i class="flaticon-envelope"></i>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="fxt-transformY-50 fxt-transition-delay-3">
                                    <button type="submit" class="fxt-btn-fill">Send Me Email</button>
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
