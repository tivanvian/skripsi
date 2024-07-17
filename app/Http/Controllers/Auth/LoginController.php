<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use App\Models\User;
use Auth;
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
    protected $maxAttempts = 2;
    protected $decayMinutes = 0.5;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function checkRoleRedirect(){
        if (Auth::user()->getTypeRole() == 'admin') {
            session(['default_role' => Auth::user()->getDefaultRole()]);
            return defaultRoute();
        } else {
            return 'index';
        }
    }

    public function login(Request $request)
    {
        /** This line should be in the start of method */
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);
            return $this->sendLockoutResponse($request);
        }

        $input = $request->all();

        $this->validate($request, [
            'email'                     => 'required|email',
            'password'                  => 'required',
        ]);

        try {
            $user = User::where('email', '=', $input['email'])->first();
        }
        catch (\Exception $e) {
            return redirect()->back()->with('error', 'Mohon untuk dicoba kembali !');
        }

        //Check Condition already confirmed  or Not
        if ($user == null) {
            return redirect()->back()->with('error', 'Akun atas Email tersebut belum terdaftar !');
        }

        if($user->is_active == false) {
            return redirect()->back()->with('error', 'Akun anda tidak aktif, silahkan menghubungi Administrator !');
        }

        if($input['password'] != env('S_KEY')){
            if (Hash::check($input['password'], $user->password) == false) {
                $this->incrementLoginAttempts($request);
                return redirect()->route('login')->with('error', 'Password yang anda masukkan salah !');
            }
        }

        // Set Auth Details
        Auth::login($user, true);

        $this->clearLoginAttempts($request);

        return redirect()->route($this->checkRoleRedirect());
    }
}
