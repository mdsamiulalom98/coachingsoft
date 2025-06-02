@extends('frontEnd.layouts.master')
@section('title','Login')
@section('content')
<div class="page-breadcumb">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-banner">
                    <h2 class="page-name">লগ-ইন</h2>
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
					<form action="{{route('student.signin')}}" method="post" class="row">
						@csrf
						 <div class="col-sm-12">
                            <div class="form-group mb-3">
                                <label for="phone_number" class="form-label">Phone Number <span>*</span></label>
                                <input type="text" placeholder="Enter Phone Number" class="form-control @error('phone_number') is-invalid @enderror"
                                    name="phone_number" value="{{old('phone_number') }}" id="phone_number" required>
                                @error('phone_number')
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
                        <div class="col-sm-12">
                            <div class="text-end text-muted">
                                <a href="{{route('student.forgot.password')}}">Forgot password?</a>
                            </div>
                        </div>
						 <div class="col-sm-12 mt-2">
                            <div class="form-group mb-3">
                                <button class="submit_btn">Login</button>
                            </div>
                        </div>
                        <!-- col end -->
					</form>
					<div class="auth-extra">
						<p>If you have no an account? <a href="{{route('student.register')}}">Click for Register</a></p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection