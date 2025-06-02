@extends('backEnd.layouts.master')
@section('title','Book Edit')
@push('css')
<link rel="stylesheet" href="{{asset('public/backEnd/assets/css/flatpickr.min.css')}}">
<link rel="stylesheet" href="{{asset('public/backEnd/assets/css/dropify.min.css')}}">
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
                        <h4 class="m-b-10">Book Edit</h4>
                        </div>
                           <ul class="breadcrumb">

                              <li class="breadcrumb-item">
                                <a href="{{route('dashboard')}}">Dashboard</a>
                              </li>
                              <li class="breadcrumb-item active">
                                Book Edit
                              </li>
                           </ul>
                    </div>
                    <div class="col-auto">
                        <div class="quick_btn">
                            <a href="{{route('books.index')}}"><i class="ti ti-plus"></i> Manage</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="page-content">
            <div class="row">
                <div class="col-sm-12">
                    <form action="{{ route('books.update') }}" method="POST" 
                    data-parsley-validate="" enctype="multipart/form-data">
                    @csrf
                        <input type="hidden" name="id" value="{{$edit_data->id}}">
                        <div class="card">
                            <div class="card-header">
                                <h6>Book Edit</h6>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group mb-3">
                                            <label for="mentor_id" class="form-label">Mentor <span>*</span></label>
                                            <select class="form-control select2" name="mentor_id" id="mentor_id" required>
                                                <option value="">Select..</option>
                                                @foreach ($mentors as $key=>$value)
                                                 <option value="{{ $value->id }}" {{$edit_data->mentor_id == $value->id ? 'selected' : ''}}>{{ $value->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('mentor_id')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <!-- col end -->
                                    <div class="col-sm-4">
                                        <div class="form-group mb-3">
                                            <label for="category_id" class="form-label">Category <span>*</span></label>
                                            <select class="form-control select2" name="category_id" id="category_id" required>
                                                <option value="">Select..</option>
                                                @foreach($categories as $key=>$value)
                                                 <option value="{{$value->id}}" {{$edit_data->category_id == $value->id ?'selected' : ''}}>{{$value->name}}</option>
                                                @endforeach
                                            </select>
                                            @error('category_id')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <!-- col end -->
                                    <div class="col-sm-4">
                                        <div class="form-group mb-3">
                                            <label for="title" class="form-label">Book <span>*</span></label>
                                            <input type="text" class="form-control @error('title') is-invalid @enderror"
                                                name="title" value="{{ $edit_data->title }}" id="title" required>
                                            @error('title')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    {{-- col end --}}                                    
                                    <div class="col-sm-4">
                                        <div class="form-group mb-3">
                                            <label for="old_price" class="form-label">Old Price</label>
                                            <input type="text" class="form-control @error('old_price') is-invalid @enderror"
                                                name="old_price" value="{{$edit_data->old_price }}" id="old_price">
                                            @error('old_price')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    {{-- col end --}}
                                    <div class="col-sm-4">
                                        <div class="form-group mb-3">
                                            <label for="price" class="form-label">Price<span>*</span></label>
                                            <input type="text" class="form-control @error('price') is-invalid @enderror"
                                                name="price" value="{{ $edit_data->price }}" id="price" required>
                                            @error('price')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    {{-- col end --}}

                                    <div class="col-sm-4">
                                        <div class="form-group mb-3">
                                            <label for="total_page" class="form-label">Total Page <span>*</span></label>
                                            <input type="text" class="form-control @error('total_page') is-invalid @enderror"
                                                name="total_page" value="{{ $edit_data->total_page }}" id="total_page" required>
                                            @error('total_page')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    {{-- col end --}}

                                    <div class="col-sm-4">
                                        <div class="form-group mb-3">
                                            <label for="stock" class="form-label">Stock <span>*</span></label>
                                            <input type="text" class="form-control @error('stock') is-invalid @enderror"
                                                name="stock" value="{{ $edit_data->stock }}" id="stock" required>
                                            @error('stock')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    {{-- col end --}}


                                    <div class="col-sm-4">
                                        <div class="form-group mb-3">
                                            <label for="image" class="form-label">Image <span>*</span></label>
                                            <input type="file" class="form-control @error('image') is-invalid @enderror"
                                                name="image" value="{{old('image') }}" id="image">
                                            <img src="{{asset($edit_data->image)}}" class="circle_img" alt="">
                                            @error('image')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    {{-- col end --}}
                                    <div class="col-sm-12">
                                        <div class="form-group mb-3">
                                            <label for="description" class="form-label">Description <span>*</span></label>
                                            <textarea type="file" class="summernote form-control @error('description') is-invalid @enderror"
                                                name="description" value="{{old('description') }}" id="description" required>{!! $edit_data->description  !!}</textarea>
                                            @error('description')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    {{-- col end --}}
                                    
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
                                    
                                </div>
                            </div>
                        </div>
                        {{-- card end --}}
                        <div class="submit">
                            <button type="submit" class="btn btn-success btn-lg">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('script')
<script src="{{asset('public/backEnd/assets/js/flatpickr.js')}}"></script>
<script src="{{asset('public/backEnd/assets/js/dropify.min.js')}}"></script>
<script>
    $(document).ready(function () {
        $('.dropify').dropify();
    });
</script>
<script src="{{ asset('public/backEnd/') }}/assets/js/summernote-lite.min.js"></script>
<script>
    $(".summernote").summernote({
        placeholder: "Enter Your Text Here",
    });
</script>

@endpush