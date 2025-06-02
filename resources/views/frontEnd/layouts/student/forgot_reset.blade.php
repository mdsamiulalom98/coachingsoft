@extends('frontEnd.layouts.master')
@section('title','Forgot Reset')
@section('content')
<div class="page-breadcumb">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-banner">
                    <h2 class="page-name">পাসওয়ার্ড পুনঃরুদ্ধার</h2>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- page-breadcrumb --}}
<div class="auth-section">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-sm-5">
				<div class="auth-content">
					<form action="{{route('student.forgot.store')}}" method="post" class="row">
						@csrf
						 <div class="col-sm-12">
                            <div class="form-group mb-3">
                                <label for="otp" class="form-label">OTP <span>*</span></label>
                                <input type="text" placeholder="Enter Phone Number" class="form-control @error('otp') is-invalid @enderror"
                                    name="otp" value="{{old('otp') }}" id="otp" required>
                                @error('otp')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <!-- col end -->
						 <div class="col-sm-12">
                            <div class="form-group mb-3">
                                <label for="password" class="form-label">Password <span>*</span></label>
                                <input type="password" placeholder="Enter Password" class="form-control @error('password') is-invalid @enderror"
                                    name="password" value="{{old('password') }}" id="password" required>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <!-- col end -->
						 <div class="col-sm-12 mt-2">
                            <div class="form-group mb-3">
                                <button class="submit_btn">Submit</button>
                            </div>
                        </div>
                        <!-- col end -->
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection