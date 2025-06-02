@extends('backEnd.layouts.master')
@section('title','Banner Edit')
@section('content')
<section class="wsit-container">
	<div class="wsit-content">
		<div class="page-header">
			<div class="page-block">
			    <div class="row align-items-center justify-content-between">
			    	<div class="col-auto">
				    	<div class="page-header-title">
	             		<h4 class="m-b-10">Banner</h4>
	            		</div>
						   <ul class="breadcrumb">

							  <li class="breadcrumb-item">
							  	<a href="{{route('dashboard')}}">Dashboard</a>
							  </li>
							  <li class="breadcrumb-item active">
							    Banner Edit
							  </li>
						   </ul>
				    </div>
			    	<div class="col-auto">
			    		<div class="quick_btn">
                            <a href="{{route('banners.index')}}"><i class="ti ti-plus"></i> Manage</a>
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
    						<form action="{{ route('banners.update') }}" method="POST" class="row"
                                data-parsley-validate="" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" value="{{$edit_data->id}}" name="id">
                                
                                <div class="col-sm-12">
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
	                                <!-- col-end -->
	                                <div class="col-sm-12">
                                        <div class="form-group mb-3">
                                            <label for="image" class="form-label">Image <span>*</span></label>
                                            <input type="file" class="dropify form-control @error('image') is-invalid @enderror"
                                                name="image" value="{{$edit_data->image }}" id="image">
                                                <img src="{{asset($edit_data->image)}}" class="circle_img" alt="">
                                            @error('image')
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