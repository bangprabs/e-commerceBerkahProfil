<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Blog;
use App\Models\CategoryBlog;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Image;
use Session;

class BlogController extends Controller
{
    public function blog()
    {
        $page_name ="";
        $blogs = Blog::get();
        // dd($blogs); die;
        return view('layouts.admin.blog.blog')->with(compact('blogs', 'page_name'));
    }

    public function updateBlogStatus(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            if ($data['status'] == "Active") {
                $status = 0;
            } else {
                $status = 1;
            }
            Blog::where('id', $data['blog_id'])->update(['status'=>$status]);
            return response()->json(['status'=>$status, 'id'=>$data['blog_id']]);
        }
    }

    public function addEditCategory(Request $request, $id=null)
    {
        $page_name = "";
        if ($id=="") {
            // Add blog function
            $title = "Add Blog";
            $blog = new Blog;
            $blogdata = Blog::get();
            $message = "Blog has been added successfully !";
            $currentDate = Carbon::now()->format('yyyy/mm/dd');
        }else{
            // Edit Category Funtcion
            $title = "Edit Blog";
            $blog = Blog::find($id);
            $blogdata = Blog::find($id);
            $currentDate = Carbon::parse($blog['blog_date'])->format('yyyy/mm/dd');
            $message = "Blog has been added updated !";
        }

        if ($request->isMethod('post')) {

            $data = $request->all();

            // Category Valdation
            $rules = [
                'main_image' => 'image',
                'front_image' => 'image',
                'blog_date' => 'required',
                'blog_title' => 'required',
                'content_blog' => 'required'
            ];
            $customeMessages = [
                'main_image.image' => 'Valid Category Image is required',
                'front_image.image' => 'Valid Category Image is required',
                'blog_date.required' => 'Valid Blog Date is required',
                'blog_title.required' => 'Valid Blog Title is required',
                'content.blog' => 'Valid Content Blog is required',
            ];
            $this->validate($request, $rules, $customeMessages);

            // Update image
            if ($request->hasFile('main_image')) {
            $image_tmp_main = $request->file('main_image');
                if ($image_tmp_main->isValid()) {
                    // Get Image Extension
                    $extension = $image_tmp_main->getClientOriginalExtension();
                    // Generate New Image Name
                    $imageName = rand(111,9999).'.'.$extension;
                    $imagePathMain = 'images/admin_images/blog_main_images/'.$imageName;
                    // Upload the images
                    Image::make($image_tmp_main)->resize(600,600)->save($imagePathMain);
                    $blog->main_image = $imageName;
                }
            }

            if ($request->hasFile('front_image')) {
                $image_tmp = $request->file('front_image');
                    if ($image_tmp->isValid()) {
                        // Get Image Extension
                        $extension = $image_tmp->getClientOriginalExtension();
                        // Generate New Image Name
                        $imageName = rand(111,9999).'.'.$extension;
                        $imagePath = 'images/admin_images/blog_cover_images/'.$imageName;
                        // Upload the images
                        Image::make($image_tmp)->resize(600,600)->save($imagePath);
                        $blog->front_image = $imageName;
                }
            }

            $blog->blog_title = $data['blog_title'];
            $blog->blog_author = $data['author'];
            $blog->blog_content = $data['content_blog'];
            $blog->blog_date = $data['blog_date'];
            $blog->catblog_id = $data['blog_category'];
            $blog->status = 1;
            if(!empty($data['is_featured'])){
                $blog->is_featured = $data['is_featured'];
            }else{
                $blog->is_featured = "No";
            }
            $blog->save();


            Session::flash('success_message', $message);
            return redirect('admin/blogs');
        }

        // Get all category blog
        $getCategory = CategoryBlog::get();
        return view('layouts.admin.blog.add_edit_blog')->with(compact('title', 'getCategory', 'blog', 'currentDate', 'blogdata', 'page_name'));
    }

    public function upload(Request $request)
    {
        if($request->hasFile('upload')) {
            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = $fileName.'_'.time().'.'.$extension;

            $request->file('upload')->move(public_path('images/admin_images/blog_picture/'), $fileName);

            $CKEditorFuncNum = $request->input('CKEditorFuncNum');
            $url = asset('images/admin_images/blog_picture/'.$fileName);
            $msg = 'Image uploaded successfully';
            $response = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";

            @header('Content-type: text/html; charset=utf-8');
            echo $response;
        }
    }

    public function deleteBlog($id)
    {
        Blog::where('id', $id)->delete();
        $message = 'Blog has been Deleted Successfully !';
        session::flash('success_message', $message);
        return redirect()->back();
    }


}

