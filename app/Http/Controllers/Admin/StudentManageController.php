<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Intervention\Image\Encoders\WebpEncoder;
use Illuminate\Http\Request;
use App\Models\Department;
use App\Models\StudentSession;
use App\Models\Classroom;
use App\Models\Batch;
use App\Models\Student;
use App\Models\AcademicInformation;
use App\Models\Attendance;
use App\Models\Payment;
use App\Models\Exam;
use Toastr;
use Image;
class StudentManageController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:student-list|student-create|student-edit|student-delete', ['only' => ['index','store']]);
         $this->middleware('permission:student-create', ['only' => ['create','store']]);
         $this->middleware('permission:student-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:student-delete', ['only' => ['destroy']]);
    }
    
    public function index(Request $request)
    {
      
        $departments = Department::where('status',1)->get();
        $sessions = StudentSession::where('status',1)->get();
        $classrooms = [];
        $batches   = [];

        $data = [];
        
        if($request->department_id){
           $data = Student::orderBy('id','DESC');
           $classrooms = Classroom::where('department_id',$request->department_id)->get();
        }
        if($request->session_id){
           $batches = Batch::where('session_id',$request->session_id)->get(); 
        }

        if($request->ajax()){
             if ($request->department_id) {
               $data = $data->where('department_id', $request->department_id);
            }

            if ($request->class_id) {
                $data = $data->where('class_id', $request->class_id);
            }

            if ($request->session_id) {
                $data = $data->where('session_id', $request->session_id);
            }

            if ($request->batch_id) {
                $data = $data->where('batch_id', $request->batch_id);
            }

            return datatables()->of($data)
            ->addColumn('action', function($row) {
                if ($row->status == 1) {
                    $statusBtn = '<form method="POST" action="'.route('students.inactive').'" class="status_form" style="display:inline;">
                                      '.csrf_field().'
                                      <input type="hidden" name="id" value="'.$row->id.'">
                                      <button type="button" class="thumb_down"><i class="ti ti-thumb-down"></i></button>
                                   </form>';
                } else {
                    $statusBtn = '<form method="POST" action="'.route('students.active').'" class="status_form" style="display:inline;">
                                      '.csrf_field().'
                                      <input type="hidden" name="id" value="'.$row->id.'">
                                      <button type="button" class="thumb_up"><i class="ti ti-thumb-up"></i></button>
                                   </form>';
                }
                $editBtn = '<a class="edit_btn" href="' . route('students.edit', $row->id) . '">
                               <i class="ti ti-pencil"></i>
                            </a>';

                 $profileBtn = '<a class="profile_btn" href="' . route('students.profile', $row->id) . '">
                        <i class="ti ti-eye"></i>
                    </a>';
                    return $statusBtn . ' ' . $editBtn . ' ' . $profileBtn;
            })
            ->addColumn('department_name', function ($row) {
                return $row->department ? $row->department->name : 'N/A';
            })
            ->addColumn('session_name', function ($row) {
                return $row->session ? $row->session->name : 'N/A';
            })
            ->addColumn('batch_name', function ($row) {
                return $row->batch ? $row->batch->name : 'N/A';
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
        return view('backEnd.student.index',compact('departments','sessions','classrooms','batches'));
    }
    
    public function create(){
        $departments = Department::where('status',1)->get();
        $sessions = StudentSession::where('status',1)->get();
        return view('backEnd.student.create',compact('departments','sessions'));
    }
    
    public function store(Request $request)
    {
  
        $this->validate($request, [
            'department_id' => 'required',
            'class_id' => 'required',
            'session_id' => 'required',
            'batch_id' => 'required',
            'add_date' => 'required',
            'password' => 'required|min:6',
            'name' => 'required|string',
            'roll_number' => 'required|string|unique:students,roll_number',
            'phone_number' => 'required',
            'dob' => 'required',
            'present_address' => 'required',
            'permanent_address' => 'required',
            'father_name' => 'required',
            'father_phone' => 'required',
            'mother_name' => 'required',
        ]);


        $file = $request->file('image');
        if($file){
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $image = Image::read($file);
            $uploadpath = 'public/uploads/student/';
            $imageUrl = $uploadpath.$filename; 
            $image->resize(300, 300, function ($constraint) {
                $constraint->aspectRatio();
            })->encode(new WebpEncoder(quality: 80))
            ->save($imageUrl);
        }else{
            $imageUrl = NULL;
        }

        $student                    = new Student();
        $student->department_id     = $request->department_id;
        $student->class_id          = $request->class_id;
        $student->session_id        = $request->session_id;
        $student->batch_id          = $request->batch_id;
        $student->add_date          = $request->add_date;
        $student->password          = bcrypt($request->password);
        $student->name              = $request->name;
        $student->bn_name           = $request->bn_name;
        $student->nick_name         = $request->nick_name;
        $student->bn_nick_name      = $request->bn_nick_name;
        $student->roll_number       = $request->roll_number;
        $student->phone_number      = $request->phone_number;
        $student->dob               = $request->dob;
        $student->present_address   = $request->present_address;
        $student->permanent_address = $request->permanent_address;
        $student->father_name       = $request->father_name;
        $student->father_phone      = $request->father_phone;
        $student->father_profession = $request->father_profession;
        $student->mother_name       = $request->mother_name;
        $student->mother_phone      = $request->mother_phone;
        $student->mother_profession = $request->mother_profession;
        $student->local_guardian    = $request->local_guardian;
        $student->lg_relation       = $request->lg_relation;
        $student->image             = $imageUrl;
        $student->verify            = 1;
        $student->status            = 1;
        $student->save();

        // if ($request->has('education')) {
        //     foreach ($request->education as $edu) {
        //         if (!empty($edu['institute'])) {
        //             $academic = new AcademicInformation();
        //             $academic->student_id = $student->id;
        //             $academic->institute = $edu['institute'];
        //             $academic->board = $edu['board'];
        //             $academic->year = $edu['year'];
        //             $academic->roll = $edu['roll']?? null;
        //             $academic->reg = $edu['reg']?? null;
        //             $academic->gpa = $edu['gpa']?? null;
        //             $academic->save();
        //         }
        //     }
        // }

        Toastr::success('Success','Data update successfully');
        return redirect()->route('students.index')->with('success', 'Student created successfully.');
    }
    
    public function edit($id)
    {
        $edit_data = Student::find($id);
        $departments = Department::where('status',1)->get();
        $sessions = StudentSession::where('status',1)->get();
        $classrooms = Classroom::where(['status'=>1,'department_id'=>$edit_data->department_id])->get();
        $batches = Batch::where(["department_id"=>$edit_data->department_id,'class_id'=>$edit_data->class_id,'session_id'=>$edit_data->session_id])->get();
        $educations = AcademicInformation::where(['student_id'=>$edit_data->id])->get();
        return view('backEnd.student.edit',compact('edit_data','departments','sessions','classrooms','batches','educations'));
    }
    
    public function update(Request $request){

        $this->validate($request, [
            'department_id' => 'required',
            'class_id' => 'required',
            'session_id' => 'required',
            'batch_id' => 'required',
            'add_date' => 'required',
            'name' => 'required',
            'roll_number' => 'required',
            'phone_number' => 'required',
            'dob' => 'required',
            'present_address' => 'required',
            'permanent_address' => 'required',
            'father_name' => 'required',
            'father_phone' => 'required',
            'mother_name' => 'required',
        ]);

        $update_data = Student::find($request->id);

        $file = $request->file('image');
        if($file){
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $image = Image::read($file);
            $uploadpath = 'public/uploads/student/';
            $imageUrl = $uploadpath.$filename; 
            $image->resize(300, 300, function ($constraint) {
                $constraint->aspectRatio();
            })->encode(new WebpEncoder(quality: 80))
            ->save($imageUrl);
        }else{
            $imageUrl = $update_data->image;
        }

        
        $update_data->department_id     = $request->department_id;
        $update_data->class_id          = $request->class_id;
        $update_data->session_id        = $request->session_id;
        $update_data->batch_id          = $request->batch_id;
        $update_data->add_date          = $request->add_date;
        $update_data->password          = bcrypt($request->password);
        $update_data->name              = $request->name;
        $update_data->bn_name           = $request->bn_name;
        $update_data->nick_name         = $request->nick_name;
        $update_data->bn_nick_name      = $request->bn_nick_name;
        $update_data->roll_number       = $request->roll_number;
        $update_data->phone_number      = $request->phone_number;
        $update_data->dob               = $request->dob;
        $update_data->present_address   = $request->present_address;
        $update_data->permanent_address = $request->permanent_address;
        $update_data->father_name       = $request->father_name;
        $update_data->father_phone      = $request->father_phone;
        $update_data->father_profession = $request->father_profession;
        $update_data->mother_name       = $request->mother_name;
        $update_data->mother_phone      = $request->mother_phone;
        $update_data->mother_profession = $request->mother_profession;
        $update_data->local_guardian    = $request->local_guardian;
        $update_data->lg_relation       = $request->lg_relation;
        $update_data->image             = $imageUrl;
        $update_data->verify            = 1;
        $update_data->status            = 1;
        $update_data->save();

        if ($request->has('education')) {
            foreach ($request->education as $edu) {
                if (!empty($edu['institute'])) {

                    $academic = !empty($edu['id']) 
                        ? AcademicInformation::find($edu['id']) 
                        : new AcademicInformation();
                    if (!empty($edu['id']) && !$academic) {
                        continue;
                    }
                    $academic->student_id = $update_data->id;
                    $academic->institute = $edu['institute'];
                    $academic->board = $edu['board'] ?? null;
                    $academic->year = $edu['year'] ?? null;
                    $academic->roll = $edu['roll'] ?? null;
                    $academic->reg = $edu['reg'] ?? null;
                    $academic->gpa = $edu['gpa'] ?? null;
                    $academic->save();
                }
            }
        }

        Toastr::success('Success','Data update successfully');
        return redirect()->route('students.index');
    }
    public function inactive(Request $request)
    {
        $inactive = Student::find($request->id);
        $inactive->status = 0;
        $inactive->save();
        Toastr::success('Success','Data inactive successfully');
        return redirect()->back();
    }
    public function active(Request $request)
    {
        $active = Student::find($request->id);
        $active->status = 1;
        $active->save();
        Toastr::success('Success','Data active successfully');
        return redirect()->back();
    }

    public function ajax_batch(Request $request)
    {
        $response = Batch::where(["department_id"=>$request->department_id,'class_id'=>$request->class_id,'session_id'=>$request->session_id])
            ->pluck('name', 'id');
        return response()->json($response);
    }
    
    public function ajax_student(Request $request)
    {
        $response = Student::where(["batch_id"=>$request->batch_id])
            ->pluck('name', 'id');
        return response()->json($response);
    }
    public function ajax_exam(Request $request)
    {
        $response = Exam::where(["department_id"=>$request->department_id,'class_id'=>$request->class_id,'session_id'=>$request->session_id]);
            
        if($request->batch_id){
            $response->where('batch_id',$request->batch_id);
        }
        $response = $response->pluck('title', 'id');
        return response()->json($response);
    }
    public function profile($id)
    {
        $details = Student::where('id', $id)->first();
        $paymentlist = Payment::where('student_id', $details->id)->get();
        $attendance = Attendance::where('student_id', $details->id)->get();
        return view('backEnd.student.profile', compact('details', 'paymentlist', 'attendance'));
    }
}
