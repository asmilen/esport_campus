<?php

namespace App\Garena;

use Exception;
use DB;
use Carbon\Carbon;

class ExamValidator
{
    public static function createExam($exam_id)
    {
        try
        {
            $all_question = array();
            // Select random tu moi category 2 cau kho va 3 cau de
            for ($cate=1; $cate <= config('constants.CATEGORY_NUMBER'); $cate++) { 
                //get ez question
                $questionez = DB::table('questions')
                                ->where('level',config('constants.QUESTION_LEVEL_EASY'))
                                ->where('type',config('constants.QUESTION_TYPE_MULTIPLE'))
                                ->where('category',$cate)
                                ->inRandomOrder()
                                ->take(3)->get();
                //get hard question 
                $questionshard = DB::table('questions')
                                ->where('level',config('constants.QUESTION_LEVEL_HARD'))
                                ->where('type',config('constants.QUESTION_TYPE_MULTIPLE'))
                                ->where('category',$cate)
                                ->inRandomOrder()
                                ->take(2)->get();

                $questions = array_merge($questionez, $questionshard);
                //get ez answer                            
                foreach ($questions as $question) {
                    # code...
                    $question->answers= DB::table('answers')
                                        ->where('question_id',$question->id)
                                        ->get();

                    foreach ($question->answers as $answer) {
                        if ($answer->status == config('constants.ANSWERS_TRUE')) 
                        {
                            $question->true_answer_id = $answer->id;
                            break;
                        }
                    }
                    $all_question[] = $question;
                }
            }
            
            $questionessay = DB::table('questions')
                                ->where('type',config('constants.QUESTION_TYPE_ESSAY'))
                                ->inRandomOrder()
                                ->first();
            $all_question[] = $questionessay;
            \Cache::put('start_exam_'.$exam_id,Carbon::now(),1);
            \Cache::put('exam_'.$exam_id,$all_question,3);
        }
        catch(\Exception $e)
        {
            \Log::error($e);
            return false;
        }
        return true;
    }
}