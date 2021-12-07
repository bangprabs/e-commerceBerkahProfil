<?php

namespace App\Http\Controllers\Front;

use Route;
use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Coupon;
use App\Models\Rating;
use App\Models\Country;
use App\Models\Product;
use App\Models\Category;
use App\Models\Province;
use App\Models\Wishlist;
use App\Models\CategoryBlog;
use Illuminate\Http\Request;
use App\Models\OrdersProduct;
use App\Models\ShippingCharge;
use App\Models\DeliveryAddress;
use App\Models\ProductsAttributes;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Session;

class ProductController extends Controller
{
    public function listing(Request $request)
    {
        $userWishlistItems = Wishlist::userWishlistItems();
        $blogCategory = CategoryBlog::select('name')->where('status', 1)->get()->toArray();
        Paginator::useBootstrap();
        if ($request->ajax()) {
            $data= $request->all();
            $url = $data['url'];
            $categoryCount = Category::where(['url'=>$url, 'status'=>1])->count();
            if ($categoryCount>0) {
                $categoryDetails = Category::catDetails($url);
                $categoryProducts = Product::whereIn('category_id', $categoryDetails['catIds'])->where('status', 1);
                // If sort option selected by User
                if (isset($data['sort']) && !empty($data['sort'])) {
                    if ($data['sort'] == "product_latest") {
                        $categoryProducts->orderBy('id', 'Desc');
                    } else if($data['sort'] == "product_name_a_z"){
                        $categoryProducts->orderBy('product_name', 'Asc');
                    } else if($data['sort'] == "product_name_z_a"){
                        $categoryProducts->orderBy('product_name', 'Desc');
                    } else if($data['sort'] == "price_lowest"){
                        $categoryProducts->orderBy('product_price', 'Asc');
                    } else if($data['sort'] == "price_highest"){
                        $categoryProducts->orderBy('product_price', 'Desc');
                    }
                } else {
                    $categoryProducts->orderBy('id', 'Desc');
                }

                $categoryProducts = $categoryProducts->paginate(9);

                $catDetails = Category::select('id', 'parent_id', 'category_name', 'url', 'description')->with(['subcategories' => function($query){
                    $query->select('id', 'parent_id', 'category_name', 'url', 'description')->where('status', 1);
                }])->where('url', $url)->first()->toArray();

                 // echo "<pre>"; print_r($categoryDetails); die;
                 $meta_title = $categoryDetails['catDetails']['meta_title'];
                 $meta_keywords = $categoryDetails['catDetails']['meta_keywords'];
                 $meta_description = $categoryDetails['catDetails']['meta_description'];
                 $page_name = "ajax";
                return view('layouts.front.products.ajax_products_listing')->with(compact('categoryDetails', 'categoryProducts', 'categoryCount', 'url', 'catDetails', 'blogCategory', 'meta_title', 'meta_description', 'meta_keywords', 'userWishlistItems'));
            } else {
                abort(404);
            }
        } else {
            $userWishlistItems = Wishlist::userWishlistItems();
            $blogCategory = CategoryBlog::select('name')->where('status', 1)->get()->toArray();
            $url = Route::getFacadeRoot()->current()->uri();
            $categoryCount = Category::where(['url'=>$url, 'status'=>1])->count();
            if(isset($_REQUEST['search']) && !empty($_REQUEST['search'])){
                $search_product = $_REQUEST['search'];
                $categoryDetails['breadcrumbs'] = $search_product;
                $categoryDetails['catDetails']['category_name'] = $search_product;
                $categoryDetails['catDetails']['description'] = "Hasil pencarian dari : " . $search_product;
                $categoryProducts = Product::join('categories', 'categories.id', '=', 'products.category_id')->select('products.*','categories.category_name')->where(function($query)use($search_product){
                    $query->where('products.product_name','like','%'.$search_product.'%')
                    ->orWhere('products.product_code','like','%'.$search_product.'%')
                    ->orWhere('products.product_color','like','%'.$search_product.'%')
                    ->orWhere('products.description','like','%'.$search_product.'%')
                    ->orWhere('categories.category_name','like','%'.$search_product.'%');
                })->where('products.status', 1);
                $categoryProducts = $categoryProducts->get();
                $page_name = "Search";
                return view('layouts.front.products.listing')->with(compact('categoryDetails', 'categoryProducts', 'categoryCount', 'url', 'page_name', 'blogCategory', 'userWishlistItems'));
            }else if ($categoryCount>0) {
                $userWishlistItems = Wishlist::userWishlistItems();
                $categoryDetails = Category::catDetails($url);
                $categoryProducts = Product::whereIn('category_id', $categoryDetails['catIds'])->where('status', 1);

                $categoryProducts = $categoryProducts->paginate(9);

                $catDetails = Category::select('id', 'parent_id', 'category_name', 'url', 'description')->with(['subcategories' => function($query){
                    $query->select('id', 'parent_id', 'category_name', 'url', 'description')->where('status', 1);
                }])->where('url', $url)->first()->toArray();

                $page_name = "listing";
                // echo "<pre>"; print_r($categoryDetails); die;
                $meta_title = $categoryDetails['catDetails']['meta_title'];
                $meta_keywords = $categoryDetails['catDetails']['meta_keywords'];
                $meta_description = $categoryDetails['catDetails']['meta_description'];
                return view('layouts.front.products.listing')->with(compact('categoryDetails', 'categoryProducts', 'categoryCount', 'url', 'page_name', 'catDetails', 'blogCategory', 'meta_title', 'meta_keywords', 'meta_description', 'userWishlistItems'));
            } else {
                abort(404);
            }
        }
    }

    public function detail($id){
        $userWishlistItems = Wishlist::userWishlistItems();
        $blogCategory = CategoryBlog::select('name')->where('status', 1)->get()->toArray();
        $page_name = "detail";
        $url = Route::getFacadeRoot()->current()->uri();
        $productDetails = Product::with(['category', 'attributes'=>function($query){
            $query->where('status', 1);
        }, 'images'])->find($id)->toArray();

        $meta_title = $productDetails['product_name'];
        $meta_keywords = $productDetails['description'];
        $meta_description = $productDetails['product_name'];

        $total_stock = ProductsAttributes::where('product_id', $id)->sum('stock');
        $upSelling = Product::where(['category_id'=> $productDetails['category']['id'], 'status'=>1])->with('category')->where('id','!=',$id)->limit(4)->where('product_price', '>' ,$productDetails['product_price'])->inRandomOrder()->get()->toArray();


        $ratings = Rating::with(['user', 'product'])->where('status', 1)->where('product_id', $id)->orderBy('id', 'desc')->get()->toArray();
        $ratingSum = Rating::where('status', 1)->where('product_id', $id)->sum('rating');
        $ratingCount = Rating::where('status', 1)->where('product_id', $id)->count();

        if ($ratingCount > 0) {
            $avgRating = $ratingSum / $ratingCount;
        } else {
            $avgRating = round(0,0);
        }

        return view('layouts.front.products.detail')->with(compact('productDetails', 'total_stock', 'upSelling' ,'page_name', 'blogCategory', 'meta_title', 'meta_description', 'meta_keywords', 'ratings', 'avgRating', 'ratingCount', 'userWishlistItems'));
    }

    public function getProductPrice(Request $request)
    {
        if($request->ajax()){
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;
            $getDiscountedAttrPrice = Product::getDiscountedAttrPrice($data['product_id'], $data['size']);
            return $getDiscountedAttrPrice;
        }
    }

    public function addToCart(Request $request)
    {
        if ($request->isMethod('post')){
            $data = $request->all();

            if ($data['quantity'] <= 0 || $data['quantity'] == "") {
                $data['quantity'] = 1;
            }

            // echo "<pre>"; print_r($data); die;
            //Check stock is avaiable or not
            $getProductStock = ProductsAttributes::where(['product_id'=>$data['product_id'], 'size'=>$data['size']])->first()->toArray();
            if ($getProductStock['stock']<$data['quantity']) {
                $message = "Required Quantity is not available!";
                session::flash('error_message', $message);
                return redirect()->back();
            }

            //generate session id if not exist
            $session_id = Session::get('session_id');
            if (empty($session_id)) {
                $session_id = Session::getId();
                Session::put('session_id', $session_id);
            }

            //Check product if already exist in cart
            if(Auth::check()){
                //User is login
                $countProducts = Cart::where(['product_id'=>$data['product_id'], 'size'=>$data['size'], 'user_id'=>Auth::user()->id])->count();
            } else {
                $countProducts = Cart::where(['product_id'=>$data['product_id'], 'size'=>$data['size'], 'session_id'=>Session::get('session_id')])->count();

            }
            if ($countProducts>0) {
                $message = "Product is Exist in Cart !";
                session::flash('error_message', $message);
                return redirect()->back();
            }

            if (Auth::check()) {
                $user_id = Auth::user()->id;
            } else {
                $user_id = 0;
            }

            //Save product in cart
            $cart = new Cart;
            $cart->session_id = $session_id;
            $cart->user_id = $user_id;
            $cart->product_id = $data['product_id'];
            $cart->size = $data['size'];
            $cart->quantity = $data['quantity'];
            $cart->save();

            $message = "Product has been addedd in Cart!";
            session::flash('success_message', $message);
            return redirect()->back();
        }
    }

    public function cart()
    {
        $userWishlistItems = Wishlist::userWishlistItems();
        $blogCategory = CategoryBlog::select('name')->where('status', 1)->get()->toArray();
        $page_name= "cart";
        $userCartItems = Cart::userCartItems();
        $meta_title = "Keranjang Belanja Berkah Profil E-Commerce";
        $meta_keywords = "keranjang belanja, beli, website berkah profil";
        $meta_description = "Lihat Keranjang Belanja";
        return view('layouts.front.products.cart')->with(compact('userCartItems', 'page_name', 'blogCategory' , 'meta_title', 'meta_description', 'meta_keywords', 'userWishlistItems'));
    }

    public function updateCartItemQty(Request $request)
    {
        if($request->ajax()){
            $data = $request->all();

            //Get cart details
            $cartDetails = Cart::find($data['cartid']);

            //get avaliable stock
            $availableStock = ProductsAttributes::select('stock')->where(['product_id'=>$cartDetails['product_id'], 'size'=>$cartDetails['size']])->first()->toArray();

            //Check stoc is available or not
            if ($data['qty']>$availableStock['stock']) {
                $userCartItems = Cart::userCartItems();
                return response()->json([
                    'status'=>false,
                    'message'=>'Product Stock out of stock',
                    'view'=>(String)View::make('layouts.front.products.cart_items')->with(compact('userCartItems'))
                ]);
            }

            $availableSize = ProductsAttributes::where(['product_id'=>$cartDetails['product_id'], 'size'=>$cartDetails['size'], 'status'=>1])->count();
            if($availableSize==0){
                $userCartItems = Cart::userCartItems();
                return response()->json([
                    'status'=>false,
                    'message'=>'Product size out of stock',
                    'view'=>(String)View::make('layouts.front.products.cart_items')->with(compact('userCartItems'))]);
            }

            Cart::where('id', $data['cartid'])->update(['quantity'=>$data['qty']]);
            $userCartItems = Cart::userCartItems();
            $totalCartItems = totalCartItems();
            return response()->json([
                'status'=>true,
                'totalCartItems'=>$totalCartItems,
                'view'=>(String)View::make('layouts.front.products.cart_items')->with(compact('userCartItems'))]);
        }
    }

    public function deleteCartItem(Request $request)
    {
        if($request->ajax()){
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;
            Cart::where('id', $data['cartid'])->delete();
            $userCartItems = Cart::userCartItems();
            $totalCartItems = totalCartItems();
            return response()->json([
                'totalCartItems'=>$totalCartItems,
                'view'=>(String)View::make('layouts.front.products.cart_items')->with(compact('userCartItems'))]);
        }
    }

    public function applyCoupon(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;
            $couponCount = Coupon::where('coupon_code', $data['code'])->count();
            if ($couponCount == 0) {
                $userCartItems = Cart::userCartItems();
                $totalCartItems = totalCartItems();

                Session::forget('couponCode');
                Session::forget('couponAmount');

                return response()->json(
                    [
                        'status'=>false,
                        'message'=>'This coupon is not valid !',
                        'totalCartItems'=>$totalCartItems,
                        'view'=>(String)View::make('layouts.front.products.cart_items')->with(compact('userCartItems'))
                    ]);
            } else {
                $couponDetails = Coupon::where('coupon_code', $data['code'])->first();
                if ($couponDetails->status==0) {
                    $message = "This coupon is not active !";
                }

                //Check if coupon is Expired
                $expiry_date = $couponDetails->expiry_date;
                $current_date = date('Y-m-d');
                if ($expiry_date<$current_date) {
                    $message = "This coupon is expired !";
                }

                 if ($couponDetails->coupon_type == "Single Times") {
                     $couponCount = Order::where(['coupon_code' => $data['code'], 'user_id' => Auth::user()->id])->count();
                     if ($couponCount >= 1) {
                         $message = "Kupon sudah di clain oleh anda !";
                     }
                 }


                //get all selected categories from coupon
                $catAttr = explode(",", $couponDetails->categories);

                //get cart items
                $userCartItems = Cart::userCartItems();

                //get all selected users coupon
                if (!empty($couponDetails->users)) {
                    $userArr = explode(", ", $couponDetails->users);
                    //get user id's of all selected users
                    foreach ($userArr as $key => $user) {
                        $getUserId = User::select('id')->where('email', $user)->first()->toArray();
                        $userId[] = $getUserId['id'];
                    }
                }

                // get cart total amount
                $total_amount = 0;

                foreach($userCartItems as $key => $item){
                    //Check if coupon is from selected categories
                    if (!in_array($item['product']['category_id'], $catAttr)) {
                        $message = "This coupon code is not for one of the selected products";
                    }

                    //check if coupon belongs to logged in user
                    if (!empty($couponDetails->users)) {
                        if (!in_array($item['user_id'], $userId)) {
                            $message = "This coupon code is not for this account";
                        }
                    }
                    $attrPrice = Product::getDiscountedAttrPrice($item['product_id'], $item['size']);
                    $total_amount = $total_amount + ($attrPrice['final_price'] * $item['quantity']);
                }

                if (isset($message)) {
                    $userCartItems = Cart::userCartItems();
                    $totalCartItems = totalCartItems();
                    return response()->json(
                        [
                            'status'=>false,
                            'message'=>$message,
                            'totalCartItems'=>$totalCartItems,
                            'view'=>(String)View::make('layouts.front.products.cart_items')->with(compact('userCartItems'))
                        ]);
                } else {
                    // check if amount type is fixed or percentage
                    if ($couponDetails->amount_type == "Fixed") {
                        $couponAmount = $couponDetails->amount;
                    } else {
                        $couponAmount = $total_amount*($couponDetails->amount/100);
                    }

                    // add coupon code & amount in session variable
                    Session::put('couponAmount', $couponAmount);
                    Session::put('couponCode', $data['code']);

                    $message = "Coupon code successfully applied. You are availing discount !";
                    $totalCartItems = totalCartItems();
                    $grand_total = $total_amount - $couponAmount;
                    return response()->json(
                        [
                            'status'=>true,
                            'message'=>$message,
                            'totalCartItems'=>$totalCartItems,
                            'grand_total' => $grand_total,
                            'couponAmount' => $couponAmount,
                            'view'=>(String)View::make('layouts.front.products.cart_items')->with(compact('userCartItems'))
                        ]);
                }
            }
        }
    }

    public function checkout(Request $request){
        $blogCategory = CategoryBlog::select('name')->where('status', 1)->get()->toArray();
        $userCartItems = Cart::userCartItems();

        if (count($userCartItems) == 0) {
            $message = "Tidak ada produk di keranjang, Harap tambahkan produk untuk bisa checkout !";
            Session::put('error_message', $message);
            return redirect()->back();
        }

        $total_price = 0;
        $total_weight = 0;
        foreach ($userCartItems as $item) {
            // echo "<pre>"; print_r($item); die;
            $product_weight = $item['product']['product_weight'];
            $total_weight = $total_weight + ($product_weight * $item['quantity']);
            $attrPrice = Product::getDiscountedAttrPrice($item['product_id'],$item['size']);
            $total_price = $total_price + ($attrPrice['final_price'] * $item['quantity']);
        }

        // echo $total_price; die;

        $deliveryAddresses = DeliveryAddress::deliveryAddresses();

        foreach ($deliveryAddresses as $key => $value) {
            $shippingCharges = ShippingCharge::getShippingCharges($total_weight, $value['city']);
            $deliveryAddresses[$key]['shipping_charges'] = $shippingCharges;
            //check if delivery pincode exist in cod pincode list
            $deliveryAddresses[$key]['codpincodeCount'] = DB::table('cod_pincodes')->where('pincode', $value['pincode'])->count();
        }

        // echo "<pre>"; print_r($deliveryAddresses); die;

        if ($request->isMethod('post')) {
            $data = $request->all();

            foreach ($userCartItems as $key => $cart) {
                // echo "<pre>"; print_r($userCartItems); die;
                $product_status = Product::getProductStatus($cart['product_id']);
                if($product_status == 0){
                    $message = $cart['product']['product_name'] . " Tidak tersedia, jadi harap hapus dari keranjang";
                    session::flash('error_message', $message);
                    return redirect('/cart');
                }

                $product_stock = Product::getProductStock($cart['product_id'], $cart['size']);
                if($product_stock == 0){
                    $message = "Stok Barang ". $cart['product']['product_name'] . " Dengan Ukuran ". $cart['size'] . " Tidak tersedia, jadi harap hapus dari keranjang";
                    session::flash('error_message', $message);
                    return redirect('/cart');
                }

                $getAttributeCount = Product::getAttributeCount($cart['product_id'], $cart['size']);
                if($getAttributeCount == 0){
                    $message = "Barang Dengan Ukuran ". $cart['size'] . " Tidak tersedia, jadi harap hapus dari keranjang";
                    session::flash('error_message', $message);
                    return redirect('/cart');
                }
            }

            if (empty($data['address_id'])) {
                $message = "Please select Delivery Address !";
                session::flash('error_message', $message);
                return redirect()->back();
            }
            if (empty($data['payment_gateway'])) {
                $message = "Please select Payment Method !";
                session::flash('error_message', $message);
                return redirect()->back();
            }

            if ($data['payment_gateway'] == "COD") {
                $payment_method = "COD";
                $order_status = "Baru";
            } else {
                $payment_method = "Transfer Bank";
                $order_status = "Pending";
            }

            //Get Delivery address from address_id
            $deliveryAddress = DeliveryAddress::where('id', $data['address_id'])->first()->toArray();
            // dd($deliveryAddress); die;

            //get shipping charges
            $shipping_charges = ShippingCharge::getShippingCharges($total_weight, $deliveryAddress['city']);

            //calculate grand total
            $grand_total = $total_price + $shipping_charges - Session::get('couponAmount');

            //insert grand total
            Session::put('grand_total', $grand_total);

            DB::beginTransaction();

            //Inser order details
            $order = new Order;
            $order->user_id = Auth::user()->id;
            $order->name = $deliveryAddress['name'];
            $order->address = $deliveryAddress['address'];
            $order->city= $deliveryAddress['city'];
            $order->state= $deliveryAddress['state'];
            $order->country = $deliveryAddress['country'];
            $order->pincode = $deliveryAddress['pincode'];
            $order->mobile = $deliveryAddress['mobile'];
            $order->email = Auth::user()->email;
            $order->shipping_charges = $shipping_charges;
            $order->coupon_code = Session::get('couponCode');
            $order->coupon_amount = Session::get('couponAmount');
            $order->order_status = $order_status;
            $order->payment_method = $payment_method;
            $order->payment_gateway = $data['payment_gateway'];
            $order->grand_total = Session::get('grand_total');
            $order->save();

            //Get last inserted order id
            $order_id = DB::getPdo()->lastInsertId();
            //get user cart item
            $cartItems = Cart::where('user_id', Auth::user()->id)->get()->toArray();
            // echo "<pre>"; print_r($cartItems); die;
            foreach ($cartItems as $key => $item) {
                $cartItem = new OrdersProduct;
                $cartItem->order_id = $order_id;
                $cartItem->user_id = Auth::user()->id;

                $getProductDetails = Product::select('product_code', 'product_name', 'product_color')->where('id', $item['product_id'])->first()->toArray();
                $cartItem->product_id = $item['product_id'];
                $cartItem->product_code = $getProductDetails['product_code'];
                $cartItem->product_name = $getProductDetails['product_name'];
                $cartItem->product_color = $getProductDetails['product_color'];
                $cartItem->product_size = $item['size'];
                $getDiscountedAttrPrice = Product::getDiscountedAttrPrice($item['product_id'], $item['size']);
                $cartItem->product_price = $getDiscountedAttrPrice['final_price'];
                $cartItem->product_qty = $item['quantity'];
                $cartItem->save();

                if ($data['payment_gateway'] == "COD") {
                    $getProductStock = ProductsAttributes::where(['product_id'=>$item['product_id'], 'size'=>$item['size']])->first()->toArray();
                    $newStock = $getProductStock['stock'] - $item['quantity'];
                    ProductsAttributes::where(['product_id'=>$item['product_id'], 'size'=>$item['size']])->update(['stock'=>$newStock]);
                } else if($data['payment_gateway'] == "transfer_bank"){
                    $getProductStock = ProductsAttributes::where(['product_id'=>$item['product_id'], 'size'=>$item['size']])->first()->toArray();
                    $newStock = $getProductStock['stock'] - $item['quantity'];
                    ProductsAttributes::where(['product_id'=>$item['product_id'], 'size'=>$item['size']])->update(['stock'=>$newStock]);
                }
            }


            DB::commit();
            Session::put('order_id', $order_id);
            if ($data['payment_gateway'] == "COD") {

                $orderDetails = Order::with('orders_products')->where('id', $order_id)->first()->toArray();
                // echo "<pre>"; print_r($orderDetails); die;

                //Send Order Email
                $email = Auth::user()->email;
                $messageData = [
                            'email'=>$email,
                            'name'=>Auth::user()->name,
                            'order_id' => $order_id,
                            'orderDetails' => $orderDetails

                ];
                Mail::send('emails.orders', $messageData, function($message) use($email){
                    $message->to($email)->subject("Order Berhasil - Berkah Profil E-Commerce");
                });

                return redirect('/thanks');
            } else if($data['payment_gateway'] == "transfer_bank"){
                $orderDetails = Order::with('orders_products')->where('id', $order_id)->first()->toArray();
                // echo "<pre>"; print_r($orderDetails); die;

                //Send Order Email
                $email = Auth::user()->email;
                $messageData = [
                            'email'=>$email,
                            'name'=>Auth::user()->name,
                            'order_id' => $order_id,
                            'orderDetails' => $orderDetails

                ];
                Mail::send('emails.orders', $messageData, function($message) use($email){
                    $message->to($email)->subject("Order Berhasil - Berkah Profil E-Commerce");
                });
                return redirect('/thanks-trf');
            } else {
                echo "Pembayaran Lainnya Akan Tersedia"; die;
            }
        }

        $page_name = "checkout";
        $userCartItems = Cart::userCartItems();
        $userWishlistItems = Wishlist::userWishlistItems();

        $meta_title = "Checkout Belanja Berkah Profil E-Commerce";
        $meta_keywords = "Checkout belanja, beli, website berkah profil";
        $meta_description = "Lihat Checkout Belanja";

        return view('layouts.front.products.checkout')->with(compact('userCartItems', 'deliveryAddresses', 'page_name', 'blogCategory', 'total_price', 'meta_title', 'meta_description', 'meta_keywords', 'userWishlistItems'));
    }

    public function thanks()
    {
        $userWishlistItems = Wishlist::userWishlistItems();
        $blogCategory = CategoryBlog::select('name')->where('status', 1)->get()->toArray();
        $page_name = "thanks";
        if (Session::has('order_id')) {
            //Empty cart user
            Cart::where('user_id', Auth::user()->id)->delete();
            return view('layouts.front.products.thanks')->with(compact('page_name', 'blogCategory', 'userWishlistItems'));
        } else {
            return redirect('/cart');
        }
    }

    public function thanksTrf()
    {
        $userWishlistItems = Wishlist::userWishlistItems();
        $blogCategory = CategoryBlog::select('name')->where('status', 1)->get()->toArray();
        $page_name = "thanks_trf";
        if (Session::has('order_id')) {
            //Empty cart user
            Cart::where('user_id', Auth::user()->id)->delete();
            return view('layouts.front.products.thanks_trf')->with(compact('page_name', 'blogCategory', 'userListItems'));
        } else {
            return redirect('/cart');
        }
    }

    public function addEditDeliveryAddress($id=null, Request $request){
        $page_name = "delivery_address";
        $userWishlistItems = Wishlist::userWishlistItems();
        $blogCategory = CategoryBlog::select('name')->where('status', 1)->get()->toArray();
        if ($id=="") {
            $title = "Add Delivery Address";
            $message = "Delivery Address added successfully !";
            $address = new DeliveryAddress;
            $countries = Country::where('status', 1)->get()->toArray();
            $addressData = array();
            $deliveryAddresses = DeliveryAddress::deliveryAddresses();
        } else {
            $title = "Edit Delivery Address";
            $address = DeliveryAddress::find($id);
            $addressData = DeliveryAddress::find($id);
            $message = "Delivery Address updated successfully !";
            $countries = Country::where('status', 1)->get()->toArray();
            $deliveryAddresses = DeliveryAddress::deliveryAddresses();
        }

        if($request->isMethod('post')){
            $data = $request->all();
            echo "<pre>"; print_r($data); die;

            $rules = [
                'name' => 'required',
                'address' => 'required',
                'state' => 'required|regex:/^[\pL\s\-]+$/u',
                'country' => 'required',
                'pincode' => 'required|numeric|digits:5',
                'mobile' => 'required|numeric|digits:12',
            ];
            $customMessages = [
                'name.required' => 'Name is required',
                'address.required' => 'Address is required',
                'city.required' => 'City is required',
                'city.regex' => 'Valid City is required',
                'state.required' => 'State is required',
                'state.regex' => 'Valid State is required',
                'country.required' => 'Country is required',
                'pincode.required' => 'Pincode is required',
                'pincode.numeric' => 'Valid Pincode is required',
                'pincode.digits' => 'Pincode must be 5 digits',
                'mobile.required' => 'Mobile is required',
                'mobile.numeric' => 'Valid Mobile is required',
                'mobile.digits' => 'Mobile must be 12 digits',
            ];
            $this->validate($request, $rules, $customMessages);

            $address->user_id = Auth::user()->id;
            $address->subject = $data['subject'];
            $address->name = $data['name'];
            $address->address = $data['address'];
            $address->city = $data['city'];
            $address->state = $data['state'];
            $address->country = $data['country'];
            $address->pincode = $data['pincode'];
            $address->mobile = $data['mobile'];
            $address->save();

            session::flash('success_message', $message);
            return redirect('checkout');;

        }

        $countries = Country::where('status', 1)->get()->toArray();
        $city = ShippingCharge::where('status', 1)->get()->toArray();
        $province = Province::where('status', 1)->get()->toArray();


        return view('layouts.front.products.add_edit_delivery_address')->with(compact('title', 'countries', 'deliveryAddresses', 'page_name', 'address', 'addressData', 'blogCategory', 'city', 'province', 'userWishlistItems'));
    }

    public function deleteDeliveryAddress($id)
    {
        DeliveryAddress::where('id', $id)->delete();
        $message = "Delivery address deleted successfully !";
        session::flash('success_message', $message);
        return redirect()->back();
    }

    public function checkPincode(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();

            if (is_numeric($data['pincode']) && $data['pincode'] > 0 && $data['pincode'] == round($data['pincode'], 0)) {
                $codpincodeCount = DB::table('cod_pincodes')->where('pincode', $data['pincode'])->count();
                if ($codpincodeCount == 0) {
                    echo "Kodepos tidak tersedia untuk pengiriman";
                } else {
                    echo "Kodepos tersedia untuk dilakukan pengiriman";
                }
            } else {
                echo "Harap input valid kodepos";
            }
        }
    }

    public function updateWishlist(Request $request){
        if ($request->ajax()) {
            $data = $request->all();
            $countWishlist = Wishlist::countWishlist($data['product_id']);
            if ($countWishlist == 0) {
                $wishList = new Wishlist;
                $wishList->user_id = Auth::user()->id;
                $wishList->product_id = $data['product_id'];
                $wishList->save();
                $totalWishlistItems = totalWishlistItems();
                return response()->json([
                    'totalWishlistItems'=>$totalWishlistItems,
                    'status' => true,
                    'action' => 'add'
                ]);
            } else {
                Wishlist::where(['user_id'=>Auth::user()->id, 'product_id'=>$data['product_id']])->delete();
                $totalWishlistItems = totalWishlistItems();
                return response()->json([
                    'totalWishlistItems'=>$totalWishlistItems,
                    'status' => true,
                    'action' => 'remove'
                ]);
            }
        }
    }

    public function wishlist(){
        $blogCategory = CategoryBlog::select('name')->where('status', 1)->get()->toArray();
        $page_name= "wishlist";
        $userWishlistItems = Wishlist::userWishlistItems();
        $meta_title = "Daftar Barang Wishlist Berkah Profil E-Commerce";
        $meta_keywords = "wishlist, beli, website berkah profil";
        $meta_description = "Lihat Daftar Barang Wishlist";
        return view('layouts.front.products.wishlist')->with(compact('userWishlistItems', 'meta_title', 'meta_keywords', 'meta_description', 'page_name', 'blogCategory'));
    }

    public function deleteWishlistItem(Request $request){
        $userWishlistItems = Wishlist::userWishlistItems();
        if($request->ajax()){
            $data = $request->all();
            Wishlist::where('id', $data['wishlistId'])->delete();
            $totalWishlistItems = totalWishlistItems();
            return response()->json([
                'totalWishlistItems'=>$totalWishlistItems,
                'view'=>(String)View::make('layouts.front.products.wishlist_item')->with(compact('userWishlistItems'))
            ]);
        }
    }
}
