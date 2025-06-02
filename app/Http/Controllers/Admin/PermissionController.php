<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Toastr;
use DB;
class PermissionController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:permission-list|permission-create|permission-edit|permission-delete', ['only' => ['index','store']]);
         $this->middleware('permission:permission-create', ['only' => ['create','store']]);
         $this->middleware('permission:permission-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:permission-delete', ['only' => ['destroy']]);
    }
    
    public function index(Request $request)
    {
        $data = Permission::orderBy('id','DESC');
        if($request->ajax()){
            return datatables()->of($data)
            ->addColumn('action', function($row) {
                $editBtn = '<a class="edit_btn" href="' . route('permissions.edit', $row->id) . '">
                               <i class="ti ti-pencil"></i>
                            </a>';
                $deleteBtn = '<form method="POST" action="'.route('permissions.destroy').'" class="delete_form" style="display:inline;">
                                  '.csrf_field().'
                                  <input type="hidden" name="id" value="'.$row->id.'">
                                  <button type="button" class="delete_btn"><i class="ti ti-trash"></i></button>
                               </form>';
                return  $editBtn . ' ' . $deleteBtn;
            })
            ->rawColumns(['action'])
            ->toJson();
        }
        return view('backEnd.permissions.index');
    }
    
    public function create()
    {
        return view('backEnd.permissions.create');
    }
    
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:permissions,name',
        ]);
        $input = $request->all();
        $input['guard_name'] = 'web';
        $insert = Permission::create($input);
        Toastr::success('Success','Data store successfully');
        return redirect()->route('permissions.index');
    }
    
    public function edit($id)
    {
        $edit_data = Permission::find($id);
        return view('backEnd.permissions.edit',compact('edit_data'));
    }
    
    public function update(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);
        $input = $request->all();
        $input['guard_name'] = 'web';
        $update_data = Permission::find($request->id);
        $update_data->update($input);
        Toastr::success('Success','Data update successfully');
        return redirect()->route('permissions.index');
    }
    public function destroy(Request $request)
    {
        $delete_data = Permission::find($request->id)->delete();
        Toastr::success('Success','Data delete successfully');
        return redirect()->back();
    }
}
