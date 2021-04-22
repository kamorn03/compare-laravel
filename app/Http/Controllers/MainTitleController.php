<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MainTitles;
use App\Models\Product;
use App\Models\Order;

class MainTitleController extends Controller
{
    function index()
    {
        $order_wait = Order::where('status','wait')->count();
        $order_payment = Order::where('status','payment')->count();
        $maintext = MainTitles::all();

        return view('admin.main-title.index', compact('order_wait','order_payment','maintext'));
    }

    function upload(Request $request)
    {
        $image = $request->file('file');

        $imageName = time() .$image->getClientOriginalName(). '.' . $image->extension();

        $image->move(public_path('images/title/'), $imageName);

        MainTitles::create([
            'image_path' => "images/title/".$imageName,
            'line_title' => "1",
            'description' => "1",
        ]);

        return response()->json(['success' => $imageName]);
    }

    function update(Request $request)
    {
        $id = $request->get('id');

        $main_title = MainTitles::where('id',$id)->update([
            // 'image_path' => "images/title/".$imageName,
            'line_title' => 'title',
            'description' => $request->get('description'),
        ]);
        // dd($main_title);
    }
    

    function fetch()
    {
        // where id 
        // $images = \File::allFiles(public_path('images\title'));
        $main = MainTitles::all();
        $output = '<div class="row">';
        $number = 1;
        foreach($main as $image)
        {
        $output .= '
                <div class="col-md-3" style="margin-bottom:16px;" align="center">
                    <div>
                        <label for="" class="col-sm-2 col-form-label text-left">รูปที่ '.$number.'</label>
                        <img src="'.asset($image->image_path).'" class="img-thumbnail" width="175" height="175" style="height:175px;" />
                    </div>
                    <div>
                    <div class="form-group row mt-3">
                    <label for="meta_title" class="col-sm-2 col-form-label text-right">Link</label>
                        <div class="col-sm-10">
                            <input class="form-control" placeholder="link" id="link-'.$image->id.'" name="link-'.$image->id.'">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 text-right">
                            <button type="button" class="btn btn-primary save_link" value="'.$image->link.'" id="save_link-'.$image->id.'">save</button>
                        </div>
                        <div class="col-sm-6">
                        <button type="button" class="btn btn-primary remove_image" id="'.$image->id.'">Remove</button>
                        </div>
                    </div>
                    </div>
                </div>
        ';
        $number ++;
        }
        $output .= '</div>';
        echo $output; // dont forget sweet alert !!!!
    }

    function delete(Request $request)
    {
        $title = MainTitles::where('id' , $request->get('id'))->first();
        $title->delete();
        // get id to see picture
        // if($request->get('name'))
        // {
        // \File::delete(public_path('images/title/' . $request->get('name')));
        // }
    }
}
