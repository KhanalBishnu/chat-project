<?php

namespace App\Http\Controllers\Auth;

use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request){
        // dd($request->all());

        $validator=Validator::make($request->all(),[
            'email'=>'required|email',
            'password'=>'required|min:6'
        ]);
        if($validator->fails()){
            return response()->json(['status'=>null,'data'=>$validator->errors()]);
        }
        $userData= array(
            'email'=>$request->email,
            'password'=>$request->password
        );
        // dd($request->all());
        if(Auth::attempt($userData)){
            // // dd('login');
            return response()->json([
                'status'=>true,
                'message'=>'User Credential match',
            ]);
           
        }else{
            // dd('login fail');
            return response()->json([
                'status'=>false,
                'message'=>'User Credential Does Not Match!',
            ]);
        }
    }
}
