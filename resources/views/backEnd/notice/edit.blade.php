@extends('backEnd.layouts.master')
@section('title','Notice Edit')
@section('content')
<section class="wsit-container">
	<div class="wsit-content">
		<div class="page-header">
			<div class="page-block">
			    <div class="row align-items-center justify-content-between">
			    	<div class="col-auto">
				    	<div class="page-header-title">
	             		<h4 class="m-b-10">Notice</h4>
	            		</div>
						   <ul class="breadcrumb">

							  <li class="breadcrumb-item">
							  	<a href="{{route('dashboard')}}">Dashboard</a>
							  </li>
							  <li class="breadcrumb-item active">
							    Notice Edit
							  </li>
						   </ul>
				    </div>
			    	<div class="col-auto">
			    		<div class="quick_btn">
                            <a href="{{route('notices.index')}}"><i class="ti ti-plus"></i> Manage</a>
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
                            <h6>Notice Create</h6>
                        </div>
    					<div class="card-body">
    						<form action="{{ route('notices.update') }}" method="POST" class="row"
                                data-parsley-validate="" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" value="{{$edit_data->id}}" name="id">
                                
                                <div class="col-sm-4">
                                    <div class="form-group mb-3">
                                        <label for="title" class="form-label">Title *</label>
                                        <input type="text" class="form-control @error('title') is-invalid @enderror"
                                            name="title" value="{{ $edit_data->title }}" id="title" required="">
                                        @error('title')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
	                                <!-- col-end -->
	                            <div class="col-sm-4">
                                    <div class="form-group mb-3">
                                        <label for="link" class="form-label">Link *</label>
                                        <input type="text" class="form-control @error('link') is-invalid @enderror"
                                            name="link" value="{{ $edit_data->link }}" id="link" required="">
                                        @error('link')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group mb-3">
                                        <label for="last_date" class="form-label">Last Date *</label>
                                        <input type="date"
				                                class="mydate form-control @error('last_date') is-invalid @enderror"
				                                name="last_date" value="{{ $edit_data->last_date }}" id="last_date"
				                                required="">
                                        @error('last_date')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group mb-3">
                                        <label for="description" class="form-label">Description *</label>
                                        <textarea class="summernote form-control @error('description')  is-invalid @enderror" name="description" rows="6"
				                                id="description" required="">{!! $edit_data->description !!}</textarea>
                                        @error('description')
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