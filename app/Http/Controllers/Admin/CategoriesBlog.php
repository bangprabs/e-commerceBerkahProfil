<?php

namespace App\Http\Controllers\Admin;

use App\Models\CategoryBlog;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoriesBlog extends Controller
{
    public function category()
    {
        $page_name = "";
        $category = CategoryBlog::get();
        return view('layouts.admin.blog.category_blog')->with(compact('category', 'page_name'));
    }

    public function updateCatBlogStatus(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            if ($data['status'] == "Active") {
                $status = 0;
            } else {
                $status = 1;
            }
            CategoryBlog::where('id', $data['catblog_id'])->update(['status'=>$status]);
            return response()->json(['status'=>$status, 'catblog_id'=>$data['catblog_id']]);
        }
    }
}
