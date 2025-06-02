@extends('backEnd.layouts.master')
@section('title','Batch Create')
@section('content')
<section class="wsit-container">
	<div class="wsit-content">
		<div class="page-header">
			<div class="page-block">
			    <div class="row align-items-center justify-content-between">
			    	<div class="col-auto">
				    	<div class="page-header-title">
	             		<h4 class="m-b-10">Batch</h4>
	            		</div>
						   <ul class="breadcrumb">

							  <li class="breadcrumb-item">
							  	<a href="{{route('dashboard')}}">Dashboard</a>
							  </li>
							  <li class="breadcrumb-item active">
							    Batch Create
							  </li>
						   </ul>
				    </div>
			    	<div class="col-auto">
			    		<div class="quick_btn">
                            <a href="{{route('batches.index')}}"><i class="ti ti-plus"></i> Manage</a>
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
                            <h6>Batch Create</h6>
                        </div>
    					<div class="card-body">
    						<form action="{{ route('batches.store') }}" method="POST" class="row"
                                data-parsley-validate="" enctype="multipart/form-data">
                                @csrf
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
                                            @foreach ($sessions as $key=>$value)
                                             <option value="{{ $value->id }}">{{ $value->name }}</option>
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
                                        <label for="name" class="form-label">Name <span>*</span></label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                            name="name" value="{{old('name') }}" id="name" required="">
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                {{-- col end --}}
                                <div class="col-sm-4">
                                    <div class="form-group mb-3">
                                        <label for="payment_type" class="form-label">Payment Type <span>*</span></label>
                                        <select class="form-control select2" name="payment_type" id="payment_type" required>
                                        	<option value="">Select..</option>
                                             <option value="1">Monthly Fee</option>
                                             <option value="2">Course Fee</option>
                                        </select>
                                        @error('payment_type')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <!-- col end -->
                                <div class="col-sm-4 course_fee" style="display: none;">
                                    <div class="form-group mb-3">
                                        <label for="course_fee" class="form-label">Course Fee *</label>
                                        <input type="text" class="form-control @error('course_fee') is-invalid @enderror"
                                            name="course_fee" value="{{old('course_fee') }}" id="course_fee">
                                        @error('course_fee')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                {{-- col end --}}
	                                <!-- col-end -->
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