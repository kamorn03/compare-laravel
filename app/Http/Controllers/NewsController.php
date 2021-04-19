<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;
use Redirect;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Yajra\Datatables\Datatables;

class NewsController extends Controller
{
    public function index()
    {
        // ดึงข้อมูล
        $news = News::all();
        return view('news.index', compact('news'));
    }
      
    /**
     * Display the specified resource.
     *
     * @param  \App\Post $post
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        return view('admin.manage-news.show');
    }


    public function newsList()
    {
        return Datatables::of(News::query())->make(true);
    }

    // add page
    public function newsAdd()
    {
        return view('admin.manage-news.add');
    }

    // store
    public function store(Request $request)
    {
        // dd($request);
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'image' => 'required',
            'image1' => 'required'
        ]);

        // dd($request);
        if($request->file()) {
            $fileName = time().'_'.$request->file('image')->getClientOriginalName();
            if(!$request->file('image')->move(public_path('/img/cards'), $fileName)) {
                return false;
            }

            $fileName1 = time().'_'.$request->file('image1')->getClientOriginalName();
            if(!$request->file('image1')->move(public_path('/img/cards'), $fileName1)) {
                return false;
            }

            // $table->string('path_img', 255)->nullable();
            // $table->string('company_name', 255)->nullable();
            // $table->string('type', 255)->nullable();
            // $table->text('news_content')->nullable();
            // $table->text('news_detail')->nullable();
            
            $insert = [
                'meta_title' => $request->meta_title,
                'meta_description' => $request->meta_description,
                'meta_keyword' => $request->meta_keyword,
                // 'slug' => SlugService::createSlug(Product::class, 'slug', $request->title),
                'company_name' => $request->title,
                'news_content' => $request->title,
                'news_detail' => $request->description,
                'path_img' => $fileName,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'path_img_detail' => $fileName1 != ""? $fileName1 : $news->path_img_detail,
            ];
       
            News::insertGetId($insert);
            return Redirect::to(route('admin.news.add'))->with('success','บันทึกสำเร็จ');
        }
    }

    // edit page
    public function edit(Request $request ,$id)
    {
        $news = News::find($id);
        return view('admin.manage-news.add',compact('news'));
    }

    // update
    public function update(Request $request)
    {
        // dd($request);
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            // 'image' => 'required'
        ]);
        $fileName = "";
        // dd($request);
        $news = News::where('id', $request->get('id'))->first();
        if($request->file('image')) {
            // dd($request->file('image'));
            $fileName = time().'_'.$request->file('image')->getClientOriginalName();
            if(!$request->file('image')->move(public_path('/img/cards'), $fileName)) {
                return false;
            }
        }
        if($request->file('image1')) {
            // dd($request->file('image1'));
            $fileName1 = time().'_'.$request->file('image1')->getClientOriginalName();
            if(!$request->file('image1')->move(public_path('/img/cards'), $fileName1)) {
                return false;
            }
        }

        // $table->string('path_img', 255)->nullable();
        // $table->string('company_name', 255)->nullable();
        // $table->string('type', 255)->nullable();
        // $table->text('news_content')->nullable();
        // $table->text('news_detail')->nullable();     
        $update = [
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
            'meta_keyword' => $request->meta_keyword,
            // 'slug' => SlugService::createSlug(Product::class, 'slug', $request->title),
            'company_name' => $request->name,
            'news_content' => $request->title,
            'news_detail' => $request->description,
            'path_img' => $fileName != ""? $fileName : $news->path_img,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
            'path_img_detail' => $fileName1 != ""? $fileName1 : $news->path_img_detail,
        ];
    
        News::where('id', $request->get('id'))->update($update);
        return Redirect::to(route('admin.news'))->with('success','บันทึกสำเร็จ');
    }

    public function newsMore(Request $request ,$id)
    {
        $news = News::find($id);
        return view('news.more', compact('news'));
    }
    // delete
    public function destroy($id)
    {
        News::find($id)->delete();
        return redirect()->route('admin.news')
                        ->with('success','User deleted successfully');
    }

}
