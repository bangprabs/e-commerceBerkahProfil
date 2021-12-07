<div class="sidebar-wrapper">
    <div>
        <div class="logo-wrapper p-3" style="padding-bottom: 0px"><a href="index.html"><img class="img-fluid for-light" style="width: 80%;"
                    src="{{url('/admin_assets/images/logo/logo.png')}}" alt=""><img class="img-fluid for-dark"
                    src="{{url('/admin_assets/images/logo/logo-dark.png')}}" alt=""></a>
            <div class="back-btn"><i class="fa fa-angle-left"></i></div>
            <div class="toggle-sidebar"><i class="status_toggle middle sidebar-toggle" data-feather="grid"> </i></div>
        </div>
        <div class="logo-icon-wrapper"><a href="index.html"><img class="img-fluid"
                    src="{{url('/admin_assets/images/logo/logo-icon')}}.png" alt=""></a></div>
        <nav class="sidebar-main">
            <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
            <div id="sidebar-menu">
                <ul class="sidebar-links" style="margin-top: 20px;" id="simple-bar">
                    <li class="back-btn"><a href="index.html"><img class="img-fluid"
                                src="{{url('/admin_assets/images/logo/logo-icon')}}.png" alt=""></a>
                        <div class="mobile-back text-end"><span>Back</span><i class="fa fa-angle-right ps-2"
                                aria-hidden="true"></i></div>
                    </li>
                    <li class="sidebar-list mb-2"><a
                            class="sidebar-link sidebar-title link-nav {{ Request::is('admin/dashboard') ? 'actives' : '' }}"
                            href="{{ url('admin/dashboard') }}"><i data-feather="home"> </i><span>Dashboard</span></a>
                    </li>
                    @if(Auth::guard('admin')->user()->type=="superadmin" || Auth::guard('admin')->user()->type=="admin")
                    <li class="sidebar-list"><a
                        class="sidebar-link sidebar-title {{ Request::is('admin/settings', 'admin/update-admin-details', 'admin/admins-subadmins', 'admin/update-role/*') ? 'actives' : '' }}"
                        href="#"><i data-feather="user"></i><span>Area Admin</span></a>
                        <ul class="sidebar-submenu {{ Request::is('admin/settings', 'admin/update-admin-details', 'admin/admins-subadmins', 'admin/update-role/*') ? 'blocks' : '' }}">
                            <li><a href="{{ url('admin/admins-subadmins') }}"
                                class="{{ Request::is('admin/admins-subadmins', 'admin/update-role/*') ? 'actives' : '' }}">Admin / Subadmin</a>
                            </li>
                            <li><a href="{{ url('admin/settings') }}"
                                    class="{{ Request::is('admin/settings') ? 'actives' : '' }}">Ganti Password</a>
                            </li>
                            <li><a href="{{ url('admin/update-admin-details') }}"
                                    class="{{ Request::is('admin/update-admin-details') ? 'actives' : '' }}">Ubah Detail Profil</a></li>
                        </ul>
                    </li>
                    @endif
                    <li class="sidebar-list mt-2 mb-2"><a
                            class="sidebar-link sidebar-title {{ Request::is('admin/categories', 'admin/add-edit-category/*', 'admin/add-edit-category/', 'admin/products', 'admin/add-edit-product/*', 'admin/add-edit-product', 'admin/add-attributes/*', 'admin/add-images/*', 'admin/coupons', 'admin/add-edit-coupon/*', 'admin/add-edit-coupon', 'admin/orders', 'admin/view-shipping-charges', 'admin/edit-shipping-charges/*') ? 'actives' : '' }}"
                            href="#"><i data-feather="shopping-bag"></i><span>Katalog</span></a>
                        <ul
                            class="sidebar-submenu {{ Request::is('admin/categories', 'admin/add-edit-category/*', 'admin/add-edit-category/', 'admin/products', 'admin/add-edit-product/*', 'admin/add-edit-product', 'admin/add-attributes/*', 'admin/add-images/*', 'admin/coupons', 'admin/add-edit-coupon/*', 'admin/add-edit-coupon', 'admin/orders', 'admin/view-shipping-charges', 'admin/edit-shipping-charges/*') ? 'blocks' : '' }}">
                            <li>
                                <a href="{{ url('admin/categories') }}"
                                    class="{{ Request::is('admin/categories', 'admin/add-edit-category/*', 'admin/add-edit-category/') ? 'actives' : '' }}">Daftar Kategori</a>
                            </li>
                            <li>
                                <a href="{{ url('admin/products') }}"
                                    class="{{ Request::is('admin/products', 'admin/add-edit-product/*', 'admin/add-edit-product', 'admin/add-attributes/*', 'admin/add-images/*') ? 'actives' : '' }}">Daftar Produk</a>
                            </li>
                            <li>
                                <a href="{{ url('admin/coupons') }}"
                                    class="{{ Request::is('admin/coupons', 'admin/add-edit-coupon/*', 'admin/add-edit-coupon') ? 'actives' : '' }}">Daftar Kupon</a>
                            </li>
                            <li>
                                <a href="{{ url('admin/orders') }}"
                                    class="{{ Request::is('admin/orders', 'admin/add-edit-coupon/*', 'admin/add-edit-coupon') ? 'actives' : '' }}">Daftar Orderan</a>
                            </li>
                            <li>
                                <a href="{{ url('admin/view-shipping-charges') }}"
                                    class="{{ Request::is('admin/view-shipping-charges', 'admin/edit-shipping-charges/*') ? 'actives' : '' }}">Biaya Pengiriman</a>
                            </li>
                        </ul>
                    </li>
                    <li class="sidebar-list mt-2 mb-2"><a
                        class="sidebar-link sidebar-title {{ Request::is('admin/users', 'admin/rating') ? 'actives' : '' }}"
                        href="#"><i data-feather="users"></i><span>Data Pengguna</span></a>
                    <ul
                        class="sidebar-submenu {{ Request::is('admin/users', 'admin/rating') ? 'blocks' : '' }}">
                        <li>
                            <a href="{{ url('admin/users') }}"
                                class="{{ Request::is('admin/users') ? 'actives' : '' }}">Daftar Pengguna Aplikasi</a>
                        </li>
                        <li>
                            <a href="{{ url('admin/rating') }}"
                                class="{{ Request::is('admin/rating') ? 'actives' : '' }}">Daftar Ulasan</a>
                        </li>
                    </ul>
                </li>
                    <li class="sidebar-list mb-2"><a
                        class="sidebar-link sidebar-title link-nav {{ Request::is('admin/cms-pages') ? 'actives' : '' }}"
                        href="{{ url('admin/cms-pages') }}"><i data-feather="cpu"> </i><span>Setting CMS</span></a>
                    </li>
                    <li class="sidebar-list mt-2"><a
                            class="sidebar-link sidebar-title {{ Request::is('admin/category-blog', 'admin/blogs', 'admin/add-edit-blog/*', 'admin/add-edit-blog') ? 'actives' : '' }}"
                            href="#"><i data-feather="airplay"></i><span>Data Blog Artikel</span></a>
                        <ul
                            class="sidebar-submenu {{ Request::is('admin/category-blog', 'admin/blogs', 'admin/add-edit-blog/*', 'admin/add-edit-blog') ? 'blocks' : '' }}">
                            <li>
                                <a href="{{ url('admin/category-blog') }}"
                                    class="{{ Request::is('admin/category-blog') ? 'actives' : '' }}">Daftar Blog Kategori</a>
                            </li>
                            <li>
                                <a href="{{ url('admin/blogs') }}"
                                    class="{{ Request::is('admin/blogs', 'admin/add-edit-blog/*', 'admin/add-edit-blog') ? 'actives' : '' }}">Daftar Blog Artikel</a>
                            </li>
                        </ul>
                    </li>
                    <li class="sidebar-list mt-2"><a
                            class="sidebar-link sidebar-title {{ Request::is('admin/banners', 'admin/add-edit-banners/*', 'admin/add-edit-banners/') ? 'actives' : '' }}"
                            href="#"><i data-feather="image"></i><span>Banner Area</span></a>
                        <ul
                            class="sidebar-submenu {{ Request::is('admin/banners', 'admin/add-edit-banners/*', 'admin/add-edit-banners/') ? 'blocks' : '' }}">
                            <li>
                                <a href="{{ url('admin/banners') }}"
                                    class="{{ Request::is('admin/banners', 'admin/add-edit-banners/*', 'admin/add-edit-banners/') ? 'actives' : '' }}">Daftar Banner</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
            <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
        </nav>
    </div>
</div>
