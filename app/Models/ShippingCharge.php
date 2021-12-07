<?php

namespace App\Models;

use App\Models\ShippingCharge;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ShippingCharge extends Model
{
    use HasFactory;

    public static function getShippingCharges($total_weight, $city){
        $shippingDetails = ShippingCharge::where('city', $city)->first()->toArray();
        if ($total_weight > 0) {
            if($total_weight > 0 && $total_weight <= 1000){
                $shipping_charges = $shippingDetails['0-1000g'];
            } else if($total_weight > 1001 && $total_weight <= 10000){
                $shipping_charges = $shippingDetails['1001-10000g'];
            } else if($total_weight > 10001 && $total_weight <= 20000){
                $shipping_charges = $shippingDetails['10001-20000g'];
            } else if($total_weight > 20001 && $total_weight <= 30000){
                $shipping_charges = $shippingDetails['20001-30000g'];
            } else if($total_weight > 30001 && $total_weight <= 40000){
                $shipping_charges = $shippingDetails['30001-40000g'];
            } else if($total_weight > 40001 && $total_weight <= 50000){
                $shipping_charges = $shippingDetails['40001-50000g'];
            } else if($total_weight > 50000){
                $shipping_charges = $shippingDetails['above_50000g'];
            } else {
                $shipping_charges = 0;
            }
        } else {
            $shipping_charges = 0;
        }
        return $shipping_charges;
    }
}
