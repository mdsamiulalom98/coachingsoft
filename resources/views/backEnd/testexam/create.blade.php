@extends('backEnd.layouts.master')
@section('title','Test Exam Create')
@section('content')
@push('css')
<link rel="stylesheet" href="{{asset('public/backEnd/assets/css/flatpickr.min.css')}}">
<link href="{{ asset('public/backEnd') }}/assets/css/summernote-lite.min.css" rel="stylesheet"
        type="text/css" />
@endpush
<section class="wsit-container">
	<div class="wsit-content">
		<div class="page-header">
			<div class="page-block">
			    <div class="row align-items-center justify-content-between">
			    	<div class="col-auto">
				    	<div class="page-header-title">
	             		<h4 class="m-b-10">Test Exam</h4>
	            		</div>
						   <ul class="breadcrumb">

							  <li class="breadcrumb-item">
							  	<a href="{{route('dashboard')}}">Dashboard</a>
							  </li>
							  <li class="breadcrumb-item active">
							    Test Exam Create
							  </li>
						   </ul>
				    </div>
			    	<div class="col-auto">
			    		<div class="quick_btn">
                            <a href="{{route('testexams.index')}}"><i class="ti ti-plus"></i> Manage</a>
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
                            <h6>Test Exam Create</h6>
                        </div>
    					<div class="card-body">
    						<form action="{{ route('testexams.store') }}" method="POST" class="row"
                                data-parsley-validate="" enctype="multipart/form-data">
                                @csrf
                                <div class="col-sm-4">
                                    <div class="form-group mb-3">
                                        <label for="title" class="form-label">Title <span>*</span></label>
                                        <input type="text" class="form-control @error('title') is-invalid @enderror"
                                            name="title" value="{{old('title') }}" id="title" required="">
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
                                        <label for="link" class="form-label">Link <span>*</span></label>
                                        <input type="text" class="form-control @error('link') is-invalid @enderror"
                                            name="link" value="{{old('link') }}" id="link" required="">
                                        @error('link')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                {{-- col end --}}
                                <div class="col-sm-4">
                                    <div class="form-group mb-3">
                                        <label for="exam_date" class="form-label">Exam Date <span>*</span></label>
                                        <input type="date" class="mydate form-control @error('exam_date') is-invalid @enderror"
                                            name="exam_date" value="{{old('exam_date') }}" id="exam_date" required="">
                                        @error('exam_date')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                {{-- col end --}}
                                
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
							 	<div class="col-sm-12">
							 		<input type="submit" class="btn btn-success" value="Submit">
							 	</div>
							</form>
    					</div>
    				</div>
    			</div>
    		</div>
		</div>
	</div>
</section>

@endsection


@push('script')
<script src="{{asset('public/backEnd/assets/js/flatpickr.js')}}"></script>
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