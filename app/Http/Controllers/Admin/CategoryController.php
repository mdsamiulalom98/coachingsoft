<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Intervention\Image\Encoders\WebpEncoder;
use App\Models\Category;
use Image;
use File;
class CategoryController extends Controller
{
    function __construct()
    {
         // $this->middleware('permission:category-list|category-create|category-edit|category-delete', ['only' => ['index','store']]);
         // $this->middleware('permission:category-create', ['only' => ['create','store']]);
         // $this->middleware('permission:category-edit', ['only' => ['edit','update']]);
         // $this->middleware('permission:category-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
       $data = Category::orderBy('id','DESC');
        if($request->ajax()){
            return datatables()->of($data)
            ->addColumn('action', function($row) {
                if ($row->status == 1) {
                    $statusBtn = '<form method="POST" action="'.route('categories.inactive').'" class="status_form" style="display:inline;">
                                      '.csrf_field().'
                                      <input type="hidden" name="id" value="'.$row->id.'">
                                      <button type="button" class="thumb_down"><i class="ti ti-thumb-down"></i></button>
                                   </form>';
                } else {
                    $statusBtn = '<form method="POST" action="'.route('categories.active').'" class="status_form" style="display:inline;">
                                      '.csrf_field().'
                                      <input type="hidden" name="id" value="'.$row->id.'">
                                      <button type="button" class="thumb_up"><i class="ti ti-thumb-up"></i></button>
                                   </form>';
                }
                $editBtn = '<a class="edit_btn" href="' . route('categories.edit', $row->id) . '">
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
         return view('backEnd.category.index');
    }
    public function create()
    {
        return view('backEnd.category.create');
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'status' => 'required',
        ]);

        $file = $request->file('image');
        if($file){
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $image = Image::read($file);
            $uploadpath = 'public/uploads/category/';
            $imageUrl = $uploadpath.$filename; 
            $image->encode(new WebpEncoder(quality: 80))
            ->save($imageUrl);
        }else{
            $imageUrl = $update_data->image;
        }
        $input = $request->all();
        $input['image'] = $imageUrl;
        Category::create($input);
        Toastr::success('Success','Data insert successfully');
        return redirect()->route('categories.index');
    }

    public function edit($id)
    {
        $edit_data = Category::find($id);
        return view('backEnd.category.edit',compact('edit_data'));
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);

        $update_data = Category::find($request->id);
        $input = $request->all();
        $file = $request->file('image');
        if($file){
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $image = Image::read($file);
            $uploadpath = 'public/uploads/category/';
            $imageUrl = $uploadpath.$filename; 
            $image->encode(new WebpEncoder(quality: 80))
            ->save($imageUrl);
        }else{
            $imageUrl = $update_data->image;
        }
        $input['status'] = $request->status?1:0;
        $input['image'] = $imageUrl;
        $update_data->update($input);

        Toastr::success('Success','Data update successfully');
        return redirect()->route('categories.index');
    }

    public function inactive(Request $request)
    {
        $inactive = Category::find($request->id);
        $inactive->status = 0;
        $inactive->save();
        Toastr::success('Success','Data inactive successfully');
        return redirect()->back();
    }
    public function active(Request $request)
    {
        $active = Category::find($request->id);
        $active->status = 1;
        $active->save();
        Toastr::success('Success','Data active successfully');
        return redirect()->back();
    }
    public function destroy(Request $request)
    {
        $delete_data = Category::find($request->id);
        $delete_data->delete();
        Toastr::success('Success','Data delete successfully');
        return redirect()->back();
    }
}
