<?php

namespace App\Http\Controllers\Admin;

use App\Models\Rating;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RatingsController extends Controller
{
    public function ratings() {
        $page_name = "";
        $ratings = Rating::with(['user', 'product'])->get()->toArray();
        return view('layouts.admin.ratings.rating')->with(compact('ratings', 'page_name'));
    }

    public function updateRatingStatus(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            if ($data['status'] == "Active") {
                $status = 0;
            } else {
                $status = 1;
            }
            Rating::where('id', $data['rating_id'])->update(['status'=>$status]);
            return response()->json(['status'=>$status, 'rating_id'=>$data['rating_id']]);
        }
    }

}
