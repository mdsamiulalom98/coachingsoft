<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AboutUs;
use App\Models\Banner;
use App\Models\Course;
use App\Models\Category;
use App\Models\SuccessStudent;
use App\Models\SuccessYear;
use App\Models\Student;
use App\Models\CourseOrder;
use App\Models\Book;
use App\Models\Notice;
use App\Models\TestExam;
use App\Models\SitePdf;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\Shipping;
use Toastr;
use Cart;
use Auth;
class FrontEndController extends Controller
{
    public function index(){
        $sliders = Banner::where('status',1)->get();
        $about = AboutUs::first();
        $courses = Course::where('status',1)->orderByDesc('id')->limit(12)->get();
        $categories = Category::where('status',1)->get();
        $success_years = SuccessYear::get();
        $students = SuccessStudent::where('status',1)->get();
        return view('frontEnd.index',compact('sliders','about','courses','categories','success_years','students'));
    }
    public function courses(){
        $courses = Course::where('status',1)->orderByDesc('id')->get();
        return view('frontEnd.layouts.pages.courses',compact('courses'));
    }
    public function course_details(Request $request){
        $details = Course::where(['status'=>1,'id'=>$request->id])->first();
        // return $details;
        return view('frontEnd.layouts.pages.course_details',compact('details'));
    }

    public function books(){
        $books = Book::where('status',1)->orderByDesc('id')->get();
        return view('frontEnd.layouts.pages.books',compact('books'));
    }
    public function book_details(Request $request){
        $details = Book::where(['status'=>1,'id'=>$request->id])->with('category:id,name','mentor:id,name,designation,image')->first();
        return view('frontEnd.layouts.pages.books_details',compact('details'));
    }

    public function checkout(Request $request){
        $carts = Cart::content();
        return view('frontEnd.layouts.pages.checkout',compact('carts'));
    }
    
    public function course_order(Request $request)
    {
        $this->validate($request,[
            'name'=>'required',
            'address'=>'required',
            'phone'=>'required',
        ]);
        
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

        $course = Course::select('id','course_fee')->where('id', $request->course_id)->first();
        $course_order                =   new CourseOrder();
        $course_order->invoice_id    =   $this->invoiceGenerate();
        $course_order->student_id    =   $student_id;
        $course_order->course_id     =   $request->course_id;
        $course_order->amount        =   $course->course_fee;
        $course_order->name          =   $request->name;
        $course_order->phone         =   $request->phone;
        $course_order->address       =   $request->address;
        $course_order->method        =   'bkash';
        $course_order->sender_number =   $request->sender_number;
        $course_order->trx_id        =   $request->trx_id;
        $course_order->status        =   'pending';
        $course_order->save();

        Toastr::success('Thanks, Your order place successfully', 'Success!');
        Auth::guard('merchant')->loginUsingId($student_id);
        return redirect()->route('student.dashboard');
        
    }
    public function notice(){
        $notice = Notice::where('status', 1)->orderByDesc('id')->get();
        return view('frontEnd.layouts.pages.notice', compact('notice'));
    }

    public function notice_details($id)
    {
        $show_data = Notice::where(['status'=>1, 'id'=>$id])->first();
        return view('frontEnd.layouts.pages.noticedetails', compact('show_data'));
    }

    public function pdf(){
        $pdf = SitePdf::where('status', 1)->orderByDesc('id')->get();
        return view('frontEnd.layouts.pages.pdf', compact('pdf'));
    }

    public function pdf_details($id)
    {
        $show_data = SitePdf::where(['status'=>1, 'id'=>$id])->first();
        return view('frontEnd.layouts.pages.sitepdfdetails', compact('show_data'));
    }

    public function exam(){
        $exam = TestExam::where('status', 1)->orderByDesc('id')->get();
        return view('frontEnd.layouts.pages.exam', compact('exam'));
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
