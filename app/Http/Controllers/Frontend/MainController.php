<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use App\Http\Requests\AccountRequest;
use App\Account;
use App\Exam;
use App\Garena\ExamValidator;

class MainController extends Controller
{
    //
    public function __construct()
    {
        //$this->middleware('frontend.authenticate', ['except' => ['index']]);
    }

    public function index()
    {
        /*ExamValidator::createExam(1);
        dd(\Cache::get('exam_1'));*/
        $page = 'index';
    	return view('frontend.index',compact('page'));
    }

    public function round1()
    {
        $page = 'vong-1';
    	return view('frontend.account',compact('page'));
    }

    public function test($exam_id)
    {
        dd(\Cache::get('exam_'.$exam_id));
        $page = 'vong-1';
        return view('frontend.account',compact('page'));
    }

    public function round2()
    {
        $page = 'vong-2';
        return view('frontend.round2',compact('page'));
    }

    public function round3()
    {
        $page = 'vong-3';
        return view('frontend.round3',compact('page'));
    }

    public function updateInfoAccount(AccountRequest $request)
    {
        $user = Auth::guard('frontend')->user();
        try
        {
            $data = $request->all();

            $exam = Exam::create([ 
                'account_id'    => $user->id,
                'full_name'     => $data['full_name'],
                'phone_number'  => $data['phone_number'],
                'identity_card' => $data['identity_card'],
                'university_id' => $data['university_id']]);

            ExamValidator::createExam($exam->id);

            \Session::flash('success', 'Cập nhật thông tin tài khoản thành công');
        }
        catch(\Exception $e)
        {
            \Log::error($e);
            \Session::flash('danger', 'Thất bại. Vui lòng thử lại');
            return redirect('vong-1/buoc-1');
        }

        return redirect('vong-1/buoc-2/'.$exam->id);
    }
}
