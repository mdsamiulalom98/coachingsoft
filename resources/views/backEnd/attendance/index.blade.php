@extends('backEnd.layouts.master')
@section('title','Attendance List')
@section('content')
<section class="wsit-container">
    <div class="wsit-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center justify-content-between">
                    <div class="col-auto">
                        <div class="page-header-title">
                        <h4 class="m-b-10">Attendance</h4>
                        </div>
                           <ul class="breadcrumb">
                              <li class="breadcrumb-item">
                                <a href="{{route('dashboard')}}">Dashboard</a>
                              </li>
                              <li class="breadcrumb-item active">
                                Attendance List
                              </li>
                           </ul>
                    </div>
                    <div class="col-auto">
                        <div class="quick_btn">
                            <a href="{{route('attendances.create')}}"><i class="ti ti-plus"></i> Attendance Create</a>
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
                            <h6>Attendance List</h6>
                        </div>
                        <div class="card-body">
                            <form class="row ">
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <select class="form-control select2" name="department_id" id="department_id">
                                            <option value="">Select Department..</option>
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
                                        <select class="form-control select2" name="class_id" id="class_id">
                                            <option value="">Select Class..</option>
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
                                        <select class="form-control select2" name="session_id" id="session_id">
                                            <option value="">Select Session..</option>
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
                                        <select class="form-control select2" name="batch_id" id="batch_id">
                                            <option value="">Select Batch..</option>
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
                            <table class="table table-striped" id="data-table" class="display" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Department</th>
                                        <th>Session</th>
                                        <th>Batch</th>
                                        <th>Name</th>
                                        <th>Roll</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data as $key=>$value)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $value->department?->name }}</td>
                                        <td>{{ $value->session?->name }}</td>
                                        <td>{{ $value->batch?->name }}</td>
                                        <td>{{ $value->name }}</td>
                                        <td>{{ $value->roll_number }}</td>

                                      
                                            <td>
                                               <div class="d-flex gap-1"> 
                                               @foreach($value->last_7_days as $status)
                                                    @if($status == 'present')
                                                        <span class="badge bg-success">P</span>
                                                    @elseif($status == 'absent')
                                                        <span class="badge bg-danger">A</span>
                                                    @else
                                                        <span class="badge bg-secondary">A</span>
                                                    @endif
                                                @endforeach
                                                </div>

                                            </td>
                                        
                                        <td>
                                            {{-- Your radio attendance inputs here --}}
                                        </td>
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
</section>
@endsection