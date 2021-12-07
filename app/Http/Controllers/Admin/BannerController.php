<?php

namespace App\Http\Controllers\Admin;

use App\Models\Banner;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Image;
use Session;

class BannerController extends Controller
{
    public function banners()
    {
        $page_name = "";
        $banners = Banner::get()->toArray();
        return view('layouts.admin.banners.banners')->with(compact('banners', 'page_name'));
    }

    public function updateBannerStatus(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            if ($data['status'] == "Active") {
                $status = 0;
            } else {
                $status = 1;
            }
            Banner::where('id', $data['banner_id'])->update(['status'=>$status]);
            return response()->json(['status'=>$status, 'banner_id'=>$data['banner_id']]);
        }
    }

    public function deleteBanner($id)
    {
        //Get Banner Image
        $bannerImage = Banner::where('id', $id)->first();

        //Get Banner Image Path
        $banner_image_path = 'images/admin_images/banner_images/';

        //Delete Banner Image if exists in Banners Folder
        if (file_exists($banner_image_path.$bannerImage->image)) {
            unlink($banner_image_path.$bannerImage->image);
        }

        //Delete Banner from DB
        Banner::where('id', $id)->delete();
        $message = 'Banner has been Deleted Successfully !';
        session::flash('success_message', $message);
        return redirect()->back();
    }

    public function addEditBanner($id = null, Request $request)
    {
        $page_name = "";
        if ($id == "") {
            $bannerdata = new Banner;
            $title = "Add Banner Image";
            $message = 'Brand has been Added Successfully !';
        } else {
            $bannerdata = Banner::find($id);
            $title = "Edit Banner Image";
            $message = 'Brand has been Updated Successfully !';
        }

        if ($request->isMethod('post')) {
            $data = $request->all();
            $bannerdata->link = $data['banner_link'];
            $bannerdata->title = $data['banner_title'];
            $bannerdata->description = $data['banner_description'];
            $bannerdata->alt = $data['banner_alt'];
            $bannerdata->status = 1;

             // Upload banner image
             if ($request->hasFile('image')) {
                $image_tmp = $request->file('image');
                if ($image_tmp->isValid()) {
                    // Get Original Name
                    $image_name = $image_tmp->getClientOriginalName();
                    // Get Extension
                    $extension = $image_tmp->getClientOriginalExtension();
                    // Generate Random Name
                    $imageName = $image_name.'-'.rand(111,99999).'.'.$extension;
                    // Set Path Image
                    $banner_image_path = 'images/admin_images/banner_images/'.$imageName;
                    // Upload image then resized it
                    Image::make($image_tmp)->resize(1920,748)->save($banner_image_path);
                    // Insert image name to table
                    $bannerdata->image = $imageName;
                }
            }

            $bannerdata->save();
            session::flash('success_message', $message);
            return redirect('admin/banners');
        }

        return view('layouts.admin.banners.add_edit_banner')->with(compact('title', 'bannerdata', 'page_name'));
    }
}
