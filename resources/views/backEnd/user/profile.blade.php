@extends('backEnd.layouts.master')
@section('content')
<section class="wsit-container">
	<div class="wsit-content">
		<div class="page-header">
			<div class="page-block">
			    <div class="row align-items-center justify-content-between">
			    	<div class="col-auto">
				    	<div class="page-header-title">
	             		<h4 class="m-b-10">Profile</h4>
	            		</div>
						   <ul class="breadcrumb">

							  <li class="breadcrumb-item">
							  	<a href="{{route('dashboard')}}">Dashboard</a>
							  </li>
							  <li class="breadcrumb-item active">
							    Profile
							  </li>
						   </ul>
				    </div>
			    	<div class="col-auto">
			    		
			    	</div>
			    </div>
			</div>
		</div>
		<div class="page-content">
		    <div class="row">
    			<div class="col-sm-3">
					<div class="card quick-sidebar">
						<ul class="scroll_menu">
							<li><a href="#personalinfo">Personal Information</a></li>
							<li><a href="#changepass">Change Password</a></li>
						</ul>
					</div>
    			</div>
    			<div class="col-sm-9">
    				<div class="card">
    					<form action="{{ route('users.update') }}" method="POST" class="row"
                                data-parsley-validate="" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" value="{{ $profile->id }}" name="id">
								<div id="personalinfo">
								 	<div class="card-header">
								 		<h6>Personal Information</h6>
								 	</div>
								 	<div class="card-body">
								 		
		                                <div class="col-sm-6">
		                                    <div class="form-group mb-3">
		                                        <label for="name" class="form-label">Name *</label>
		                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
		                                            name="name" value="{{ $profile->name }}" id="name" required="">
		                                        @error('name')
		                                            <span class="invalid-feedback" role="alert">
		                                                <strong>{{ $message }}</strong>
		                                            </span>
		                                        @enderror
		                                    </div>
		                                </div>
		                                <!-- col-end -->
		                                <div class="col-sm-6">
		                                    <div class="form-group mb-3">
		                                        <label for="email" class="form-label">Email *</label>
		                                        <input type="text" class="form-control @error('email') is-invalid @enderror"
		                                            name="email" value="{{ $profile->email }}" id="email" required="">
		                                        @error('email')
		                                            <span class="invalid-feedback" role="alert">
		                                                <strong>{{ $message }}</strong>
		                                            </span>
		                                        @enderror
		                                    </div>
		                                </div>
		                                <!-- col-end -->
		                                <div class="col-sm-6">
		                                    <div class="form-group mb-3">
		                                        <label for="password" class="form-label">Password *</label>
		                                        <input type="password" class="form-control @error('password') is-invalid @enderror"
		                                            name="password" value="" id="password">
		                                        @error('password')
		                                            <span class="invalid-feedback" role="alert">
		                                                <strong>{{ $message }}</strong>
		                                            </span>
		                                        @enderror
		                                    </div>
		                                </div>
		                                <!-- col end -->
		                                <div class="col-sm-6">
		                                    <div class="form-group mb-3">
		                                        <label for="confirm-password" class="form-label">Confirm Password *</label>
		                                        <input type="password"
		                                            class="form-control @error('confirm-password') is-invalid @enderror"
		                                            name="confirm-password" value="" id="confirm-password">
		                                        @error('confirm-password')
		                                            <span class="invalid-feedback" role="alert">
		                                                <strong>{{ $message }}</strong>
		                                            </span>
		                                        @enderror
		                                    </div>
		                                </div>
		                                <!-- col end -->
		                                <div class="col-sm-6">
		                                    <div class="form-group mb-3">
		                                        <label for="roles" class="form-label">Role *</label>
		                                        <select class="form-control select2" name="roles[]" data-toggle="select2"
		                                            multiple="multiple" data-placeholder="Choose ..." required>
		                                            <optgroup label="Select Role">
		                                                @foreach ($roles as $role)
		                                                    <option value="{{ $role->name }}"
		                                                        @foreach ($profile->roles as $srole) {{ $srole->id == $role->id ? 'selected' : '' }} @endforeach>
		                                                        {{ $role->name }}</option>
		                                                @endforeach
		                                            </optgroup>
		                                        </select>
		                                        @error('roles')
		                                            <span class="invalid-feedback" role="alert">
		                                                <strong>{{ $message }}</strong>
		                                            </span>
		                                        @enderror
		                                    </div>
		                                </div>
		                                <!-- col end -->
		                                <div class="col-sm-6 mb-3">
		                                    <div class="form-group">
		                                        <label for="image" class="form-label">Image *</label>
		                                        <input type="file" class="form-control @error('image') is-invalid @enderror"
		                                            name="image" value="{{ $profile->image }}" id="image">
		                                        <img src="{{ asset($profile->image) }}" class="circle_img">
		                                        @error('image')
		                                            <span class="invalid-feedback" role="alert">
		                                                <strong>{{ $message }}</strong>
		                                            </span>
		                                        @enderror
		                                    </div>
		                                </div>
		                                <!-- col end -->
								 	</div>
								 	<div class="card-footer text-end">
								 		<input type="submit" class="btn btn-success" value="Save Change">
								 	</div>
								</div>
						</form>
    				</div>
    				<div class="card">
						<div id="changepass">
						 	<div class="card-header">
						 		<h6>Change Password</h6>
						 	</div>
						 	<form action="{{ route('users.change_password') }}" method="POST" data-parsley-validate=""
                            enctype="multipart/form-data">
                            @csrf
						 	<div class="card-body">
						 		<div class="col-sm-12">
	                                <div class="form-group mb-3">
	                                    <label for="old_password" class="form-label">Old Password *</label>
	                                    <input type="password" class="form-control @error('old_password') is-invalid @enderror"
	                                        name="old_password" value="{{ old('old_password') }}" id="old_password"
	                                        required="">
	                                    @error('old_password')
	                                        <span class="invalid-feedback" role="alert">
	                                            <strong>{{ $message }}</strong>
	                                        </span>
	                                    @enderror
	                                </div>
	                            </div>
	                            <!-- col end -->
	                            <div class="col-sm-12">
	                                <div class="form-group mb-3">
	                                    <label for="new_password" class="form-label">New Password *</label>
	                                    <input type="password" class="form-control @error('new_password') is-invalid @enderror"
	                                        name="new_password" value="{{ old('new_password') }}" id="new_password"
	                                        required="">
	                                    @error('new_password')
	                                        <span class="invalid-feedback" role="alert">
	                                            <strong>{{ $message }}</strong>
	                                        </span>
	                                    @enderror
	                                </div>
	                            </div>
	                            <!-- col end -->
	                            <div class="col-sm-12">
	                                <div class="form-group mb-3">
	                                    <label for="confirm_password" class="form-label">Confirm Password *</label>
	                                    <input type="password"
	                                        class="form-control @error('confirm_password') is-invalid @enderror"
	                                        name="confirm_password" value="{{ old('confirm_password') }}" id="confirm_password"
	                                        required="">
	                                    @error('confirm_password')
	                                        <span class="invalid-feedback" role="alert">
	                                            <strong>{{ $message }}</strong>
	                                        </span>
	                                    @enderror
	                                </div>
	                            </div>
	                            <!-- col end -->
						 	</div>
						 	<div class="card-footer text-end">
						 		<input type="submit" class="btn btn-success" value="Save Change">
						 	</div>
						</div>
    				</div>
    			</div>
    		</div>
		</div>
	</div>
</section>

@endsection