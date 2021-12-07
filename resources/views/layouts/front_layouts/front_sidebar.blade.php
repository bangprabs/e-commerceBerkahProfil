@php
use App\Models\Category;
use App\Models\Product;
$categories = Category::getCategories();
// dd($categories); die;
@endphp

@if (isset($page_name) && $page_name!="account" && $page_name!="cart" && $page_name!="checkout" && $page_name!="delivery_address" && $page_name!="thanks" && $page_name!="orderdetails" && $page_name!="thanks_trf" && $page_name!="cms_page" && $page_name!="contact" && $page_name!="wishlist")
<div class="shop-sidebar-wrap">
    <!-- Sidebar single item -->
    <div class="sidebar-widget">
        <h4 class="sidebar-title">Kategori</h4>
        <div class="sidebar-widget-category">
            @foreach ($categories as $category)
            <ul>
                @php
                    $productsCounts = Product::productCount($category['id'])
                @endphp
                <li class="title"><a href="{{ url($category['url'])}}"><span style="font-weight: bold;" >{{$category['category_name']}} <b>({{$productsCounts}})</b></span></a></li>
                @foreach ($category['subcategories'] as $subcategory)
                @php
                    $productsCount = Product::productCountSubCategory($subcategory['id'])
                @endphp
                <li> <a href="{{ url($subcategory['url'])}}">{{ $subcategory['category_name'] }} <b>({{$productsCount}})</b></a></li>
                @endforeach
            </ul>
            @endforeach
        </div>
    </div>
    <!-- Sidebar single item -->
    <div class="sidebar-widget mt-8">
        <h4 class="sidebar-title">Filter Harga</h4>
        <div class="price-filter">
            <div class="price-slider-amount">
                <input type="text" id="amount" class="p-0 h-auto lh-1" name="price" placeholder="Add Your Price" />
            </div>
            <div id="slider-range"></div>
        </div>
    </div>
    <!-- Sidebar single item -->
    <div class="sidebar-widget">
        <h4 class="sidebar-title">Warna Produk</h4>
        <div class="sidebar-widget-color">
            <ul class="d-flex flex-wrap">
                <li><a href="#" class="color-1"></a></li>
                <li><a href="#" class="color-2"></a></li>
                <li><a href="#" class="color-3"></a></li>
                <li><a href="#" class="color-4"></a></li>
                <li><a href="#" class="color-5"></a></li>
                <li><a href="#" class="color-6"></a></li>
                <li><a href="#" class="color-7"></a></li>
                <li><a href="#" class="color-8"></a></li>
                <li><a href="#" class="color-9"></a></li>
                <li><a href="#" class="color-10"></a></li>
                <li><a href="#" class="color-11"></a></li>
                <li><a href="#" class="color-12"></a></li>
                <li><a href="#" class="color-13"></a></li>
                <li><a href="#" class="color-14"></a></li>
            </ul>
        </div>
    </div>
    <div class="sidebar-widget">
        <h4 class="sidebar-title">Kategori Blog Artikel</h4>
        <div class="sidebar-widget-category">
            @foreach ($blogCategory as $category)
            <ul>
                <li class="title"><a href=""><span style="font-weight: bold;" >{{$category['name']}}</span></a></li>
            </ul>
            @endforeach
        </div>
    </div>
</div>
</div>
@endif

<!-- Nav tabs -->
@if (isset($page_name) && $page_name=="account" && $page_name!="cart" && $page_name!="checkout" && $page_name!="delivery_address" && $page_name!="thanks" && $page_name!="thanks_trf")
<div class="dashboard_tab_button" data-aos="fade-up" data-aos-delay="0">
    <ul role="tablist" class="nav flex-column dashboard-list">
        <li><a href="#dashboard" data-bs-toggle="tab" class="nav-link active">Dashboard</a></li>
        <li><a href="#orders" data-bs-toggle="tab" class="nav-link">Orders</a></li>
        <li><a href="#address" data-bs-toggle="tab" class="nav-link">Addresses Info</a></li>
        <li><a href="#account-details" data-bs-toggle="tab" class="nav-link">Account details</a></li>
        <li><a href="#update-password" data-bs-toggle="tab" class="nav-link">Update Password</a></li>
        <li><a href="{{('/logout')}}" class="nav-link">logout</a></li>
    </ul>
</div>
@endif
