<?php

namespace App\Models;

use App\Models\Product;
use App\Models\Category;
use App\Models\ProductsAttributes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    public function category()
    {
        return $this->belongsTo('App\Models\Category', 'category_id');
    }

    public function categories()
    {
        return $this->hasMany('App\Models\Category', 'section_id')->where(['parent_id' => 'ROOT', 'status' => 1])->with('subcategories');
    }

    public function attributes()
    {
        return $this->hasMany('App\Models\ProductsAttributes');
    }

    public function images()
    {
        return $this->hasMany('App\Models\ProductsImages');
    }

    public static function getDiscountedPrice($product_id)
    {
        $proDetails = Product::select('product_price', 'product_discount', 'category_id')->where('id', $product_id)->first()->toArray();
        $catDetails = Category::select('category_discount')->where('id', $proDetails['category_id'])->first()->toArray();

        if ($proDetails['product_discount']>0) {
            $discounted_price = ($proDetails['product_price'] - $proDetails['product_price'] * $proDetails['product_discount'] / 100);
            // Sale Price = Cost Price - Discount Price

        } else if ($catDetails['category_discount']>0) {
            $discounted_price = ($proDetails['product_price'] - $proDetails['product_price'] * $catDetails['category_discount'] / 100);

        } else {
            $discounted_price = 0;
        }

        return $discounted_price;
    }

    public static function getDiscountedAttrPrice($product_id, $size)
    {
        $proAttrPrice =  ProductsAttributes::where(['product_id'=>$product_id, 'size'=>$size])->first()->toArray();
        $proDetails = Product::select('product_discount', 'category_id')->where('id', $product_id)->first()->toArray();
        $catDetails = Category::select('category_discount')->where('id', $proDetails['category_id'])->first()->toArray();

        if ($proDetails['product_discount']>0) {
            $final_price = ($proAttrPrice['price'] - $proAttrPrice['price'] * $proDetails['product_discount'] / 100);
            $discount = $proAttrPrice['price'] - $final_price;
        } else if ($catDetails['category_discount']>0) {
            $final_price = ($proAttrPrice['price'] - $proAttrPrice['price'] * $catDetails['category_discount'] / 100);
            $discount = $proAttrPrice['price'] - $final_price;
        } else {
            $final_price = $proAttrPrice['price'];
            $discount = 0;
        }
        return array('product_price'=>$proAttrPrice['price'], 'final_price'=>$final_price, 'discount'=>$discount);
    }

    public static function getProductImage($product_id){
        $getProductImage = Product::select('main_image')->where('id', $product_id)->first()->toArray();
        return $getProductImage['main_image'];
    }

    public static function getProductStatus($product_id){
        $getProductStatus = Product::where('id', $product_id)->first()->toArray();
        return $getProductStatus['status'];
    }

    public static function deleteCartProduct($product_id)
    {
        Cart::where('product_id', $product_id)->delete();
    }

    public static function getProductStock($product_id, $product_size){
        $getProductStock = ProductsAttributes::select('stock')->where(['product_id'=>$product_id, 'size'=>$product_size])->first()->toArray();
        return $getProductStock['stock']; die;
    }

    public static function getAttributeCount($product_id, $product_size){
        $getAttributeCount = ProductsAttributes::where(['product_id'=>$product_id, 'size'=>$product_size, 'status'=>1])->count();
        return $getAttributeCount;
    }

    public static function FunctionName($category_id)
    {
        $getCategoryStatus = Category::select('status')->where('id', $category_id)->first()->toArray();
        return $getCategoryStatus['status'];
    }

    public static function productCountSubCategory($category_id){
        $productsCount = Product::where(['category_id' => $category_id, 'status'=>1])->count();
        return $productsCount;
    }

    public static function productCount($category_id){
        $catIds = Category::select('id')->where('parent_id', $category_id)->get()->toArray();
        $catIds1 = array_flatten($catIds);
        $catIds2 = array($category_id);
        $catIds = array_merge($catIds1, $catIds2);
        $productsCount = Product::whereIn('category_id', $catIds)->where('status', 1)->count();
        return $productsCount;
    }
}

