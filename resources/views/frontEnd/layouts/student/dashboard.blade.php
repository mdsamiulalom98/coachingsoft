@extends('frontEnd.layouts.student.master')
@section('title', 'Dashboard')
@section('content')
    <section class="wsit-container">
        <div class="wsit-content">
            <div class="page-header">
                <div class="page-block">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-auto">
                            <div class="page-header-title">
                                <h4 class="m-b-10">Student Dashboard</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="page-content">
                <div class="row">
                    <div class="paddleft-120 col-lg-12 col-md-12 col-sm-4">
                        <div class="customer-profile">
                            <div class="row">

                                <div class="col-sm-12">
                                    <div class="content-deshboard">
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <div class="counter-item bg-1">
                                                    <div class="counter-item-left">
                                                        <p><i class="fa fa-check-square"></i></p>
                                                    </div>
                                                    <div class="counter-item-right">
                                                        <p>Total Present</p>
                                                        <h5>{{ $totalpresent }}</h5>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- counter end -->
                                            <div class="col-sm-3">
                                                <div class="counter-item bg-2">
                                                    <div class="counter-item-left">
                                                        <p><i class="fa fa-thumbs-down"></i></p>
                                                    </div>
                                                    <div class="counter-item-right">
                                                        <p>Total Absent</p>
                                                        <h5>{{ $totalabsent }}</h5>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- counter end -->
                                            <div class="col-sm-3">
                                                <div class="counter-item bg-3">
                                                    <div class="counter-item-left">
                                                        <p><i class="fa fa-edit"></i></p>
                                                    </div>
                                                    <div class="counter-item-right">
                                                        <p>Total Exam</p>
                                                        <h5>{{ $totalexam ?? 0 }}</h5>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- counter end -->
                                            <div class="col-sm-3">
                                                <div class="counter-item bg-4">
                                                    <div class="counter-item-left">
                                                        <p><i class="fa fa-bell"></i></p>
                                                    </div>
                                                    <div class="counter-item-right">
                                                        <p>Notice</p>
                                                        <h5>{{ $totalnotice ?? 0 }}</h5>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- counter end -->
                                        </div>
                                    </div>
                                </div>

                                <div class="result_list_area">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-md-5 col-12">
                                                <div class="result_list">
                                                    <h3>Last 7 Days Attendance</h3>
                                                    <table class="table table-bordered table-striped">
                                                        <thead class="bg-success">
                                                            <th>SL.</th>
                                                            <th>Date</th>
                                                            <th>Status</th>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($attendances as $key => $value)
                                                                <tr>
                                                                    <td>{{ $loop->iteration }}</td>
                                                                    <td>{{ date('d-m-Y', strtotime($value->created_at)) }}
                                                                    </td>
                                                                    <td>{{ $value->status == 1 ? 'Present' : 'Absent' }}
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="col-md-7 col-12">
                                                <div class="result_list">
                                                    <h3>Last 7 Results</h3>
                                                    <table class="table table-bordered table-striped">
                                                        <thead class="bg-success">
                                                            <th>SL.</th>
                                                            <th>Date</th>
                                                            <th>Exam</th>
                                                            <th>Total</th>
                                                            <th>Marks</th>
                                                            <th>CQ</th>
                                                            <th>MCQ</th>
                                                            <th>HS</th>
                                                            <th>Position</th>
                                                        </thead>
                                                        <tbody>
                                                            {{-- @forelse($results as $key=>$value)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $value->created_at->format('d-m-y') }}</td>
                                        <td>{{ $value->exam ? $value->exam->title : '' }}</td>
                                        <td>{{ $value->exam ? $value->exam->marks : '' }}</td>
                                        <td><button
                                                class="@if (Auth::guard('student')->user()->id == $value->student_id) btn-success @endif">{{ $value->marks }}</button>
                                        </td>
                                        <td>{{ $value->cq }}</td>
                                        <td>{{ $value->mcq }}</td>
                                        <td>{{ $value->hs }}</td>
                                        <td>{{ $value->position }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5">Result processing</td>
                                    </tr>
                                @endforelse --}}
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
                </div>
            </div>
        </div>
    </section>
@endsection
