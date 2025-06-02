@extends('backEnd.layouts.master')
@section('title','User Create')
@push('css')
<!-- DataTables JS -->
<link href="https://cdn.datatables.net/2.2.2/css/dataTables.dataTables.css">
@endpush
@section('content')
<section class="wsit-container">
    <div class="wsit-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center justify-content-between">
                    <div class="col-auto">
                        <div class="page-header-title">
                        <h4 class="m-b-10">User Manage</h4>
                        </div>
                       <ul class="breadcrumb">
                          <li class="breadcrumb-item">
                            <a href="{{route('dashboard')}}">Dashboard</a>
                          </li>
                          <li class="breadcrumb-item active">
                            User Create
                          </li>
                       </ul>
                    </div>
                   
                    <div class="col-auto">
                        <div class="quick_btn">
                            <a href="{{route('users.index')}}"><i class="ti ti-device-desktop-check"></i> Manage</a>
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
                            <h6>User Create</h6>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('users.store') }}" method="POST" class="row"
                                data-parsley-validate="" enctype="multipart/form-data">
                                @csrf
                                <div class="col-sm-6">
                                    <div class="form-group mb-3">
                                        <label for="name" class="form-label">Name *</label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                            name="name" value="{{ old('name') }}" id="name" required="">
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
                                            name="email" value="{{ old('email') }}" id="email" required="">
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
                                            name="password" value="{{old('password')}}" id="password">
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
                                            name="confirm-password" value="{{old('confirm-password')}}" id="confirm-password">
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
                                                    <option value="{{ $role->name }}">
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
                                            name="image" value="{{old('image') }}" id="image">
                                        @error('image')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <!-- col end -->
                                <div class="col-sm-6 mb-3">
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
                                <div>
                                    <input type="submit" class="btn btn-submit" value="Submit">
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
