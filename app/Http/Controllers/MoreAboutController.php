<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CMSAdminManage;
use Redirect;

class MoreAboutController extends Controller
{
    public function index()
    {
        // ดึงข้อมูล
        $more_about = CMSAdminManage::where('page_type', 'more-about')->first();
        return view('admin.manage-more-about.index', compact('more_about'));
    }

    public function show()
    {
        $more_about = CMSAdminManage::where('page_type', 'more-about')->first();
        return view('more-about.index', compact('more_about'));
    }

    public function update(Request $request)
    {
        // แยก path ได้
        $data_more_about = CMSAdminManage::where('page_type', 'more-about')->first();
        if(!$data_more_about){
            $data_more_about = CMSAdminManage::create([
                'meta_title' =>  $request->get('meta_title'),
                'meta_description' =>  $request->get('meta_description'),
                'meta_keyword' =>  $request->get('meta_keyword'),
                'page_type' => 'more-about',
                'content' => $request->get('editor1'),
                'detail' => $request->get('editor2')
            ]);
            return Redirect::to(route('admin.more-about'))->with('success','Greate! posts created successfully.');
        }else{
            $data_more_about = CMSAdminManage::where('page_type', 'more-about')->update([
                'meta_title' =>  $request->get('meta_title'),
                'meta_description' =>  $request->get('meta_description'),
                'meta_keyword' =>  $request->get('meta_keyword'),
                'page_type' => 'more-about',
                'content' => $request->get('editor1'),
                'detail' => $request->get('editor2')
            ]);
            return Redirect::to(route('admin.more-about'))->with('success','Greate! posts created successfully.');
        }
    }   
}
