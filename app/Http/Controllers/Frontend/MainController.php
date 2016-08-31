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
use Cache;
use Carbon\Carbon;

class MainController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('frontend.authenticate', ['except' => ['index','round2','round3']]);
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
        $user = Auth::guard('frontend')->user();
        $cache_key = 'user_exam_'.$user->id;
        if (Cache::has($cache_key)) return redirect('vong-1/buoc-2');
    	return view('frontend.account',compact('page'));
    }

    public function test(Request $request)
    {
        $page = 'vong-1';

        $user = Auth::guard('frontend')->user();
        $cache_key = 'user_exam_'.$user->id;
        if (!Cache::has($cache_key)) return redirect('vong-1/buoc-1');

        $exam_id = Cache::get($cache_key);
        $info = Cache::get('exam_'.$exam_id);
        // Neu het thoi gian lam bai
        if (Carbon::now()->lt($info['end_time']))
            $remain_time = Carbon::now()->diffInSeconds($info['end_time']);
        else
            $remain_time = 0;
        
        $current = $info['current_question'];
        if ($request->has('answer')) {
            $answer = $request->input('answer');
            $info['question'][$current]->user_answer = $answer;
            $info['current_question'] = ++$current;
            Cache::put('exam_'.$exam_id,$info,200);
        }

        $question = $info['question'][$current];
        return view('frontend.step_2',compact('page','question','current','remain_time'));
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

        return redirect('vong-1/buoc-2/');
    }
}
