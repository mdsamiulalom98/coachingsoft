<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Department;
use App\Models\Classroom;
use Toastr;
class ClassroomController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:class-list|class-create|class-edit|class-delete', ['only' => ['index','store']]);
         $this->middleware('permission:class-create', ['only' => ['create','store']]);
         $this->middleware('permission:class-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:class-delete', ['only' => ['destroy']]);
    }
    
    public function index(Request $request)
    {
        $data = Classroom::orderBy('id','DESC')->with('department:id,name');
        if($request->ajax()){
            return datatables()->of($data)
            ->addColumn('action', function($row) {
                if ($row->status == 1) {
                    $statusBtn = '<form method="POST" action="'.route('classrooms.inactive').'" class="status_form" style="display:inline;">
                                      '.csrf_field().'
                                      <input type="hidden" name="id" value="'.$row->id.'">
                                      <button type="button" class="thumb_down"><i class="ti ti-thumb-down"></i></button>
                                   </form>';
                } else {
                    $statusBtn = '<form method="POST" action="'.route('classrooms.active').'" class="status_form" style="display:inline;">
                                      '.csrf_field().'
                                      <input type="hidden" name="id" value="'.$row->id.'">
                                      <button type="button" class="thumb_up"><i class="ti ti-thumb-up"></i></button>
                                   </form>';
                }
                $editBtn = '<a class="edit_btn" href="' . route('classrooms.edit', $row->id) . '">
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
            ->rawColumns(['status','action'])
            ->toJson();
        }
        
        return view('backEnd.classroom.index');
    }
    
    public function create(){
        $departments = Department::where('status',1)->get();
        return view('backEnd.classroom.create',compact('departments'));
    }
    
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);
        $input = $request->all();
        Classroom::create($input);
        Toastr::success('Success','Data store successfully');
        return redirect()->route('classrooms.index');
    }
    
    public function edit($id)
    {
        $edit_data = Classroom::find($id);
        $departments = Department::where('status',1)->get();
        return view('backEnd.classroom.edit',compact('edit_data','departments'));
    }
    
    public function update(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);
        $input = $request->all();
        $update_data = Classroom::find($request->id);
        $update_data->update($input);

        Toastr::success('Success','Data update successfully');
        return redirect()->route('classrooms.index');
    }
    public function inactive(Request $request)
    {
        $inactive = Classroom::find($request->id);
        $inactive->status = 0;
        $inactive->save();
        Toastr::success('Success','Data inactive successfully');
        return redirect()->back();
    }
    public function active(Request $request)
    {
        $active = Classroom::find($request->id);
        $active->status = 1;
        $active->save();
        Toastr::success('Success','Data active successfully');
        return redirect()->back();
    }
    public function ajax_class(Request $request)
    {
        $response = Classroom::where("department_id", $request->id)
            ->pluck('name', 'id');
        return response()->json($response);
    }
}
