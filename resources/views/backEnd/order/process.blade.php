@extends('backEnd.layouts.master')
@section('title', 'Order Status Edit')
@push('css')
    <link rel="stylesheet" href="{{ asset('public/backEnd/assets/css/flatpickr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/backEnd/assets/css/dropify.min.css') }}">
    <link href="{{ asset('public/backEnd') }}/assets/css/summernote-lite.min.css" rel="stylesheet" type="text/css" />
@endpush
@section('content')
    <section class="wsit-container">
        <div class="wsit-content">
            <div class="page-header">
                <div class="page-block">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-auto">
                            <div class="page-header-title">
                                <h4 class="m-b-10">Order Status Edit</h4>
                            </div>
                            <ul class="breadcrumb">

                                <li class="breadcrumb-item">
                                    <a href="{{ route('dashboard') }}">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item active">
                                    Order Status Edit
                                </li>
                            </ul>
                        </div>
                        <div class="col-auto">
                            <div class="quick_btn">
                                <a href="{{ route('admin.orders', ['slug' => 'all']) }}"><i class="ti ti-plus"></i>
                                    Manage</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="page-content">
                <div class="row">
                    <div class="col-sm-12">
                        <form action="{{ route('admin.order_change') }}" method="POST" data-parsley-validate=""
                            enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{ $data->id }}">
                            <div class="card">
                                <div class="card-header">
                                    <h6>Order Process [Invoice : #{{ $data->invoice_id }}]</h6>
                                </div>
                                <div class="card">
                                    <div class="card-body">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>SL</th>
                                                    <th>Image</th>
                                                    <th>Product</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($data->orderdetails as $key => $product)
                                                    <tr>
                                                        <td>{{ $key + 1 }}</td>
                                                        <td><img src="{{ asset($product->book->image ?: '') }}"
                                                                height="50" width="50" alt=""></td>
                                                        <td>{{ $product->book_name }}</td>
                                                    </tr>
                                                @endforeach

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group mb-3">
                                                <label for="status" class="form-label">Order Status</label>
                                                <select
                                                    class="form-control form-select select2-multiple @error('status') is-invalid @enderror"
                                                    value="{{ old('status') }}" name="status" data-toggle="select2"
                                                    data-placeholder="Choose ..." required>

                                                    <option value="">Select..</option>
                                                    @foreach ($orderstatuses as $value)
                                                        <option value="{{ $value->id }}"
                                                            @if ($data->order_status == $value->id) selected @endif>
                                                            {{ $value->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('status')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        {{-- col end --}}

                                        

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
    <script src="{{ asset('public/backEnd/assets/js/flatpickr.js') }}"></script>
    <script src="{{ asset('public/backEnd/assets/js/dropify.min.js') }}"></script>
    <script>
        $(document).ready(function() {
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
