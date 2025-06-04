<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\CourseOrder;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\Shipping;
use App\Models\Setting;
use App\Models\Attendance;
use App\Models\Course;
use App\Models\Chapter;
use App\Models\Lesson;
use Carbon\Carbon;
use Session;
use Toastr;
use Auth;
use Cart;
class StudentController extends Controller
{
        private function setting()
    {
        return Setting::select('name')->first();
    }
    public function register()
    {
        return view('frontEnd.layouts.student.register');
    }

    public function store(Request $request)
    {
        // return $request->all();
        $this->validate($request, [
                'name' => 'required',
                'phone_number' => 'required|max:11|unique:students|regex:/^\S*$/u',
                'password' => 'required|min:6|confirmed',
            ]);
        
        $token= rand(1111,9999);

        $store_data                 = new Student();
        $store_data->name           = $request->name;
        $store_data->phone_number   = $request->phone_number;
        $store_data->add_date       = Carbon::now();
        $store_data->roll_number    = $this->rollGenerate();
        $store_data->platform       = 'online';
        $store_data->verify         = $token;
        $store_data->status         = 0;
        $store_data->password       = bcrypt(request('password'));
        $store_data->save();

        Session::put('verify_phone',$store_data->phone_number);
        Toastr::success('Congratulation your account create successfully', 'success!');
        return redirect()->route('student.verify');
    }
    public function verify()
    {
        return view('frontEnd.layouts.student.verify');
    }
    public function account_verify(Request $request)
    {
        $this->validate($request, [
            'otp' => 'required',
        ]);
        $auth_check = Student::select('id', 'phone_number', 'verify')->where('phone_number', Session::get('verify_phone'))->first();
        if ($auth_check->verify == $request->otp) {
            $auth_check->verify = 1;
            $auth_check->status = 1;
            $auth_check->save();

            Auth::guard('student')->loginUsingId($auth_check->id);
            Toastr::success('Your account verified successfully', 'Congratulations!');
            Session::forget('verify_phone');
            return redirect()->route('student.dashboard');
        } else {
            Toastr::error('Your token does not match', 'Failed!');
            return redirect()->back();
        }
    }

    public function login()
    {
        return view('frontEnd.layouts.student.login');
    }
    // login form
    public function signin(Request $request)
    {
        $this->validate($request, [
            'phone_number' => 'required',
            'password' => 'required',
        ]);

        $check_auth =  Student::select('id','phone_number')->where('phone_number', $request->phone_number)->first();
        if(!$check_auth){
            Toastr::error('Oops', 'You have no account');
            return back();
        }

        $credentials = ['phone_number' => $request->phone_number, 'password' => $request->password];
        if (Auth::guard('student')->attempt($credentials)) {
            Toastr::success('Congratulation you login successfully', 'success!');
            
            return redirect()->route('student.dashboard');
        } else {
            Toastr::error('Oops', 'Your credentials does not match!');
            return redirect()->back();
        }
    }

    public function dashboard(Request $request){
        $student = Auth::guard('student')->user();
        $totalpresent = Attendance::where(['status' => 1, 'student_id' => $student->id])->whereMonth('created_at', Carbon::now()->month)->count();
        $totalabsent = Attendance::where(['status' => 0, 'student_id' => $student->id])->whereMonth('created_at', Carbon::now()->month)->count();
        $attendances = Attendance::where(['student_id' => $student->id])->whereMonth('created_at', Carbon::now()->month)->limit(7)->get();
        return view('frontEnd.layouts.student.dashboard', compact('totalpresent', 'totalabsent', 'attendances'));
    }

    public function profile()
    {
        $memberInfo = Student::find(Auth::guard('student')->user()->id);
        return view('frontEnd.layouts.student.profile', compact('memberInfo'));
    }
    public function enrollcourse() {
        $enrcourses = CourseOrder::where(['student_id'=>Auth::guard('student')->user()->id,'status'=>'paid'])->with('course')->get();
        return view('frontEnd.layouts.student.enrolled', compact('enrcourses'));
    }
     public function course_video(Request $request){

        $enrcourses = CourseOrder::where(['student_id'=>Auth::guard('student')->user()->id,'course_id'=>$request->course,'status'=>'paid'])->with('course')->first();

        if(!$enrcourses){
            Toastr::error('Oops', 'Your are trying invalid access!');
            return back();
        }
        $details = Course::where('id', $request->course)->with('chapters.lesson')->first();
        $chapters = Chapter::where(['course_id' => $request->course, 'status' => 1])->with('lesson')->get();
        if ($request->play) {
            $play_video = Lesson::where(['id' => $request->play, 'status' => 1])->first();
        } else {
            $play_video = Lesson::where(['status' => 1])->first();
        }
        return view('frontEnd.layouts.student.course_video', compact('chapters', 'play_video'));
    }

    public function settings()
    {
        $profile = Student::find(Auth::guard('student')->user()->id);
        $areas = [];
        $districts = [];
        return view('frontEnd.layouts.student.settings', compact('profile', 'districts', 'areas'));
    }
    public function profile_update(Request $request)
    {
        $update_data = Student::find(Auth::guard('student')->user()->id);
        $update_image = $request->file('image');
        if ($update_image) {
            $file = $request->file('image');
            $name = time() . '-' . $file->getClientOriginalName();
            $uploadPath = 'public/uploads/member/';
            $file->move($uploadPath, $name);
            $fileUrl = $uploadPath . $name;
        } else {
            $fileUrl = $update_data->image;
        }
        $update_data->fullName = $request->fullName ?? $update_data->fullName;
        $update_data->address = $request->address ?? $update_data->address;
        $update_data->image = $fileUrl;
        $update_data->save();
        Toastr::success('Profile info update successfully', 'Success');
        return redirect()->back();
    }
    public function payment_method(Request $request)
    {
        $update_data = MemberMethod::where('member_id', Auth::guard('student')->user()->id)->first();
        if ($update_data) {
            $update_data->bank_id = $request->bank_id ?? $update_data->bank_id;
            $update_data->branch = $request->branch ?? $update_data->branch;
            $update_data->routing = $request->routing ?? $update_data->routing;
            $update_data->account_name = $request->account_name ?? $update_data->account_name;
            $update_data->account_number = $request->account_number ?? $update_data->account_number;
            $update_data->bkash = $request->bkash ?? $update_data->bkash;
            $update_data->nagad = $request->nagad ?? $update_data->nagad;
            $update_data->rocket = $request->rocket ?? $update_data->rocket;
            $update_data->save();
        } else {
            $data_store = new MemberMethod();
            $data_store->member_id = Auth::guard('student')->user()->id;
            $data_store->bank_id = $request->bank_id;
            $data_store->branch = $request->branch;
            $data_store->routing = $request->routing;
            $data_store->account_name = $request->account_name;
            $data_store->account_number = $request->account_number;
            $data_store->bkash = $request->bkash;
            $data_store->nagad = $request->nagad;
            $data_store->rocket = $request->rocket;
            $data_store->save();
        }

        Toastr::success('Basic info update successfully', 'Success');
        return redirect()->back();
    }
    public function change_pass()
    {
        return view('frontEnd.layouts.student.change_password');
    }

    public function password_update(Request $request)
    {
        $this->validate($request, [
            'old_password' => 'required',
            'new_password' => 'required',
            'confirm_password' => 'required_with:new_password|same:new_password|'
        ]);
        $auth_user = Student::find(Auth::guard('student')->user()->id);
        $hashPass = $auth_user->password;
        if (Hash::check($request->old_password, $hashPass)) {
            $auth_user->fill([
                'password' => Hash::make($request->new_password)
            ])->save();
            Toastr::success('Password changed successfully!', 'Success');
            return redirect()->route('student.dashboard');
        } else {
            Toastr::error('Old password not match!', 'Failed');
            return redirect()->back();
        }
    }

   
    public function forgot_password()
    {
        return view('frontEnd.layouts.student.forgot_password');
    }

    public function forgot_verify(Request $request)
    {
        $auth_info = Student::select('id','phone_number')->where('phone_number', $request->phone_number)->first();
        if (!$auth_info) {
            Toastr::error('Your phone number not found', 'Failed');
            return back();
        }
        $auth_info->forgot = rand(1111, 9999);
        $auth_info->save();
        session::put('verify_phone', $request->phone_number);
        Toastr::success('Verify OTP send your phone number', 'Success');
        return redirect()->route('student.forgot.reset');
    }

    public function forgot_reset()
    {
        if (!Session::get('verify_phone')) {
            Toastr::error('Something wrong please try again', 'Failed');
            return redirect()->route('student.forgot.password');
        }
        return view('frontEnd.layouts.student.forgot_reset');
    }
    public function forgot_store(Request $request)
    {

        $auth_info = Student::select('id','phone_number','forgot','password')->where('phone_number', session::get('verify_phone'))->first();
        if ($auth_info->forgot != $request->otp) {
            Toastr::error('Failed', 'Your OTP not match');
            return redirect()->back();
        }
        $auth_info->forgot = 1;
        $auth_info->password = bcrypt($request->password);
        $auth_info->save();
        if (Auth::guard('student')->attempt(['phone' => $auth_info->phone, 'password' => $request->password])) {
            Session::forget('verify_phone');
            Toastr::success('You are login successfully', 'success!');
            return redirect()->route('student.dashboard');
        }
    }

    public function member_payment(Request $request)
    {
        $merchatnpay = MemberMethod::where(['member_id' => Auth::guard('student')->user()->id])->first();
        $paycod = Parcel::where(['member_id' => Auth::guard('student')->user()->id, 'status' => 7, 'payment_status' => 'unpaid'])->sum('cod');
        $delivery_charge = Parcel::where(['member_id' => Auth::guard('student')->user()->id, 'status' => 7, 'payment_status' => 'unpaid'])->sum('delivery_charge');
        $cod_charge = Parcel::where(['member_id' => Auth::guard('student')->user()->id, 'status' => 7, 'payment_status' => 'unpaid'])->sum('cod_charge');

        $payments = Payment::where(['user_id' => Auth::guard('student')->user()->id, 'user_type' => 'member'])->latest();
        switch ($request->filter) {
            case 'today':
                $payments = $payments->whereDate('created_at', Carbon::today());
                break;
            case 'week':
                $payments = $payments->whereBetween('created_at', [Carbon::now()->subDays(7), Carbon::now()]);
                break;
            case 'month':
                $payments = $payments->whereMonth('created_at', Carbon::now()->month);
                break;
            case 'last-month':
                $payments = $payments->whereMonth('created_at', Carbon::now()->subMonth()->month);
                break;
            case 'year':
                $payments = $payments->whereYear('created_at', Carbon::now()->year);
                break;
            case 'last-year':
                $payments = $payments->whereYear('created_at', Carbon::now()->subYear()->year);
                break;
            default:
                break;
        }
        $payments = $payments->paginate(30);

        return view('frontEnd.layouts.student.payment', compact('paycod', 'delivery_charge', 'cod_charge', 'merchatnpay', 'payments'));
    }
    public function payable_parcel()
    {
        $parcels = Parcel::where(['member_id' => Auth::guard('student')->user()->id, 'status' => 7, 'payment_status' => 'unpaid'])->select('id', 'name', 'phone', 'address', 'cod', 'delivery_charge', 'cod_charge', 'payable_amount', 'district_id', 'area_id', 'parcel_id', 'member_invoice', 'status', 'payment_status')->get();
        return view('frontEnd.layouts.student.payable', compact('parcels'));
    }
    public function payment_request(Request $request)
    {
        $parcels = Parcel::where(['member_id' => Auth::guard('student')->user()->id, 'status' => 7, 'payment_status' => 'unpaid'])->select('id', 'member_id', 'status', 'payment_status', 'cod', 'payable_amount', 'delivery_charge', 'cod_charge')->get();

        $memberpay = MemberMethod::where(['member_id' => Auth::guard('student')->user()->id])->with('bankname')->first();

        if ($parcels->sum('payable_amount') == 0) {
            Toastr::error('You have no payable amount', 'failed!');
            return redirect()->back();
        }

        if ($request->payment_method == 'bank') {
            $user_note = 'Bank Name: ' . ($memberpay->bankname ? $memberpay->bankname->name : '') . ', Account Name: ' . $memberpay->account_name . ', Account Number: ' . $memberpay->account_number . ', Routing: ' . $memberpay->routing;
        } elseif ($request->payment_method == 'bkash') {
            $user_note = 'Receive Number: ' . $memberpay->bkash;
        } elseif ($request->payment_method == 'nagad') {
            $user_note = 'Receive Number: ' . $memberpay->nagad;
        } elseif ($request->payment_method == 'rocket') {
            $user_note = 'Receive Number: ' . $memberpay->rocket;
        }

        $payment = new Payment();
        $payment->invoice_id = $this->invoiceIdGenerate();
        $payment->user_id = Auth::guard('student')->user()->id;
        $payment->user_type = 'member';
        $payment->cod = $parcels->sum('cod');
        $payment->payable_amount = $parcels->sum('payable_amount');
        $payment->delivery_charge = $parcels->sum('delivery_charge');
        $payment->cod_charge = $parcels->sum('cod_charge');
        $payment->payment_method = $request->payment_method;
        $payment->user_note = $user_note;
        $payment->status = 'process';
        $payment->save();

        foreach ($parcels as $parcel) {
            $payment_details = new PaymentDetails();
            $payment_details->payment_id = $payment->id;
            $payment_details->parcel_id = $parcel->id;
            $payment_details->cod = $parcel->cod;
            $payment_details->delivery_charge = $parcel->delivery_charge;
            $payment_details->cod_charge = $parcel->cod_charge;
            $payment_details->payable_amount = $parcel->cod - ($parcel->delivery_charge + $parcel->cod_charge);
            $payment_details->save();
            $parcel->payment_status = 'process';
            $parcel->save();
        }

        Toastr::success('Your payment request has been place successfully', 'success!');
        return redirect()->back();
    }

    public function payment_invoice($invoice_id)
    {
        $payment = Payment::where(['user_id' => Auth::guard('student')->user()->id, 'user_type' => 'member', 'invoice_id' => $invoice_id])->with('paymentdetails.parcel', 'member')->first();
        return view('frontEnd.layouts.student.invoice', compact('payment'));
    }

    public function fraud_checker(Request $request)
    {
        $total_parcel = Parcel::where('phone', $request->phone)->count();
        $total_cancel = Parcel::where(['phone' => $request->phone])->whereIn('status', ['8', '9', '10'])->count();
        return view('frontEnd.layouts.student.fraud_checker', compact('total_parcel', 'total_cancel'));
    }
    public function notice(Request $request)
    {
        $notices = Notice::latest()->get();
        
        return view('frontEnd.layouts.student.notice', compact('notices'));
    }
    public function notification(Request $request)
    {
        $notifies = Notification::latest()->where(['user_id' => Auth::guard('student')->user()->id, 'user_type' => 'member'])->paginate(30);
        return view('frontEnd.layouts.student.notification', compact('notifies'));
    }
    public function pricing(Request $request)
    {
        $areas = DB::table('thanas')->select('id', 'name', 'status')->where('status', 1)->get();
        $servicetypes = ServiceType::where('status', 1)->get();
        return view('frontEnd.layouts.student.pricing', compact('areas', 'servicetypes'));
    }

    public function consignment_search(Request $request)
    {
        $keyword = $request->keyword;
        $parcels = Parcel::select('id', 'member_id', 'name', 'phone', 'parcel_id')->where('member_id', Auth::guard('student')->user()->id);
        if ($request->keyword) {
            $parcels = $parcels->where('parcel_id', 'LIKE', '%' . $request->keyword . "%")->orWhere('phone', 'LIKE', '%' . $request->keyword . "%");
        }
        $parcels = $parcels->get();
        if (empty($request->keyword)) {
            $parcels = [];
        }
        return view('frontEnd.layouts.student.search', compact('parcels'));
    }
    public function order_save(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'phone' => 'required',
            'address' => 'required',
        ]);


    
        if (Cart::count() <= 0) {
            Toastr::error('Your shopping empty', 'Failed!');
            return redirect()->back();
        }

        $subtotal = Cart::total();
        $subtotal = str_replace(',', '', $subtotal);
        $subtotal = str_replace('.00', '', $subtotal);
        $discount = Session::get('discount');

        $shipping_area  = Setting::first();
        if($request->area == 'Inside Dinajpur'){
            $shipping_charge  = $shipping_area->inside_charge;
        }else{
            $shipping_charge  = $shipping_area->outside_charge;
        }
        
        if (Auth::guard('student')->user()) {
            $student_id = Auth::guard('student')->user()->id;
        } else {
            $exits_student = Student::where('phone_number', $request->phone)->select('phone_number', 'id')->first();
            if ($exits_student) {
                $student_id = $exits_student->id;
            } else {
                $password = rand(111111,999999);
                $store_data                 = new Student();
                $store_data->name           = $request->name;
                $store_data->phone_number   = $request->phone;
                $store_data->add_date       = Carbon::now();
                $store_data->roll_number    = $this->rollGenerate();
                $store_data->platform       = 'online';
                $store_data->verify         = 1;
                $store_data->status         = 0;
                $store_data->password       = bcrypt($password);
                $store_data->save();
                $student_id = $store_data->id;
            }
        }

        // order data save
        $order                   = new Order();
        $order->invoice_id       = rand(111111,999999);
        $order->amount           = ($subtotal + $shipping_charge) - $discount;
        $order->discount         = $discount ? $discount : 0;
        $order->student_id       = $student_id;
        $order->shipping_charge  = $shipping_charge;
        $order->order_status     = 1;
        $order->note             = $request->note;
        $order->save();
       
        // shipping data save
        $shipping              =   new Shipping();
        $shipping->order_id    =   $order->id;
        $shipping->student_id  =   $student_id;
        $shipping->name        =   $request->name;
        $shipping->phone       =   $request->phone;
        $shipping->address     =   $request->address;
        $shipping->area        =   $request->area;
        $shipping->save();

        foreach (Cart::content() as $cart) {
            $order_details                  =   new OrderDetails();
            $order_details->order_id        =   $order->id;
            $order_details->book_id         =   $cart['id'];
            $order_details->book_name       =   $cart['name'];
            $order_details->sale_price      =   $cart['price'];
            $order_details->old_price       =   $cart['options']['old_price'];
            $order_details->qty             =   $cart['quantity'];
            $order_details->save();
        }

        session()->forget('laravel_simple_cart');
        Session::forget('free_shipping');
        Session::put('purchase_event', 'true');
        Toastr::success('Thanks, Your order place successfully', 'Success!');
        return redirect()->back();
        return redirect('order-place/' . $order->id);
    }

    public function logout()
    {
        Session::flush();
        Toastr::success('You are logout successfully', 'Logout!');
        return redirect()->route('student.login');
    }

    function rollGenerate()
    {
        do {
            $roll_number = rand(111111,666666);
            $exists = Student::select('id','roll_number')->where('roll_number', $roll_number)->exists();
        } while ($exists);

        return $roll_number;
    }
    function invoiceGenerate()
    {
        do{
            $invoice_id = rand(111111,666666);
            $exists = Order::select('id','invoice_id')->where('invoice_id', $invoice_id)->exists();
        } while ($exists);

        return $invoice_id;
    }
}
