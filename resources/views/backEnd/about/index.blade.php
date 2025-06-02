@extends('backEnd.layouts.master')
@section('title','About us')
@push('css')
<link href="{{ asset('public/backEnd') }}/assets/css/summernote-lite.min.css" rel="stylesheet"
        type="text/css" />
@endpush
@section('content')
<section class="wsit-container">
    <div class="wsit-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center justify-content-between">
                    <div class="col-auto">
                        <div class="page-header-title">
                        <h4 class="m-b-10">About us</h4>
                        </div>
                       <ul class="breadcrumb">
                          <li class="breadcrumb-item">
                            <a href="{{route('dashboard')}}">Dashboard</a>
                          </li>
                          <li class="breadcrumb-item active">
                           About us
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
                            <h6>Contact us</h6>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('about.update') }}" method="POST" class="row"
                                data-parsley-validate="" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" value="{{ $edit_data->id }}" name="id">
                                <div class="col-sm-6">
                                    <div class="form-group mb-3">
                                        <label for="image" class="form-label">Image <span>*</span></label>
                                        <input type="file" class="form-control @error('image') is-invalid @enderror"
                                            name="image" value="{{ $edit_data->image }}" id="image" required>
                                            <img src="{{asset($edit_data->image)}}"  class="circle_img">
                                        @error('image')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group mb-3">
                                        <label for="title" class="form-label">Title <span>*</span></label>
                                        <input type="text" class="form-control @error('title') is-invalid @enderror"
                                            name="title" value="{{ $edit_data->title }}" id="title" required>
                                        @error('title')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <div class="form-group mb-3">
                                        <label for="sub_title" class="form-label">Sub Title <span>*</span></label>
                                        <input type="text" class="form-control @error('sub_title') is-invalid @enderror"
                                            name="sub_title" value="{{ $edit_data->sub_title }}" id="sub_title" required>
                                        @error('sub_title')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <div class="form-group mb-3">
                                        <label for="short_description" class="form-label">Short Description <span>*</span></label>
                                        <textarea type="text" class="form-control @error('short_description') is-invalid @enderror summernote"
                                            name="short_description"  id="short_description">{!! $edit_data->short_description !!}</textarea>
                                        @error('short_description')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group mb-3">
                                        <label for="description" class="form-label">Description <span>*</span></label>
                                        <textarea type="text" class="form-control @error('description') is-invalid @enderror summernote"
                                            name="description" id="description">{!! $edit_data->description !!}</textarea>
                                        @error('description')
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

@push('script')
<script src="{{ asset('public/backEnd/') }}/assets/js/summernote-lite.min.js"></script>
<script>
    $(".summernote").summernote({
        placeholder: "Enter Your Text Here",
    });
</script>
@endpush
