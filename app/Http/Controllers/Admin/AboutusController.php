<?php

namespace App\Http\Controllers\Admin;
use Intervention\Image\Encoders\WebpEncoder;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AboutUs;
use Toastr;
use Image;
class AboutusController extends Controller
{
    public function index()
    {
        $edit_data = AboutUs::first();
        return view('backEnd.about.index',compact('edit_data'));
    }
    
    public function update(Request $request){

        $this->validate($request, [
            'title' => 'required',
            'sub_title' => 'required',
            'short_description' => 'required',
        ]);

        $file = $request->file('image');
        if($file){
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $image = Image::read($file);
            $uploadpath = 'public/uploads/about/';
            $imageUrl = $uploadpath.$filename; 
            $image->encode(new WebpEncoder(quality: 80))
            ->save($imageUrl);
        }else{
            $imageUrl = $update_data->image;
        }

        $update_data = AboutUs::find($request->id);
        $input = $request->all();
        $input['image'] = $imageUrl;
        $update_data->update($input);
        Toastr::success('Success','Data update successfully');
        return redirect()->back();
    }
}
