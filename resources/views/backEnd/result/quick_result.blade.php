@extends('backEnd.layouts.master')
@section('title','Quick Result Upload')
@section('content')
<section class="wsit-container">
	<div class="wsit-content">
		<div class="page-header">
			<div class="page-block">
			    <div class="row align-items-center justify-content-between">
			    	<div class="col-auto">
				    	<div class="page-header-title">
	             		<h4 class="m-b-10">Quick Result Upload</h4>
	            		</div>
						   <ul class="breadcrumb">

							  <li class="breadcrumb-item">
							  	<a href="{{route('dashboard')}}">Dashboard</a>
							  </li>
							  <li class="breadcrumb-item active">
							    Result Upload
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
                            <h6>Quick Result Upload</h6>
                        </div>
    					<div class="card-body">
    						<form action="{{ route('results.quick_import') }}" method="POST" class="row"
                                data-parsley-validate="" enctype="multipart/form-data">
                                @csrf
                                    <div class="col-sm-12">
                                        <div class="form-group mb-3">
                                            <label for="exam_code" class="form-label">Exam Code  </label>
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
                                    <div class="col-sm-12">
                                        <div class="form-group mb-3">
                                            <label for="excel" class="form-label">Excel Upload <span>*</span></label>
                                            <input type="file" class="form-control @error('excel') is-invalid @enderror"
                                                name="excel" value="{{old('excel') }}" id="excel" required="">
                                            @error('excel')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    {{-- col end --}}
	                                <!-- col-end -->
	                                 <div class="col-sm-12 mb-3 d-flex gap-3">
	                                    <div class="form-group">
	                                        <div class="form-check form-switch">
	                                          <input class="form-check-input" name="student_sms" value="1" type="checkbox" id="student_sms">
	                                          <label class="form-check-label" for="student_sms">Student SMS</label>
	                                        </div>
	                                        @error('student_sms')
	                                            <span class="invalid-feedback" role="alert">
	                                                <strong>{{ $message }}</strong>
	                                            </span>
	                                        @enderror
	                                    </div>
                                        <div class="form-group">
                                            <div class="form-check form-switch">
                                              <input class="form-check-input" name="parent_sms" value="1" type="checkbox" id="parent_sms">
                                              <label class="form-check-label" for="parent_sms">Parent's SMS</label>
                                            </div>
                                            @error('parent_sms')
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
<script>
    $(document).ready(function() {
        $('#payment_type').change(function() {
            var paymentType = $(this).val();
            console.log(paymentType);
            if (paymentType === '2') {
                $('.course_fee').show();
            } else {
                $('.course_fee').hide();
            }
        });
    });
</script>
@endpush