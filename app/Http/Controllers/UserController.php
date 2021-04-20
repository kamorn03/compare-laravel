<?php
    
namespace App\Http\Controllers;
    
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Order;
use App\Models\Blogger;
// use Spatie\Permission\Models\Role;
use DB;
use Hash;
use Illuminate\Support\Arr;
    
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = User::orderBy('id','DESC')->paginate(5);
        return view('users.index',compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $roles = Role::pluck('name','name')->all();
        return view('users.create');
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required|email|unique:bloggers,email',
            'password' => 'required|same:confirm-password',
            // 'roles' => 'required'
        ]);
        $address = null;
        if($request->get('street-address')) {
            $address = array(
                'company' => $request->get('company'),
                'country' =>  $request->get('country'),
                'address' => $request->get('street-address'),
                'city' =>   $request->get('town'),
                'state' =>  $request->get('state'),
                'zip' =>  $request->get('postcode'),
                'phone' =>  $request->get('phone'),
                'email' =>   $request->get('email'),
            );
        }  
       

        Blogger::create([
            'name' =>$request->firstname." ".$request->lastname,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'address' => $address
        ]);
    
    
        return redirect()->route('home')
                        ->with('success','User created successfully');
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return view('users.show',compact('user'));
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = Blogger::find($id);
        // dd($user);
        // $roles = Role::pluck('name','name')->all();
        // $userRole = $user->roles->pluck('name','name')->all();

        return view('users.edit',compact('user'));
    }

      /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showOrder()
    {
        $order = Order::all();
        // $roles = Role::pluck('name','name')->all();
        // $userRole = $user->roles->pluck('name','name')->all();
        // dd('1');
        return view('users.order',compact('order'));
    }
  

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'firstname' => 'required',
            'lastname' => 'required',
            // 'password' => 'required|same:confirm-password',
            'email' => 'required|email|unique:bloggers,email,'.$id,
        ]);

        // $input = $request->all();
        // if(!empty($input['password'])){ 
        //     $input['password'] = Hash::make($input['password']);
        // }else{
        //     $input = Arr::except($input,array('password'));    
        // }
    
        $user = Blogger::find($id);
        $address = null;
        if($request->get('street-address')) {
            $address = array(
                'company' => $request->get('company'),
                'country' =>  $request->get('country'),
                'address' => $request->get('street-address'),
                'city' =>   $request->get('town'),
                'state' =>  $request->get('state'),
                'zip' =>  $request->get('postcode'),
                'phone' =>  $request->get('phone'),
                'email' =>   $request->get('email'),
            );
        }  

        $user->update([
            'name' =>$request->firstname." ".$request->lastname,
            'email' => $request->email,
            // 'password' => Hash::make($request->password),
            'address' => $address
        ]);
        return redirect()->route('users.edit', ['user' =>  $id])->with('success','แก้ไขข้อมูลสำเร็จ');
    }


      /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function changePassword(Request $request, $id)
    {
        $user = Blogger::find($id);
        return view('users.change-pass', compact('user'));
    }

    
    public function updatePassword(Request $request, $id)
    {
        $this->validate($request, [
            'password' => 'required|same:confirm-password',
            'newpassword' => 'required',
        ]);
        $user = Blogger::find($id);
        $user->update([
            'password' => Hash::make($request->newpassword),
        ]);
        return redirect()->route('users.change.password', ['user' =>  $id])->with('success','แก้ไขข้อมูลสำเร็จ');
    }

    public function updateAddress(Request $request, $id)
    {      

        $this->validate($request, [
            'address' => 'required',
            'country' => 'required',
            'city' => 'required',
            'zipcode' => 'required',
        ]);
    
        $user = Blogger::find($id);
        $input['address'] = array(
            'company' => $request->company,
            'address' => $request->address,
            'country' =>  $request->country,
            'zip' =>  $request->zipcode,
            'city' =>  $request->city,
            'phone' =>  $request->phone,
            'email' =>  $request->email,
            // 'state' => 'STATE',
        );
        $user->update($input);
        return redirect()->route('cart.shipping', ['user' =>  $id])
                        ->with('success','เพิ่มที่อยู่สำเร็จ');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect()->route('admin.users')
                        ->with('success','User deleted successfully');
    }
}
