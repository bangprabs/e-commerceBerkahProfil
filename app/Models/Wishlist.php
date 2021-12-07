<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Wishlist extends Model
{
    use HasFactory;

    public static function countWishlist($product_id){
        $countWishlist = Wishlist::where(['user_id'=>Auth::user()->id, 'product_id'=>$product_id])->count();
        return $countWishlist;
    }

    public static function userWishlistItems(){
        if (Auth::check()) {
            $userWishlistItems = Wishlist::with(['product'=>function($query){
                $query->select('id', 'product_name', 'product_code', 'product_color', 'main_image', 'product_price');
            }])->where('user_id', Auth::user()->id)->orderBy('id', 'Desc')->get()->toArray();
        } else {
            $userWishlistItems = [];
        }
        return $userWishlistItems;
    }

    public function product(){
        return $this->belongsTo('App\Models\Product', 'product_id');
    }
}
