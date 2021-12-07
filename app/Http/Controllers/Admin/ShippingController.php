<?php

namespace App\Http\Controllers\Admin;

use Session;
use Illuminate\Http\Request;
use App\Models\ShippingCharge;
use App\Http\Controllers\Controller;

class ShippingController extends Controller
{
    public function viewShippingCharges()
    {
        $page_name = "";
        $shippingCharges = ShippingCharge::get()->toArray();
        return view('layouts.admin.shipping.shipping_charges')->with(compact('shippingCharges', 'page_name'));
    }

    public function editShippingCharges($id, Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();
            ShippingCharge::where('id', $id)->update(
                [
                    '0-1000g' => $data['0-1000g'],
                    '1001-10000g' => $data['1001-10000g'],
                    '10001-20000g' => $data['10001-20000g'],
                    '20001-30000g' => $data['20001-30000g'],
                    '30001-40000g' => $data['30001-40000g'],
                    '40001-50000g' => $data['40001-50000g'],
                    'above_50000g' => $data['above_50000g'],
                ]
            );
            $message = "Biaya Pengiriman Berhasil di Ubah";
            session::flash('success_message', $message);
            return redirect()->back();
        }
        $page_name = "";
        $shippingDetails = ShippingCharge::where('id', $id)->first()->toArray();
        return view('layouts.admin.shipping.edit_shipping_charges')->with(compact('shippingDetails', 'page_name'));
    }

    public function updateShippingStatus(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            if ($data['status'] == "Active") {
                $status = 0;
            } else {
                $status = 1;
            }
            ShippingCharge::where('id', $data['shipping_id'])->update(['status'=>$status]);
            return response()->json(['status'=>$status, 'shipping_id'=>$data['shipping_id']]);
        }
    }
}
