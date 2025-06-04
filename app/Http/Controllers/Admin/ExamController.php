<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Department;
use App\Models\StudentSession;
use App\Models\Classroom;
use App\Models\Batch;
use App\Models\Exam;
use App\Models\Student;
use Toastr;
class ExamController extends Controller
{
     public function create(){
        $departments = Department::where('status',1)->get();
        $sessions = StudentSession::where('status',1)->get();
        return view('backEnd.exam.create',compact('departments','sessions'));
    }
    public function store(Request $request){
        $this->validate($request,[
            'department_id'=>'required',
            'class_id'=>'required',
            'session_id'=>'required',
            'marks'=>'required',
        ]);

        $store_data                 =   new Exam();
        $store_data->title          =   $request->title;
        $store_data->exam_code      =   $request->exam_code;
        $store_data->department_id  =   $request->department_id;
        $store_data->class_id       =   $request->class_id;
        $store_data->session_id     =   $request->session_id;
        $store_data->batch_id       =   $request->batch_id;
        $store_data->marks          =   $request->marks;
        $store_data->cq             =   $request->cq;
        $store_data->mcq            =   $request->mcq;
        $store_data->status         =   1;
        $store_data->save();

        Toastr::success('Success','Data add successfully');
        return redirect()->back();
    }
   public function index(Request $request){
       
        $departments = Department::where('status',1)->get();
        $sessions = StudentSession::where('status',1)->get();
        $classrooms = [];
        $batches   = [];

        $data = [];
        
        if($request->department_id){
           $data = Exam::orderBy('id','DESC');
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
                    $statusBtn = '<form method="POST" action="'.route('exams.inactive').'" class="status_form" style="display:inline;">
                                      '.csrf_field().'
                                      <input type="hidden" name="id" value="'.$row->id.'">
                                      <button type="button" class="thumb_down"><i class="ti ti-thumb-down"></i></button>
                                   </form>';
                } else {
                    $statusBtn = '<form method="POST" action="'.route('exams.active').'" class="status_form" style="display:inline;">
                                      '.csrf_field().'
                                      <input type="hidden" name="id" value="'.$row->id.'">
                                      <button type="button" class="thumb_up"><i class="ti ti-thumb-up"></i></button>
                                   </form>';
                }
                $editBtn = '<a class="edit_btn" href="' . route('exams.edit', $row->id) . '">
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
        return view('backEnd.exam.index',compact('departments','sessions','classrooms','batches'));
    }
    public function edit($id){
        $edit_data  = Exam::find($id);
        $departments = Department::where('status',1)->get();
        $classrooms = Classroom::where(['status'=>1,'department_id'=>$edit_data->department_id])->get();
        $batches = Batch::where(['status'=>1,'class_id'=>$edit_data->class_id])->get();
        $sessions = StudentSession::where('status',1)->get();
        return view('backEnd.exam.edit',compact('edit_data', 'departments','classrooms','batches','sessions'));
    }
    
    public function update(Request $request){
        $this->validate($request,[
            'department_id'=>'required',
            'class_id'=>'required',
            'session_id'=>'required',
            'marks'=>'required',
        ]);

        $update_data                 =  Exam::find($request->id);
        $update_data->title          =   $request->title;
        $update_data->exam_code      =   $request->exam_code;
        $update_data->department_id  =   $request->department_id;
        $update_data->class_id       =   $request->class_id;
        $update_data->session_id     =   $request->session_id;
        $update_data->batch_id       =   $request->batch_id;
        $update_data->marks          =   $request->marks;
        $update_data->cq             =   $request->cq;
        $update_data->mcq            =   $request->mcq;
        $update_data->save();

        Toastr::success('Success','Data update successfully');
        return redirect()->back();
    }
    public function inactive(Request $request){
        $inactive_data =  Exam::find($request->id);
        $inactive_data->status=0;
        $inactive_data->save();
        Toastr::success('Success','Data inactive successfully');
        return redirect()->back();      
    }

    public function active(Request $request){
        $inactive_data =  Exam::find($request->id);
        $inactive_data->status=1;
        $inactive_data->save();
        Toastr::success('Success','Data active successfully');
        return redirect()->back();     
    }

    public function destroy(Request $request){
        $delete_data =  Exam::find($request->id);
        $delete_data->delete();
        Toastr::success('Success','Data delete successfully');
        return redirect()->back();        
    }
}
