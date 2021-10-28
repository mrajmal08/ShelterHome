<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Role;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\User;
use Auth;
use Redirect;
use DB;

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
    public function login()
    {
        return view('auth.login');
    }


    protected function postlogin(Request $request)
    {
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required',
        ]);

        $email = $request->input('email');
        $password = $request->input('password');

        $user = User::where('email', $request->input('email'))->first();
        if (!Auth::attempt($request->only(['email', 'password']))) {
            return Redirect::back()->withErrors(['Username & Password combination doesn\'t not match']);

        }
        //dd(Auth::user()->hasAccess(['admin']));

        if (Auth::user()->hasAccess(['admin'])) {

            return redirect()->route('admin-home')->with('success', 'WELCOME' . Auth::user()->username . '...');

        } elseif (Auth::user()->hasAccess(['volunter'])) {

            return redirect()->route('volunter-home')->with('success', 'WELCOME ' . Auth::user()->username . '...');

        } else {
            return redirect()->back()->with('danger', 'Something went wrong please try again...');
        }
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }


    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('login');
    }

    public function re_generate_password(Request $request){

        $user = User::where('email', $request->input('email'))->first();
        if ($user){

            DB::table('re_generate_password')->insert([
                'email' => $request->email,
            ]);

            return redirect()->back()->with('success', 'Your Re-Generate-Password Request Has Been Sent To Admin');
        }else{
            return Redirect::back()->withErrors(['This Email does not exist in the database']);
        }
        return view();
    }
}
