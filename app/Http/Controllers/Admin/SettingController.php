<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Intervention\Image\Encoders\WebpEncoder;
use Illuminate\Http\Request;
use App\Models\Setting;
use Toastr;
use Image;
class SettingController extends Controller
{
    public function edit()
    {
        $edit_data = Setting::first();
        return view('backEnd.setting.edit',compact('edit_data'));
    }
    
    public function update(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);

        $update_data = Setting::find($request->id);

        $input = $request->all();
        $white_logo = $request->file('white_logo');
        if($white_logo){
            $filename = time() . '.' . $white_logo->getClientOriginalName();
            $image = Image::read($white_logo);
            $uploadpath = 'public/uploads/setting/';
            $imageUrl = $uploadpath.$filename; 
            $image->resize(210, 70, function ($constraint) {
                $constraint->aspectRatio();
            })->encode(new WebpEncoder(quality: 80))
            ->save($imageUrl);
            $input['white_logo'] = $imageUrl;
        }else{
            $input['white_logo'] = $update_data->white_logo;
        }

        $dark_logo = $request->file('dark_logo');
        if($dark_logo){
            $filename = time() . '.' . $dark_logo->getClientOriginalName();
            $image = Image::read($dark_logo);
            $uploadpath = 'public/uploads/setting/';
            $imageUrl = $uploadpath.$filename; 
            $image->resize(210, 70, function ($constraint) {
                $constraint->aspectRatio();
            })->encode(new WebpEncoder(quality: 80))
            ->save($imageUrl);
            $input['dark_logo'] = $imageUrl;
        }else{
            $input['dark_logo'] = $update_data->dark_logo;
        }

        $favicon = $request->file('favicon');
        if($favicon){
            $filename = time() . '.' . $favicon->getClientOriginalName();
            $image = Image::read($favicon);
            $uploadpath = 'public/uploads/setting/';
            $imageUrl = $uploadpath.$filename; 
            $image->resize(210, 70, function ($constraint) {
                $constraint->aspectRatio();
            })->encode(new WebpEncoder(quality: 80))
            ->save($imageUrl);
            $input['favicon'] = $imageUrl;
        }else{
            $input['favicon'] = $update_data->favicon;
        }
        $update_data->update($input);
        Toastr::success('Success','Data update successfully');
        return redirect()->back();
    }
}
