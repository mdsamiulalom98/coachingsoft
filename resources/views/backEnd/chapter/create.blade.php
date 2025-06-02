@extends('backEnd.layouts.master')
@section('title', 'Chapter Create')
@section('content')

<section class="wsit-container">
    <div class="wsit-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center justify-content-between">
                    <div class="col-auto">
                        <div class="page-header-title">
                        <h4 class="m-b-10">Chapter</h4>
                        </div>
                           <ul class="breadcrumb">

                              <li class="breadcrumb-item">
                                <a href="{{route('dashboard')}}">Dashboard</a>
                              </li>
                              <li class="breadcrumb-item active">
                                Chapter Create
                              </li>
                           </ul>
                    </div>
                    <div class="col-auto">
                        <div class="quick_btn">
                            <a href="{{route('chapter.index')}}"><i class="ti ti-plus"></i> Manage</a>
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
                            <h6>Chapter Create</h6>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('chapter.store') }}" method="POST" class="row" data-parsley-validate=""
                                enctype="multipart/form-data">
                                @csrf
                                <div class="col-sm-6">
                                    <div class="form-group mb-3">
                                        <label for="course_id" class="form-label">Course Select * </label>
                                        <select class="form-control select2-multiple @error('link') is-invalid @enderror"
                                            name="course_id" data-toggle="select2" data-placeholder="Choose ..." required>
                                            <optgroup>
                                                <option value="">Select..</option>
                                                @foreach ($category_name as $value)
                                                    <option value="{{ $value->id }}">{{ $value->title }}
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
                                            name="title" value="{{ old('title') }}" id="title" required="">
                                        @error('title')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <!-- col-end -->
                                
                                
                                <!-- col-end -->
                                 <div class="col-sm-12 mb-3">
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
