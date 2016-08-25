<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;

class MainController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('frontend.authenticate', ['except' => ['index']]);
    }

    public function index()
    {
    	return 1;
    }

    public function test()
    {
    	$user = Auth::guard('frontend')->user();
    	return $user;
    }
}
