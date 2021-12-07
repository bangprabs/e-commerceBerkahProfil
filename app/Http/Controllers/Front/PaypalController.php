<?php

namespace App\Http\Controllers\Front;

use App\Models\Cart;
use App\Models\Order;
use App\Models\CategoryBlog;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class PaypalController extends Controller
{
    public function paypal()
    {
        $blogCategory = CategoryBlog::select('name')->where('status', 1)->get()->toArray();
        $page_name = "thanks";
        if (Session::has('order_id')) {
            Cart::where('user_id', Auth::user()->id)->delete();
            $orderDetails = Order::where('id', Session::get('order_id'))->first()->toArray();
            $nameArr = explode(' ',$orderDetails['name']);
            return view('layouts.front.paypal.paypal')->with(compact('page_name', 'blogCategory', 'orderDetails', 'nameArr'));
        } else {
            return redirect('/cart');
        }
    }

    public function success()
    {
        if (Session::has('order_id')) {
            Cart::where('user_id', Auth::user()->id)->delete();
            return view('layouts.front.paypal.success');
        } else {
            return redirect('/cart');
        }
    }

    public function failed()
    {
        return view('layouts.front.paypal.failed');
    }

    public function ipn(Request $request){
        $data = $request->all();
        $data['payment_status'] == "Completed";
        if ($data['payment_status'] == "Completed") {
            $order_id = Session::get('order_id');

            Order::where('id', $order_id)->update(['order_status'=>'Terbayar']);

            $orderDetails = Order::with('orders_products')->where('id', $order_id)->first()->toArray();

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
        }
    }
}
