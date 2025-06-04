@extends('backEnd.layouts.master')
@section('title','Course Add')
@push('css')
<link rel="stylesheet" href="{{asset('public/backEnd/assets/css/flatpickr.min.css')}}">
<link rel="stylesheet" href="{{asset('public/backEnd/assets/css/dropify.min.css')}}">
<link href="{{ asset('public/backEnd') }}/assets/css/summernote-lite.min.css" rel="stylesheet"
        type="text/css" />
@endpush
@section('content')
<section class="wsit-container">
	<div class="wsit-content">
		<div class="page-header">
			<div class="page-block">
			    <div class="row align-items-center justify-content-between">
			    	<div class="col-auto">
				    	<div class="page-header-title">
	             		<h4 class="m-b-10">Course Add</h4>
	            		</div>
						   <ul class="breadcrumb">

							  <li class="breadcrumb-item">
							  	<a href="{{route('dashboard')}}">Dashboard</a>
							  </li>
							  <li class="breadcrumb-item active">
							    Course Add
							  </li>
						   </ul>
				    </div>
			    	<div class="col-auto">
			    		<div class="quick_btn">
                            <a href="{{route('courses.index')}}"><i class="ti ti-plus"></i> Manage</a>
                        </div>
			    	</div>
			    </div>
			</div>
		</div>

		<div class="page-content">
		    <div class="row">
    			<div class="col-sm-12">
                    <form action="{{ route('courses.store') }}" method="POST" 
                    data-parsley-validate="" enctype="multipart/form-data">
                    @csrf
        				<div class="card">
        					<div class="card-header">
                                <h6>Course Information</h6>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group mb-3">
                                            <label for="mentor_id" class="form-label">Mentor <span>*</span></label>
                                            <select class="form-control select2" name="mentor_id" id="mentor_id" required>
                                                <option value="">Select..</option>
                                                @foreach ($mentors as $key=>$value)
                                                 <option value="{{ $value->id }}">{{ $value->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('mentor_id')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <!-- col end -->
                                    <div class="col-sm-4">
                                        <div class="form-group mb-3">
                                            <label for="title" class="form-label">Course Title <span>*</span></label>
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
                                            <label for="total_class" class="form-label">Total Class <span>*</span></label>
                                            <input type="text" class="form-control @error('total_class') is-invalid @enderror"
                                                name="total_class" value="{{old('total_class') }}" id="total_class" required>
                                            @error('total_class')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    {{-- col end --}}
                                    <div class="col-sm-4">
                                        <div class="form-group mb-3">
                                            <label for="time" class="form-label">Time <span>*</span></label>
                                            <input type="text" placeholder="Duration/Schedule" class="form-control @error('time') is-invalid @enderror"
                                                name="time" value="{{old('time') }}" id="time" required>
                                            @error('time')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    {{-- col end --}}
                                    <div class="col-sm-4">
                                        <div class="form-group mb-3">
                                            <label for="old_fee" class="form-label">Old Course Fee  </label>
                                            <input type="text"  class="form-control @error('old_fee') is-invalid @enderror"
                                                name="old_fee" value="{{old('old_fee') }}" id="old_fee">
                                            @error('old_fee')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    {{-- col end --}}
                                    <div class="col-sm-4">
                                        <div class="form-group mb-3">
                                            <label for="course_fee" class="form-label">Course Fee  <span>*</span></label>
                                            <input type="text"  class="form-control @error('course_fee') is-invalid @enderror"
                                                name="course_fee" value="{{old('course_fee') }}" id="course_fee" required>
                                            @error('course_fee')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    {{-- col end --}}

                                    <div class="col-sm-4">
                                        <div class="form-group mb-3">
                                            <label for="category" class="form-label">Category <span>*</span></label>
                                            <select class="form-control select2" name="category" id="category" required>
                                                <option value="">Select..</option>
                                                 <option value="Academic">Academic</option>
                                                 <option value="Admission">Admission</option>
                                                 <option value="Academic & Admission" >Academic & Admission</option>
                                            </select>
                                            @error('category')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <!-- col end -->
                                    <div class="col-sm-4">
                                        <div class="form-group mb-3">
                                            <label for="course_type" class="form-label">Course Type <span>*</span></label>
                                            <select class="form-control select2" name="course_type" id="course_type" required>
                                                <option value="">Select..</option>
                                                 <option value="Online">Online</option>
                                                 <option value="Offline">Offline</option>
                                            </select>
                                            @error('course_type')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <!-- col end -->
                                    <div class="col-sm-4">
                                        <div class="form-group mb-3">
                                            <label for="image" class="form-label">Image <span>*</span></label>
                                            <input type="file" class="form-control @error('image') is-invalid @enderror"
                                                name="image" value="{{old('image') }}" id="image">
                                            @error('image')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    {{-- col end --}}
                                    <div class="col-sm-4">
                                        <div class="form-group mb-3">
                                            <label for="video" class="form-label">Intro Video <span>*</span></label>
                                            <input type="text" class="form-control @error('video') is-invalid @enderror"
                                                name="video" value="{{ old('video') }}" id="video" required>
                                            @error('video')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    {{-- col end --}}
                                    <div class="col-sm-12">
                                        <div class="form-group mb-3">
                                            <label for="description" class="form-label">Description <span>*</span></label>
                                            <textarea type="file" class="summernote form-control @error('description') is-invalid @enderror"
                                                name="description" value="{{old('description') }}" id="description" required></textarea>
                                            @error('description')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    {{-- col end --}}
                                    <div class="col-sm-12">
                                        <div class="form-group mb-3">
                                            <label for="why_us" class="form-label">Why Do it </label>
                                            <textarea type="file" class="summernote form-control @error('why_us') is-invalid @enderror"
                                                name="why_us" value="{{old('why_us') }}" id="why_us"></textarea>
                                            @error('why_us')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    {{-- col end --}}
                                    <div class="col-sm-12 mb-3">
                                        <div class="form-group">
                                            <div class="form-check form-switch">
                                              <input class="form-check-input" name="status" value="1" type="checkbox" id="id" checked>
                                              <label class="form-check-label" for="id">Status</label>
                                            </div>
                                            @error('status')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <!-- col end -->
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
<script src="{{asset('public/backEnd/assets/js/dropify.min.js')}}"></script>
<script>
    $(document).ready(function () {
        $('.dropify').dropify();
    });
</script>
<script src="{{ asset('public/backEnd/') }}/assets/js/summernote-lite.min.js"></script>
<script>
    $(".summernote").summernote({
        placeholder: "Enter Your Text Here",
    });
</script>

@endpush