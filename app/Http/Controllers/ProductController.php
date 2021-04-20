<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Collections;
use App\Models\ProductImage;
use Redirect;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Support\Facades\Storage;
use \Illuminate\Http\UploadedFile;

class ProductController extends Controller
{
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['products'] = Product::orderBy('id','desc')->paginate(10);
        return view('product.list', $data);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('product.create');
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
            'description' => 'required',
            'category' => 'required',
            // 'collection' => 'required',
            'price' => 'required',
            'image' => 'required'
        ]);

        // dd($request);
        if($request->file()) {
            $fileName = time().'_'.$request->image->getClientOriginalName();
            if(!$request->image->move(public_path('/img/cards'), $fileName)) {
                return false;
            }
            // dd(SlugService::createSlug(Product::class, 'slug', $request->name));
            $insert = [
                'meta_title' => $request->meta_title,
                'meta_description' => $request->meta_description,
                'meta_keyword' => $request->meta_keyword,
                'slug' => SlugService::createSlug(Product::class, 'slug', $request->name),
                'name' => $request->name,
                'description' => $request->description,
                'price' =>  $request->price,
                'shipping_cost' => $request->price,
                'category_id' =>  $request->category,
                'collection_id' =>  $request->collection,
                'image_path' => $fileName,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ];
       
            Product::insertGetId($insert);
            return Redirect::to(route('admin.product'))->with('success','Greate! posts created successfully.');
        }
    }
    
    /**
     * Display the specified resource.
     *
     * @param  \App\Post $post
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request , $category , $collection , $slug)
    {
        // select slug
        $data['products'] = Product::where('slug', $slug)->get();
        $data['wish_list'] = Product::query()->select([
            "products.id as id",
            "products.name as name",
            "products.slug as slug",
            "categories.slug as cate_slug",
            "collections.slug as collect_slug",
            "details",
            "price",
            "shipping_cost",
            "description",
            "collection_id",
            "products.category_id",
            "image_path",
            "products.created_at",
            "products.updated_at",
        ])
        ->leftJoin('categories', 'products.category_id', '=', 'categories.id')
        ->leftJoin('collections', 'products.collection_id', '=', 'collections.id')
        ->limit(6)
        ->orderBy('products.created_at', 'asc')
        ->get();
        
        // $data['wish_list'] = Product::orderBy('id','desc')->paginate(10);
        return view('product.show', $data);
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {   
        $categories = Category::get();
        $product = Product::find($id);

        return view('admin.product.add', compact('categories','product'));
    }

    

    public function upload(Request $request ,$id)
    {
        $image = $request->file('file');

        $imageName = time() . '.' . $image->extension();

        $image->move(public_path('images/product/'), $imageName);

        ProductImage::create([
            'filepath' => "images/product/".$imageName,
            'product_id' => $id
        ]);

        return response()->json(['success' => $imageName]);
    }


    public function fetch($id)
    {
        // where id 
        $main = ProductImage::where('product_id', $id)->get();
        $output = '<div class="row">';
        $number = 1;
        foreach($main as $image)
        {
        $output .= '
        <div class="col-md-3" style="margin-bottom:16px;" align="center">
                <img src="'.asset($image->filepath).'" class="img-thumbnail" width="175" height="175" style="height:175px;" /> 
                <button type="button" class="btn btn-link remove_image" id="'.$image->id.'">Remove</button>
        </div>
        ';
        $number ++;
        }
        $output .= '</div>';
        echo $output; // dont forget sweet alert !!!!
    }

    public function deleteImage(Request $request)
    {
        $image = ProductImage::where('id' , $request->get('id'))->first();
        $image->delete();
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
       // dd($request);
       $request->validate([
            'name' => 'required',
            'description' => 'required',
            'category' => 'required',
            // 'collection' => 'required',
            'price' => 'required',
            // 'image' => 'required'
        ]);
        $fileName = null;
        // dd($request);
        if($request->file()) {
            $fileName = time().'_'.$request->image->getClientOriginalName();
            if(!$request->image->move(public_path('/img/cards'), $fileName)) {
                return false;
            }
        }
        $product =Product::where('id', $request->get('id'))->first();
        $update = [
            // 'slug' => SlugService::createSlug(Product::class, 'slug', $request->title),
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
            'meta_keyword' => $request->meta_keyword,
            'name' => $request->name,
            'description' => $request->description,
            'price' =>  $request->price,
            'shipping_cost' => $request->price,
            'category_id' =>  $request->category,
            'collection_id' =>  $request->collection,
            'image_path' => $fileName ? $fileName : $product->image_path,
            // 'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];

        Product::where('id', $request->get('id'))->update($update);
        return Redirect::to(route('admin.product'))->with('success','Greate! posts created successfully.');
    }
    
   
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
 
    }


    // collecion slug paginate
    public function ShowProductCategories(Request $request, $category)
    {
        $category_data = Category::where('name', $category)->first(); 
        $product_list = array(); 
        $collection = null;
        if(isset($category_data)){
            // $product_list = Product::where('category_id',$category_data->id)->get();
            $product_list = Product::query()->select([
                "products.id as id",
                "products.name as name",
                "products.slug as slug",
                "categories.slug as cate_slug",
                "collections.slug as collect_slug",
                "details",
                "price",
                "shipping_cost",
                "description",
                "collection_id",
                "products.category_id",
                "image_path",
                "products.created_at",
                "products.updated_at",
            ])
            ->where('products.category_id',$category_data->id)
            ->leftJoin('categories', 'products.category_id', '=', 'categories.id')
            ->leftJoin('collections', 'products.collection_id', '=', 'collections.id')
            ->orderBy('products.created_at', 'asc')
            ->get();
        }
        
        return view('product.paginate' ,compact('category','collection','category_data', 'product_list'));
    }

    public function ShowProductCollections(Request $request, $category ,$collection)
    {
        $category_data = Category::where('name', $category)->first(); 
        $collection_data = Collections::where('name', $collection)->first(); 
        $product_list = array(); 
        if(isset($collection_data)){
            // $product_list = Product::where('collection_id',$collection_data->id)->get();
            $product_list = Product::query()->select([
                "products.id as id",
                "products.name as name",
                "products.slug as slug",
                "categories.slug as cate_slug",
                "collections.slug as collect_slug",
                "details",
                "price",
                "shipping_cost",
                "description",
                "collection_id",
                "products.category_id",
                "image_path",
                "products.created_at",
                "products.updated_at",
            ])
            ->where('collection_id',$collection_data->id)
            ->leftJoin('categories', 'products.category_id', '=', 'categories.id')
            ->leftJoin('collections', 'products.collection_id', '=', 'collections.id')
            ->orderBy('products.created_at', 'asc')
            ->get();
        }
        
        return view('product.paginate' ,compact('category','collection','category_data','collection_data' ,'product_list'));
    }


}
