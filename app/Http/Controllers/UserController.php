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
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            // 'roles' => 'required'
        ]);

        Blogger::create([
            'name' =>$request->firstname." ".$request->lastname,
            'email' => $request->email,
            'password' => Hash::make($request->password),
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
            'email' => 'required|email|unique:users,email,'.$id,
        ]);


    
        $input = $request->all();
        if(!empty($input['password'])){ 
            $input['password'] = Hash::make($input['password']);
        }else{
            $input = Arr::except($input,array('password'));    
        }
    
        $user = Blogger::find($id);
        // $user->update($input);
        $user->update([
            'name' =>$request->firstname." ".$request->lastname,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'address' => array(
                'address' => $request->get('street-address'),
                'country' =>  $request->get('state'),
                'zip' =>  $request->get('postcode'),
                'city' =>   $request->get('town'),
                // 'state' => 'STATE',
            )
        ]);
    
        // DB::table('model_has_roles')->where('model_id',$id)->delete();
    
        // $user->assignRole($request->input('roles'));
    
        return redirect()->route('users.edit', ['user' =>  $id])
                        ->with('success','แก้ไขข้อมูลสำเร็จ');
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
            'address' => $request->address,
            'country' =>  $request->country,
            'zip' =>  $request->zipcode,
            'city' =>  $request->city,
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
