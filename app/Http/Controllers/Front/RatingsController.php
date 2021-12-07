<?php

namespace App\Http\Controllers\Front;

use App\Models\Rating;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class RatingsController extends Controller
{
    public function addRating(Request $request){
        if ($request->isMethod('post')) {
            $data = $request->all();
            if (!Auth::check()) {
                $message = "Login untuk bisa memberi ulasan";
                Session::flash('error_messages', $message);
                return redirect()->back();
            }

            if (!isset($data['rate'])) {
                $message = "Berikan setidaknya 1 bintang untuk mengulas prooduk ini.";
                Session::flash('error_messages', $message);
                return redirect()->back();
            }

            $ratingCount = Rating::where(['user_id' => Auth::user()->id, 'product_id'=>$data['product_id']])->count();
            if ($ratingCount > 0) {
                $message = "Ulasan anda sudah diberikan pada barang ini.";
                Session::flash('error_messages', $message);
                return redirect()->back();
            } else {
                $rating = new Rating;
                $rating->user_id = Auth::user()->id;
                $rating->product_id = $data['product_id'];
                $rating->review = $data['review'];
                $rating->rating = $data['rate'];
                $rating->status = 0;
                $rating->save();
                $message = "Terima kasih telah memberikan ulasan pada produk kami. Ulasan akan muncul ketika di setujui";
                Session::flash('success_messages', $message);
                return redirect()->back();
            }
        }
    }
}
