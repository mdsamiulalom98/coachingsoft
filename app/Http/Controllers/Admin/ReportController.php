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
use App\Models\Result;
use App\Models\Exam;
use Carbon\Carbon;
class ReportController extends Controller
{
   public function attendance(Request $request)
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
        
            $month = $request->month ?? date('m');
            $year = $request->year ?? date('Y'); 

            $monthStart = Carbon::create($year, $month, 1)->startOfMonth();
            $monthEnd = Carbon::create($year, $month, 1)->endOfMonth();

            $classDates = Attendance::whereBetween('date', [$monthStart, $monthEnd])
                ->whereHas('student', function($q) use ($request) {
                    if ($request->batch_id) {
                        $q->where('batch_id', $request->batch_id);
                    }
                })
                ->orderBy('date')
                ->pluck('date')
                ->unique()
                ->values();

            $data = $students->map(function($student) use ($classDates) {
                $attendanceData = [];

                foreach ($classDates as $date) {
                    $attendance = $student->attendances->firstWhere('date', $date);
                    $attendanceData[$date] = $attendance?->status ?? 'A'; 
                }

                $student->monthly_attendance = $attendanceData;
                return $student;
            });
        }
        return view('backEnd.reports.attendance',compact('data','departments','sessions','classrooms','batches','batchstudents'));
    }
    
    public function payment(Request $request)
    {
        $departments = Department::where('status',1)->get();
        $sessions = StudentSession::where('status',1)->get();
        $classrooms = [];
        $batches   = [];
        $students   = [];
        $find_batch   = null;

        $data = [];

        if ($request->department_id) {

            if ($request->department_id) {
                $data = Student::orderBy('id', 'asc')
                    ->with(['batch'])
                    ->select('id','department_id','class_id','session_id','batch_id','name','roll_number')
                    ->where('department_id', $request->department_id);

                $classrooms = Classroom::where('department_id', $request->department_id)->get();
            }

            if ($request->class_id) {
                $data = $data->where('class_id', $request->class_id);
            }

            if ($request->session_id) {
                $data = $data->where('session_id', $request->session_id);
                $batches = Batch::where('session_id', $request->session_id)->get();
            }

            if ($request->batch_id) {
                $data = $data->where('batch_id', $request->batch_id);
                $find_batch = Batch::where('id', $request->batch_id)->select('id', 'payment_type', 'course_fee')->first();
                $students = Student::where('batch_id', $request->batch_id)->select('id','roll_number', 'name')->get();
            }
            if($request->status == 'due'){
                $paidstudent = Payment::where('month', $request->month)->pluck('student_id')->toArray();
                $data = $data->whereNotIn('id',$paidstudent);
            }

            if($request->status == 'paid'){
                $paidstudent = Payment::where('month', $request->month)->pluck('student_id')->toArray();
                $data = $data->whereIn('id',$paidstudent);
            }

            if ($request->student_id) {
                $data = $data->where('id', $request->student_id);
            }
        
            $data = $data->get();

           
        }

        $months = [];
        $year = Carbon::now()->year;
        for ($i = 1; $i <= 12; $i++) {
            $date = Carbon::create($year, $i, 1);
            $months[] = [
                'month' => $date->format('M Y')
            ];
        }

        return view('backEnd.reports.payment',compact('data','departments','sessions','classrooms','batches','students','months','find_batch'));
    }
    // result
    public function result(Request $request){

        $departments = Department::where('status', 1)->get();
        $sessions = StudentSession::where('status', 1)->get();
        $classrooms = [];
        $batches = [];
        $students = [];
        $batch_students = [];
        $exams = [];
        $data = [];

            if ($request->department_id) {

                if ($request->department_id) {
                    $students = Student::orderBy('id', 'asc')
                        ->with(['batch', 'attendances'])
                        ->select('id','department_id','class_id','session_id','batch_id','name','roll_number','phone_number')
                        ->where('department_id', $request->department_id);
                    $classrooms = Classroom::where('department_id', $request->department_id)->get();
                }

                if ($request->class_id) {
                    $students = $students->where('class_id', $request->class_id);
                }

                if ($request->session_id) {
                    $students = $students->where('session_id', $request->session_id);
                    $batches = Batch::where('session_id', $request->session_id)->get();
                    $exams = Exam::where('session_id', $request->session_id)->get();
                }

                if ($request->batch_id) {
                    $students = $students->where('batch_id', $request->batch_id);
                    $exams = Exam::where('batch_id', $request->batch_id)->get();
                }

                if ($request->student_id) {
                    $students = $students->where('id', $request->student_id);
                }
            
                $students = $students->get();

               
            
 
            $resultDates = Result::where('batch_id', $request->batch_id)
                ->orderBy('result_date')
                ->pluck('result_date')
                ->unique()
                ->values();

            $data = $students->map(function ($student) use ($resultDates) {
                $resultsByDate = [];

                foreach ($resultDates as $date) {
                    $result = $student->results->firstWhere('result_date', $date);
                    $resultsByDate[$date] = $result ? $result : 'A';
                }

                $student->monthly_result = $resultsByDate;
                return $student;
            });
        }
        
        return view('backEnd.reports.result', compact('data', 'departments','sessions','classrooms','batches','students','exams'));
    }

}
