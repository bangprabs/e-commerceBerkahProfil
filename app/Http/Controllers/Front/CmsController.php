<?php

namespace App\Http\Controllers\Front;

use Session;
use App\Models\CmsPage;
use App\Models\Wishlist;
use App\Models\CategoryBlog;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;


class CmsController extends Controller
{
    public function cmsPage(){
        $page_name = "cms_page";
        $blogCategory = CategoryBlog::select('name')->where('status', 1)->get()->toArray();
        $currentRoute = url()->current();
        $currentRoute = str_replace("http://127.0.0.1:5126/","", $currentRoute);
        $cmsRoutes = CmsPage::where('status', 1)->get()->pluck('url')->toArray();
        if (in_array($currentRoute, $cmsRoutes)) {
            $cmsPageDetails = CmsPage::where('url', $currentRoute)->first()->toArray();
            $meta_title = $cmsPageDetails['meta_title'];
            $meta_keywords = $cmsPageDetails['meta_keywords'];
            $meta_description = $cmsPageDetails['meta_description'];
            return view('layouts.front.pages.cms_pages')->with(compact('cmsPageDetails', 'page_name', 'blogCategory', 'meta_title', 'meta_description', 'meta_keywords'));
        } else {
            abort(404);
        }
    }

    public function contact(Request $request){
        $page_name = "contact";
        $userWishlistItems = Wishlist::userWishlistItems();
        $blogCategory = CategoryBlog::select('name')->where('status', 1)->get()->toArray();

        if($request->isMethod('post')){
            $data = $request->all();

            $rules = [
                'name' => 'required',
                'email' => 'required|email',
                'subject' => 'required',
                'message' => 'required',
            ];

            $validator = Validator::make($data, $rules);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $email = "bangprabs@gmail.com";
            $messageData = [
                'name' => $data['name'],
                'email' => $data['email'],
                'subject' => $data['subject'],
                'comment' => $data['message']
            ];
            Mail::send('emails.enquiry', $messageData, function($message)use($email){
                $message->to($email)->subject("Email dari Website E-Commerce");
            });
            $message = "Terima kasih telah mengirimkan email kepada kami. Kami akan memberi feedback segera !";
            session::flash('success_message', $message);
            return redirect()->back();
        }
        return view('layouts.front.pages.contact')->with(compact('page_name', 'blogCategory', 'userWishlistItems'));
    }
}
