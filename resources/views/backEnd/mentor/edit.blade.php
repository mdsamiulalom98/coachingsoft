@extends('backEnd.layouts.master')
@section('title','Mentor Edit')
@section('content')
<section class="wsit-container">
    <div class="wsit-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center justify-content-between">
                    <div class="col-auto">
                        <div class="page-header-title">
                        <h4 class="m-b-10">Mentor</h4>
                        </div>
                           <ul class="breadcrumb">

                              <li class="breadcrumb-item">
                                <a href="{{route('dashboard')}}">Dashboard</a>
                              </li>
                              <li class="breadcrumb-item active">
                                Mentor Edit
                              </li>
                           </ul>
                    </div>
                    <div class="col-auto">
                        <div class="quick_btn">
                            <a href="{{route('mentors.index')}}"><i class="ti ti-plus"></i> Manage</a>
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
                            <h6>Mentor Edit</h6>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('mentors.store') }}" method="POST" class="row"
                                data-parsley-validate="" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" value="{{ $edit_data->id }}" name="id">
                                    <div class="col-sm-6">
                                        <div class="form-group mb-3">
                                            <label for="name" class="form-label">Name *</label>
                                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                                name="name" value="{{ $edit_data->name }}" id="name" required="">
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
                                            <label for="designation" class="form-label">Designation *</label>
                                            <input type="text" class="form-control @error('designation') is-invalid @enderror"
                                                name="designation" value="{{ $edit_data->designation }}" id="designation" required="">
                                            @error('designation')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <!-- col-end -->
                                    <div class="col-sm-12 mb-3">
                                        <div class="form-group">
                                            <label for="image" class="form-label">Image *</label>
                                            <input type="file" class="form-control @error('image') is-invalid @enderror"
                                                name="image" value="{{ $edit_data->image }}" id="image">
                                            <img src="{{ asset($edit_data->image) }}" alt="" class="circle_img">
                                            @error('image')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <!-- col end -->
                                    <div class="col-sm-12 mb-3">
                                        <div class="form-group">
                                            <div class="form-check form-switch">
                                              <input class="form-check-input" name="status" value="1" type="checkbox" id="id"  @if ($edit_data->status == 1) checked @endif>
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