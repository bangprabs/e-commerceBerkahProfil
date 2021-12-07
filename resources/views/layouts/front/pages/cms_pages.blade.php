@extends('layouts.front_layouts.front_layout')
@section('cms_page')

<div class="product-area related-product">
    <div class="container">
        {!!$cmsPageDetails['description']!!}
    </div>
</div>
<!-- Product Area End -->

@endsection
