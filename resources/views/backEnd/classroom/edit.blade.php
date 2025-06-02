@extends('backEnd.layouts.master')
@section('title','Class Edit')
@section('content')
<section class="wsit-container">
	<div class="wsit-content">
		<div class="page-header">
			<div class="page-block">
			    <div class="row align-items-center justify-content-between">
			    	<div class="col-auto">
				    	<div class="page-header-title">
	             		<h4 class="m-b-10">Class</h4>
	            		</div>
						   <ul class="breadcrumb">

							  <li class="breadcrumb-item">
							  	<a href="{{route('dashboard')}}">Dashboard</a>
							  </li>
							  <li class="breadcrumb-item active">
							    Class Edit
							  </li>
						   </ul>
				    </div>
			    	<div class="col-auto">
			    		<div class="quick_btn">
                            <a href="{{route('classrooms.index')}}"><i class="ti ti-plus"></i> Manage</a>
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
                            <h6>Class Create</h6>
                        </div>
    					<div class="card-body">
    						<form action="{{ route('classrooms.update') }}" method="POST" class="row"
                                data-parsley-validate="" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" value="{{$edit_data->id}}" name="id">
                                <div class="col-sm-12">
                                    <div class="form-group mb-3">
                                        <label for="department_id" class="form-label">Department</label>
                                        <select class="form-control select2" name="department_id" required>
                                        	<option value="">Select..</option>
                                            @foreach ($departments as $key=>$value)
                                             <option value="{{ $value->id }}" {{$value->id == $edit_data->department_id ? 'selected' : ''}}>{{ $value->name }}</option>
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
                                <div class="col-sm-12">
                                    <div class="form-group mb-3">
                                        <label for="name" class="form-label">Name *</label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                            name="name" value="{{ $edit_data->name }}" id="name" required="">
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
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