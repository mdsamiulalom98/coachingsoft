<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['locked', 'unlocked']);
    }
    public function dashboard(Request $request)
    {
        
        return view('backEnd.admin.dashboard');
    }
    public function changepassword()
    {
        return view('backEnd.admin.changepassword');
    }
    
    public function locked()
    {
        // only if user is logged in

        Session::put('locked', true);
        return view('backEnd.auth.locked');
        return redirect()->route('login');
    }

    public function unlocked(Request $request)
    {
        if (!Auth::check())
            return redirect()->route('login');
        $password = $request->password;
        if (Hash::check($password, Auth::user()->password)) {
            Session::forget('locked');
            Toastr::success('Success', 'You are logged in successfully!');
            return redirect()->route('dashboard');
        }
        Toastr::error('Failed', 'Your password not match!');
        return back();
    }

}
