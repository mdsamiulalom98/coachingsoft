@extends('frontEnd.layouts.master')
@section('title','Forgot Password')
@section('content')
<div class="page-breadcumb">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-banner">
                    <h2 class="page-name">পাসওয়ার্ড ভুলে গেছেন?</h2>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="auth-section">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-sm-5">
				<div class="auth-content">
					<form action="{{route('student.forgot.verify')}}" method="post" class="row">
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