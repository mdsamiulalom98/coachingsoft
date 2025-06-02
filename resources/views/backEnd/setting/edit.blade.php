@extends('backEnd.layouts.master')
@section('title','General Setting')
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
                        <h4 class="m-b-10">General Setting</h4>
                        </div>
                       <ul class="breadcrumb">
                          <li class="breadcrumb-item">
                            <a href="{{route('dashboard')}}">Dashboard</a>
                          </li>
                          <li class="breadcrumb-item active">
                           General Setting
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
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h6>General Setting</h6>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('settings.update') }}" method="POST" class="row"
                                data-parsley-validate="" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" value="{{ $edit_data->id }}" name="id">
                                <div class="col-sm-12">
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
                                <div class="col-sm-6 mb-3">
                                    <div class="form-group">
                                        <label for="white_logo" class="form-label">White Image *</label>
                                        <input type="file" class="form-control @error('white_logo') is-invalid @enderror"
                                            name="white_logo" value="{{ $edit_data->white_logo }}" id="white_logo">
                                        <img src="{{ asset($edit_data->white_logo) }}" class="circle_img" alt="">
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
                                        <label for="dark_logo" class="form-label">Dark Image *</label>
                                        <input type="file" class="form-control @error('dark_logo') is-invalid @enderror"
                                            name="dark_logo" value="{{ $edit_data->dark_logo }}" id="dark_logo">
                                        <img src="{{ asset($edit_data->dark_logo) }}" class="circle_img" alt="">
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
                                        <label for="favicon" class="form-label">Favicon *</label>
                                        <input type="file" class="form-control @error('favicon') is-invalid @enderror"
                                            name="favicon" value="{{ $edit_data->favicon }}" id="favicon">
                                        <img src="{{ asset($edit_data->favicon) }}" class="circle_img" alt="">
                                        @error('image')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <!-- col end --> 
                                <div class="col-sm-6">
                                    <div class="form-group mb-3">
                                        <label for="copy_right" class="form-label">Copyright *</label>
                                        <input type="text" class="form-control @error('copy_right') is-invalid @enderror"
                                            name="copy_right" value="{{ $edit_data->copy_right }}" id="copy_right" required="">
                                        @error('copy_right')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <!-- col-end -->
                                <div class="col-sm-6">
                                    <div class="form-group mb-3">
                                        <label for="inside_charge" class="form-label">Inside Delivery Charge *</label>
                                        <input type="text" class="form-control @error('inside_charge') is-invalid @enderror"
                                            name="inside_charge" value="{{ $edit_data->inside_charge }}" id="inside_charge" required="">
                                        @error('inside_charge')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <!-- col-end -->
                                <div class="col-sm-6">
                                    <div class="form-group mb-3">
                                        <label for="outside_charge" class="form-label">Outside Delivery Charge *</label>
                                        <input type="text" class="form-control @error('outside_charge') is-invalid @enderror"
                                            name="outside_charge" value="{{ $edit_data->outside_charge }}" id="outside_charge" required="">
                                        @error('outside_charge')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <!-- col-end -->
                                <div class="col-sm-4">
                                    <div class="form-group mb-3">
                                        <label for="primary_color" class="form-label">Primary Color *</label>
                                        <input type="color" class="form-control @error('primary_color') is-invalid @enderror"
                                            name="primary_color" value="{{ $edit_data->primary_color }}" id="primary_color" required="">
                                        @error('primary_color')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <!-- col-end -->
                                <div class="col-sm-4">
                                    <div class="form-group mb-3">
                                        <label for="secondary_color" class="form-label">Secondary Color *</label>
                                        <input type="color" class="form-control @error('secondary_color') is-invalid @enderror"
                                            name="secondary_color" value="{{ $edit_data->secondary_color }}" id="secondary_color" required="">
                                        @error('secondary_color')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <!-- col-end -->
                                <div class="col-sm-4">
                                    <div class="form-group mb-3">
                                        <label for="extra_color" class="form-label">Extra Color *</label>
                                        <input type="color" class="form-control @error('extra_color') is-invalid @enderror"
                                            name="extra_color" value="{{ $edit_data->extra_color }}" id="extra_color" required="">
                                        @error('extra_color')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <!-- col-end -->
                                <div>
                                    <input type="submit" class="btn btn-submit" value="Save Change">
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
