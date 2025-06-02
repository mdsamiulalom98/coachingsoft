@extends('backEnd.layouts.master')
@section('title','New Attendance')
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
                                New Attendance
                              </li>
                           </ul>
                    </div>
                    <div class="col-auto">
                        <div class="quick_btn">
                            <a href="{{route('students.create')}}"><i class="ti ti-plus"></i> Attendance List</a>
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
                            <h6>New Attendance</h6>
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
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$value->department?->name}}</td>
                                        <td>{{$value->session?->name}}</td>
                                        <td>{{$value->batch?->name}}</td>
                                        <td>{{$value->name}}</td>
                                        <td>{{$value->roll_number}}</td>
                                        <td>
                                            <div class="d-flex gap-2">
                                                <div class="form-check">
                                                  <input class="form-check-input default attendance" type="radio" name="status_{{$value->id}}" value="absent" id="absent{{$value->id}}" data-id="{{$value->id}}"  {{ (isset($attendances[$value->id]) && $attendances[$value->id] == 'absent') ? 'checked' : '' }}>
                                                  <label class="form-check-label" for="absent{{$value->id}}">
                                                   Absent
                                                  </label>
                                                </div>
                                                <div class="form-check">
                                                  <input class="form-check-input attendance default" type="radio" name="status_{{$value->id}}" value="present" id="present{{$value->id}}" data-id="{{$value->id}}"  {{ (isset($attendances[$value->id]) && $attendances[$value->id] == 'present') ? 'checked' : '' }}>
                                                  <label class="form-check-label" for="present{{$value->id}}">
                                                   Present
                                                  </label>
                                                </div>
                                            </div>
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

@push('script')
<script type="text/javascript">
    $(document).ready(function(){
    $('.attendance').click(function(){
        var student_id = $(this).data('id');
        var status =  $(this).val();
        console.log('status',status);
        if(student_id,status){
            $.ajax({
                cache: false,
                type: "POST",
                url: "{{ route('attendances.store') }}",
                data: {
                    _token: "{{ csrf_token() }}",
                    student_id: student_id,
                    status: status
                },
                dataType: "json",
                success: function (res) {
                    console.log("Success:", res);
                },
                error: function (err) {
                    console.error("Error:", err);
                }
            });
        }
       
       });
  });
</script>
<!-- attendance ajax end -->
@endpush