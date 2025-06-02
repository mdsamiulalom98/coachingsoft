@extends('frontEnd.layouts.master')
@section('title','Verify')
@section('content')
<div class="page-breadcumb">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-banner">
                    <h2 class="page-name">একাউন্ট ভেরিফাই</h2>
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
					<form action="{{route('student.account_verify')}}" method="post" class="row">
						@csrf
						 <div class="col-sm-12">
                            <div class="form-group mb-3">
                                <label for="otp" class="form-label">OTP <span>*</span></label>
                                <input type="text" placeholder="Enter otp Number" class="form-control @error('otp') is-invalid @enderror"
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
                                <button class="submit_btn">Verify</button>
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