<?php
namespace App\Imports;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use App\Models\Exam;
use App\Models\Student;
use App\Models\Result;
use Carbon\Carbon;
class ResultImport implements ToCollection,WithHeadingRow
{
    protected $request;
    public function __construct($request)
    {
        $this->request = $request;
    }

  public function collection(Collection $rows){

        // dd($this->request->exam_code);
        foreach ($rows->toArray() as $key=>$row){
           $firstRow = $rows->first();
            if (!isset($firstRow['roll_no'])) {
                notify()->error('Your Excel file is incorrect, please check it.');
                return;
            }
           $exam = Exam::select('id','title','exam_code','marks','cq','mcq')->where('exam_code',$this->request->exam_code)->first();

           // dd($exam);
         
          $student = Student::select('id','department_id','class_id','session_id','batch_id','roll_number','phone_number','father_name','name')->where('roll_number',$row['roll_no'])->first();
       
          
           if($student){
                $result = new Result();
                $result->type        =  $student->type;
                $result->classtype   =  $student->classtype;
                $result->session_id  =  $student->session_id;
                $result->batch_id    =  $student->batch_id;
                $result->roll_number =  $student->roll_number;
                $result->student_id  =  $student->id;
                $result->exam_id     =  $exam->id;
                $result->mcq         =  $row['mcq_marks'];
                $result->cq          =  $row['written_marks'];
                $result->marks       =  $row['total_obtained_marks'];
                $result->hs          =  $rows->first()['total_obtained_marks'];
                $result->position    =  $row['merit_position'];
                $result->resultDate  =  Carbon::now();
                $result->status      =  1;
                dd($result);
                $result->save();
                if ($this->request->student_sms != NULL || $this->request->parents_sms != NULL) {
                    if($this->request->student_sms == 1 && $this->request->parents_sms == 1){
                        $numbers = "$student->s_number,$student->g_number";
                    }elseif($this->request->student_sms == 1){
                        $numbers = $student->s_number;
                    }elseif($this->request->parents_sms == 1){
                        $numbers = $student->g_number;
                    }
                $sms = "Dear Student, $student->name, Roll: $student->roll_number, $exam->title ($exam->exam_code),  Marks: $result->marks out of: $exam->marks MCQ : $result->mcq CQ : $result->cq  Position: $result->position Highest Marks:  $result->hs Thank You, Admission Aid";
                 $url = "https://msg.elitbuzz-bd.com/smsapi";
                  $data = [
                    "api_key" => "C200816561d6d9a91d5e50.54729786",
                    "type" => "text",
                     "contacts" => $numbers,
                    "senderid" => "8809612472615",
                    "msg"=>$sms,
                   ];
                //  dd($data);
                  $ch = curl_init();
                  curl_setopt($ch, CURLOPT_URL, $url);
                  curl_setopt($ch, CURLOPT_POST, 1);
                  curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
                  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                  $response = curl_exec($ch);
                //   dd($response);
                  curl_close($ch);
                }
           }
           dd('ok');
           notify()->success('Your result upload Successfully!');
        }
    }

}
