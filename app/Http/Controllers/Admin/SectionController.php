<?php

namespace App\Http\Controllers\Admin;

use App\Models\Sections;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;

class SectionController extends Controller
{
    public function sections()
    {
        $sections = Sections::get();
        return view('layouts.admin.sections.sections')->with(compact('sections'));
    }

    public function updateSectionsStatus(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            if ($data['status'] == "Active") {
                $status = 0;
            } else {
                $status = 1;
            }
            Sections::where('id', $data['section_id'])->update(['status'=>$status]);
            return response()->json(['status'=>$status, 'section_id'=>$data['section_id']]);
        }
    }

    public function addEditSections($id = null, Request $request)
    {
        if ($id == "") {
            $sectiondata = new Sections;
            $title = "Add Section Data";
            $message = 'Section has been Added Successfully !';
            $listsection = Sections::get();
        } else {
            $sectiondata = Sections::find($id);
            $title = "Edit Section Data";
            $message = 'Section has been Updated Successfully !';
            $listsection = Sections::get();
        }

        if ($request->isMethod('post')) {
            $data = $request->all();
            $sectiondata->name = $data['section_name'];
            $sectiondata->status = 1;

            $sectiondata->save();
            session::flash('success_message', $message);
            return redirect('admin/sections');
        }
        return view('layouts.admin.sections.add_edit_section')->with(compact('title', 'sectiondata', 'listsection'));
    }

    public function deleteSections($id)
    {
        Sections::where('id', $id)->delete();
        $message = 'Section has been Deleted Successfully !';
        session::flash('success_message', $message);
        return redirect()->back();
    }
}
