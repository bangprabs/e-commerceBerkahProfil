<?php

namespace App\Http\Controllers\Front;

use App\Models\Order;
use App\Models\OrdersLog;
use App\Models\CategoryBlog;
use Illuminate\Http\Request;
use App\Models\DeliveryAddress;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Image;
use Session;

class OrdersController extends Controller
{
    public function orders()
    {
        $page_name = "account";
        $orders = Order::with('orders_products')->where('user_id', Auth::user()->id)->get()->toArray();
        dd($orders); die;
        return view('layouts.front.users.account')->with(compact('orders', 'page_name'));
    }

    public function orderDetails($id, Request $request)
    {
        $blogCategory = CategoryBlog::select('name')->where('status', 1)->get()->toArray();
        $page_name = "orderdetails";
        $orderDetails = Order::with('orders_products')->where('id', $id)->first()->toArray();
        $orderLog = OrdersLog::where('order_id', $id)->get()->toArray();

        // dd($orderDetails); die;
        return view('layouts.front.orders.orders_details')->with(compact('orderDetails', 'page_name', 'blogCategory', 'orderLog'));
    }

    public function updateTransferBank(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;

            // Upload product image
            if ($request->hasFile('transfer_image')) {
                $image_tmp = $request->file('transfer_image');
                if ($image_tmp->isValid()) {
                    // Get Original Name
                    $image_name = $image_tmp->getClientOriginalName();
                    // Get Extension
                    $extension = $image_tmp->getClientOriginalExtension();
                    // Generate Random Name
                    $imageName = $image_name.'-'.rand(111,99999).'.'.$extension;
                    // Set Path Image
                    $large_image_path = 'images/admin_images/product_images/large/'.$imageName;
                    $medium_image_path = 'images/admin_images/product_images/medium/'.$imageName;
                    $small_image_path = 'images/admin_images/product_images/small/'.$imageName;
                    // Upload origninal image (size big)
                    Image::make($image_tmp)->save($large_image_path);
                    // Upload image then resized it
                    Image::make($image_tmp)->resize(270,274)->save($medium_image_path);
                    Image::make($image_tmp)->resize(260,300)->save($small_image_path);
                    // Insert image name to table
                    if (!empty($data['transfer_image'])) {
                        Order::where('id', $data['order_id'])->update(['transfer_image'=>$imageName]);
                    }
                }
                $message = "Bukti transfer sukses di upload, kemudian sedang di verifikasi. Terima kasih";
                session::flash('success_message', $message);
                return redirect()->back();
            }
        }
    }

    public function orderCancel($id, Request $request){

        if ($request->isMethod('post')) {
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;

            if (isset($data['reason']) & empty($data['reason'])) {
                return redirect()->back();
            }

            $user_id_auth = Auth::user()->id;
            $user_id_order = Order::select('user_id')->where('id', $id)->first();

            if ($user_id_auth == $user_id_order->user_id) {
                Order::where('id', $id)->update(['order_status' => 'Dibatalkan']);
                $log = new OrdersLog;
                $log->order_id = $id;
                $log->order_status = "Dibatalkan oleh Pelanggan";
                $log->updated_by = "Pelanggan";
                $log->save();

                $message = "Pesanan berhasil dibatalkan";
                session::flash('success_message', $message);
                return redirect()->back();
            } else {
                $message = "Permintaan pembatalan pesanan tidak valid !";
                session::flash('error_message', $message);
                return redirect('orders');
            }
        }
    }
}
