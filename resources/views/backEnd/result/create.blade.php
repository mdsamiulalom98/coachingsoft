@extends('backEnd.layouts.master')
@section('title','Result Create')
@section('content')
<section class="wsit-container">
    <div class="wsit-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center justify-content-between">
                    <div class="col-auto">
                        <div class="page-header-title">
                        <h4 class="m-b-10">Result</h4>
                        </div>
                           <ul class="breadcrumb">
                              <li class="breadcrumb-item">
                                <a href="{{route('dashboard')}}">Dashboard</a>
                              </li>
                              <li class="breadcrumb-item active">
                                Result Create
                              </li>
                           </ul>
                    </div>
                    <div class="col-auto">
                        <div class="quick_btn">
                            <a href="{{route('results.index')}}"><i class="ti ti-plus"></i> Manage</a>
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
                            <h6>Result Create</h6>
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
                                        <select class="form-control select2 ajax_exam" name="session_id" id="session_id" required>
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
                                        <select class="form-control select2 ajax_exam" name="batch_id" id="batch_id">
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
                                        <select class="form-control select2" name="exam_id" id="exam_id">
                                            <option value="">Select Exam..</option>
                                            @foreach($exams as $key=>$value)
                                            <option value="{{$value->id}}" {{request('exam_id') == $value->id ? 'selected' : ''}}>{{$value->title}}</option>
                                            @endforeach
                                        </select>
                                        @error('exam_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                {{-- <div class="col-sm-2">
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
                                </div> --}}
                                <!-- col end -->
                                <div class="col-sm-2">
                                    <div class="form-group ">
                                       <button class="btn btn-success" id="filter">Search</button>
                                    </div>
                                </div>
                                <!-- col end -->
                            </form>
                            <div class="payment-form mt-3">
                                <form action="{{route('results.store')}}" method="POST">
                                    @csrf

                                    <input type="hidden" name="department_id" value="{{request('department_id')}}">
                                    <input type="hidden" name="class_id" value="{{request('class_id')}}">
                                    <input type="hidden" name="session_id" value="{{request('session_id')}}">
                                    <input type="hidden" name="batch_id" value="{{request('batch_id')}}">
                                    <input type="hidden" name="exam_id" value="{{request('exam_id')}}">

                                  <table id="example" class="table table-bordered table-responsive-sm sm-form">
                                    <thead>
                                    <tr>
                                      <th>Sl</th>
                                      <th>Department</th>
                                      <th>Class</th>
                                      <th>Session</th>
                                      <th>Batch</th>
                                      <th>Name</th>
                                      <th>Roll</th>
                                      <th>Number</th>
                                      <th>Written</th>
                                      <th>MCQ</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if($data)
                                        @foreach($data as $key=>$value)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$value->department?->name}}</td>
                                            <td>{{$value->class?->name}}</td>
                                            <td>{{$value->session?->name}}</td>
                                            <td>{{$value->batch?->name}}</td>
                                            <td>{{$value->name}}</td>
                                            <td>{{$value->roll_number}}</td>
                                            <td>{{$value->phone_number}}</td>
                                            <td>
                                                <input type="hidden" name="student_id[]" value="{{$value->id}}">
                                                <input type="text" name="written[]" value="">
                                            </td>
                                            <td>
                                                <input type="text" name="mcq[]" value="">
                                            </td>
                                        </tr>
                                        @endforeach
                                        <tr>
                                            <td colspan="7"></td>
                                            <td>
                                                <div class="onlyweb-check">
                                                    <label for="onlyweb"><input type="checkbox" id="onlyweb" name="onlyweb" value="1">Only for Web</label>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="onlyweb-check">
                                                    <label for="onlymcq"><input type="checkbox" id="onlymcq" name="onlymcq" value="1">Only MCQ</label>
                                                </div>
                                            </td>
                                            <td> <button class="btn btn-success btn-sm" type="submit">Submit Result</button></td>
                                               
                                        </tr>
                                    @endif
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
@push('script')
    <script>
        $(".ajax_exam").on("change", function() {
        var department_id = $('#department_id').val();
        var class_id = $('#class_id').val();
        var session_id = $('#session_id').val();
        var session_id = $('#session_id').val();
        var batch_id = $('#batch_id').val();
        if (session_id) {
            $.ajax({
                type: "GET",
                data: {department_id,class_id,session_id,batch_id},
                url: "{{ route('students.ajax_exam') }}",
                success: function(response) {
                    if (response) {
                        $("#exam_id").empty();
                        $("#exam_id").append('<option value="0">Select  Exam...</option>');
                        $.each(response, function(key, value) {
                            $("#exam_id").append('<option value="' + key + '">' +
                                value + "</option>");
                        });
                    } else {
                        $("#exam_id").empty();
                    }
                },
            });
        } else {
            $("#exam_id").empty();
        }
    });
    </script>
@endpush
@endsection