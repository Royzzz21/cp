<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

//    protected function redirectTo()
//    {
//        return redirect('/');
//    }

//    public function login(Request $request){
//        $this->validate($request,[
//            'email'=>'required|email',
//            'password'=>'required'
//        ]);
//        if(auth()->attempt(['email'=>$request->email,'password'=>$request->password])){
//
//            if(auth()->user()->confirmed==0){
//                Auth::logout();
//                return back()->with('warning', 'Your account has not yet been activated. Please check Your email');
//            }
//            return redirect(route('app.index'));
//        }else {
//            return back()->with('warning', 'Address email or/and password are incorrect.');
//        }
//    }
//

}
