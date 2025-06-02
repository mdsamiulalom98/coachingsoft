@extends('backEnd.layouts.master')
@section('title','Role Create')
@section('content')
<section class="wsit-container">
    <div class="wsit-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center justify-content-between">
                    <div class="col-auto">
                        <div class="page-header-title">
                        <h4 class="m-b-10">Role Create</h4>
                        </div>
                       <ul class="breadcrumb">
                          <li class="breadcrumb-item">
                            <a href="{{route('dashboard')}}">Dashboard</a>
                          </li>
                          <li class="breadcrumb-item active">
                            Role Create
                          </li>
                       </ul>
                    </div>
                    <div class="col-auto">
                        <div class="quick_btn">
                            <a href="{{route('roles.index')}}"><i class="ti ti-device-desktop-check"></i> Manage</a>
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
                            <h6>Role Create</h6>
                        </div>
                        <div class="card-body">
                            <form action="{{route('roles.store')}}" method="POST">
                                @csrf
                                @csrf
                                <div class="col-sm-12">
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
                                <div class="col-sm-12 mb-3">
                                    <div class="form-check">
                                          <input class="form-check-input" type="checkbox" value="" id="checkbox">
                                          <label class="form-check-label" for="checkbox">
                                           Check All
                                          </label>
                                    </div>
                                    <div class="row">
                                        @foreach ($permission as $value)
                                            <div class="col-sm-4">
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input" value="{{ $value->id }}"
                                                        id="customCheck{{ $value->id }}" name="permission[]">
                                                    <label class="form-check-label"
                                                        for="customCheck{{ $value->id }}">{{ $value->name }}</label>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="col-sm-12">
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