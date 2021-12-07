<?php

namespace App\Http\Controllers\Front;

use App\Models\Blog;
use App\Models\Product;
use App\Models\Category;
use App\Models\Wishlist;
use App\Models\CategoryBlog;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function index()
    {
        // Get Featured Item
        $featuredItemsCount = Product::where('is_featured', 'Yes')->where('status', 1)->count();
        $featuredItems = Product::where(['is_featured'=>'Yes', 'status'=>1])->with(['category', 'attributes'=>function($query){
            $query->where('status', 1);
        }, 'images'])->get()->toArray();
        $featuredItemsChunk = array_chunk($featuredItems, 4);
        // $product = Product::find($id);
        $categories = Category::where(['parent_id' => 'ROOT', 'status' => 1])->get();
        $blogCategory = CategoryBlog::select('name')->where('status', 1)->get()->toArray();

        $newProducts = Product::where('status',1)->orderBy('id', 'Desc')->limit(6)->with(['category', 'attributes'=>function($query){
            $query->where('status', 1);
        }, 'images'])->get()->toArray();

        $blog = Blog::orderBy('id', 'Desc')->limit(2)->where('status', 1)->get()->toArray();
        $userWishlistItems = Wishlist::userWishlistItems();


        $page_name = "index";
        $meta_title = "E-Commerce Berkah Profil";
        $meta_description = "Mulai berbelanja untuk mempercantik rumah.";
        $meta_keywords = "belanja e-commerce, berkah profil, lis beton, batu alam, roster";
        return view('layouts.front.index')->with(compact('page_name', 'featuredItemsChunk', 'featuredItemsCount', 'newProducts', 'featuredItems', 'categories', 'blog', 'blogCategory', 'meta_title', 'meta_keywords', 'meta_description', 'userWishlistItems'));
    }
}
