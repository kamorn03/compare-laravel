<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Redirect;
use App\Models\Size;
use Yajra\DataTables\DataTables;
use App\Models\Product;

class SizeController extends Controller
{
    public function index(Request $request , $id)
    {
        $product = Product::find($id);
        return view('admin.manage-size.index' , compact('product'));
    }

    public function sizeAdd($id)
    {   
        $product = Product::find($id);
        return view('admin.manage-size.add', compact('product'));
    }

    public function sizeEdit(Request $request,$product, $id)
    {
        $size = Size::find($id); 
        // dd($size);
        $product = Product::find($product);
        return view('admin.manage-size.add', compact('size','product'));
    }

    public function sizeList($id)
    {
        return Datatables::of(Size::query()->where('product_id' , $id))->make(true);
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
            'product_id' => 'required'
        ]);
        $insert = [
            'size' => $request->size,
            'type' => '-',
            'product_id' => $request->product_id,
        ];

        Size::insertGetId($insert);
        return Redirect::to(route('admin.product.size', ['id' => $request->product_id]))->with('success','Greate! posts created successfully.');
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
        return Redirect::to(route('admin.product.size', ['id' => $request->product_id]))->with('success','Greate! posts updated successfully.');
    }

    
    public function destroy($product,$id)
    {
        // dd($product);
        Size::find($id)->delete();
        return redirect()->route('admin.product.size', ['id' => $product])
                        ->with('success','User deleted successfully');
    }
    
}
