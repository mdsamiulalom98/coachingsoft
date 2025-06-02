<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Intervention\Image\Encoders\WebpEncoder;
use App\Models\SuccessStudent;
use App\Models\SuccessYear;
use Toastr;
use Image;
class SuccessStudentController extends Controller
{
    function __construct()
    {
         // $this->middleware('permission:success-student-list|success-student-create|success-student-edit|success-student-delete', ['only' => ['index','store']]);
         // $this->middleware('permission:success-student-create', ['only' => ['create','store']]);
         // $this->middleware('permission:success-student-edit', ['only' => ['edit','update']]);
         // $this->middleware('permission:success-student-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
       $data = SuccessStudent::orderBy('id','DESC');
        if($request->ajax()){
            return datatables()->of($data)
            ->addColumn('action', function($row) {
                if ($row->status == 1) {
                    $statusBtn = '<form method="POST" action="'.route('success_students.inactive').'" class="status_form" style="display:inline;">
                                      '.csrf_field().'
                                      <input type="hidden" name="id" value="'.$row->id.'">
                                      <button type="button" class="thumb_down"><i class="ti ti-thumb-down"></i></button>
                                   </form>';
                } else {
                    $statusBtn = '<form method="POST" action="'.route('success_students.active').'" class="status_form" style="display:inline;">
                                      '.csrf_field().'
                                      <input type="hidden" name="id" value="'.$row->id.'">
                                      <button type="button" class="thumb_up"><i class="ti ti-thumb-up"></i></button>
                                   </form>';
                }
                $editBtn = '<a class="edit_btn" href="' . route('success_students.edit', $row->id) . '">
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
         return view('backEnd.success.index');
    }
    public function create()
    {
        $success_years = SuccessYear::get();
        return view('backEnd.success.create',compact('success_years'));
    }
    public function store(Request $request)
    {
        // return $request->all();
        $this->validate($request, [
            'name' => 'required',
            'session' => 'required',
            'institute' => 'required',
            'image' => 'required',
        ]);

        $file = $request->file('image');
        if($file){
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $image = Image::read($file);
            $uploadpath = 'public/uploads/success/';
            $imageUrl = $uploadpath.$filename; 
            $image->encode(new WebpEncoder(quality: 80))
            ->save($imageUrl);
        }else{
            $imageUrl = NULL;
        }
        $input = $request->all();
        $input['status'] = $request->status ?? 1;
        $input['image'] = $imageUrl;
        SuccessStudent::create($input);
        Toastr::success('Success','Data insert successfully');
        return redirect()->route('success_students.index');
    }

    public function edit($id)
    {
        $edit_data = SuccessStudent::find($id);
        $success_years = SuccessYear::get();
        return view('backEnd.success.edit',compact('edit_data','success_years'));
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'session' => 'required',
            'institute' => 'required'
        ]);

        $update_data = SuccessStudent::find($request->id);
        $input = $request->all();
        $file = $request->file('image');
        if($file){
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $image = Image::read($file);
            $uploadpath = 'public/uploads/success/';
            $imageUrl = $uploadpath.$filename; 
            $image->encode(new WebpEncoder(quality: 80))
            ->save($imageUrl);
            $input['image'] = $imageUrl;
        }else{
            $imageUrl = $update_data->image;
            $input['image'] = $imageUrl;
        }

        $input['status'] = $request->status?1:0;
        $update_data->update($input);

        Toastr::success('Success','Data update successfully');
        return redirect()->route('success_students.index');
    }

    public function inactive(Request $request)
    {
        $inactive = SuccessStudent::find($request->id);
        $inactive->status = 0;
        $inactive->save();
        Toastr::success('Success','Data inactive successfully');
        return redirect()->back();
    }
    public function active(Request $request)
    {
        $active = SuccessStudent::find($request->id);
        $active->status = 1;
        $active->save();
        Toastr::success('Success','Data active successfully');
        return redirect()->back();
    }
    public function destroy(Request $request)
    {
        $delete_data = SuccessStudent::find($request->id);
        $delete_data->delete();
        Toastr::success('Success','Data delete successfully');
        return redirect()->back();
    }
    public function success_year(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:success_years',
        ]);
        return "wait";

        $store_date = new SuccessYear();
        $store_date->name = $request->name;
        $store_date->save();
        Toastr::success('Success','Data save successfully');
        return redirect()->back();
    }
}
