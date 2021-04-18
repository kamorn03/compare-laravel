<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.manage-banner.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function show(Banner $banner)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function edit(Banner $banner)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Banner $banner)
    {

        // แยก path ได้
        // dd(Banner::first());
        // dd($request->file('file'));
        $data_banner = Banner::first();
        if(!$data_banner){

            $image = $request->file('image1');
            $imageName = time() . '.' . $image->extension();
            $image->move(public_path('images/banner/'), $imageName);
            // $table->string('path_img', 255)->nullable();
            // $table->text('link')->nullable();
            // $table->text('detail')->nullable();
            $data_banner = Banner::create([
                'path_img' => "images/banner/".$imageName,
                'link' => 'test',
                'detail' => 'test',
            ]);
            $image2 = $request->file('image2');
            $imageName2 = time() . '.' . $image2->extension();
            $image2->move(public_path('images/banner/'), $imageName2);
            // $table->string('path_img', 255)->nullable();
            // $table->text('link')->nullable();
            // $table->text('detail')->nullable();
            $data_banner2 = Banner::create([
                'path_img' => "images/banner/".$imageName2,
                'link' => 'test',
                'detail' => 'test',
            ]);
            return Redirect::to(route('admin.banner'))->with('success','Greate! posts created successfully.');
        }else{
            $image = $request->file('image1');
            $imageName = time() . '.' . $image->extension();
            $image->move(public_path('images/banner/'), $imageName);
            $data_banner = Banner::where('id', 1)->update([
                'path_img' => "images/banner/".$imageName,
                'link' => 'test',
                'detail' => 'test',
            ]);
            $image2 = $request->file('image2');
            $imageName2 = time() . '.' . $image2->extension();
            $image2->move(public_path('images/banner/'), $imageName2);
            $data_banner = Banner::where('id', 2)->update([
                'path_img' => "images/banner/".$imageName2,
                'link' => 'test',
                'detail' => 'test',
            ]);

            return Redirect::to(route('admin.banner'))->with('success','Greate! posts created successfully.');
        }
        // $banner::in
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function destroy(Banner $banner)
    {
        //
    }
}
