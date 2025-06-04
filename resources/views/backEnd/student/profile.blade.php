@extends('backEnd.layouts.master')
@section('title', 'Student Manage')
@section('content')
    <section class="wsit-container">
        <div class="wsit-content">
            <div class="page-header">
                <div class="page-block">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-auto">
                            <div class="page-header-title">
                                <h4 class="m-b-10">Student</h4>
                            </div>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('dashboard') }}">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item active">
                                    Student Manage
                                </li>
                            </ul>
                        </div>
                        <div class="col-auto">
                            <div class="quick_btn">
                                <a href="{{ route('students.create') }}"><i class="ti ti-plus"></i> New</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="page-content">

                <div class="row">
                    <div class="col-sm-12">
                        <div class="card-header">
                            <h6>Student Manage</h6>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="card card-outline card-primary mt-2">
                                    <div class="card-body p-3 box-profile">
                                        <div class="text-center">
                                            <img class="profile-user-img img-fluid img-circle"
                                                src="{{ asset($details->image) }}" alt="User profile picture">
                                        </div>

                                        <h3 class="profile-username text-center">{{ $details->name }}</h3>

                                        <p class="text-muted text-center">{{ $details->roll_number }}</p>

                                        <ul class="list-group list-group-unbordered mb-3">
                                            <li class="list-group-item">
                                                <b>Admit Type</b> <a class="float-right">
                                                    @if ($details->type == 1)
                                                        Academic
                                                    @elseif($details->type == 2)
                                                        Admission
                                                    @else
                                                        Pre-Admission
                                                    @endif
                                                </a>
                                            </li>
                                            <li class="list-group-item">
                                                <b>Class</b> <a class="float-right">{{ $details->class->classtype }}</a>
                                            </li>
                                            <li class="list-group-item">
                                                <b>Batch</b> <a
                                                    class="float-right">{{ $details->batch ? $details->batch->name : '' }}</a>
                                            </li>
                                            <li class="list-group-item">
                                                <b>Admission Form</b> <a class="float-right"
                                                    href="{{ url('editor/student/admission-form/' . $details->id) }}"><i
                                                        class="fas fa-print"></i> Print</a>
                                            </li>
                                        </ul>

                                    </div>
                                    <!-- /.card-body -->
                                    <!-- /.card -->
                                </div>

                            </div>
                            <!-- /.col -->
                            <div class="col-md-9">
                                <div class="card">
                                    <div class="card-header p-2">
                                        <ul class="nav nav-pills">
                                            <li class="nav-item"><a class="nav-link active" href="#profile"
                                                    data-bs-toggle="tab">Profile</a></li>
                                            <li class="nav-item"><a class="nav-link" href="#payment"
                                                    data-bs-toggle="tab">Payment</a>
                                            </li>
                                            <li class="nav-item"><a class="nav-link" href="#result"
                                                    data-bs-toggle="tab">Result</a>
                                            </li>
                                            <li class="nav-item"><a class="nav-link" href="#attendance"
                                                    data-bs-toggle="tab">Attendance</a></li>
                                        </ul>
                                    </div><!-- /.card-header -->
                                    <div class="card-body">
                                        <div class="tab-content">
                                            <div class="active tab-pane" id="profile">
                                                <div class="profile_item">
                                                    <h3>Student Information</h3>
                                                    <table class="table table-bordered">
                                                        <tbody>
                                                            <tr>
                                                                <td>Admission Date</td>
                                                                <td>{{ date('M d, Y', strtotime($details->adDate)) }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Name</td>
                                                                <td>{{ $details->name }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Roll Number</td>
                                                                <td>{{ $details->roll_number }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Phone Number</td>
                                                                <td>0{{ $details->s_number }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Date Of Birth</td>
                                                                <td>{{ date('M d, Y', strtotime($details->dob)) }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>College Name</td>
                                                                <td>{{ $details->institute }}</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="profile_item">
                                                    <h3>Address Detail</h3>
                                                    <table class="table table-bordered">
                                                        <tbody>
                                                            <tr>
                                                                <td>Present Address</td>
                                                                <td>{!! $details->address !!}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Parmenent Address</td>
                                                                <td>{!! $details->parmanent_address !!}</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>

                                                <div class="profile_item">
                                                    <h3>Parent / Guardian Details</h3>
                                                    <table class="table table-bordered">
                                                        <tbody>
                                                            <tr>
                                                                <td>Father Name</td>
                                                                <td>{{ $details->fathername }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Profession</td>
                                                                <td>{{ $details->father_profession }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Mother Name</td>
                                                                <td>{{ $details->mothername }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Profession</td>
                                                                <td>{{ $details->mother_profession }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Guardian's Contact Number</td>
                                                                <td>0{{ $details->g_number }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Local Guardian</td>
                                                                <td>{{ $details->local_guardian }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Relation</td>
                                                                <td>{{ $details->lg_relation }}</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="profile_item">
                                                    <h3>Academic Qualification</h3>
                                                    <table class="table table-bordered">
                                                        <thead>
                                                            <tr>
                                                                <td>Exam Name</td>
                                                                <td>School/College</td>
                                                                <td>Board</td>
                                                                <td>Year</td>
                                                                <td>Roll</td>
                                                                <td>Reg</td>
                                                                <td>GPA</td>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>S.S.C</td>
                                                                <td>{{ $details->ssc_institute }}</td>
                                                                <td>{{ $details->ssc_board }}</td>
                                                                <td>{{ $details->ssc_year }}</td>
                                                                <td>{{ $details->ssc_roll }}</td>
                                                                <td>{{ $details->ssc_reg }}</td>
                                                                <td>{{ $details->ssc_gpa }}</td>
                                                            </tr>
                                                            <tr>
                                                            <tr>
                                                                <td>H.S.C</td>
                                                                <td>{{ $details->hsc_institute }}</td>
                                                                <td>{{ $details->hsc_board }}</td>
                                                                <td>{{ $details->hsc_year }}</td>
                                                                <td>{{ $details->hsc_roll }}</td>
                                                                <td>{{ $details->hsc_reg }}</td>
                                                                <td>{{ $details->hsc_gpa }}</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <!-- /.tab-pane -->

                                            <div class="tab-pane" id="payment">
                                                <div class="pay_item">
                                                    <table class="table table-bordered table-striped">
                                                        <thead>
                                                            <th>SL.</th>
                                                            <th>Date</th>
                                                            <th>Amount</th>
                                                            <th>Status</th>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($paymentlist as $key => $value)
                                                                <tr>
                                                                    <td>{{ $loop->iteration }}</td>
                                                                    <td>{{ date('M d, Y', strtotime($value->payDate)) }}
                                                                    </td>
                                                                    <td>{{ $value->amount }}</td>
                                                                    <td>{{ $value->status == 1 ? 'Paid' : 'Due' }}</td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <!-- /.tab-pane -->

                                            <div class="tab-pane" id="result">
                                                <div class="result_item">
                                                    <table class="table table-bordered">
                                                        <thead>
                                                            <tr>
                                                                <th>SL.</th>
                                                                <th>Date</th>
                                                                <th>Exam</th>
                                                                <th>Total</th>
                                                                <th>Marks</th>
                                                                <th>CQ</th>
                                                                <th>MCQ</th>
                                                                <th>Position</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>

                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <!-- /.tab-pane -->

                                            <div class="tab-pane" id="attendance">
                                                <div class="result_item">
                                                    <table class="table table-bordered">
                                                        <thead>
                                                            <tr>
                                                                <th>SL.</th>
                                                                <th>Date</th>
                                                                <th>Staus</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($attendance as $key => $value)
                                                                <tr>
                                                                    <td>{{ $loop->iteration }}</td>
                                                                    <td>{{ $value->created_at }}</td>
                                                                    <td>
                                                                        @if ($value->status == 1)
                                                                            Present
                                                                        @elseif($value->status == 0)
                                                                            Absent
                                                                        @else
                                                                        @endif
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <!-- /.tab-pane -->
                                        </div>
                                        <!-- /.tab-content -->
                                    </div><!-- /.card-body -->
                                </div>
                                <!-- /.nav-tabs-custom -->
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </div><!-- /.container-fluid -->
                </div>
            </div>
        </div>
    </section>
@endsection
