<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use App\Http\Requests\AccountRequest;
use App\Account;

class MainController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('frontend.authenticate', ['except' => ['index']]);
    }

    public function index()
    {
    	return view('frontend.index');
    }

    public function test()
    {
    	$account = Auth::guard('frontend')->user();
    	if (empty($account->university_id)) return view('frontend.account',compact('account'));

    	return $account;
    }

    public function updateInfoAccount(AccountRequest $request)
    {
        $user = Auth::guard('frontend')->user();
        $account = Account::find($user->id);
        
        $data = $request->all();

        $account->full_name = $data['full_name'];
        $account->phone_number = $data['phone_number'];
        $account->identity_card = $data['identity_card'];
        $account->university_id = $data['university_id'];

        
        $account->save();

        \Session::flash('success', 'Cập nhật thông tin tài khoản thành công');
        return redirect('tham-gia');
    }
}
