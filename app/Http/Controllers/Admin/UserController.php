<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Intervention\Image\Encoders\WebpEncoder;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Arr;
use App\Models\User;
use Auth;
use Toastr;
use Image;
use File;
use DB;
use Hash;
class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:user-list|user-create|user-edit|user-delete', ['only' => ['index','store']]);
        $this->middleware('permission:user-create', ['only' => ['create','store']]);
        $this->middleware('permission:user-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:user-delete', ['only' => ['destroy']]);
    }
    public function dashboard()
    {
        return view('backEnd.user.dashboard');
    }
    public function index(Request $request)
    {
        $data = User::orderBy('id','asc');
        if($request->ajax()){
            return datatables()->of($data)
            ->addColumn('action', function($row) {
                if ($row->status == 1) {
                    $statusBtn = '<form method="POST" action="'.route('users.inactive').'" class="status_form" style="display:inline;">
                                      '.csrf_field().'
                                      <input type="hidden" name="id" value="'.$row->id.'">
                                      <button type="button" class="thumb_down"><i class="ti ti-thumb-down"></i></button>
                                   </form>';
                } else {
                    $statusBtn = '<form method="POST" action="'.route('users.active').'" class="status_form" style="display:inline;">
                                      '.csrf_field().'
                                      <input type="hidden" name="id" value="'.$row->id.'">
                                      <button type="button" class="thumb_up"><i class="ti ti-thumb-up"></i></button>
                                   </form>';
                }
                $editBtn = '<a class="edit_btn" href="' . route('users.edit', $row->id) . '">
                               <i class="ti ti-pencil"></i>
                            </a>';
                $deleteBtn = '<form method="POST" action="'.route('users.destroy').'" class="delete_form" style="display:inline;">
                                  '.csrf_field().'
                                  <input type="hidden" name="id" value="'.$row->id.'">
                                  <button type="button" class="delete_btn"><i class="ti ti-trash"></i></button>
                               </form>';
                return $statusBtn . ' ' . $editBtn . ' ' . $deleteBtn;
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
        return view('backEnd.user.index',compact('data'));
    }
    
    public function create()
    {
        $roles = Role::select('name')->get();
        return view('backEnd.user.create',compact('roles'));
    }
    
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            'roles' => 'required'
        ]);

        $file = $request->file('image');
        if($file){
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $image = Image::read($file);
            $uploadpath = 'public/uploads/user/';
            $imageUrl = $uploadpath.$filename; 
            $image->resize(300, 300, function ($constraint) {
                $constraint->aspectRatio();
            })->encode(new WebpEncoder(quality: 80))
            ->save($imageUrl);
        }else{
            $imageUrl = NULL;
        }

        $input = $request->except('confirm-password','roles');
        $input['password'] = Hash::make($input['password']);
        $input['image'] = $imageUrl;
        $input['status'] = $request->status??0;
        
        $user = User::create($input);
        $user->assignRole($request->input('roles'));
        Toastr::success('Success','Data insert successfully');
        return redirect()->route('users.index');
    }
    
    public function edit($id)
    {
        $edit_data = User::find($id);
        $roles = Role::get();
        return view('backEnd.user.edit',compact('edit_data','roles'));
    }
    
    public function update(Request $request){
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'password' => 'same:confirm-password',
            'roles' => 'required'
        ]);
        
        $update_data = User::find($request->id);
        
        $input = $request->except('confirm-password','roles');

        if(!empty($input['password'])){ 
            $input['password'] = Hash::make($input['password']);
        }else{
            $input = Arr::except($input,array('password'));    
        }

        $file = $request->file('image');
        if($file){
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $image = Image::read($file);
            $uploadpath = 'public/uploads/user/';
            $imageUrl = $uploadpath.$filename; 
            $image->resize(300, 300, function ($constraint) {
                $constraint->aspectRatio();
            })->encode(new WebpEncoder(quality: 80))
            ->save($imageUrl);
        }else{
            $imageUrl = $update_data->image;
        }
        

        $input['image'] = $imageUrl;
        $input['status'] = $request->status?1:0;
        $update_data->update($input);

        DB::table('model_has_roles')->where('model_id',$request->id)->delete();
        $update_data->assignRole($request->input('roles'));
        
        Toastr::success('Success','Data update successfully');
        return redirect()->route('users.index');
    }
 
    public function inactive(Request $request)
    {
        $inactive = User::find($request->id);
        $inactive->status = 0;
        $inactive->save();
        Toastr::success('Success','Data inactive successfully');
        return redirect()->back();
    }
    public function active(Request $request)
    {
        $active = User::find($request->id);
        $active->status = 1;
        $active->save();
        Toastr::success('Success','Data active successfully');
        return redirect()->back();
    }
    public function destroy(Request $request)
    {

        $delete_data = User::find($request->id);
        File::delete($delete_data->image);
        $delete_data->delete();
        Toastr::success('Success','Data delete successfully');
        return redirect()->back();
    }
    public function profile(Request $request)
    {
        $profile = User::find(auth()->user()->id);
        $roles = Role::select('name')->get();
        return view('backEnd.user.profile',compact('profile','roles'));
    }
    public function change_password(Request $request)
    {
        $this->validate($request, [
            'old_password' => 'required',
            'new_password' => 'required',
            'confirm_password' => 'required_with:new_password|same:new_password|'
        ]);

        $user = User::find(Auth::user()->id);
        $hashPass = $user->password;

        if (Hash::check($request->old_password, $hashPass)) {
            $user->fill([
                'password' => Hash::make($request->new_password)
            ])->save();

            Toastr::success('Success', 'Password changed successfully!');
            return redirect()->route('users.index');
        } else {
            Toastr::error('Failed', 'Old password not match!');
            return back();
        }
    }
    
}
