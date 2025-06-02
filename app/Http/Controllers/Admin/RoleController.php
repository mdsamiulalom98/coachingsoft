<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Toastr;
use DB;
class RoleController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:role-list|role-create|role-edit|role-delete', ['only' => ['index','store']]);
         $this->middleware('permission:role-create', ['only' => ['create','store']]);
         $this->middleware('permission:role-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:role-delete', ['only' => ['destroy']]);
    }
    
    public function index(Request $request)
    {
        $data = Role::orderBy('id','DESC');
        if($request->ajax()){
            return datatables()->of($data)
            ->addColumn('action', function($row) {
                $editBtn = '<a class="edit_btn" href="' . route('roles.edit', $row->id) . '">
                               <i class="ti ti-pencil"></i>
                            </a>';
                $deleteBtn = '<form method="POST" action="'.route('roles.destroy').'" class="delete_form" style="display:inline;">
                                  '.csrf_field().'
                                  <input type="hidden" name="id" value="'.$row->id.'">
                                  <button type="button" class="delete_btn"><i class="ti ti-trash"></i></button>
                               </form>';
                return  $editBtn . ' ' . $deleteBtn;
            })
            ->rawColumns(['action'])
            ->toJson();
        }
        return view('backEnd.roles.index');
    }
    
    public function create()
    {
        $permission = Permission::get();
        return view('backEnd.roles.create',compact('permission'));
    }
    
    public function store(Request $request)
    {
        return $request->all();
        $this->validate($request, [
            'name' => 'required|unique:roles,name',
            'permission' => 'required',
        ]);

        $permissionsID = array_map(
            function($value) { return (int)$value; },
            $request->input('permission')
        );

        $role = Role::create(['name' => $request->input('name')]);
        $role->syncPermissions($permissionsID);
        Toastr::success('Success','Data store successfully');
        return redirect()->route('roles.index');
    }
    
    public function show($id)
    {
        $role = Role::find($id);
        $rolePermissions = Permission::join("role_has_permissions","role_has_permissions.permission_id","=","permissions.id")
            ->where("role_has_permissions.role_id",$id)
            ->get();
    
        return view('backEnd.roles.show',compact('role','rolePermissions'));
    }
    public function edit($id)
    {
        $edit_data = Role::find($id);
        $permission = Permission::get();
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id",$id)
            ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
            ->all();
        return view('backEnd.roles.edit',compact('edit_data','permission','rolePermissions'));
    }
    
    public function update(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'permission' => 'required',
        ]);
        $permissionsID = array_map(
            function($value) { return (int)$value; },
            $request->input('permission')
        );
        $input = $request->all();
        $update_data = Role::find($request->hidden_id);
        $update_data->update($input);
    
        $update_data->syncPermissions($permissionsID);
        Toastr::success('Success','Data update successfully');
        return redirect()->route('roles.index');
    }
    public function destroy(Request $request)
    {
        $delete_data = Role::find($request->hidden_id)->delete();
        Toastr::success('Success','Data delete successfully');
        return redirect()->back();
    }
}
