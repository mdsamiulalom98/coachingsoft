 @extends('backEnd.layouts.master')
@section('title','Exam Add')
@push('css')
<link rel="stylesheet" href="{{asset('public/backEnd/assets/css/flatpickr.min.css')}}">
<link rel="stylesheet" href="{{asset('public/backEnd/assets/css/dropify.min.css')}}">
@endpush
@section('content')
<section class="wsit-container">
	<div class="wsit-content">
		<div class="page-header">
			<div class="page-block">
			    <div class="row align-items-center justify-content-between">
			    	<div class="col-auto">
				    	<div class="page-header-title">
	             		<h4 class="m-b-10">Exam Add</h4>
	            		</div>
						   <ul class="breadcrumb">

							  <li class="breadcrumb-item">
							  	<a href="{{route('dashboard')}}">Dashboard</a>
							  </li>
							  <li class="breadcrumb-item active">
							    Exam Add
							  </li>
						   </ul>
				    </div>
			    	<div class="col-auto">
			    		<div class="quick_btn">
                            <a href="{{route('exams.index')}}"><i class="ti ti-plus"></i> Manage</a>
                        </div>
			    	</div>
			    </div>
			</div>
		</div>

		<div class="page-content">
		    <div class="row">
    			<div class="col-sm-12">
                    <form action="{{ route('exams.store') }}" method="POST" 
                    data-parsley-validate="" enctype="multipart/form-data">
                    @csrf
        				<div class="card">
        					<div class="card-header">
                                <h6>Exam Add</h6>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group mb-3">
                                            <label for="department_id" class="form-label">Department <span>*</span></label>
                                            <select class="form-control select2" name="department_id" id="department_id" required>
                                                <option value="">Select..</option>
                                                @foreach ($departments as $key=>$value)
                                                 <option value="{{ $value->id }}">{{ $value->name }}</option>
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
                                    <div class="col-sm-4">
                                        <div class="form-group mb-3">
                                            <label for="class_id" class="form-label">Class <span>*</span></label>
                                            <select class="form-control select2" name="class_id" id="class_id" required>
                                                <option value="">Select..</option>
                                            </select>
                                            @error('class_id')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <!-- col end -->

                                    <div class="col-sm-4">
                                        <div class="form-group mb-3">
                                            <label for="session_id" class="form-label">Session <span>*</span></label>
                                            <select class="form-control select2" name="session_id" id="session_id" required>
                                                <option value="">Select..</option>
                                                @foreach($sessions as $key=>$value)
                                                <option value="{{$value->id}}">{{$value->name}}</option>
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
                                    <div class="col-sm-4">
                                        <div class="form-group mb-3">
                                            <label for="batch_id" class="form-label">Batch </label>
                                            <select class="form-control select2" name="batch_id" id="batch_id">
                                                <option value="">Select..</option>
                                            </select>
                                            @error('batch_id')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <!-- col end -->
                                    <div class="col-sm-4">
                                        <div class="form-group mb-3">
                                            <label for="title" class="form-label">Exam Name  <span>*</span></label>
                                            <input type="text" class="form-control @error('title') is-invalid @enderror"
                                                name="title" value="{{old('title') }}" id="title" required>
                                            @error('title')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    {{-- col end --}}
                                    <div class="col-sm-4">
                                        <div class="form-group mb-3">
                                            <label for="exam_code" class="form-label">Exam Code </label>
                                            <input type="text" class="form-control @error('exam_code') is-invalid @enderror"
                                                name="exam_code" value="{{old('exam_code') }}" id="exam_code">
                                            @error('exam_code')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    {{-- col end --}}
                                    <div class="col-sm-4">
                                        <div class="form-group mb-3">
                                            <label for="marks" class="form-label">Marks <span>*</span></label>
                                            <input type="text" class="form-control @error('marks') is-invalid @enderror"
                                                name="marks" value="{{old('marks') }}" id="marks" required>
                                            @error('marks')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    {{-- col end --}}
                                    <div class="col-sm-4">
                                        <div class="form-group mb-3">
                                            <label for="cq" class="form-label">CQ Marks </label>
                                            <input type="text" class="form-control @error('cq') is-invalid @enderror"
                                                name="cq" value="{{old('cq') }}" id="cq">
                                            @error('cq')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    {{-- col end --}}
                                    <div class="col-sm-4">
                                        <div class="form-group mb-3">
                                            <label for="mcq" class="form-label">MCQ Marks </label>
                                            <input type="text" class="form-control @error('mcq') is-invalid @enderror"
                                                name="mcq" value="{{old('mcq') }}" id="mcq">
                                            @error('mcq')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    {{-- col end --}}
                                </div>
                            </div>
        				</div>
                        {{-- card end --}}
                        <div class="submit">
                            <button type="submit" class="btn btn-success btn-lg">Submit</button>
                        </div>
                    </form>
    			</div>
    		</div>
		</div>
	</div>
</section>
@endsection

@push('script')
<script src="{{asset('public/backEnd/assets/js/flatpickr.js')}}"></script>
<script>
    flatpickr(".customDate", {});
</script>

@endpush