<?php

namespace App\Http\Controllers\Front;

use App\Models\Cart;
use App\Models\Order;
use App\Models\CategoryBlog;
use Illuminate\Http\Request;
use Softon\Indipay\Facades\Indipay;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class PayumoneyController extends Controller
{
    public function payumoney()
    {
        $order_id = Session::get('order_id');
        $grand_total = Session::get('grand_total');
        $orderDetails = Order::where('id', $order_id)->first()->toArray();
        // echo "<pre>"; print_r($orderDetails); die;
        $nameArr = explode(' ', $orderDetails['name']);

        $parameters = [
            'txnid' => $order_id,
            'order_id' => $order_id,
            'amount' => $grand_total,
            'firstname' => $nameArr[0],
            'lastname' => $nameArr[1], 
            'email' => $orderDetails['email'],
            'phone' => $orderDetails['mobile'],
            'productinfo' => $order_id,
            'service_provider' => '',
            'zipcode' => $orderDetails['pincode'],
            'city' => $orderDetails['city'],
            'state' => $orderDetails['state'],
            'country' => $orderDetails['country'],
            'address1' => $orderDetails['address'],
            'address2' => '',
            'curl' => url('/payumoney/response'),
            'surl' => url('/payumoney/success'),
            'furl' => url('/payumoney/fail'),
          ];

        //   echo "<pre>"; print_r($parameters); die;
          $order = Indipay::prepare($parameters);
          return Indipay::process($order);
    }

    public function payumoneyResponse(Request $request)
    {
        // For default Gateway
        // $response = Indipay::response($request);
        $response['status'] = "success";
        $response['unmappedstatus'] = "captured";
        if ($response['status'] == "success" && $response['unmappedstatus'] == "captured") {
            // echo "Sukses";

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

            return redirect('/payumoney/success');

        } else {
            $order_id = Session::get('order_id');
            Order::where('id', $order_id)->update(['order_status'=>'Pembayaran Gagal']);
            return redirect('/payumoney/fail');
        }
    }

    public function success()
    {
        $blogCategory = CategoryBlog::select('name')->where('status', 1)->get()->toArray();
        $page_name = "thanks";
        if (Session::has('order_id')) {
            Cart::where('user_id', Auth::user()->id)->delete();
            return view('layouts.front.payumoney.success')->with(compact('blogCategory', 'page_name'));
        } else {
            return redirect('/cart');
        }
    }

    public function failed()
    {
        return view('layouts.front.payumoney.failed');
    }

    public function payumoneyVerify($id = null)
    {

        if ($id > 0) {
            $orders = Order::where('id', $id)->get();
        } else {
            $orders = Order::where('payment_gateway', 'Payumoney')->take(5)->orderBy('id', 'Desc')->get();
        }

        foreach ($orders as $key => $order) {
            $key = 'gtKFFx';
            $salt = 'eCwWELxi';

            $command = "verify_payment";
            $var1 = "NPMM87334121";
            $hash_str = $key  . '|' . $command . '|' . $var1 . '|' . $salt ;
            $hash = strtolower(hash('sha512', $hash_str));
            $r = array('key' => $key , 'hash' =>$hash , 'var1' => $var1, 'command' => $command);

            // echo "<pre>"; print_r($order); die;

            $qs= http_build_query($r);
            $wsUrl = "https://test.payu.in/merchant/postservice?form=2";
            $c = curl_init();
            curl_setopt($c, CURLOPT_URL, $wsUrl);
            curl_setopt($c, CURLOPT_POST, 1);
            curl_setopt($c, CURLOPT_POSTFIELDS, $qs);
            curl_setopt($c, CURLOPT_CONNECTTIMEOUT, 30);
            curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($c, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($c, CURLOPT_SSL_VERIFYPEER, 0);
            $o = curl_exec($c);
            if (curl_errno($c)) {
            $sad = curl_error($c);
            throw new Exception($sad);
            }
            curl_close($c);

            echo "<pre>"; print_r($o); die;

            // echo "<pre>"; print_r($o); die;

            $valueSerialized = @unserialize($o);
            if($o === 'b:0;' || $valueSerialized !== false) {
            print_r($valueSerialized);
            }
            $o = json_decode($o);

            // echo "<pre>"; print_r($o); die;

            foreach($o->transaction_details as $key => $val){
                if(($val->status=="success")&&($val->unmappedstatus=="captured")){
                    if($order->order_status == "Payment Cancelled"){
                        Order::where(['id' => $order->id])->update(['order_status' => 'Terbayar']);
                    } else if($order->order_status == "Payment Fail"){
                        Order::where(['id' => $order->id])->update(['order_status' => 'Terbayar']);
                    } else if($order->order_status == "New"){
                        Order::where(['id' => $order->id])->update(['order_status' => 'Terbayar']);
                    } else if($order->order_status == "Pending"){
                        Order::where(['id' => $order->id])->update(['order_status' => 'Terbayar']);
                        echo "Berhasil di ubah";
                    }
                }else{
                    if($order->order_status == "Terbayar"){
                        Order::where(['id' => $order->id])->update(['order_status' => 'Payment Cancelled']);
                    } else if($order->order_status == "New"){
                        Order::where(['id' => $order->id])->update(['order_status' => 'Payment Cancelled']);
                    }
                }
            }
        }
    }
}
