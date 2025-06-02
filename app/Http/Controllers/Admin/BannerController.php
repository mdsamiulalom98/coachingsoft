<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Intervention\Image\Encoders\WebpEncoder;
use App\Models\Banner;
use Toastr;
use Image;
class BannerController extends Controller
{
     public function index(Request $request)
    {
        $data = Banner::orderBy('id','DESC');
        if($request->ajax()){
            return datatables()->of($data)
            ->addColumn('action', function($row) {
                if ($row->status == 1) {
                    $statusBtn = '<form method="POST" action="'.route('banners.inactive').'" class="status_form" style="display:inline;">
                                      '.csrf_field().'
                                      <input type="hidden" name="id" value="'.$row->id.'">
                                      <button type="button" class="thumb_down"><i class="ti ti-thumb-down"></i></button>
                                   </form>';
                } else {
                    $statusBtn = '<form method="POST" action="'.route('banners.active').'" class="status_form" style="display:inline;">
                                      '.csrf_field().'
                                      <input type="hidden" name="id" value="'.$row->id.'">
                                      <button type="button" class="thumb_up"><i class="ti ti-thumb-up"></i></button>
                                   </form>';
                }
                $editBtn = '<a class="edit_btn" href="' . route('banners.edit', $row->id) . '">
                               <i class="ti ti-pencil"></i>
                            </a>';
                return $statusBtn . ' ' . $editBtn;
            })
            ->addColumn('image', function ($row) {
                    return '<img src="'.asset($row->image).'" alt="Banner" class="circle_img">';
            })
            ->addColumn('status', function($row) {
                if($row->status == 1){
                    $statusBtn = '<span class="active_btn">Active</span>';
                }else{
                    $statusBtn = '<span class="inactive_btn">Inactive</span>';
                }
                return $statusBtn;
            })
            ->rawColumns(['image','status','action'])
            ->toJson();
        }
        
        return view('backEnd.banner.index');
    }
    public function create()
    {
        return view('backEnd.banner.create');
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'link' => 'required',
            'status' => 'required',
        ]);

        $file = $request->file('image');
        if($file){
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $image = Image::read($file);
            $uploadpath = 'public/uploads/banner/';
            $imageUrl = $uploadpath.$filename; 
            $image->encode(new WebpEncoder(quality: 80))
            ->save($imageUrl);
        }else{
            $imageUrl = $update_data->image;
        }

        $input = $request->all();
        $input['status'] = $request->status ? 1 : 0;
        $input['image'] = $imageUrl;
        Banner::create($input);
        Toastr::success('Success', 'Data insert successfully');
        return redirect()->route('banners.index');
    }

    public function edit($id)
    {
        $edit_data = Banner::find($id);
        return view('backEnd.banner.edit', compact('edit_data'));
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'link' => 'required',
        ]);

        $update_data = Banner::find($request->id);
        $input = $request->all();

        $file = $request->file('image');
        if($file){
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $image = Image::read($file);
            $uploadpath = 'public/uploads/banner/';
            $imageUrl = $uploadpath.$filename; 
            $image->encode(new WebpEncoder(quality: 80))
            ->save($imageUrl);
        }else{
            $imageUrl = $update_data->image;
        }
        
        $input['status'] = $request->status ? 1 : 0;
        $input['image'] = $imageUrl;
        $update_data->update($input);

        Toastr::success('Success', 'Data update successfully');
        return redirect()->route('banners.index');
    }

    public function inactive(Request $request)
    {
        $inactive = Banner::find($request->hidden_id);
        $inactive->status = 0;
        $inactive->save();
        Toastr::success('Success', 'Data inactive successfully');
        return redirect()->back();
    }
    public function active(Request $request)
    {
        $active = Banner::find($request->hidden_id);
        $active->status = 1;
        $active->save();
        Toastr::success('Success', 'Data active successfully');
        return redirect()->back();
    }
    public function destroy(Request $request)
    {
        $delete_data = Banner::find($request->hidden_id);
        $delete_data->delete();
        Toastr::success('Success', 'Data delete successfully');
        return redirect()->back();
    }
}
