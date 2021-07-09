<?php

namespace App\Http\Controllers\Auth;

use Auth;
use Session;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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

    public function login(Request $request)
    {
        $this->validate($request, [
            "email"    => "required|email",
            "password" => "required|min:6",
        ]);
        if (Auth::guard("web")->attempt(["email" => $request->email, "password" => $request->password], $request->remember)) {
            $tokenResult = auth()->user()->createToken("authToken");
            $token       = $tokenResult->token;
            $token->save();
            Session::flash("vue-spa-token", [
                "access_token" => $tokenResult->accessToken,
                "token_type"   => "Bearer",
                "expires_at"   => Carbon::parse($tokenResult->token->expires_at)->toDateTimeString(),
            ]);
            return redirect()->route("home");
        }
        return redirect()->back()->withDanger("credentials wrong")->withInput($request->only("email", "remember"));
    }

}
