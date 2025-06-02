@extends('backEnd.layouts.master')
@section('title','Course Enroll Payment')
@section('content')
     @php
            $statuses = ['paid', 'rejected'];
            $statusConfig = [
                'paid' => [
                    'class' => 'btn-info',
                    'icon' => 'loader',
                ],
                'rejected' => [
                    'class' => 'btn-danger',
                    'icon' => 'x-circle',
                ],
            ];
    @endphp

   <section class="wsit-container">
    <div class="wsit-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center justify-content-between">
                    <div class="col-auto">
                        <div class="page-header-title">
                        <h4 class="m-b-10">Course Enroll Payment</h4>
                        </div>
                           <ul class="breadcrumb">
                              <li class="breadcrumb-item">
                                <a href="{{route('dashboard')}}">Dashboard</a>
                              </li>
                              <li class="breadcrumb-item active">
                                Payment
                              </li>
                           </ul>
                    </div>
                    <div class="col-auto">
                        <div class="quick_btn">
                            {{-- <a href="{{route('students.create')}}"><i class="ti ti-plus"></i> Payment List</a> --}}
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
                            <h6>Course Enroll Payment</h6>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12">
                                      <a href="{{route('enroll.payment',['slug'=>'all'])}}" class="btn rounded-pill btn-primary">All</a>
                                        @foreach ($statuses as $status)
                                            <a href="{{route('enroll.payment',['slug'=>$status])}}" class="btn rounded-pill {{ $statusConfig[$status]['class'] }}"><i
                                                    class="fe-{{ $statusConfig[$status]['icon'] }}"></i>
                                                {{ ucfirst($status) }}</a>
                                       
                                    @endforeach
                                </div>
                            </div>
                            <div class="payment-form mt-3">
                                   <div class="table-responsive ">
                            <table id="datatable-buttons" class="table table-striped w-100">
                                <thead>
                                    <tr>
                                        <th>Invoice</th>
                                        <th>Name</th>
                                        <th>Phone</th>
                                        <th>Course</th>
                                        <th>Fee</th>
                                        <th>Trx</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($payments as $key => $value)
                                        <tr>
                                            <td>{{$value->invoice_id}}</td>
                                            <td> {{ $value->name}}</td>
                                            <td> {{ $value->phone}}</td>
                                            <td> {{ $value->course?->title}}</td>
                                            <td>{{ $value->amount }}</td>
                                            <td>{{ $value->trx_id }}</td>
                                            <td>{{ $value->status }}</td>
                                            <td><a href="{{route('enroll.payment.details',$value->id)}}" class="btn btn-success">View</a></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>  
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
