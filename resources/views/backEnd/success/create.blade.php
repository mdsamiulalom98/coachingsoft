@extends('backEnd.layouts.master')
@section('title','Success Student Add')
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
	             		<h4 class="m-b-10">Success Student Add</h4>
	            		</div>
						   <ul class="breadcrumb">

							  <li class="breadcrumb-item">
							  	<a href="{{route('dashboard')}}">Dashboard</a>
							  </li>
							  <li class="breadcrumb-item active">
							    Success Student Add
							  </li>
						   </ul>
				    </div>
			    	<div class="col-auto">
			    		<div class="quick_btn">
                            <a href="{{route('success_students.index')}}"><i class="ti ti-plus"></i> Manage</a>
                        </div>
			    	</div>
			    </div>
			</div>
		</div>

		<div class="page-content">
		    <div class="row">
    			<div class="col-sm-12">
                    <form action="{{ route('success_students.store') }}" method="POST" 
                    data-parsley-validate="" enctype="multipart/form-data">
                    @csrf
        				<div class="card">
        					<div class="card-header">
                                <h6>Success Student</h6>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group mb-3">
                                            <label for="session" class="form-label">Session/Year <span>*</span> <a data-bs-toggle="modal" data-bs-target="#yearModal" class="btn btn-primary">+</a></label>
                                            <select class="form-control select2" name="session" id="session" required>
                                                <option value="">Select..</option>
                                                @foreach ($success_years as $key=>$value)
                                                 <option value="{{ $value->name }}">{{ $value->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('session')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <!-- col end -->
                                    <div class="col-sm-4">
                                        <div class="form-group mb-3">
                                            <label for="name" class="form-label"> Name<span>*</span></label>
                                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                                name="name" value="{{old('name') }}" id="name" required>
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
                                            <label for="institute" class="form-label">Institute</label>
                                            <input type="text"  class="form-control @error('institute') is-invalid @enderror"
                                                name="institute" value="{{old('institute') }}" id="institute">
                                            @error('institute')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    {{-- col end --}}
                                    <div class="col-sm-4">
                                        <div class="form-group mb-3">
                                            <label for="merit_position" class="form-label">Merit Position</label>
                                            <input type="text"  class="form-control @error('merit_position') is-invalid @enderror"
                                                name="merit_position" value="{{old('merit_position') }}" id="merit_position">
                                            @error('merit_position')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    {{-- col end --}}
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
<!-- Modal -->
<div class="modal fade" id="yearModal" tabindex="-1" aria-labelledby="yearModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="yearModalLabel">Success Year/Session Create</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
       <form action="{{route('success_year.add')}}" method="POST">
        @csrf
          <div class="modal-body">
                <div class="form-group mb-3">
                    <label for="name" class="form-label">Success Session/Year<span>*</span></label>
                    <input type="text"  class="form-control @error('name') is-invalid @enderror"
                        name="name" value="{{old('name') }}" id="name" required>
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                {{-- col end --}}
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save</button>
          </div>
      </form>
    </div>
  </div>
</div>
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