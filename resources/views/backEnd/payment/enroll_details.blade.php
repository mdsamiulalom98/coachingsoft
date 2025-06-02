@extends('backEnd.layouts.master')
@section('title','Online Payment Details')
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
                        <h4 class="m-b-10">Online Payment Details</h4>
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
                            <h6>Online Course Payment</h6>
                        </div>
                        <div class="card-body">
                            <div class="payment-form mt-3">
                                <div class="table-responsive ">
                                    <table class="table table-bordered">
                                        <tbody>
                                            <tr>
                                                <td>Name</td>
                                                <td>{{$payment->name}}</td>
                                            </tr>
                                            <tr>
                                                <td>Phone</td>
                                                <td>{{$payment->phone}}</td>
                                            </tr>
                                            <tr>
                                                <td>Address</td>
                                                <td>{{$payment->address}}</td>
                                            </tr>
                                            <tr>
                                                <td>Course</td>
                                                <td>{{$payment->course?->title}}</td>
                                            </tr>
                                            <tr>
                                                <td>Amount</td>
                                                <td>{{$payment->amount}} Tk</td>
                                            </tr>
                                            <tr>
                                                <td>Method</td>
                                                <td>{{$payment->method}} Tk</td>
                                            </tr>
                                            <tr>
                                                <td>Trx</td>
                                                <td>{{$payment->trx_id}} Tk</td>
                                            </tr>
                                            <tr>
                                                <td>Sender</td>
                                                <td>{{$payment->sender_id}} Tk</td>
                                            </tr>
                                            <tr>
                                                <td>Status</td>
                                                <td>{{ucfirst($payment->status)}}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <div class="card bg-dark">
                                        <div class="card-body">
                                            <form action="{{route('course.online.payment_update')}}" method="post">
                                                @csrf
                                                <input type="hidden" value="{{$payment->id}}" name="id">
                                                <div class="form-group">
                                                    <label for="status" class="form-label">Select Status</label>
                                                    <select name="status" id="status" class="form-control" required>
                                                        <option value="">Select Status</option>
                                                        @foreach ($statuses as $status)
                                                        <option value="{{ $status }}" {{$status == $payment->status ? 'selected' : ''}}>{{ ucfirst($status) }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group mt-3">
                                                    <button class="btn btn-primary">Update Submit</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
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
