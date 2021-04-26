<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Models\User;
use App\Models\Product;
use App\Models\Order;
use App\Models\Category;
use App\Models\Collections;
use App\Models\Blogger;

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
        return Datatables::of(Product::query()->orderBy('created_at','DESC'))->make(true);
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
        $data = Blogger::orderBy('id','DESC')->paginate(5);
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
        $user = Blogger::find($id);
        return view('admin.manage-users.show',compact('user'));
    }

    public function userRemove(Request $request, $id)
    {
        // dd(Blogger::find($id));
        Blogger::where('id',$id)->first()->delete();
        return redirect()->route('admin.users')
                        ->with('success','User deleted successfully');
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

    public function orderShow($status , $order)
    {
        $data_order = Order::query()->where('order_no', $order)->orderBy('id', 'desc')->first();;
        return view('admin.manage-order-status.show',compact('data_order'));
    }


    public function order($status)
    {
        $submit_url = "/api/home_manage";
        
        // watting_payment -> รอการชำระเงิน
        // successful_payment -> ชำระเงินเสร็จสิ้น (รอจัดส่ง)
        // waiting_delivery -> ระหว่างจัดส่ง
        // successful_delivery ->จัดส่งเสร็จสิ้น
        // cancel -> ยกเลิก

        return view('admin.manage-order-status.wait', compact('submit_url','status'));
    }

    public function mainTitle()
    {
        $order_wait = Order::where('status','wait')->count();
        $order_payment = Order::where('status','payment')->count();
        return view('admin.main-title.index', compact('order_wait','order_payment'));
    }

}
