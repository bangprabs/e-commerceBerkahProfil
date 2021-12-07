<?php

namespace App\Http\Controllers\Admin;

use Image;
use Session;
use App\Models\Category;
use App\Models\AdminsRoles;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function categories()
    {
        $page_name = "";
        $categories = Category::with(['parentcategory'])->get();

        $categoryModuleCount = AdminsRoles::where(['admin_id'=>Auth::guard('admin')->user()->id, 'module'=>'categories'])->count();
        if(Auth::guard('admin')->user()->type == "superadmin"){
            $categoryModule['view_access'] = 1;
            $categoryModule['edit_access'] = 1;
            $categoryModule['full_access'] = 1;
        }
        else if ($categoryModuleCount <= 0) {
            $message = "Menu tersebut tidak dibisa di akses oleh anda !";
            session::flash('error_message', $message);
            return redirect('admin/dashboard');
        } else {
            $categoryModule = AdminsRoles::where(['admin_id'=>Auth::guard('admin')->user()->id, 'module'=>'categories'])->first()->toArray();
        }

        return view('layouts.admin.categories.categories')->with(compact('categories', 'page_name', 'categoryModule'));
    }

    public function updateCategoryStatus(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            if ($data['status'] == "Active") {
                $status = 0;
            } else {
                $status = 1;
            }
            Category::where('id', $data['category_id'])->update(['status'=>$status]);
            return response()->json(['status'=>$status, 'category_id'=>$data['category_id']]);
        }
    }

    public function addEditCategory(Request $request, $id=null)
    {
        $page_name = "";
        if ($id=="") {
            // Add category function
            $title = "Add Category";
            $category = new Category;
            $categorydata = array();
            $getCategories = Category::with('subcategories')->where(['parent_id'=>0, 'status'=>1])->get();
            $message = "Category has been added successfully !";
        }else{
            // Edit Category Funtcion
            $title = "Edit Category";
            $categorydata = Category::where('id', $id)->first();
            $getCategories = Category::with('subcategories')->where(['parent_id'=>0, 'status'=>1])->get();
            $category = Category::find($id);
            $message = "Category has been updated !";

        }

        if ($request->isMethod('post')) {

            $data = $request->all();

            // Category Valdation
            $rules = [
                'category_name' => 'required|regex:/^[\pL\s\-]+$/u',
                'url' => 'required',
                'category_image' => 'image'
            ];
            $customeMessages = [
                'category_name.required' => 'Category Name is required',
                'category_name.regex' => 'Valid Category Name is required',
                'url.required' => 'Category URL is required',
                'category_image.image' => 'Valid Category Image is required'
            ];
            $this->validate($request, $rules, $customeMessages);

            // Update image
            if ($request->hasFile('category_image')) {
            $image_tmp = $request->file('category_image');
                if ($image_tmp->isValid()) {
                    // Get Image Extension
                    $extension = $image_tmp->getClientOriginalExtension();
                    // Generate New Image Name
                    $imageName = rand(111,9999).'.'.$extension;
                    $imagePath = 'images/admin_images/category_images/'.$imageName;
                    // Upload the images
                    Image::make($image_tmp)->resize(1920,406)->save($imagePath);
                    $category->category_image = $imageName;
                }
            }


            if (empty($data['category_discount'])) {
                $data['category_discount'] = 0;
            }

            if (empty($data['description'])) {
                $data['description'] = "";
            }

            if (empty($data['meta_title'])) {
                $data['meta_title'] = "";
            }

            if (empty($data['meta_description'])) {
                $data['meta_description'] = "";
            }

            if (empty($data['meta_keywords'])) {
                $data['meta_keywords'] = "";
            }

            $category->parent_id = $data['parent_id'];
            $category->category_name = $data['category_name'];
            $category->category_discount = $data['category_discount'];
            $category->description = $data['description'];
            $category->url = $data['url'];
            $category->meta_title = $data['meta_title'];
            $category->meta_description = $data['meta_description'];
            $category->meta_keywords = $data['meta_keywords'];
            $category->status = 1;
            $category->save();


            Session::flash('success_message', $message);
            return redirect('admin/categories');
            }
         return view('layouts.admin.categories.add_edit_categories')->with(compact('title', 'categorydata', 'getCategories', 'page_name'));
    }

    public function deleteCategory($id)
    {
        Category::where('id', $id)->delete();
        $message = 'Category has been Deleted Successfully !';
        session::flash('success_message', $message);
        return redirect()->back();
    }
}
