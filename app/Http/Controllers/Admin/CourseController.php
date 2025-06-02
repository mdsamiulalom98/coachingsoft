<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use Brian2694\Toastr\Facades\Toastr;
use Intervention\Image\Encoders\WebpEncoder;
use App\Models\CourseOrder;
use App\Models\Mentor;
use Image;
use File;
class CourseController extends Controller
{
    function __construct()
    {
         // $this->middleware('permission:course-list|course-create|course-edit|course-delete', ['only' => ['index','store']]);
         // $this->middleware('permission:course-create', ['only' => ['create','store']]);
         // $this->middleware('permission:course-edit', ['only' => ['edit','update']]);
         // $this->middleware('permission:course-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
       $data = Course::orderBy('id','DESC');
        if($request->ajax()){
            return datatables()->of($data)
            ->addColumn('action', function($row) {
                if ($row->status == 1) {
                    $statusBtn = '<form method="POST" action="'.route('courses.inactive').'" class="status_form" style="display:inline;">
                                      '.csrf_field().'
                                      <input type="hidden" name="id" value="'.$row->id.'">
                                      <button type="button" class="thumb_down"><i class="ti ti-thumb-down"></i></button>
                                   </form>';
                } else {
                    $statusBtn = '<form method="POST" action="'.route('courses.active').'" class="status_form" style="display:inline;">
                                      '.csrf_field().'
                                      <input type="hidden" name="id" value="'.$row->id.'">
                                      <button type="button" class="thumb_up"><i class="ti ti-thumb-up"></i></button>
                                   </form>';
                }
                $editBtn = '<a class="edit_btn" href="' . route('courses.edit', $row->id) . '">
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
         return view('backEnd.course.index');
    }
    public function create()
    {
        $mentors = Mentor::where('status',1)->get();
        return view('backEnd.course.create',compact('mentors'));
    }
    public function store(Request $request)
    {
        // return $request->all();
        $this->validate($request, [
            'title' => 'required',
            'course_fee' => 'required',
            'total_class' => 'required',
            'category' => 'required',
            'course_type' => 'required',
            'description' => 'required',
            'image' => 'required',
        ]);

        $file = $request->file('image');
        if($file){
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $image = Image::read($file);
            $uploadpath = 'public/uploads/course/';
            $imageUrl = $uploadpath.$filename; 
            $image->encode(new WebpEncoder(quality: 80))
            ->save($imageUrl);
        }else{
            $imageUrl = NULL;
        }
        $input = $request->all();
        $input['status'] = $request->status ?? 1;
        $input['image'] = $imageUrl;
        Course::create($input);
        Toastr::success('Success','Data insert successfully');
        return redirect()->route('courses.index');
    }

    public function edit($id)
    {
        $edit_data = Course::find($id);
        $mentors = Mentor::where('status',1)->get();
        return view('backEnd.course.edit',compact('edit_data','mentors'));
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'course_fee' => 'required',
            'total_class' => 'required',
            'category' => 'required',
            'course_type' => 'required',
            'description' => 'required',
        ]);

        $update_data = Course::find($request->id);
        $input = $request->all();
        $file = $request->file('image');
        if($file){
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $image = Image::read($file);
            $uploadpath = 'public/uploads/course/';
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
        return redirect()->route('courses.index');
    }

    public function inactive(Request $request)
    {
        $inactive = Course::find($request->id);
        $inactive->status = 0;
        $inactive->save();
        Toastr::success('Success','Data inactive successfully');
        return redirect()->back();
    }
    public function active(Request $request)
    {
        $active = Course::find($request->id);
        $active->status = 1;
        $active->save();
        Toastr::success('Success','Data active successfully');
        return redirect()->back();
    }
    public function destroy(Request $request)
    {
        $delete_data = Course::find($request->id);
        $delete_data->delete();
        Toastr::success('Success','Data delete successfully');
        return redirect()->back();
    }
    
    public function enroll_payment(Request $request)
    {
        if ($request->slug == 'all') {
            $order_status = (object) [
                'name' => 'All',
                'orders_count' => CourseOrder::count(),
            ];
            $payments = CourseOrder::orderBy('id','desc')->with('course:id,title')->paginate(50);
        } else {
            $order_status = (object) [
                'name' => ucfirst($request->slug),
                'orders_count' => CourseOrder::where('status', $request->slug)->count(),
            ];
            $payments = CourseOrder::where(['status' => $request->slug])->orderBy('id','desc')->with('course:id,title')->paginate(50);
        }
        return view('backEnd.payment.enroll_payment', compact('payments', 'order_status'));
    }
    
    public function enroll_details($id){
        $payment = CourseOrder::where('id',$id)->orderBy('id','desc')->with('student:id,bn_name,phone_number,roll_number,image')->with('course:id,title')->first();
        return view('backEnd.payment.enroll_details', compact('payment'));
    }
    public function payment_update(Request $request)
    {
        $payment_update = CourseOrder::find($request->id);
        $payment_update->status = $request->status;
        $payment_update->save();
        Toastr::success('Success','Payment status successfully');
        return redirect()->back();
    }
}
