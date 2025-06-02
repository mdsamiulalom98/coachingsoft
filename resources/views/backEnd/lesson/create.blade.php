@extends('backEnd.layouts.master')
@section('title', 'Lesson Create')
@section('content')
<section class="wsit-container">
    <div class="wsit-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center justify-content-between">
                    <div class="col-auto">
                        <div class="page-header-title">
                        <h4 class="m-b-10">Lesson</h4>
                        </div>
                           <ul class="breadcrumb">

                              <li class="breadcrumb-item">
                                <a href="{{route('dashboard')}}">Dashboard</a>
                              </li>
                              <li class="breadcrumb-item active">
                                Lesson Create
                              </li>
                           </ul>
                    </div>
                    <div class="col-auto">
                        <div class="quick_btn">
                            <a href="{{route('lesson.index')}}"><i class="ti ti-plus"></i> Manage</a>
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
                            <h6>Lesson Create</h6>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('lesson.store') }}" method="POST" class="row"
                                data-parsley-validate="" enctype="multipart/form-data">
                                @csrf
                                <div class="col-sm-6">
                                    <div class="form-group mb-3">
                                        <label for="course_id" class="form-label">Course Select *</label> 
                                        <select class="form-control select2-multiple @error('course_id') is-invalid @enderror"
                                            name="course_id" id="course_id" data-toggle="select2" data-placeholder="Choose ..." required>
                                            <optgroup>
                                                <option value="">Select..</option>
                                                @foreach ($category_name as $value)
                                                    <option value="{{ $value->id }}">{{ $value->title }}</option>
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

                                <!-- Chapter Select Dropdown -->
                                <div class="col-sm-6">
                                    <div class="form-group mb-3">
                                        <label for="chapter_id" class="form-label">Chapter Select (Optional)</label>
                                        <select class="form-control select2 @error('chapter_id') is-invalid @enderror"
                                            id="chapter_id" name="chapter_id" data-placeholder="Choose ...">
                                            <optgroup>
                                                <option value="">Select..</option>
                                            </optgroup>
                                        </select>
                                        @error('chapter_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>


                                <div class="col-sm-4">
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

                                <div class="col-sm-4">
                                    <div class="form-group mb-3">
                                        <label for="duration" class="form-label">Duration *</label>
                                        <input type="text" class="form-control @error('duration') is-invalid @enderror"
                                            name="duration" value="{{ old('duration') }}" id="duration" required="">
                                        @error('duration')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <!-- col-end -->


                                <div class="col-sm-4">
                                    <div class="form-group mb-3">
                                        <label for="video" class="form-label">video *</label>
                                        <input type="text" class="form-control @error('video') is-invalid @enderror"
                                            name="video" value="{{ old('video') }}" id="video">
                                        @error('video')
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










@push('script')
    <script src="{{ asset('public/backEnd/') }}/assets/libs/parsleyjs/parsley.min.js"></script>
    <script src="{{ asset('public/backEnd/') }}/assets/js/pages/form-validation.init.js"></script>
    <script src="{{ asset('public/backEnd/') }}/assets/js/pages/form-advanced.init.js"></script>
    <!-- Plugins js -->
    <script src="{{ asset('public/backEnd/') }}/assets/libs//summernote/summernote-lite.min.js"></script>
    <script>
        $(".summernote").summernote({
            placeholder: "Enter Your Text Here",

        });
    </script>

    <script>
        $(document).ready(function() {
            var serialNumber = 1;
            $(".increment_btn").click(function() {
                var html = $(".clone_variable").html();
                var newHtml = html.replace(/stock\[\]/g, "stock[" + serialNumber + "]");
                $(".variable_product").after(newHtml);
                serialNumber++;
            });
            $("body").on("click", ".remove_btn", function() {
                $(this).parents(".increment_control").remove();
                serialNumber--;
            });
        });

        // course to chapter
        $("#course_id").on("change", function () {
            var ajaxId = $(this).val();
            if (ajaxId) {
                $.ajax({
                    type: "GET",
                    url: "{{ url('ajax-product-subcategory') }}?course_id=" + ajaxId,
                    success: function (res) {
                        if (res) {
                            $("#chapter_id").empty();
                            $("#chapter_id").append('<option value="">Choose...</option>');
                            $.each(res, function (key, value) {
                                $("#chapter_id").append('<option value="' + key + '">' + value + "</option>");
                            });
                        } else {
                            $("#chapter_id").empty();
                        }
                    },
                });
            } else {
                $("#chapter_id").empty();
            }
        });
    </script>
@endpush
@endsection
