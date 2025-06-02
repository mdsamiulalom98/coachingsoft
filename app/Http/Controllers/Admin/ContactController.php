<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;
use Toastr;
class ContactController extends Controller
{
    public function index()
    {
        $edit_data = Contact::first();
        return view('backEnd.contact.index',compact('edit_data'));
    }
    
    public function update(Request $request){
        $this->validate($request, [
            'phone' => 'required',
            'email' => 'required',
            'address' => 'required',
        ]);

        $update_data = Contact::find($request->id);
        $input = $request->all();
        $update_data->update($input);
        Toastr::success('Success','Data update successfully');
        return redirect()->back();
    }
}
