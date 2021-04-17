<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Models\User;
use App\Models\Product;
use App\Models\Order;
use App\Models\Category;
use App\Models\Collections;

class AdminController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $submit_url = "/api/home_manage";
        $order = Order::get();
        $order_wait = Order::where('status','wait')->count();
        $order_payment = Order::where('status','payment')->count();

        return view('admin.home', compact('submit_url','order','order_wait','order_payment'));
    }

    


    //   return Datatables::of(User::query())->make(true);
    public function productList()
    {
        return Datatables::of(Product::query())->make(true);
    }

    public function productAdd(Request $request)
    { 
        $categories = Category::get();
        return view('admin.product.add', compact('categories'));
    }

    public function productImage(Request $request, $id)
    {
        $product = Product::where('id', $id)->first();
        return view('admin.product.image', compact('product'));
    }

    public function users(Request $request){
        $data = User::orderBy('id','DESC')->paginate(5);
        return view('admin.manage-users.index',compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function userShow(Request $request, $id)
    {
        $user = User::find($id);
        return view('admin.manage-users.show',compact('user'));
    }

    public function product()
    {
        $submit_url = "/api/home_manage";
        $order_wait = Order::where('status','wait')->count();
        
        $order_payment = Order::where('status','payment')->count();
        return view('admin.product.show', compact('submit_url','order_wait','order_payment'));
    }

    public function category(Request $request)
    {
        return view('admin.manage-category.index');
    }
    
    public function categoryList()
    {
        return Datatables::of(category::query())->make(true);
    }
    
    public function categoryUpdate(Request $request ,$id)
    {
        $category = Category::find($id);
        return view('admin.manage-category.index',compact('category'));
    }
    

    public function collection(Request $request)
    {
        $categories = Category::get();
        return view('admin.manage-collection.index', compact('categories'));
    }

    public function collectionList()
    {
        return Datatables::of(Collections::query())->make(true);
    }

    public function collectionUpdate(Request $request ,$id)
    {
        $categories = Category::get();
        $collection = Collections::find($id);
        return view('admin.manage-collection.index',compact('collection','categories'));
    }


    public function orderList($status)
    {
        return Datatables::of(Order::query()->where('status', $status))->make(true);
    }

    public function order($status)
    {
        $submit_url = "/api/home_manage";
        $order_wait = Order::where('status','wait')->count();
        $order_payment = Order::where('status','payment')->count();
        return view('admin.manage-order-status.wait', compact('submit_url','order_wait','order_payment','status'));
    }

    public function mainTitle()
    {
        $order_wait = Order::where('status','wait')->count();
        $order_payment = Order::where('status','payment')->count();
        return view('admin.main-title.index', compact('order_wait','order_payment'));
    }

}
