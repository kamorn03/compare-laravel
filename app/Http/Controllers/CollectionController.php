<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Redirect;
use Cviebrock\EloquentSluggable\Services\SlugService;
use App\Models\Collections;
use App\Models\Category;

class CollectionController extends Controller
{
    public function getCateGories()
    {
        $collection = Collections::whereName($name)->get(); 
        return view('project.show_collection')->with('collection',$collection);  
    }

    public function collectionAdd()
    {
        $categories = Category::all(); 
        return view('admin.manage-collection.add',compact('categories'));
    }

    public function collectionEdit(Request $request, $id)
    {
        $categories = Category::all(); 
        $collections = Collections::find($id);
        return view('admin.manage-collection.add', compact('categories','collections'));
    }

    public function index()
    {
        // todo list
    }

     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        $request->validate([
            'name' => 'required',
            'slug' => 'required',
            'category_id' => 'required'
            // 'file' => 'required'
        ]);
        $insert = [
            'slug' => SlugService::createSlug(Collections::class, 'slug', $request->slug),
            'name' => $request->name,
            'category_id' => $request->category_id
        ];

        Collections::insertGetId($insert);
        return Redirect::to(route('admin.collection'))->with('success','Greate! posts created successfully.');
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
        $category =  Collections::find($request->get('id'));
        $request->validate([
            'name' => 'required',
            'slug' => 'required',
            'category_id' => 'required'
            // 'file' => 'required'
        ]);
        $insert = [
            'slug' => SlugService::createSlug(Collections::class, 'slug', $request->slug),
            'name' => $request->name,
            'category_id' => $request->category_id
        ];
        $category->update($insert);
        return Redirect::to(route('admin.collection'))->with('success','Greate! posts updated successfully.');
    }


    public function collectionGetList(Request $request, $category_id)
    {
        $collections = Collections::where('category_id', $category_id)->get();
        return $collections;
    }

    public function destroy($id)
    {
        Collections::find($id)->delete();
        return redirect()->route('admin.collection')
                        ->with('success','User deleted successfully');
    }
    
}
