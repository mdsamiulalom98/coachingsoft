<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Department;
use App\Models\StudentSession;
use App\Models\Classroom;
use App\Models\Batch;
use App\Models\Student;
use App\Models\Attendance;
use Carbon\Carbon;
use Toastr;
class AttendanceController extends Controller
{


    public function create(Request $request){
        $departments = Department::where('status',1)->get();
        $sessions = StudentSession::where('status',1)->get();
        $classrooms = [];
        $batches   = [];

        $date = $request->date ?? Carbon::today()->toDateString();
        $data = [];
        if($request->department_id){
            if($request->department_id) {
                $data = Student::orderBy('id','asc')->select('id','department_id','class_id','session_id','batch_id','name','roll_number');
                $data = $data->where('department_id', $request->department_id);
               $classrooms = Classroom::where('department_id',$request->department_id)->get();
            }
            if ($request->class_id) {
                $data = $data->where('class_id', $request->class_id);
            }
            if ($request->session_id) {
                $data = $data->where('session_id', $request->session_id);
                $batches = Batch::where('session_id',$request->session_id)->get(); 
            }

            if ($request->batch_id) {
                $data = $data->where('batch_id', $request->batch_id);
            }
            $data = $data->get();
        }

        $attendances = Attendance::whereDate('created_at', $date)->pluck('status', 'student_id');
        return view('backEnd.attendance.create',compact('data','departments','sessions','classrooms','batches','attendances'));
    }
    public function store(Request $request){
        $findtoday = Attendance::whereDate('created_at',Carbon::today())->where('student_id',$request->student_id)->get();
        $date = date('Y-m-d');
        if($findtoday->count() < 1){
            $attendance             = new Attendance();
            $attendance->student_id = $request->student_id;
            $attendance->date       = $date;
            $attendance->status     = $request->status;
            $attendance->save();
        }else{
            $attendance         =  Attendance::whereDate('date', $date)->where('student_id',$request->student_id)->first();
            $attendance->status = $request->status;
            $attendance->save();
        }
        return response()->json(['attendance'=>$attendance]);
        notify()->success('Student Attendance Successfully!');      
    }
    public function index(Request $request)
    {
        $departments = Department::where('status',1)->get();
        $sessions = StudentSession::where('status',1)->get();
        $classrooms = [];
        $batches   = [];
        $batchstudents   = [];

        $data = [];

        if ($request->department_id) {

            if ($request->department_id) {
                $students = Student::orderBy('id', 'asc')
                    ->with(['batch', 'attendances'])
                    ->select('id','department_id','class_id','session_id','batch_id','name','roll_number')
                    ->where('department_id', $request->department_id);

                $classrooms = Classroom::where('department_id', $request->department_id)->get();
            }

            if ($request->class_id) {
                $students = $students->where('class_id', $request->class_id);
            }

            if ($request->session_id) {
                $students = $students->where('session_id', $request->session_id);
                $batches = Batch::where('session_id', $request->session_id)->get(); 
            }

            if ($request->batch_id) {
                $students = $students->where('batch_id', $request->batch_id);
                $batchstudents = $students->get();
            }

            if ($request->student_id) {
                $students = $students->where('id', $request->student_id);
            }
            

            $students = $students->get();

            $data = $students->map(function($student) {
                $batch_id = $student->batch_id;

                $lastClassDates = Attendance::whereHas('student', function ($query) use ($batch_id) {
                        $query->where('batch_id', $batch_id);
                    })
                    ->orderBy('date', 'desc')
                    ->distinct('date')
                    ->pluck('date')
                    ->take(7)
                    ->sort()
                    ->values();

                // For this student, get their attendance on those dates
                $attendanceData = [];

                foreach ($lastClassDates as $date) {
                    $attendance = $student->attendances->firstWhere('date', $date);
                    $attendanceData[$date] = $attendance?->status ?? '-';
                }

                $student->last_7_days = $attendanceData;
                return $student;
            });
        }
        return view('backEnd.attendance.index',compact('data','departments','sessions','classrooms','batches','batchstudents'));
    }
}
