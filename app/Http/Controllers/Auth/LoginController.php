<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use App\User;
date_default_timezone_set("Asia/Jakarta");

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

    protected function authenticated(Request $request, $user)
    {
        $date = date('Y-m-d H:i:s');
        if ($user->aktif === 'Y') {
            if ($user->level === 1) {
                User::where('id', $user->id)
                      ->update(['last_login' => $date]);
                return redirect('/admin/home');
            } elseif ($user->level === 2) {
                User::where('id', $user->id)
                      ->update(['last_login' => $date]);
                return redirect('/staff/home');
            }
        } else {
            $this->guard()->logout();
            $request->session()->flush();
            $request->session()->regenerate();
            alert()->error('Oops...','Account tidak aktif, silahkan hub. administrator!');
            return redirect('/login');
            // ->with('failed', 'Account tidak aktif, silahkan hub. administrator!');
        }
    }

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    // protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function index()
    {
        return view('auth.login');
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();
        $request->session()->flush();
        $request->session()->regenerate();
        alert()->info('Terima kasih','selamat datang kembali!');
        return redirect('/login');
        // ->with('status', 'Terima kasih, selamat datang kembali!');
    }
}
