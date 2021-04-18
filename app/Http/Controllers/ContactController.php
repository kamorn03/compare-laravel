<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CMSAdminManage;
use Redirect;


class ContactController extends Controller
{
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // ดึงข้อมูล
        $contact = CMSAdminManage::where('page_type', 'contact')->first();
        return view('contact.index', compact('contact'));
    }

    // page
    public function updateContact(){
        $contact = CMSAdminManage::where('page_type', 'contact')->first();
        $count = CMSAdminManage::count();
        return view('admin.manage-contact.index',compact('contact', 'count'));
    }

    // api
    public function update(Request $request , $id){

        $this->validate($request, [
            'email' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'location' => 'required',
            'phone' => 'required',
            'time' => 'required',
            'email' => 'required',
        ]);
    
        $cms = CMSAdminManage::find($id);
        $contact = [
            'location' => $request->location,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'phone' => $request->phone,
            'email' => $request->email,
            'time' => $request->time,
            // 'state' => 'STATE',
        ];
        $insert = [
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
            'meta_keyword' => $request->meta_keyword,
            'page_type' => 'contact',
            // 'slug' => SlugService::createSlug(Product::class, 'slug', $request->title),
            'contact' => json_encode($contact),
        ];

        if(isset($cms)){
            $cms->update($insert);
        }else{
            CMSAdminManage::insertGetId($insert);
        }
        return redirect()->route('admin.contact', ['cms' =>  $id])
            ->with('success','เพิ่มที่อยู่สำเร็จ');   
      

    }
}
