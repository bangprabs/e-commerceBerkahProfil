<?php

namespace App\Http\Controllers\Admin;

use Image;
use App\Models\Admin;
use App\Models\AdminsRoles;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    public function dashboard()
    {
        $page_name = "";
        return view('layouts.admin.admin_dashboard')->with(compact('page_name'));
    }

    public function login(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();

            $request->validate([
                'email' => 'required|email|max:255',
                'password' => 'required',
            ]);

            if (Auth::guard('admin')->attempt(['email' => $data['email'], 'password'=> $data['password'], 'status' => 1])) {
                return redirect('admin/dashboard');
            } else {
                $value = "Invalid Email or Password";
                Session::flash('error_message', $value);
                return redirect()->back();
            }
        }
        return view('layouts.admin.admin_login');
    }

    public function settings() {
        $page_name = "";
        $adminDetails = Admin::where('email', Auth::guard('admin')->user()->email)->first();
        return view('layouts.admin.admin_settings')->with(compact('adminDetails', 'page_name'));
    }

    public function chkCurrentPassword(Request $request){
        $data = $request->all();
        if (Hash::check($data['current_pwd'], Auth::guard('admin')->user()->password)) {
            echo "true";
        } else {
            echo "false";
        }
    }

    public function updateCurrentPassword(Request $request) {
        if ($request->isMethod('post')) {
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;

            if (Hash::check($data['current_pwd'], Auth::guard('admin')->user()->password)) {
                if ($data['new_pwd'] == $data ['confirm_pwd']) {
                    Admin::where('id', Auth::guard('admin')->user()->id)->update(['password'=>bcrypt($data['new_pwd'])]);
                    Session::flash('success_message', 'Password has been updated successfully !');
                } else {
                    Session::flash('error_message', 'Your new password and Confirm Password doesn\'t match');
                }
            } else {
                Session::flash('error_message', 'Your current password is incorrect');
                return redirect()->back();
            }
            return redirect()->back();
        }
    }

    public function updateAdminDetails(Request $request){
        $page_name = "";
        if ($request->isMethod('post')) {
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;
            $rules = [
                'admin_name' => 'required|regex:/^[\pL\s\-]+$/u',
                'admin_mobile' => 'required|numeric',
                'admin_image' => 'mimes:jpeg,jpg,png,gif|required|max:100000'
            ];
            $customeMessages = [
                'admin_name.required' => 'Name is required',
                'admin.regex' => 'Valid name is required',
                'admin_mobile.required' => 'Mobile is required',
                'admin_mobile.numeric' => 'Valid Mobile is required',
                'admin_image.mimes' => 'Valid Image is required'
            ];
            $this->validate($request, $rules, $customeMessages);

            // Update image
            if ($request->hasFile('admin_image')) {
                $image_tmp = $request->file('admin_image');
                    if ($image_tmp->isValid()) {
                        // Get Image Extension
                        $extension = $image_tmp->getClientOriginalExtension();
                        // Generate New Image Name
                        $imageName = rand(111,9999).'.'.$extension;
                        $imagePath = 'images/admin_images/admin_photos/'.$imageName;
                        // Upload the images
                        Image::make($image_tmp)->resize(400,400)->save($imagePath);
                    } else if (!empty($data['current_admin_image'])){
                        $imageName = $data['current_admin_image'];
                    } else {
                        $imageName = "";
                    }
            }

            // Update admin details
            Admin::where('email', Auth::guard('admin')->user()->email)->update(
                [
                    'name'=>$data['admin_name'],
                    'mobile'=>$data['admin_mobile'],
                    'image'=>$imageName
                ]);
            Session::flash('success_message', 'Admin Detail has been updated successfully !');
            return redirect()->back();

        }
        $adminDetails = Admin::where('email', Auth::guard('admin')->user()->email)->first();

        return view('layouts.admin.update_admin_details')->with(compact('adminDetails', 'page_name'));
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect('/admin');
    }

    public function adminsSubadmins()
    {
        if (Auth::guard('admin')->user()->type=="subadmin") {
            return redirect('admin/dashboard');
        }
        $page_name = "";
        $admins_subadmins = Admin::get();
        return view('layouts.admin.admins_submadmins.admins_subadmins')->with(compact('admins_subadmins', 'page_name'));
    }

    public function updateAdminStatus(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            if ($data['status'] == "Active") {
                $status = 0;
            } else {
                $status = 1;
            }
            Admin::where('id', $data['admin_id'])->update(['status'=>$status]);
            return response()->json(['status'=>$status, 'admin_id'=>$data['admin_id']]);
        }
    }

    public function deleteAdmin($id)
    {
        Admin::where('id', $id)->delete();
        $message = 'Admin sukses dihapus !';
        session::flash('success_message', $message);
        return redirect()->back();
    }

    public function addEditAdminSubadmin($id = null, Request $request)
    {
        $page_name = "";
        if($id == ""){
            $title = "Tambah Admin/SubAdmin";
            $admindata = new Admin;
            $message = "Admin/SubAdmin berhasil di tambahkan";
        } else {
            $title = "Edit Admin/SubAdmin";
            $admindata = Admin::find($id);
            // $admindata = json_decode(json_encode($admindata), true);
            $message = "Admin/SubAdmin berhasil di edit";
        }


        if ($request->isMethod('post')) {
            $data = $request->all();

            if ($id=="") {
                $adminCount = Admin::where('email', $data['email'])->count();
                if ($adminCount>0) {
                    Session::flash('error_message', 'Admin / SubAdmin sudah ada');
                    return redirect()->back();
                }
            }

            // echo "<pre>"; print_r($data); die;

            $rules = [
                'admin_name' => 'required|regex:/^[\pL\s\-]+$/u',
                'mobile' => 'required|numeric'
            ];
            $customeMessages = [
                'admin_name.required' => 'Name is required',
                'admin.regex' => 'Valid name is required',
                'mobile.required' => 'Mobile is required',
                'mobile.numeric' => 'Valid Mobile is required'
            ];
            $this->validate($request, $rules, $customeMessages);

            // Update image
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
                    $image_path = 'images/admin_images/admin_photos/'.$imageName;
                    // Upload origninal image (size big)
                    Image::make($image_tmp)->save($image_path);
                    // Insert image name to table
                    $admindata->image = $imageName;
                }
            }

            $admindata->name = $data['admin_name'];
            $admindata->mobile = $data['mobile'];
            $admindata->email = $data['email'];
            $admindata->type = $data['admin_type'];
            if ($id == "") {
                $admindata->email = $data['email'];
                $admindata->type = $data['admin_type'];
            }
            if ($data['admin_password']!="") {
                $admindata->password = bcrypt($data['admin_password']);
            }
            $admindata->save();

            Session::flash('success_message', $message);
            return redirect('admin/admins-subadmins');
        }
        return view('layouts.admin.admins_submadmins.add_edit_admins_subadmins')->with(compact('title', 'admindata', 'page_name'));
    }

    public function updateRole($id, Request $request)
    {
        $page_name = "";
        if ($request->isMethod('post')) {
            $data = $request->all();
            unset($data['_token']);

            AdminsRoles::where('admin_id', $id)->delete();

            foreach ($data as $key => $value) {
                if (isset($value['view'])) {
                    $view = $value['view'];
                } else {
                    $view = 0;
                }
                if (isset($value['edit'])) {
                    $edit = $value['edit'];
                } else {
                    $edit = 0;
                }
                if (isset($value['full'])) {
                    $full = $value['full'];
                } else {
                    $full = 0;
                }

                AdminsRoles::where('admin_id')->insert([
                    'admin_id' => $id,
                    'module' => $key,
                    'view_access' => $view,
                    'edit_access' => $edit,
                    'full_access' => $full
                ]);
            }
            $message = "Perizinan berhasil di ubah";
            Session::flash('success_message', $message);
            return redirect()->back();
        }

        $adminDetails = Admin::where('id', $id)->first()->toArray();
        $title = "Ubah Role " . $adminDetails['type'] . " " .$adminDetails['name'];
        $adminRoles = AdminsRoles::where('admin_id', $id)->get()->toArray();
        return view('layouts.admin.admins_submadmins.update_roles')->with(compact('title', 'page_name', 'adminDetails', 'adminRoles'));
    }
}
