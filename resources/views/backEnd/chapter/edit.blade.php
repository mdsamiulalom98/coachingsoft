@extends('backEnd.layouts.master')
@section('title', 'Chapter Edit')
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
                            <form action="{{ route('chapter.update') }}" method="POST" class="row"
                                data-parsley-validate="" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" value="{{ $edit_data->id }}" name="hidden_id">

                                    <div class="col-sm-6">
                                        <div class="form-group mb-3">
                                            <label for="course_id" class="form-label">Course Select *</label>
                                            <select class="form-control select2-multiple @error('link') is-invalid @enderror"
                                                name="course_id" data-toggle="select2" data-placeholder="Choose ..." required>
                                                <optgroup>
                                                    <option value="">Select..</option>
                                                    @foreach ($course_name as $value)
                                                        <option value="{{ $value->id }}"
                                                            @if ($edit_data->course_id == $value->id) selected @endif>{{ $value->title }}
                                                        </option>
                                                    @endforeach
                                                </optgroup>
                                            </select>
                                            @error('course_id')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <!-- col end -->
                                    <div class="col-sm-6">
                                        <div class="form-group mb-3">
                                            <label for="title" class="form-label">Title *</label>
                                            <input type="text" class="form-control @error('title') is-invalid @enderror"
                                                name="title" value="{{ $edit_data->title }}" id="title" required="">
                                            @error('title')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <!-- col-end -->
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
