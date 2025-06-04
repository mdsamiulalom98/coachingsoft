<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use App\Imports\ResultImport;
use App\Models\Department;
use App\Models\StudentSession;
use App\Models\Classroom;
use App\Models\Batch;
use App\Models\Exam;
use App\Models\Result;
use App\Models\Student;
use Toastr;
use Carbon\Carbon;
class ResultController extends Controller
{
     public function index(Request $request){
       
        $departments = Department::where('status',1)->get();
        $sessions = StudentSession::where('status',1)->get();
        $classrooms = [];
        $batches   = [];

        $data = [];
        
        if($request->department_id){
           $data = Result::orderBy('id','DESC');
           $classrooms = Classroom::where('department_id',$request->department_id)->get();
        }
        if($request->session_id){
           $batches = Batch::where('session_id',$request->session_id)->get(); 
        }

        if($request->ajax()){
             if ($request->department_id) {
               $data = $data->where('department_id', $request->department_id);
            }

            if ($request->class_id) {
                $data = $data->where('class_id', $request->class_id);
            }

            if ($request->session_id) {
                $data = $data->where('session_id', $request->session_id);
            }

            if ($request->batch_id) {
                $data = $data->where('batch_id', $request->batch_id);
            }

            return datatables()->of($data)
            ->addColumn('action', function($row) {
                if ($row->status == 1) {
                    $statusBtn = '<form method="POST" action="'.route('results.inactive').'" class="status_form" style="display:inline;">
                                      '.csrf_field().'
                                      <input type="hidden" name="id" value="'.$row->id.'">
                                      <button type="button" class="thumb_down"><i class="ti ti-thumb-down"></i></button>
                                   </form>';
                } else {
                    $statusBtn = '<form method="POST" action="'.route('results.active').'" class="status_form" style="display:inline;">
                                      '.csrf_field().'
                                      <input type="hidden" name="id" value="'.$row->id.'">
                                      <button type="button" class="thumb_up"><i class="ti ti-thumb-up"></i></button>
                                   </form>';
                }
                $editBtn = '<a class="edit_btn" href="' . route('results.edit', $row->id) . '">
                               <i class="ti ti-pencil"></i>
                            </a>';
                return $statusBtn . ' ' . $editBtn;
            })
            ->addColumn('department_name', function ($row) {
                return $row->department ? $row->department->name : 'N/A';
            })
            ->addColumn('session_name', function ($row) {
                return $row->session ? $row->session->name : 'N/A';
            })
            ->addColumn('batch_name', function ($row) {
                return $row->batch ? $row->batch->name : 'N/A';
            })
            ->addColumn('student_name', function ($row) {
                return $row->student ? $row->student->name : 'N/A';
            })
            ->addColumn('status', function($row) {
                if($row->status == 1){
                    $statusBtn = '<span class="active_btn">Active</span>';
                }else{
                    $statusBtn = '<span class="inactive_btn">Inactive</span>';
                }
                return $statusBtn;
            })
            ->rawColumns(['status','action'])
            ->toJson();
        }
        return view('backEnd.result.index',compact('departments','sessions','classrooms','batches'));
    }
    public function create(Request $request){
        $departments = Department::where('status',1)->get();
        $sessions = StudentSession::where('status',1)->get();
        $classrooms = [];
        $batches   = [];
        $batchstudents   = [];
        $exams   = [];
        $find_batch   = null;

        $data = [];

        if ($request->department_id) {

            if ($request->department_id) {
                $data = Student::orderBy('id', 'asc')
                    ->with(['batch', 'attendances'])
                    ->select('id','department_id','class_id','session_id','batch_id','name','roll_number','phone_number')
                    ->where('department_id', $request->department_id);
                $classrooms = Classroom::where('department_id', $request->department_id)->get();
            }

            if ($request->class_id) {
                $data = $data->where('class_id', $request->class_id);
            }

            if ($request->session_id) {
                $data = $data->where('session_id', $request->session_id);
                $batches = Batch::where('session_id', $request->session_id)->get();
                $exams = Exam::where('session_id', $request->session_id)->get();
            }

            if ($request->batch_id) {
                $data = $data->where('batch_id', $request->batch_id);
                $exams = Exam::where('batch_id', $request->batch_id)->get();
            }

            if ($request->student_id) {
                $data = $data->where('id', $request->student_id);
            }
        
            $data = $data->get();

           
        }

        return view('backEnd.result.create',compact('data','departments','sessions','classrooms','batches','batchstudents','exams'));
    }
    public function store(Request $request){
        // return $request->all();
        $this->validate($request,[
            'exam_id'=>'required',
            'department_id'=>'required',
            'class_id'=>'required',
            'session_id'=>'required',
            'written'=>'required',
        ]);

        // return $request->all();
        $student_id =  $request->student_id;
        $written    =  $request->written;
        $max_written= collect($written)->flatten()->max();
        $mcq        =  $request->mcq;
        $mcq_max    = collect($mcq)->flatten()->max();
        
        $total_marks = [];
        foreach ($student_id as $key => $id) {
            $total_marks[$id] = (int)($written[$key] ?? 0) + (int)($mcq[$key] ?? 0);
        }

    
        arsort($total_marks);
    
        $position = 1;
        $previous_marks = null;
        $positions = [];
        foreach ($total_marks as $id => $total) {
            if ($total !== $previous_marks) {
                $position = count($positions) + 1;
            }
            $positions[$id] = $position;
            $previous_marks = $total;
        }
        $highest = max($total_marks);
        
        foreach($student_id as $key=>$value){

            if (!empty($written[$key]) || !empty($mcq[$key])) {
            $studen = Student::find($student_id[$key]);
            $exam = Exam::find($request->exam_id);
            $value = new Result();
            $value->department_id  =  $request->department_id;
            $value->roll_number    =  $studen->roll_number;
            $value->class_id       =  $request->class_id;
            $value->session_id     =  $request->session_id;
            $value->batch_id       =  $request->batch_id;
            $value->exam_id        =  $request->exam_id;
            $value->marks          =  $exam->marks;
            $value->mcq            =  $mcq[$key]??0;
            $value->cq             =  $written[$key]??0;
            $value->hs             =  max($total_marks);
            $value->position       =  $positions[$student_id[$key]];
            $value->result_date    =  Carbon::now();
            $value->student_id     =  $student_id[$key];
            $value->status         =  1;
            $value->save();
            
            if($request->onlyweb!=1){
            
            
            if($request->onlymcq){
                $msg = "Dear $studen->name\r\n$exam->title result\r\nRoll : $studen->roll_number\r\nFull Mark : $exam->marks\r\nYour Mark: MCQ- $value->marks\r\n\Highest: MCQ- $mcq_max\r\n-Admission Aid";
            }else{
                   $msg = "Dear {$studen->name}\r\n{$exam->title} result\r\nRoll : {$studen->roll_number}\r\nFull Mark : {$exam->marks}\r\nYour Mark:" . ($value->mcq ? " MCQ- {$value->mcq} &" : "") . ($value->cq ? "Written- {$value->cq}" : "") . "\r\nHighest:" . ($mcq_max ? " MCQ- {$mcq_max} &" : "") . ($max_written ? "Written- {$max_written}" : "") . "\r\n- Admission Aid";

            }
                
            // $url = "https://msg.elitbuzz-bd.com/smsapi";
            //   $data = [
            //     "api_key" => "C200816561d6d9a91d5e50.54729786",
            //     "type" => "{content type}",
            //     "contacts" => $studen->father_number,
            //     "senderid" => "8809612472615",
            //     "msg"=>$msg,
            //    ];
            // //   return $data;
            //   $ch = curl_init();
            //   curl_setopt($ch, CURLOPT_URL, $url);
            //   curl_setopt($ch, CURLOPT_POST, 1);
            //   curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            //   curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            //   curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            //   $response = curl_exec($ch);
            //   curl_close($ch);

            }
        }
        }
        Toastr::success('Success','Result add successfully');
        return redirect()->back();
    }

    public function quick_result(){
        return view('backEnd.result.quick_result');
    }
    public function quick_import(Request $request)
    {
       Excel::import(new ResultImport($request), $request->file('excel'));
      return redirect()->back(); 
    }
}
