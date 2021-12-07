<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use Dompdf\Options;
use App\Models\User;
use App\Models\Order;
use App\Models\OrdersLog;
use App\Models\AdminsRoles;
use App\Models\OrderStatus;
use App\Models\CategoryBlog;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class OrdersController extends Controller
{
    public function orders()
    {
        $page_name = "";
        $orders = Order::with('orders_products')->orderBy('id', 'Desc')->get()->toArray();

        $orderModuleCount = AdminsRoles::where(['admin_id'=>Auth::guard('admin')->user()->id, 'module'=>'order'])->count();
        if(Auth::guard('admin')->user()->type == "superadmin"){
            $orderModule['view_access'] = 1;
            $orderModule['edit_access'] = 1;
            $orderModule['full_access'] = 1;
        }
        else if ($orderModuleCount <= 0) {
            $message = "Menu tersebut tidak dibisa di akses oleh anda !";
            session::flash('error_message', $message);
            return redirect('admin/dashboard');
        } else {
            $orderModule = AdminsRoles::where(['admin_id'=>Auth::guard('admin')->user()->id, 'module'=>'order'])->first()->toArray();
        }


        return view('layouts.admin.orders.orders')->with(compact('orders', 'page_name', 'orderModule'));
    }

    public function ordersDetails($id)
    {
        $page_name = "";
        $orderDetails = Order::with('orders_products')->where('id', $id)->first()->toArray();
        $userDetails = User::where('id', $orderDetails['user_id'])->first()->toArray();
        $orderStatuses = OrderStatus::where('status', 1)->get()->toArray();
        // dd($userDetails); die;
        $orderLog = Orderslog::where('order_id', $id)->get()->toArray();
        return view('layouts.admin.orders.orders_detail')->with(compact('orderDetails', 'page_name', 'userDetails', 'orderStatuses', 'orderLog'));
    }

    public function updateOrderStatus(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;
            Order::where('id', $data['order_id'])->update(['order_status' => $data['order_status']]);
            Session::put('success_message', 'Status Order Berhasil Diubah');

            //Update nama pengirim dan nomor pengiriman
            if (!empty($data['courier_name']) && !empty($data['tracking_number'])) {
                Order::where('id', $data['order_id'])->update(['courier_name'=>$data['courier_name'],
                'tracking_number'=>$data['tracking_number']]);
            }

            $deliveryDetails = Order::select('mobile', 'email', 'name')->where('id', $data['order_id'])->first()->toArray();
            $message = "Halo, pesanan anda #".$data['order_id']. " status nya di perbaharui menjadi '".$data['order_status']."' oleh sistem Berkah Profil E-Commerce";

            $orderDetails = Order::with('orders_products')->where('id', $data['order_id'])->first()->toArray();

             //Send Order Email
             $email = $deliveryDetails['email'];
             $messageData = [
                         'email'=>$email,
                         'name'=>$deliveryDetails['name'],
                         'order_id' => $data['order_id'],
                         'order_status' =>$data['order_status'],
                         'courier_name'=>$data['courier_name'],
                         'tracking_number'=>$data['tracking_number'],
                         'orderDetails' => $orderDetails

             ];
             Mail::send('emails.order_status', $messageData, function($message) use($email){
                 $message->to($email)->subject("Status Pemesanan Anda Di Perbarui - Berkah Profil E-Commerce");
             });

             // update order log
             $log = new OrdersLog;
             $log->order_id = $data['order_id'];
             $log->order_status = $data['order_status'];
             $log->save();

            return redirect()->back();
        }
    }

    public function viewOrderInvoice($id){
        $page_name = "printInvoice";
        $orderDetails = Order::with('orders_products')->where('id', $id)->first()->toArray();
        $userDetail = User::where('id', $orderDetails['user_id'])->first()->toArray();
        return view('layouts.admin.orders.order_invoice')->with(compact('orderDetails', 'userDetail', 'page_name'));
    }

    public function viewOrderCharts(){
        $page_name = "";
        $currentMonthOrder = Order::whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->month)->count();
        $before1Month = Order::whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->subMonth(1))->count();
        $before2Month = Order::whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->subMonth(2))->count();
        $before3Month = Order::whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->subMonth(3))->count();
        $before4Month = Order::whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->subMonth(4))->count();
        $before5Month = Order::whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->subMonth(5))->count();
        $ordersCount = array($currentMonthOrder,$before1Month,$before2Month,$before3Month, $before4Month, $before5Month);
        return view('layouts.admin.orders.view_orders_charts')->with(compact('page_name', 'ordersCount'));
    }
}
