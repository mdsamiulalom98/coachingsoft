@extends('backEnd.layouts.master')
@section('title','Payment Create')
@section('content')
<section class="wsit-container">
    <div class="wsit-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center justify-content-between">
                    <div class="col-auto">
                        <div class="page-header-title">
                        <h4 class="m-b-10">Payment</h4>
                        </div>
                           <ul class="breadcrumb">
                              <li class="breadcrumb-item">
                                <a href="{{route('dashboard')}}">Dashboard</a>
                              </li>
                              <li class="breadcrumb-item active">
                                Payment Create
                              </li>
                           </ul>
                    </div>
                    <div class="col-auto">
                        <div class="quick_btn">
                            <a href="{{route('students.create')}}"><i class="ti ti-plus"></i> Payment Create</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="page-content">

            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h6>Payment Create</h6>
                        </div>
                        <div class="card-body">
                            <form class="row ">
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <select class="form-control select2" name="department_id" id="department_id" required>
                                            <option value="">Select Department *</option>
                                            @foreach ($departments as $key=>$value)
                                             <option value="{{ $value->id }}" {{request('department_id') == $value->id ? 'selected' : ''}}>{{ $value->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('department_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <!-- col end -->
                                <div class="col-sm-2">
                                    <div class="form-group ">
                                        <select class="form-control select2" name="class_id" id="class_id" required>
                                            <option value="">Select Class *</option>
                                            @foreach($classrooms as $key=>$value)
                                            <option value="{{$value->id}}" {{request('class_id') == $value->id ? 'selected' : ''}}>{{$value->name}}</option>
                                            @endforeach
                                        </select>
                                        @error('class_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <!-- col end -->
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <select class="form-control select2" name="session_id" id="session_id" required>
                                            <option value="">Select Session *</option>
                                            @foreach($sessions as $key=>$value)
                                            <option value="{{$value->id}}" {{request('session_id') == $value->id ? 'selected' : ''}}>{{$value->name}}</option>
                                            @endforeach
                                        </select>
                                        @error('session_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <!-- col end -->
                                <div class="col-sm-2">
                                    <div class="form-group ">
                                        <select class="form-control select2" name="batch_id" id="batch_id" required>
                                            <option value="">Select Batch *</option>
                                            @foreach($batches as $key=>$value)
                                            <option value="{{$value->id}}" {{request('batch_id') == $value->id ? 'selected' : ''}}>{{$value->name}}</option>
                                            @endforeach
                                        </select>
                                        @error('batch_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <!-- col end -->
                                <div class="col-sm-2">
                                    <div class="form-group ">
                                        <select class="form-control select2" name="student_id" id="student_id">
                                            <option value="">Select Student..</option>
                                            @foreach($batchstudents as $key=>$value)
                                            <option value="{{$value->id}}" {{request('student_id') == $value->id ? 'selected' : ''}}>{{$value->name}}</option>
                                            @endforeach
                                        </select>
                                        @error('student_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <!-- col end -->
                                <div class="col-sm-2">
                                    <div class="form-group ">
                                       <button class="btn btn-success" id="filter">Search</button>
                                    </div>
                                </div>
                                <!-- col end -->
                            </form>
                            <div class="payment-form mt-3">
                                <form action="{{route('payments.store')}}" method="POST">
                                      @csrf

                                     <input type="hidden" name="student_id[]" value="{{$value->id}}">
                                     <input type="hidden" name="batch_id" value="{{$value->batch_id}}">
                                    <table id="example" class="table table-bordered table-responsive-sm sm-form">
                                      <thead>
                                      <tr>
                                        <th>Name</th>
                                        <th>Roll</th>
                                        @if(!is_null($find_batch) && $find_batch->payment_type == 2)
                                        <th>Course Fee</th>
                                        <th>Paid</th>
                                        <th>Due</th>
                                        <th>Amount</th>
                                        @else
                                        @foreach($months as $key=>$month)
                                        <th>{{$month['month'] }}</th>
                                        @endforeach
                                        @endif
                                      </tr>
                                      </thead>
                                      <tbody>
                                      @foreach($data as $key => $value)
                                       
                                        <tr>
                                          <td>{{$value->name}}</td>
                                          <td>{{$value->roll_number}}</td>
                                             <input type="hidden" name="student_id[]" value="{{$value->id}}">
                                             @if($find_batch->payment_type ==2)
                                             <input type="hidden" name="month[]" value="{{date('M Y')}}">
                                             <td>
                                               <input type="text" disabled value="{{$find_batch->course_fee}}">
                                             </td>
                                             <td>
                                               <input type="text" class="text-success" disabled value="{{$value->course_fee}}">
                                             </td>
                                             <td>
                                               <input type="text" class="text-danger" disabled value="{{$find_batch->course_fee-$value->course_fee}}">
                                             </td>
                                             <td>
                                              <input type="text"  value="" name="amount[]">
                                             </td>
                                             @else
                                            @foreach($months as $key=>$month)
                                            @php
                                              $find_pay = App\Models\Payment::where(['student_id'=>$value->id,'month'=>$month['month']])->select('id','student_id','month','amount')->first();
                                            @endphp
                                            <td>
                                               <input type="hidden" name="month{{$key+1}}[]" value="{{$month['month']}}">
                                               
                                               <input type="hidden" name="is_input{{$key+1}}[]" value="{{$find_pay?0:1}}">
                                               <input type="text"  value="{{$find_pay?$find_pay->amount:''}}" name="amount{{$key+1}}[]">
                                            </td>
                                            @endforeach
                                            @endif
                                        </tr>
                                        @endforeach
                                        <tr>
                                          <td colspan="5"></td>
                                          <td>
                                            <input type="text" placeholder="Paid By" name="paid_by">
                                            <button class="btn btn-success btn-sm" type="submit">Submit</button>
                                          </td>
                                        </tr>
                                      </tbody>

                                    </table> 
                                    </form> 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection