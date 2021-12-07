<?php

namespace App\Http\Controllers\Admin;

use Image;
use Session;
use App\Models\Product;
use App\Models\Category;
use App\Models\AdminsRoles;
use Illuminate\Http\Request;
use App\Models\ProductsImages;
use App\Models\ProductsAttributes;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function products()
    {
        $page_name = "";
        $products = Product::with(['category'=>function($query)
            {
                $query->select('id', 'category_name');
            }])->get();

        $productModuleCount = AdminsRoles::where(['admin_id'=>Auth::guard('admin')->user()->id, 'module'=>'products'])->count();
        if(Auth::guard('admin')->user()->type == "superadmin"){
            $productModule['view_access'] = 1;
            $productModule['edit_access'] = 1;
            $productModule['full_access'] = 1;
        }
        else if ($productModuleCount <= 0) {
            $message = "Menu tersebut tidak dibisa di akses oleh anda !";
            session::flash('error_message', $message);
            return redirect('admin/dashboard');
        } else {
            $productModule = AdminsRoles::where(['admin_id'=>Auth::guard('admin')->user()->id, 'module'=>'products'])->first()->toArray();
        }

        return view('layouts.admin.products.products')->with(compact('products', 'page_name', 'productModule'));
    }

    public function updateProductStatus(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            if ($data['status'] == "Active") {
                $status = 0;
            } else {
                $status = 1;
            }
            Product::where('id', $data['product_id'])->update(['status'=>$status]);
            return response()->json(['status'=>$status, 'product_id'=>$data['product_id']]);
        }
    }

    public function addEditProduct(Request $request, $id = null)
    {
        $page_name = "";
        if ($id == "") {
            $title = "Add Product";
            $product = new Product;
            $productdata = array();
            $message = "Product Added Successfully !";
        } else {
            $title = "Edit Products";
            $productdata = Product::find($id);
            $product = Product::find($id);
            // echo "<pre>"; print_r($product); die;
            $message = "Product has been Edited Successfully !";
        }

        if ($request->isMethod('post')) {
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;

             // Product Valdation
             $rules = [
                'category_id' => 'required',
                'product_name' => 'required|regex:/^[\pL\s\-]+$/u',
                'product_code' => 'required|regex:/^[\w-]*$/',
                'product_price' => 'required|numeric',
                'product_color' => 'required|regex:/^[\pL\s\-]+$/u',
                'product_material' => 'required|regex:/^[\pL\s\-]+$/u'
            ];
            $customeMessages = [
                'category_id.required' => 'Category ID is required',
                'product_name.required' => 'Product Name is required',
                'product_name.regex' => 'Valid Product Name is required',
                'product_code.required' => 'Product Code is required',
                'product_code.regex' => 'Valid Product Code is required',
                'product_price.required' => 'Product Price is required',
                'product_price.regex' => 'Valid Product Price is required',
                'product_color.required' => 'Product Color is required',
                'product_color.regex' => 'Valid Product Color is required',
                'product_material.required' => 'Product Material is required',
                'product_material.regex' => 'Valid Product Material is required',
            ];
            $this->validate($request, $rules, $customeMessages);


            // Upload product image
            if ($request->hasFile('main_image')) {
                $image_tmp = $request->file('main_image');
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
                    $product->main_image = $imageName;
                }
            }

            if (empty($data['main_image'])) {
                $data['main_image'] = "";
            }

            if (empty($data['product_video'])) {
                $data['product_video'] = "";
            }

            if (empty($data['product_discount'])) {
                $data['product_discount'] = 0;
            }

            if (empty($data['description'])) {
                $data['description'] = "";
            }

            if (empty($data['meta_title'])) {
                $data['meta_title'] = "";
            }

            if (empty($data['meta_keywords'])) {
                $data['meta_keywords'] = "";
            }

            if (empty($data['meta_description'])) {
                $data['meta_description'] = "";
            }

            if (empty($data['meta_title'])) {
                $data['meta_title'] = "";
            }

            if (empty($data['group_code'])) {
                $data['group_code'] = "";
            }

            // Upload Product Video
            if ($request->hasFile('product_video')) {
                $video_temp = $request->file('product_video');
                if ($video_temp->isValid()) {
                    // Upload video
                    $video_name = $video_temp->getClientOriginalName();
                    $extension = $video_temp->getClientOriginalExtension();
                    $videoName = $video_name;
                    $video_path = 'videos/products_videos/';
                    $video_temp->move($video_path, $videoName);
                    // Save video in table
                    $product->product_video = $video_name;
                }
            }

            if (empty($data['product_video'])) {
                $data['product_video'] = "";
            }

            // Find Data From ID
            $categoryDetails = Category::find($data['category_id']);
            $product->category_id = $data['category_id'];
            $product->product_name = $data['product_name'];
            $product->product_code = $data['product_code'];
            $product->product_price = $data['product_price'];
            $product->product_color = $data['product_color'];
            $product->group_code = $data['group_code'];
            $product->product_discount = $data['product_discount'];
            $product->product_weight = $data['product_weight'];
            $product->material = $data['product_material'];
            $product->description = $data['description'];
            $product->meta_title = $data['meta_title'];
            $product->meta_keywords = $data['meta_keywords'];
            $product->meta_description = $data['meta_description'];
            if(!empty($data['is_featured'])){
                $product->is_featured = $data['is_featured'];
            }else{
                $product->is_featured = "No";
            }
            $product->status = 1;
            $product->save();
            session::flash('success_message', $message);
            return redirect('admin/products');
        }

        $categories = Category::where(['parent_id' => 'ROOT', 'status' => 1])->get();

        return view ('layouts.admin.products.add_edit_products')->with(compact('title', 'categories', 'productdata', 'page_name'));
    }

    public function deleteProduct($id)
    {
        Product::where('id', $id)->delete();
        $message = 'Product has been Deleted Successfully !';
        Session::flash('success_message', $message);
        return redirect()->back();
    }

    public function deleteProductImage($id)
    {
        // Get product image
        $productImage = Product::select('main_image')->where('id', $id)->first();

        // Get Image Path
        $smallImagePath = 'images/admin_images/product_images/small/';
        $mediumImagePath = 'images/admin_images/product_images/medium/';
        $largeImagePath = 'images/admin_images/product_images/large/';

        // Delete Image from folder if exist in small folder
        if (file_exists($smallImagePath.$productImage->main_image)) {
            unlink($smallImagePath.$productImage->main_image);
        }

        // Delete Image from folder if exist in medium folder
        if (file_exists($mediumImagePath.$productImage->main_image)) {
            unlink($mediumImagePath.$productImage->main_image);
        }

        // Delete Image from folder if exist in large folder
        if (file_exists($largeImagePath.$productImage->main_image)) {
            unlink($largeImagePath.$productImage->main_image);
        }

        // Delete image from product table
        Product::where('id', $id)->update(['main_image'=>'']);
        $message = 'Product Image has been Deleted Successfully !';
        session::flash('success_message', $message);
        return redirect()->back();
    }

    public function deleteProductVideo($id)
    {
        // Get product image
        $productVideo = Product::select('product_video')->where('id', $id)->first();

        // Get Video Path
        $productVideoPath = 'videos/products_videos/';

        // Delete Image from folder if exist in small folder
        if (file_exists($productVideoPath.$productVideo->product_video)) {
            unlink($productVideoPath.$productVideo->product_video);
        }

        // Delete image from product table
        Product::where('id', $id)->update(['product_video'=>'']);
        $message = 'Product Videos has been Deleted Successfully !';
        session::flash('success_message', $message);
        return redirect()->back();
    }

    public function addAttributes(Request $request, $id)
    {
        $page_name = "";
        if ($request->isMethod('post')) {
            $data = $request->all();
            foreach ($data['sku'] as $key => $value) {
                if (!empty($value)) {
                    //For SKU Checking
                    $attrCountSKU = ProductsAttributes::where('sku', $value)->count();
                    if ($attrCountSKU > 0) {
                        $message = "SKU Already exist, Please add another SKU !";
                        session::flash('error_message', $message);
                        return redirect()->back();
                    }

                    //For Size if exist
                    $attrCountSize = ProductsAttributes::where(['product_id' => $id, 'size' => $data['size'][$key]])->count();
                    if ($attrCountSize > 0) {
                        $message = "Size Already exist, Please add another Size !";
                        session::flash('error_message', $message);
                        return redirect()->back();
                    }

                    $attribute = new ProductsAttributes;
                    $attribute->product_id = $id;
                    $attribute->sku = $value;
                    $attribute->size = $data['size'][$key];
                    $attribute->price = $data['price'][$key];
                    $attribute->stock = $data['stock'][$key];
                    $attribute->status = 1;
                    $attribute->save();
                }
            }
            $message = "Product Attribute has been successfully added !";
            session::flash('success_message', $message);
            return redirect()->back();
        }

        $productdata = Product::select('id', 'product_name', 'product_code', 'product_color', 'product_price', 'main_image')->with('attributes')->find($id);
        $productdata = json_decode(json_encode($productdata), true);
        // echo "<pre>"; print_r($productdata); die;
        $title = "Product Attributes";
        return view('layouts.admin.products.add_attribute')->with(compact('productdata', 'title', 'page_name'));
    }

    public function editAttributes(Request $request, $id)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;
            foreach ($data['attrId'] as $key => $attr) {
                if (!empty($attr)) {
                    ProductsAttributes::where(['id'=>$data['attrId'][$key]])->update(['sku'=>$data['sku'][$key], 'size'=>$data['size'][$key], 'price'=>$data['price'][$key], 'stock'=>$data['stock'][$key]]);
                }
            }
        }
        $message = 'Attributes has been Edited Successfully !';
        session::flash('success_message_edit_attr', $message);
        return redirect()->back();
    }

    public function updateAttributeStatus(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            if ($data['status'] == "Active") {
                $status = 0;
            } else {
                $status = 1;
            }
            ProductsAttributes::where('id', $data['attribute_id'])->update(['status'=>$status]);
            return response()->json(['status'=>$status, 'attribute_id'=>$data['attribute_id']]);
        }
    }

    public function deleteAttributes($id)
    {
        ProductsAttributes::where('id', $id)->delete();
        $message = 'Attributes has been Deleted Successfully !';
        Session::flash('success_message_edit_attr', $message);
        return redirect()->back();
    }

    public function addImages(Request $request, $id)
    {
        $page_name = "";
        if ($request->isMethod('post')) {
            if ($request->hasFile('image')) {
                $images = $request->file('image');
                foreach ($images as $key => $image) {
                    $productImage = new ProductsImages;
                    $imageTemp = Image::make($image);
                    $extension = $image->getClientOriginalExtension();
                    $imageName = rand(111,999999).time().".".$extension;

                     // Set Path Image
                     $large_image_path = 'images/admin_images/product_images/large/'.$imageName;
                     $medium_image_path = 'images/admin_images/product_images/medium/'.$imageName;
                     $small_image_path = 'images/admin_images/product_images/small/'.$imageName;
                     // Upload origninal image (size big)
                     Image::make($imageTemp)->save($large_image_path);
                     // Upload image then resized it
                     Image::make($imageTemp)->resize(520,600)->save($medium_image_path);
                     Image::make($imageTemp)->resize(260,300)->save($small_image_path);

                     $productImage->image = $imageName;
                     $productImage->product_id = $id;
                     $productImage->status = 1;
                     $productImage->save();
                }
                $message = 'Product Image has been Uploaded Successfully !';
                Session::flash('success_message_edit_attr', $message);
                return redirect()->back();
            }
        }
        $productdata = Product::with('images')->select('id', 'product_name', 'product_code', 'product_color', 'main_image')->find($id);
        $productdata = json_decode(json_encode($productdata), true);
        $title = "Add Images Attribute";
        // echo "<pre>"; print_r($productdata); die;
        return view('layouts.admin.products.add_images')->with(compact('productdata', 'title', 'page_name'));
    }

    public function updateImagesStatus(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            if ($data['status'] == "Active") {
                $status = 0;
            } else {
                $status = 1;
            }
            ProductsImages::where('id', $data['image_id'])->update(['status'=>$status]);
            return response()->json(['status'=>$status, 'image_id'=>$data['image_id']]);
        }
    }

    public function deleteImage($id)
    {
        // Get product image
        $productImage = ProductsImages::select('image')->where('id', $id)->first();

        // Get Image Path
        $smallImagePath = 'images/admin_images/product_images/small/';
        $mediumImagePath = 'images/admin_images/product_images/medium/';
        $largeImagePath = 'images/admin_images/product_images/large/';

        // Delete Image from folder if exist in small folder
        if (file_exists($smallImagePath.$productImage->image)) {
            unlink($smallImagePath.$productImage->image);
        }

        // Delete Image from folder if exist in medium folder
        if (file_exists($mediumImagePath.$productImage->image)) {
            unlink($mediumImagePath.$productImage->image);
        }

        // Delete Image from folder if exist in large folder
        if (file_exists($largeImagePath.$productImage->image)) {
            unlink($largeImagePath.$productImage->image);
        }

        // Delete image from product table
        ProductsImages::where('id', $id)->delete();
        $message = 'Product Image has been Deleted Successfully !';
        session::flash('success_message_edit_attr', $message);
        return redirect()->back();
    }
}
