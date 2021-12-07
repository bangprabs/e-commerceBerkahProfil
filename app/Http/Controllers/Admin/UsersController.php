<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class UsersController extends Controller
{
    public function users()
    {
        $page_name = "";
        $users = User::get()->toArray();
        // dd($users); die;
        return view('layouts.admin.users.users')->with(compact('users', 'page_name'));
    }

    public function updateUserStatus(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            if ($data['status'] == "Active") {
                $status = 0;
            } else {
                $status = 1;
            }
            User::where('id', $data['user_id'])->update(['status'=>$status]);
            return response()->json(['status'=>$status, 'user_id'=>$data['user_id']]);
        }
    }

    public function viewUserCharts(){
        $page_name = "";
        $currentMonthUser = User::whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->month)->count();
        $before1Month = User::whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->subMonth(1))->count();
        $before2Month = User::whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->subMonth(2))->count();
        $before3Month = User::whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->subMonth(3))->count();
        $usersCount = array($currentMonthUser,$before1Month,$before2Month,$before3Month);
        return view('layouts.admin.users.view_users_charts')->with(compact('page_name', 'usersCount'));
    }

    public function viewUserCityCharts(){
        $page_name = "";
        $getUserCity = User::select('city', DB::raw('count(city) as count'))->groupBy('city')->get()->toArray();
        // dd($getUserCity);
        return view('layouts.admin.users.view_userscity_charts')->with(compact('page_name', 'getUserCity'));
    }
}
