@extends('backEnd.layouts.master')
@section('title','Result Reports')
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
                                Result Reports
                              </li>
                           </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="page-content">

            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h6>Result Reports</h6>
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
                                    <div class="form-group ">
                                       <button class="btn btn-success" id="filter">Search</button>
                                    </div>
                                </div>
                            </form>
                            <table class="table table-striped table-bordered mt-4" id="data-table" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Roll</th>
                                        <th>Name</th>
                                        @if($data && $data->first()?->monthly_result)
                                            @foreach ($data->first()->monthly_result as $date => $mark)
                                                <th>{{ \Carbon\Carbon::parse($date)->format('d M') }}</th>
                                            @endforeach
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $student)
                                        <tr>
                                            <td>{{ $student->roll_number }}</td>
                                            <td>{{ $student->name }}</td>
                                            @foreach ($student->monthly_result as $date => $result)
                                            <td>
                                                @if (is_object($result))
                                                    <table class="table">
                                                        <tbody>
                                                            <tr>
                                                                <td>CQ</td>
                                                                <td>{{ $result->cq }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>MCQ</td>
                                                                <td>{{ $result->mcq }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>PS</td>
                                                                <td>{{ $result->position }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>HS</td>
                                                                <td>{{ $result->hs }}</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                @else
                                                    <span class="text-danger">Absent</span>
                                                @endif
                                            </td>
                                            @endforeach
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