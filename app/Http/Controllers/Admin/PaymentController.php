<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Department;
use App\Models\StudentSession;
use App\Models\Classroom;
use App\Models\Batch;
use App\Models\Student;
use App\Models\Payment;
use Carbon\Carbon;
use Session;
use Toastr;
class PaymentController extends Controller
{
    public function create(Request $request){
        $departments = Department::where('status',1)->get();
        $sessions = StudentSession::where('status',1)->get();
        $classrooms = [];
        $batches   = [];
        $batchstudents   = [];
        $find_batch   = null;

        $data = [];

        if ($request->department_id) {

            if ($request->department_id) {
                $data = Student::orderBy('id', 'asc')
                    ->with(['batch', 'attendances'])
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
                $batchdata = $data->get();
                $find_batch = Batch::where('id', $request->batch_id)->select('id', 'payment_type', 'course_fee')->first();
            }

            if ($request->student_id) {
                $data = $data->where('id', $request->student_id);
            }
        
            $data = $data->get();

           
        }

        Session::forget('payids');
        $months = [];
        $currentDate = Carbon::now();
        for ($i = 0; $i < 4; $i++) {
            $months[] = [
                'month' => $currentDate->format('M').' '.$currentDate->format('Y')
            ];
            $currentDate->subMonth();
        }
        $months = array_reverse($months);
        return view('backEnd.payment.create',compact('data','departments','sessions','classrooms','batches','batchstudents','months','find_batch'));
    }
    public function store(Request $request){

        $student_ids = $request->student_id;
        $paid_by = $request->paid_by;
        $payids = [];

        foreach ($student_ids as $key => $student_id) {
            $student = Student::find($student_id);
            $batch = Batch::find($student->batch_id);

            if ($batch->payment_type == 2) {
                if (!empty($request->amount[$key])) {
                    $payment = new Payment();
                    $payment->date = date('Y-m-d');
                    $payment->student_id = $student_id;
                    $payment->amount = $request->amount[$key];
                    $payment->month = $request->month[$key];
                    $payment->paid_by = $paid_by;
                    $payment->status = 1;
                    $payment->save();

                    $payids[] = $payment->id;

                    $student->course_fee += $payment->amount;
                    $student->save();
                }
            } else {
                for ($i = 1; $i <= 12; $i++) {
                    $amountField = "amount{$i}";
                    $monthField = "month{$i}";
                    $inputField = "is_input{$i}";

                    if (isset($request->$amountField[$key], $request->$inputField[$key], $request->$monthField[$key])) {
                        if (!empty($request->$amountField[$key]) && $request->$inputField[$key] == 1) {

                            $payment = new Payment();
                            $payment->date = date('Y-m-d');
                            $payment->student_id = $student_id;
                            $payment->amount = $request->$amountField[$key];
                            $payment->month = $request->$monthField[$key];
                            $payment->paid_by = $paid_by;
                            $payment->status = 1;
                            $payment->save();

                            $payids[] = $payment->id;
                        }
                    }
                }
            }
        }

        session::put('payids',$payids);
        return redirect()->route('payments.invoice'); 
    }
    public function index(Request $request)
    {
        $departments = Department::where('status',1)->get();
        $sessions = StudentSession::where('status',1)->get();
        $classrooms = [];
        $batches   = [];
        $batchstudents   = [];
        $find_batch   = null;

        $data = [];

        if ($request->department_id) {

            if ($request->department_id) {
                $data = Student::orderBy('id', 'asc')
                    ->with(['batch', 'attendances'])
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
                $batchdata = $data->get();
                $find_batch = Batch::where('id', $request->batch_id)->select('id', 'payment_type', 'course_fee')->first();
            }

            if ($request->student_id) {
                $data = $data->where('id', $request->student_id);
            }
        
            $data = $data->get();

           
        }

        Session::forget('payids');
        $months = [];
        $year = Carbon::now()->year;
        for ($i = 1; $i <= 12; $i++) {
            $date = Carbon::create($year, $i, 1);
            $months[] = [
                'month' => $date->format('M')
            ];
        }
        return view('backEnd.payment.index',compact('data','departments','sessions','classrooms','batches','batchstudents','months','find_batch'));
    }
    public function invoice(Request $request)
    {
        $payids = session::get('payids');
        return view('backEnd.payment.invoice',compact('payids'));
    }
}
