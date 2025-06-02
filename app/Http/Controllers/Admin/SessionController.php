<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StudentSession;
use Toastr;
class SessionController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:session-list|session-create|session-edit|session-delete', ['only' => ['index','store']]);
         $this->middleware('permission:session-create', ['only' => ['create','store']]);
         $this->middleware('permission:session-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:session-delete', ['only' => ['destroy']]);
    }
    
    public function index(Request $request)
    {
        $data = StudentSession::orderBy('id','DESC');
        if($request->ajax()){
            return datatables()->of($data)
            ->addColumn('action', function($row) {
                if ($row->status == 1) {
                    $statusBtn = '<form method="POST" action="'.route('sessions.inactive').'" class="status_form" style="display:inline;">
                                      '.csrf_field().'
                                      <input type="hidden" name="id" value="'.$row->id.'">
                                      <button type="button" class="thumb_down"><i class="ti ti-thumb-down"></i></button>
                                   </form>';
                } else {
                    $statusBtn = '<form method="POST" action="'.route('sessions.active').'" class="status_form" style="display:inline;">
                                      '.csrf_field().'
                                      <input type="hidden" name="id" value="'.$row->id.'">
                                      <button type="button" class="thumb_up"><i class="ti ti-thumb-up"></i></button>
                                   </form>';
                }
                $editBtn = '<a class="edit_btn" href="' . route('sessions.edit', $row->id) . '">
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
            ->rawColumns(['status','action'])
            ->toJson();
        }
        
        return view('backEnd.session.index');
    }
    
    public function create(){
        return view('backEnd.session.create');
    }
    
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);
        $input = $request->all();
        $input['status'] = $request->status??0;
        StudentSession::create($input);
        Toastr::success('Success','Data store successfully');
        return redirect()->route('sessions.index');
    }
    
    public function edit($id)
    {
        $edit_data = StudentSession::find($id);
        return view('backEnd.session.edit',compact('edit_data'));
    }
    
    public function update(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);
        $input = $request->all();
        $input['status'] = $request->status??0;
        $update_data = StudentSession::find($request->id);
        $update_data->update($input);

        Toastr::success('Success','Data update successfully');
        return redirect()->route('sessions.index');
    }
    public function inactive(Request $request)
    {
        $inactive = StudentSession::find($request->id);
        $inactive->status = 0;
        $inactive->save();
        Toastr::success('Success','Data inactive successfully');
        return redirect()->back();
    }
    public function active(Request $request)
    {
        $active = StudentSession::find($request->id);
        $active->status = 1;
        $active->save();
        Toastr::success('Success','Data active successfully');
        return redirect()->back();
    }
}
