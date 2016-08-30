<?php

namespace App\Http\Controllers\Backend;

use App\Answer;
use App\Gift;
use App\Question;
use App\University;
use Illuminate\Http\Request;
use App\GiftDetail;
use App\UploadFile;
use App\Http\Requests;
use Input,File;
use App\Http\Requests\UploadFileRequest;
use App\Http\Controllers\Controller;
use League\Flysystem\Directory;

class UploadFileController extends Controller
{
    //
    private function readingExcelFileUniversity($filename)
    {
        $inputFileName = getcwd(). '/upload/' . $filename;
        $objPHPExcel = \PHPExcel_IOFactory::load($inputFileName);
        foreach ($objPHPExcel->getWorksheetIterator() as $worksheet) {
            $highestRow         = $worksheet->getHighestRow(); // e.g. 10
            $highestColumn      = $worksheet->getHighestColumn(); // e.g 'F'
            $highestColumnIndex = \PHPExcel_Cell::columnIndexFromString($highestColumn);
            for ($row = 2; $row <= $highestRow; ++ $row) {
                try {
                    $universityCard = new University();
                    for ($col = 0; $col < $highestColumnIndex; ++$col) {
                        $cell = $worksheet->getCellByColumnAndRow($col, $row);
                        $val = $cell->getValue();
                        switch ($col) {
                            case 0:
                                $universityCard->short_name = $val;
                                break;
                            case 1:
                                $universityCard->name = $val;
                                break;
                            case 2:
                                $universityCard->desc = $val;
                                break;
                            case 3:
                                $universityCard->image = $val;
                                break;
                            case 4:
                                $universityCard->status = $val;
                                break;
                        }
                    }
                    $universityCard->save();
                } catch (\Exception $e)
                {
                    \File::append(storage_path('logs/add_university.log'),'line' . $row . ':' . $e->getMessage());
                }
            }
            break; // GET ONLY FIRST SHEET
        }

        // Xoa file tren server
        File::delete($inputFileName);
    }
    private function readingExcelFileQuestion($filename)
    {
        $inputFileName = getcwd(). '/upload/' . $filename;
        $objPHPExcel = \PHPExcel_IOFactory::load($inputFileName);
        foreach ($objPHPExcel->getWorksheetIterator() as $worksheet) {
            $highestRow         = $worksheet->getHighestRow(); // e.g. 10
            $highestColumn      = $worksheet->getHighestColumn(); // e.g 'F'
            $highestColumnIndex = \PHPExcel_Cell::columnIndexFromString($highestColumn);
            for ($row = 2; $row <= $highestRow; ++ $row) {
                try {
                    $questionCard = new Question();
                    for ($col = 0; $col < $highestColumnIndex; ++$col) {
                        $cell = $worksheet->getCellByColumnAndRow($col, $row);
                        $val = $cell->getValue();
                        switch ($col) {
                            case 0:
                                $questionCard->question = $val;
                                break;
                            case 1:
                                $questionCard->type = $val;
                                break;
                            case 2:
                                $questionCard->level = $val;
                                break;
                            case 3:
                                $questionCard->category = $val;
                                break;
                        }
                    }
                    $questionCard->save();
                } catch (\Exception $e)
                {
                    \File::append(storage_path('logs/add_question.log'),'line' . $row . ':' . $e->getMessage());
                }
            }
            break; // GET ONLY FIRST SHEET
        }

        // Xoa file tren server
        File::delete($inputFileName);
    }

    private function readingExcelFileAnswer($filename)
    {
        $inputFileName = getcwd(). '/upload/' . $filename;
        $objPHPExcel = \PHPExcel_IOFactory::load($inputFileName);
        foreach ($objPHPExcel->getWorksheetIterator() as $worksheet) {
            $highestRow         = $worksheet->getHighestRow(); // e.g. 10
            $highestColumn      = $worksheet->getHighestColumn(); // e.g 'F'
            $highestColumnIndex = \PHPExcel_Cell::columnIndexFromString($highestColumn);
            for ($row = 2; $row <= $highestRow; ++ $row) {
                try {
                    $AnswerCard = new Answer();
                    for ($col = 0; $col < $highestColumnIndex; ++$col) {
                        $cell = $worksheet->getCellByColumnAndRow($col, $row);
                        $val = $cell->getValue();
                        switch ($col) {
                            case 0:
                                $AnswerCard->question_id = $val;
                                break;
                            case 1:
                                $AnswerCard->answer = $val;
                                break;
                            case 2:
                                $AnswerCard->status = $val;
                                break;

                        }
                    }
                    $AnswerCard->save();
                } catch (\Exception $e)
                {
                    \File::append(storage_path('logs/add_answer.log'),'line' . $row . ':' . $e->getMessage());
                }
            }
            break; // GET ONLY FIRST SHEET
        }

        // Xoa file tren server
        File::delete($inputFileName);
    }

    public function addUniversity()
    {
        return view('admin/index');
    }

    public function addQuestion()
    {
        return view('admin/add_question');
    }
    public function addAnswer()
    {
        return view('admin/add_answer');
    }

    public function postAddFileUniversity(UploadFileRequest $request){
        if ($request->file('uploadfile')) {
            $file_name = $request->file('uploadfile')->getClientOriginalName();
            $pieces = explode(".", $file_name);
            if($pieces[1] == 'xlsx' || $pieces[1] == 'xls'){
                $uploadfile = new UploadFile();
                $uploadfile->file = $file_name;
                $request->file('uploadfile')->move('upload/', $file_name);
                //dd($request);
                $uploadfile->save();
                self::readingExcelFileUniversity($file_name);
                \Session::flash('success', 'Thêm trường đại học thành công');
            }else{
                \Session::flash('danger', 'Vui lòng chọn file đúng định dạng: xls hoặc xlsx');
            }
        }
        else
        {
            \Session::flash('danger', 'Vui lòng chọn file');
        }
        return redirect('quan-li/them-truong');

    }

    public function postAddFileQuestion(UploadFileRequest $request){
        if ($request->file('uploadfile')) {
            $file_name = $request->file('uploadfile')->getClientOriginalName();
            $pieces = explode(".", $file_name);
            if($pieces[1] == 'xlsx' || $pieces[1] == 'xls'){
                $uploadfile = new UploadFile();
                $uploadfile->file = $file_name;
                $request->file('uploadfile')->move('upload/', $file_name);
                //dd($request);
                $uploadfile->save();
                self::readingExcelFileQuestion($file_name);
                \Session::flash('success', 'Thêm câu hỏi thành công');
            }else{
                \Session::flash('danger', 'Vui lòng chọn file đúng định dạng: xls hoặc xlsx');
            }
        }
        else
        {
            \Session::flash('danger', 'Vui lòng chọn file');
        }
        return redirect('quan-li/them-cau-hoi');

    }
    public function postAddFileAnswer(UploadFileRequest $request){
        if ($request->file('uploadfile')) {
            $file_name = $request->file('uploadfile')->getClientOriginalName();
            $pieces = explode(".", $file_name);
            if($pieces[1] == 'xlsx' || $pieces[1] == 'xls'){
                $uploadfile = new UploadFile();
                $uploadfile->file = $file_name;
                $request->file('uploadfile')->move('upload/', $file_name);
                //dd($request);
                $uploadfile->save();
                self::readingExcelFileAnswer($file_name);
                \Session::flash('success', 'Thêm đáp án thành công');
            }else{
                \Session::flash('danger', 'Vui lòng chọn file đúng định dạng: xls hoặc xlsx');
            }
        }
        else
        {
            \Session::flash('danger', 'Vui lòng chọn file');
        }
        return redirect('quan-li/them-dap-an');

    }
}
