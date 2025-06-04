@extends('backEnd.layouts.master')
@section('title','Payment Reports')
@section('content')
<section class="wsit-container">
    <div class="wsit-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center justify-content-between">
                    <div class="col-auto">
                        <div class="page-header-title">
                        <h4 class="m-b-10">Payment Manage</h4>
                        </div>
                           <ul class="breadcrumb">
                              <li class="breadcrumb-item">
                                <a href="{{route('dashboard')}}">Dashboard</a>
                              </li>
                              <li class="breadcrumb-item active">
                                Payment Reports
                              </li>
                           </ul>
                    </div>
                    <div class="col-auto">
                        <div class="quick_btn">
                            <a href="{{route('payments.create')}}"><i class="ti ti-plus"></i> Payment Create</a>
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
                            <h6>Payment Reports</h6>
                        </div>
                        <div class="card-body">
                            <form class="row ">
                                <div class="col-sm-12 d-flex gap-2">
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
                                    {{-- from group end --}}
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
                                    {{-- from group end --}}
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
                                    {{-- from group end --}}
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
                                    {{-- from group end --}}
                                  <div class="form-group">
                                    <select  id="month" name="month" class="select2 form-control{{ $errors->has('month') ? ' is-invalid' : '' }}" >
                                    <option value="">Select Month</option>
                                    @foreach($months as $month)
                                     <option value="{{$month['month']}}" {{request('month') == $month['month'] ? 'selected' : ''}}>{{$month['month']}}</option>
                                    @endforeach
                                    </select>
                                  </div>
                                  {{-- from group end --}}
                                    <div class="form-group">
                                      <select  id="status" name="status" class="status select2 form-control{{ $errors->has('status') ? ' is-invalid' : '' }}">
                                        <option value="">Paid/Due</option>
                                        <option value="paid" {{request('status') == 'paid' ? 'selected' :''}}>Paid</option>
                                        <option value="due" {{request('status') == 'due' ? 'selected' :''}}>Due</option>
                                      </select>
                                    </div>
                                    {{-- from group end --}}
                                    <div class="form-group ">
                                        <select class="form-control select2" name="student_id" id="student_id">
                                            <option value="">Select Student..</option>
                                            @foreach($students as $key=>$value)
                                            <option value="{{$value->id}}" {{request('student_id') == $value->id ? 'selected' : ''}}>{{$value->name}}</option>
                                            @endforeach
                                        </select>
                                        @error('student_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    {{-- from group end --}}
                                    <div class="form-group ">
                                       <button class="btn btn-success" id="filter">Search</button>
                                    </div>

                                </div>
                            </form>
                            <div class="payment-form mt-3">
                                    <table id="example" class="table table-bordered table-striped table-responsive-sm sm-form">
                                      <thead>
                                      <tr>
                                        <th>Name</th>
                                        <th>Roll</th>
                                        @if(!is_null($find_batch) && $find_batch->payment_type == 2)
                                        <th>Course Fee</th>
                                        <th>Paid</th>
                                        <th>Due</th>
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
                                            
                                             @if($find_batch->payment_type ==2)
                                             <input type="hidden" name="month[]" value="{{date('M Y')}}">
                                             <td>
                                              <p>{{$find_batch->course_fee}}</p>
                                             </td>
                                             <td>
                                                <p>{{$value->course_fee??0}}</p>
                                             </td>
                                             <td>
                                               <p>{{$find_batch->course_fee-$value->course_fee}}</p>
                                             </td>
                                             @else
                                            @foreach($months as $key=>$month)
                                            @php
                                              $find_pay = App\Models\Payment::where(['student_id'=>$value->id,'month'=>$month['month']])->select('id','student_id','month','amount')->first();
                                            @endphp
                                            <td>
                                               <p class="{{$month['month'] == request('month') ? 'text-primary' : ''}}">{{$find_pay? 'Paid' :''}} </p>
                                            </td>
                                            @endforeach
                                            @endif
                                        </tr>
                                        @endforeach
                                      </tbody>

                                    </table> 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection