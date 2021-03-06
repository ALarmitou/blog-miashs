<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
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

    protected function authenticated(Request $request, User $user)
    {
        if ($request->ajax()){
            $scopes = array();
            foreach($user->roles as $role) {
                foreach ($role->permissions as $permission) {
                    if(!in_array($permission->slug,$scopes)) {
                        $scopes[] = $permission->slug;
                    }
                }
            }
            $token = $user->createToken('personnal',$scopes)->accessToken;
            return response()->json([
                'auth' => auth()->check(),
                'user' => $user,
                'token'=>$token,
                'intended' => $this->redirectPath(),
            ]);

        }
    }

    public function loggedOut(Request $request)
    {
        return response()->json([],204);
    }

}
