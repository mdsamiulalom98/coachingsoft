<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Department;
use App\Models\StudentSession;
use App\Models\Classroom;
use App\Models\Batch;
use Toastr;
class BatchController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:batch-list|batch-create|batch-edit|batch-delete', ['only' => ['index','store']]);
         $this->middleware('permission:batch-create', ['only' => ['create','store']]);
         $this->middleware('permission:batch-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:batch-delete', ['only' => ['destroy']]);
    }
    
    public function index(Request $request)
    {
        $data = Batch::orderBy('id','DESC')->with('department:id,name','class:id,name','session:id,name');
        if($request->ajax()){
            return datatables()->of($data)
            ->addColumn('action', function($row) {
                if ($row->status == 1) {
                    $statusBtn = '<form method="POST" action="'.route('batches.inactive').'" class="status_form" style="display:inline;">
                                      '.csrf_field().'
                                      <input type="hidden" name="id" value="'.$row->id.'">
                                      <button type="button" class="thumb_down"><i class="ti ti-thumb-down"></i></button>
                                   </form>';
                } else {
                    $statusBtn = '<form method="POST" action="'.route('batches.active').'" class="status_form" style="display:inline;">
                                      '.csrf_field().'
                                      <input type="hidden" name="id" value="'.$row->id.'">
                                      <button type="button" class="thumb_up"><i class="ti ti-thumb-up"></i></button>
                                   </form>';
                }
                $editBtn = '<a class="edit_btn" href="' . route('batches.edit', $row->id) . '">
                               <i class="ti ti-pencil"></i>
                            </a>';
                return $statusBtn . ' ' . $editBtn;
            })
            ->addColumn('status', function($row) {
                if($row->status == 1){
                    $statusBtn = '<span class="active_btn">Active</span>';
                }else{
                    $statusBtn = '<span class="inactive_btn">Inactive</span>';
                }
                return $statusBtn;
            })
            ->addColumn('department_name', function ($row) {
                return $row->department ? $row->department->name : 'N/A';
            })
            ->addColumn('class_name', function ($row) {
                return $row->class ? $row->class->name : 'N/A';
            })
            ->addColumn('session_name', function ($row) {
                return $row->session ? $row->session->name : 'N/A';
            })
            ->rawColumns(['status','action'])
            ->toJson();
        }
        
        return view('backEnd.batch.index');
    }
    
    public function create(){
        $departments = Department::where('status',1)->get();
        $sessions = StudentSession::where('status',1)->get();
        return view('backEnd.batch.create',compact('departments','sessions'));
    }
    
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'department_id' => 'required',
            'class_id' => 'required',
            'session_id' => 'required',
            'payment_type' => 'required',
        ]);
        $input = $request->all();
        $input['status'] = $request->status??0;
        Batch::create($input);
        Toastr::success('Success','Data store successfully');
        return redirect()->route('batches.index');
    }
    
    public function edit($id)
    {
        $edit_data = Batch::find($id);
        $departments = Department::where('status',1)->get();
        $sessions = StudentSession::where('status',1)->get();
        $classrooms = Classroom::where(['status'=>1,'department_id'=>$edit_data->department_id])->get();
        // return $edit_data;
        return view('backEnd.batch.edit',compact('edit_data','departments','sessions','classrooms'));
    }
    
    public function update(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'department_id' => 'required',
            'class_id' => 'required',
            'session_id' => 'required',
            'payment_type' => 'required',
        ]);
        $input = $request->all();
        $update_data = Batch::find($request->id);
        $input['status'] = $request->status??0;
        $update_data->update($input);

        Toastr::success('Success','Data update successfully');
        return redirect()->route('batches.index');
    }
    public function inactive(Request $request)
    {
        $inactive = Batch::find($request->id);
        $inactive->status = 0;
        $inactive->save();
        Toastr::success('Success','Data inactive successfully');
        return redirect()->back();
    }
    public function active(Request $request)
    {
        $active = Batch::find($request->id);
        $active->status = 1;
        $active->save();
        Toastr::success('Success','Data active successfully');
        return redirect()->back();
    }
}
