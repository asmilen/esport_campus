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
        $this->middleware('frontend.authenticate', ['except' => ['index']]);
    }

    public function index()
    {
        //ExamValidator::createExam(1);
        dd(\Cache::get('start_exam_1'));
    	return view('frontend.index');
    }

    public function test()
    {
    	return view('frontend.account');
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
            return redirect('tham-gia');
        }

        return $exam;
    }
}
