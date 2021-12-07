<?php

// use Route;
use App\Models\Category;
use App\Models\CmsPage;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('/admin')->namespace('Admin')->group(function(){
    Route::match(['get', 'post'], '/', 'AdminController@login');

    Route::group(['middleware'=>['admin']], function(){
        Route::get('dashboard', 'AdminController@dashboard');
        Route::get('settings', 'AdminController@settings');
        Route::POST('check-current-pwd','AdminController@chkCurrentPassword');
        Route::POST('update-current-pwd','AdminController@updateCurrentPassword');
        Route::match(['get', 'post'], 'update-admin-details', 'AdminController@updateAdminDetails');
        Route::get('logout', 'AdminController@logout');

        //Route Category Blog
        Route::get('category-blog', 'CategoriesBlog@category');
        Route::post('update-catblog-status', 'CategoriesBlog@updateCatBlogStatus');

        //Route List Blog
        Route::get('blogs', 'BlogController@blog');
        Route::match(['get', 'post'], 'add-edit-blog/{id?}', 'BlogController@addEditCategory');
        Route::post('update-blog-status', 'BlogController@updateBlogStatus');
        Route::get('delete-blog/{id}','BlogController@deleteBlog');
        Route::post('ckeditor/upload', 'BlogController@upload')->name('ckeditor.upload');

        //Banners Route
        Route::get('banners', 'BannerController@banners');
        Route::match(['get', 'post'], 'add-edit-banner/{id?}', 'BannerController@addEditBanner');
        Route::post('update-banner-status', 'BannerController@updateBannerStatus');
        Route::get('delete-banner/{id}','BannerController@deleteBanner');

        //Section Route
        Route::get('sections', 'SectionController@sections');
        Route::match(['get', 'post'], 'add-edit-section/{id?}', 'SectionController@addEditSections');
        Route::post('update-sections-status', 'SectionController@updateSectionsStatus');
        Route::get('delete-sections/{id}','SectionController@deleteSections');

        // Categories Route
        Route::get('categories','CategoryController@categories');
        Route::post('update-category-status', 'CategoryController@UpdateCategoryStatus');
        Route::match(['get', 'post'], 'add-edit-category/{id?}', 'CategoryController@addEditCategory');
        Route::post('append-categories-level', 'CategoryController@appendCategoryLevel');
        Route::get('delete-category-image/{id}','CategoryController@deleteCategoryImage');
        Route::get('delete-category/{id}','CategoryController@deleteCategory');

        //Products Route
        Route::get('products', 'ProductController@products');
        Route::post('update-product-status', 'ProductController@updateProductStatus');
        Route::get('delete-product/{id}','ProductController@deleteProduct');
        Route::match(['get', 'post'], 'add-edit-product/{id?}', 'ProductController@addEditProduct');
        Route::get('delete-product-image/{id}','ProductController@deleteProductImage');
        Route::get('delete-product-video/{id}','ProductController@deleteProductVideo');

         //Attributes Route
        Route::match(['get', 'post'], 'add-attributes/{id}', 'ProductController@addAttributes');
        Route::post ('edit-attributes/{id}', 'ProductController@editAttributes');
        Route::post('update-attribute-status', 'ProductController@updateAttributeStatus');
        Route::get('delete-attribute/{id}','ProductController@deleteAttributes');

        //Images Route
        Route::match(['get', 'post'], 'add-images/{id}', 'ProductController@addImages');
        Route::post('update-images-status', 'ProductController@updateImagesStatus');
        Route::get('delete-image/{id}','ProductController@deleteImage');

        //Coupons Route
        Route::get('coupons', 'CouponsController@coupons');
        Route::post('update-coupon-status', 'CouponsController@updateCouponStatus');
        Route::match(['get', 'post'], 'add-edit-coupon/{id?}', 'CouponsController@addEditCoupon');
        Route::get('delete-coupon/{id}','CouponsController@deleteCoupon');

        //Orders Route
        Route::get('orders', 'OrdersController@orders');
        Route::get('orders/{id}', 'OrdersController@ordersDetails');
        Route::post('update-order-status', 'OrdersController@updateOrderStatus');
        Route::get('view-order-invoice/{id}', 'OrdersController@viewOrderInvoice');

        //Route Ongkos Kirim
        Route::get('view-shipping-charges', 'ShippingController@viewShippingCharges');
        Route::match(['get', 'post'], 'edit-shipping-charges/{id?}', 'ShippingController@editShippingCharges');
        Route::post('update-shipping-status', 'ShippingController@updateShippingStatus');

        //List users
        Route::get('users', 'UsersController@users');
        Route::post('update-user-status', 'UsersController@updateUserStatus');

        //Summary users, order, user country
        Route::get('view-users-charts', 'UsersController@viewUserCharts');
        Route::get('view-orders-charts', 'OrdersController@viewOrderCharts');
        Route::get('view-users-city-charts', 'UsersController@viewUserCityCharts');

        //cms page
        Route::get('cms-pages', 'CmsController@cmspages');
        Route::post('update-page-status', 'CmsController@updateCmsStatus');
        Route::get('delete-page/{id}','CmsController@deletePage');
        Route::match(['get','post'], 'add-edit-cms-page/{id?}', 'CmsController@addEditCmsPage');

        //admin route
        Route::get('admins-subadmins', 'AdminController@adminsSubadmins');
        Route::post('update-admin-status', 'AdminController@updateAdminStatus');
        Route::get('delete-admin/{id}','AdminController@deleteAdmin');
        Route::match(['get','post'], 'add-edit-admin-subadmin/{id?}', 'AdminController@addEditAdminSubadmin');
        Route::match(['get', 'post'], 'update-role/{id}', 'AdminController@updateRole');

        //Route ulasan
        Route::get('rating', 'RatingsController@ratings');
        Route::post('update-rating-status', 'RatingsController@updateRatingStatus');
    });
});

Route::namespace('Front')->group(function (){

    Route::get('/', 'IndexController@index');

    // Get categeory url
    $catUrls = Category::select('url')->where('status', 1)->get()->pluck('url')->toArray();
    foreach ($catUrls as $url) {
        Route::get('/'.$url, 'ProductController@listing');
    }

    // Get CMS url
    $cmsUrls = CmsPage::select('url')->where('status', 1)->get()->pluck('url')->toArray();
    foreach ($cmsUrls as $url) {
        Route::get('/'.$url, 'CmsController@cmsPage');
    }

    //dummy route
    Route::get('/order-email', function () {
    return view('emails.orders');
    });

    // Details page route
    Route::get('/product/{id}', 'ProductController@detail');
    //Get product attribute price
    Route::post('/get-product-price', 'ProductController@getProductPrice');
    // Add to cart Route
    Route::post('/add-to-cart', 'ProductController@addToCart');
    // Shopping cart Routes
    Route::get('/cart', 'ProductController@cart');
    //Route for update qty in cart
    Route::post('/update-cart-item-qty', 'ProductController@updateCartItemQty');
    //Delete cart items
    Route::post('/delete-cart-item', 'ProductController@deleteCartItem');
    //Login page
    Route::get('/login-area', ['as'=>'login','uses'=>'UserController@loginPage']);
    //Register page
    Route::get('/register-area', 'UserController@registerPage');
    //Route login user
    Route::post('/login', 'UserController@loginUser');
    //Route regist user
    Route::post('/register', 'UserController@registerUser');
    //Route check email already exist regist
    Route::match(['get', 'post'], '/check-email', 'UserController@checkEmail');
    //Route logout user
    Route::get('/logout', 'UserController@logout');
    //Confirm account
    Route::match(['get', 'post'], '/confirm/{code}', 'UserController@confirmAccount');
    //Route forgot password
    Route::match(['get', 'post'], '/forgot-password', 'UserController@forgotPassword');
    //Route check email already exist regist
    Route::match(['get', 'post'], '/check-email', 'UserController@checkEmail');
    //Check delivery pincode
    Route::post('/check-pincode', 'ProductController@checkPincode');
    //Route search
    Route::get('/search-products', 'ProductController@listing');
    //contact route
    Route::match(['get', 'post'], '/contact', 'CmsController@contact');
    //add rating
    Route::post('/add-rating', 'RatingsController@addRating');

    Route::group(['middleware'=>['auth']], function(){
        //route user account
        Route::match(['get', 'post'], '/account', 'UserController@account');
        //User order
        Route::get('/orders', 'OrdersController@orders');
        //User order details
        Route::get('/orders/{id}', 'OrdersController@orderDetails');
        //User cancel order
        Route::match(['GET', 'POST'],'/orders/{id}/cancel', 'OrdersController@orderCancel');
        //Route for checking user password
        Route::post('/check-user-password', 'UserController@userChkPassword');
        //Route update password
        Route::post('/update-password', 'UserController@updateUserPassword');
        //Apply Coupon
        Route::post('/apply-coupon', 'ProductController@applyCoupon');
        //Checkout Route
        Route::match(['GET', 'POST'], '/checkout', 'ProductController@checkout');
        //Add/Edit Delivery Address
        Route::match(['GET', 'POST'], '/add-edit-delivery-address/{id?}', 'ProductController@addEditDeliveryAddress');
        //Delete Address Delivery Address
        Route::get('/delete-delivery-address/{id}', 'ProductController@deleteDeliveryAddress');
        //Thanks Page COD
        Route::get('/thanks', 'ProductController@thanks');
        //Thanks Page Trf
        Route::get('/thanks-trf', 'ProductController@thanksTrf');
        //Paypal Page
        Route::get('/paypal', 'PaypalController@paypal');
        //Paypal Success
        Route::get('/paypal/success', 'PaypalController@success');
        //Paypal Fail
        Route::get('/paypal/fail', 'PaypalController@failed');
        //Paypal Fail
        Route::any('/paypal/ipn', 'PaypalController@ipn');
        //Payumoney Route
        Route::get('payumoney', 'PayumoneyController@payumoney');
        //Payumoney Route
        Route::get('/payumoney/response', 'PayumoneyController@payumoneyResponse');
        //Payumoney success Route
        Route::get('/payumoney/success', 'PayumoneyController@success');
        //Payumoney success Route
        Route::get('/payumoney/fail', 'PayumoneyController@fail');
        //Update transfer Bank
        Route::post('update-transfer-bank', 'OrdersController@updateTransferBank');
        //Route wishlist
        Route::post('/update-wishlist', 'ProductController@updateWishlist');
        //Route list wishlist
        Route::get('/wishlist', 'ProductController@wishlist');
        //Delete wishlist item
        Route::post('/delete-wishlist-item', 'ProductController@deleteWishlistItem');
    });
});







// //Payumoney success Route
// Route::get('/payumoney/verify/{id?}', 'PayumoneyController@payumoneyVerify');
