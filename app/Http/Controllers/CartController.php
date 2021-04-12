<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Order;
use App\Models\News;
use App\Models\Category;
use App\Models\CMSAdminManage;
use Illuminate\Http\Request;
use App\Models\MainTitles;
use Illuminate\Support\Facades\DB;


class CartController extends Controller
{
    public function shop(Request $request)
    {
        // $user = $request->user(); //getting the current logged in user

        
        // dd($user->hasRole('admin','editor')); // and so on
        // $products = Category::with('products')->with('collections')->orderBy('created_at', 'asc')->get();
        // dd($products->toSql()); // Show results of log

        $products = Product::query()->select([
                                "products.id as id",
                                "products.name as name",
                                "products.slug as slug",
                                "categories.slug as cate_slug",
                                // "collections.slug as collect_slug",
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
                            // ->leftJoin('collections', 'products.collection_id', '=', 'collections.id')
                            ->limit(9)
                            ->orderBy('products.id', 'desc')
                            ->get();

        $news = News::limit(3)->get();
        $main_title = MainTitles::all();
        $more_about = CMSAdminManage::where('page_type', 'more-about')->first();
        $category = "cate-1";
        $collection = "collection";
        return view('shop', compact('category','collection','main_title','more_about','news'))->withTitle('E-COMMERCE STORE | SHOP')->with(['products' => $products]);
    }

    public function cart()  
    {
        $cartCollection = \Cart::getContent();
        return view('cart')->withTitle('E-COMMERCE STORE | CART')->with(['cartCollection' => $cartCollection]);;
    }

    public function checkout()  
    {
        $cartCollection = \Cart::getContent();
        // dd($cartCollection);
        return view('checkout')->withTitle('E-COMMERCE STORE | CHECKOUT')->with(['cartCollection' => $cartCollection]);;
    }

    // page shipping
    public function shipping()  
    {
        $cartCollection = \Cart::getContent();
        // dd($cartCollection);
        return view('shipping')->withTitle('E-COMMERCE STORE | SHIPPING')->with(['cartCollection' => $cartCollection]);;
    }

    // page and save order to db --> clear order [Cart] session : METHOD POST
    public function generateRandomString($length = 25) {
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function generateRandomNumber($length = 25) {
        $characters = '0123456789';
        $charactersLength = strlen($characters);
        $randomNumber = '';
        for ($i = 0; $i < $length; $i++) {
            $randomNumber .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomNumber;
    }

    public function confirm()  
    {
        $cartCollection = \Cart::getContent();
        // dd($cartCollection->toJson());
        $order = new Order();
        $order->user_id = Auth::id();
        $order->cart = $cartCollection;
        $order->address = "address";
        $order->name = "name";
        $order->status = "wait";
        $order->payment_id = "2";
        $order->order_no = $this->generateRandomString(2).$this->generateRandomNumber(6);
        $order->save();
        // save $cartCollection to db
        $this->clear();
        $order_id = $order->id;
        return redirect()->route('cart.complete')->with('success_msg', 'Order Complete!')->with('order_id', $order_id);
    }

    public function VerifyPayment(Request $request)  
    {
        $order = Order::find($request->get('id'));
        $order->update([
            'status' => 'payment'
        ]);
        return redirect()->route('cart.finish')->with('success_msg', 'Order finish!')->with('order', $order);
    }

    
    public function finish(Request $request)  
    {
        return view('payment.finish')->withTitle('finish');
    }

    // show complate page 
    public function complete()  
    {
        $cartCollection = \Cart::getContent(); // order
        // dd($cartCollection);
        $user_id = Auth::id();
        $last_order = Order::query()->where('user_id', $user_id)->orderBy('id', 'desc');
        $data_order = $last_order->first();

        return view('complete',compact('data_order'))->withTitle('E-COMMERCE STORE | COMPLETE')->with(['cartCollection' => $cartCollection]);;
    }

    public function add(Request $request)
    {
        \Cart::add(array(
            'id' => $request->id,
            'name' => $request->name,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'attributes' => array(
                'image' => $request->img,
                'slug' => $request->slug
            )
        ));
        return redirect()->route('cart.index')->with('success_msg', 'Item is Added to Cart!');
    }

    public function remove(Request $request)
    {
        \Cart::remove($request->id);
        return redirect()->route('cart.index')->with('success_msg', 'Item is removed!');
    }

    public function update(Request $request)
    {
        // dd($request->id,$request->quantity);
        \Cart::update($request->id,
            array(
                'quantity' => array(
                    'relative' => false,
                    'value' => $request->quantity
                ),
            ));
        return redirect()->route('cart.index')->with('success_msg', 'Cart is Updated!');
    }

    public function clear()
    {
        \Cart::clear();
        return redirect()->route('cart.index')->with('success_msg', 'Car is cleared!');
    }
}
