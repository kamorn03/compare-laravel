<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Redirect;
use App\Models\Size;
use Yajra\DataTables\DataTables;

class SizeController extends Controller
{
    public function index(Request $request)
    {
        return view('admin.manage-size.index');
    }

    public function sizeAdd()
    {
        return view('admin.manage-size.add');
    }

    public function sizeEdit(Request $request, $id)
    {
        $size = Size::find($id); 
        // dd($size);
        return view('admin.manage-size.add', compact('size'));
    }

    public function sizeList()
    {
        return Datatables::of(Size::query())->make(true);
    }


    public function sizeUpdate(Request $request ,$id)
    {
        $size = Size::find($id);
        return view('admin.manage-size.add',compact('size'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'size' => 'required',
            // 'file' => 'required'
        ]);
        $insert = [
            'size' => $request->size,
            'type' => '-'
        ];

        Size::insertGetId($insert);
        return Redirect::to(route('admin.size'))->with('success','Greate! posts created successfully.');
    }

      /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $size =  Size::find($request->get('id'));
        $request->validate([
            'size' => 'required',
            
        ]);

        $insert = [
            'size' => $request->size,
            'type' => '-'
        ];

        $size->update($insert);
        return Redirect::to(route('admin.size'))->with('success','Greate! posts updated successfully.');
    }

    
    public function destroy($id)
    {
        Size::find($id)->delete();
        return redirect()->route('admin.size')
                        ->with('success','User deleted successfully');
    }
    
}
