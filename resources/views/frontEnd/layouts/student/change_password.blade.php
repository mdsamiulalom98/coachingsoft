@extends('frontEnd.layouts.student.master')
@section('title', 'Forgot Password')
@section('content')
    <section class="wsit-container">
        <div class="wsit-content">
            <div class="page-header">
                <div class="page-block">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-auto">
                            <div class="page-header-title">
                                <h4 class="m-b-10">Change Password</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="page-content">
                <div class="row justify-content-center">
                    <div class="col-sm-5">
                        <div class="auth-content">
                            <form action="{{ route('student.password_update') }}" method="post" class="row">
                                @csrf
                                <div class="col-sm-12">
                                    <div class="form-group mb-3">
                                        <label for="old_password" class="form-label">Old Password<span>*</span></label>
                                        <input type="password"
                                            class="form-control @error('old_password') is-invalid @enderror"
                                            name="old_password" value="{{ old('old_password') }}" id="old_password"
                                            required>
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
                                        <label for="new_password" class="form-label">New Password<span>*</span></label>
                                        <input type="password"
                                            class="form-control @error('new_password') is-invalid @enderror"
                                            name="new_password" value="{{ old('new_password') }}" id="new_password"
                                            required>
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
                                        <label for="confirm_password" class="form-label">Confirm
                                            Password<span>*</span></label>
                                        <input type="password"
                                            class="form-control @error('confirm_password') is-invalid @enderror"
                                            name="confirm_password" value="{{ old('confirm_password') }}"
                                            id="confirm_password" required>
                                        @error('confirm_password')
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
    </section>
@endsection
