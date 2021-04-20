<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;
use Session;

class LoginController extends Controller
{
    
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
   
    public function __construct()
    {
            $this->middleware('guest')->except('logout');
            $this->middleware('guest:admin')->except('logout');
            $this->middleware('guest:blogger')->except('logout');
    }

     public function showAdminLoginForm()
    {
        return view('auth.admin-login', ['url' => 'admin']);
    }

    public function adminLogin(Request $request)
    {
        $this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required|min:6'
        ]);

        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))) {

            return redirect()->intended('/digiso-admin');
        }
        return back()->withInput($request->only('email', 'remember'));
    }

     public function showBloggerLoginForm()
    {
        return view('auth.login', ['url' => 'blogger']);
    }

    public function bloggerLogin(Request $request)
    {

        // Auth::logout();
        // Session::flush();

        $this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required|min:6'
        ]);
    
        // dd($request);
        if (Auth::guard('blogger')->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))) {
            $user = Auth::guard('blogger')->user();
            return redirect()->intended('/users/'.$user->id.'/edit');
        }
        return back()->withInput($request->only('email', 'remember'));
    }
}