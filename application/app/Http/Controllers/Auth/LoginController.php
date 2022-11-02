<?php

namespace App\Http\Controllers\Auth;

use App\Clinic;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

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

    public function showLoginForm()
    {
        return view('front/auth/signin');
    }

    // custom logout function
    // redirect to login page
    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        if ($response = $this->loggedOut($request)) {
            return $response;
        }

        return $request->wantsJson()
            ? new Response('', 204)
            : redirect('/login');
    }

      /**
     * The user has been authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function authenticated(Request $request, $user)
    {
        if($user->role == 'admin'){
            return redirect(route('dashboard'));
        }elseif($user->role == 'doctor'){
            $clinic = Clinic::first();
            session()->put('clinic_id',$clinic->id);
            session()->put('clinic_name', $clinic->name);
            return redirect(route('main.dashboard'));
        }elseif($user->role == 'medical assistant'){
            $clinic = Clinic::first();
            session()->put('clinic_id',$clinic->id);
            session()->put('clinic_name', $clinic->name);
            return redirect(route('main.dashboard'));
        }else{
            $clinic = Clinic::first();
            session()->put('clinic_id',$clinic->id);
            session()->put('clinic_name', $clinic->name);
            return redirect(route('main.dashboard'));
        }
    }
}
