<?php

namespace App\Http\Controllers\Admin;

use App\Models\CmsPage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use Validator;

class CmsController extends Controller
{
    public function cmspages(){
        $page_name = "";
        $cms_pages = CmsPage::get()->toArray();
        return view('layouts.admin.pages.cms_pages')->with(compact('cms_pages', 'page_name'));
    }

    public function updateCmsStatus(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            if ($data['status'] == "Active") {
                $status = 0;
            } else {
                $status = 1;
            }
            CmsPage::where('id', $data['page_id'])->update(['status'=>$status]);
            return response()->json(['status'=>$status, 'page_id'=>$data['page_id']]);
        }
    }

    public function deletePage($id)
    {
        CmsPage::where('id', $id)->delete();
        $message = 'Page has been Deleted Successfully !';
        session::flash('success_message', $message);
        return redirect()->back();
    }

    public function addEditCmsPage($id=null, Request $request){
        $page_name = "";
        if ($id == "") {
            $title = "Tambah Data CMS";
            $cmspage = new CmsPage;
            $message = "CMS Sukses di tambahkan";
        } else {
            $title = "Edit Data CMS";
            $cmspage = CmsPage::find($id);
            $message = "CMS Sukses di edit";
        }

        if ($request->isMethod('post')) {
            $data = $request->all();

            // Form Valdation
            $rules = [
                'title' => 'required',
                'url' => 'required',
                'description' => 'required'
            ];
            $customeMessages = [
                'title.required' => 'Judul harus di isi',
                'title.regex' => 'Masukkan judul yang sesuai',
                'url.required' => 'URL harus di isi',
                'description.required' => 'Deskripsi harus di isi'
            ];
            $this->validate($request, $rules, $customeMessages);

            $cmspage->title = $data['title'];
            $cmspage->url = $data['url'];
            $cmspage->description = $data['description'];
            $cmspage->meta_title = $data['meta_title'];
            $cmspage->meta_description = $data['meta_description'];
            $cmspage->meta_keywords = $data['meta_keywords'];
            $cmspage->status = 1;
            $cmspage->save();
            Session::flash('success_message', $message);
            return redirect('/admin/cms-pages');
        }

        return view('layouts.admin.pages.add_edit_cmspage')->with(compact('page_name', 'title', 'message', 'cmspage'));
    }

}
