<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Redirect;
use Cviebrock\EloquentSluggable\Services\SlugService;
use App\Models\Category;

class CategoryController extends Controller
{
    public function getCateGories()
    {
        $categories = Category::whereName($name)->get(); 
        return view('project.show_category')->with('categories',$categories);  
    }

    public function index()
    {
        // todo list
    }

    public function categoriesAdd()
    {
        return view('admin.manage-category.add');
    }

    public function categoryEdit(Request $request, $id)
    {
        $categories = Category::find($id); 
        return view('admin.manage-category.add', compact('categories'));
    }

    
     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'slug' => 'required',
            // 'file' => 'required'
        ]);
        $insert = [
            'slug' => SlugService::createSlug(Category::class, 'slug', $request->slug),
            'name' => $request->name,
        ];

        Category::insertGetId($insert);
        return Redirect::to(route('admin.category'))->with('success','Greate! posts created successfully.');
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
      
        $category =  Category::find($request->get('id'));
        
        $request->validate([
            'name' => 'required',
            'slug' => 'required',
            // 'file' => 'required'
        ]);

        $insert = [
            'slug' => SlugService::createSlug(Category::class, 'slug', $request->slug),
            'name' => $request->name,
        ];

        // dd($insert);

        $category->update($insert);
        return Redirect::to(route('admin.category'))->with('success','Greate! posts updated successfully.');
    }

    public function destroy($id)
    {
        Category::find($id)->delete();
        return redirect()->route('admin.category')
                        ->with('success','User deleted successfully');
    }
}
