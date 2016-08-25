<?php

namespace App\Http\Controllers\Frontend;

use App\Account;
use App\AccountHistory;
use App\Garena\EaUtil;
use App\Garena\OAuth;
use App\User;
use Auth;
use DB;
use Illuminate\Http\Request;

use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';
    protected $redirectPath = '/';
    protected $guard = 'frontend';
    protected $redirectAfterLogout = '/';   

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware($this->guestMiddleware(), ['except' => 'redirectToLogout']);

        /*if (session()->has('mobile')) {
            $this->redirectTo = 'mobile-login-by-gas-only';
            $this->redirectPath = 'mobile-login-by-gas-only';
            $this->redirectAfterLogout = 'mobile-login-by-gas-only';
        }*/
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

    protected function findOrCreateAccount($gUser)
    {
        if ($authUser = Account::where('uid', $gUser['uid'])->first()) {
            return $authUser;
        }

        $username = (isset($gUser['nickname']) && $gUser['nickname']) ? $gUser['nickname'] : $gUser['username'];

        DB::beginTransaction();

        try {

            $account = Account::create([
                'username' => $username,
                'email' => isset($gUser['email']) ? $gUser['email'] : '',
                'uid' => $gUser['uid'],
                'client_ip' => isset($gUser['client_ip'])? $gUser['client_ip'] : ''
            ]);

            DB::commit();
        } catch (\Exception $e) {
            \Log::error($e);
            DB::rollBack();
            $account = null;
        }

        return $account;
    }
    
    public function redirectToLogin()
    {
        if (env('TESTING') == 1) {
            return redirect('oauth/callback?access_token=test');
        } else {
           return redirect()->away(OAuth::authUrl());
        }
    }
    
    public function redirectToLogout()
    {
        $access_token = session()->get('authenticate.token');
        Auth::guard($this->guard)->logout();
        session()->forget('authenticate');
        session()->forget('update_gas_login');
        EaUtil::get(OAuth::logoutUrl($access_token));
        return redirect()->intended($this->redirectAfterLogout);
    }
    
    public function callback(Request $request) 
    {
        if ($request->input('access_token')) {

            if (env('TESTING') == 1) {
                $this->randomLogin($request);
            }

            $authenticate = OAuth::handleAccessToken($request->input('access_token'));

            if (isset($authenticate['errors'])) {
                return  $authenticate['errors'];
            } else {
               return $this->loginUserArrays($authenticate, $request);
            }
        }
    }

    public function randomLogin($request)
    {
        $uid = random_int(100, 100000);
        return $this->loginUserArrays([
            'username' => md5($uid),
            'uid' => $uid,
        ], $request);
    }
    
    public function loginUserArrays($authenticate, $request)
    {
        $account  = $this->findOrCreateAccount($authenticate);
        if ($account) {
            auth($this->guard)->login($account, true);
            return $this->handleUserWasAuthenticated($request, null);
        } else {
            return 'Có lỗi xảy ra trong quá trình đăng nhập xin thử lại sau!';
        }
    }

    protected function authenticated($request, $user)
    {
        session()->put('authenticate', [
            'id' => $user->id,
            'username' => $user->username,
            'uid' => $user->uid,
            'token' => $request->input('access_token')
        ]);

        return redirect()->intended($this->redirectPath());
    }
}
