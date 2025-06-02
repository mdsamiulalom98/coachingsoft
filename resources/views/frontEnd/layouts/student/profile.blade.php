@extends('frontEnd.layouts.student.master')
@section('title', 'Student Profile')
@section('content')


    <section class="wsit-container">
        <div class="wsit-content">
            <div class="page-header">
                <div class="page-block">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-auto">
                            <div class="page-header-title">
                                <h4 class="m-b-10">Student Profile</h4>
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
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="cprofile-details">
                                        <p class="account-title"> Account Information</p>
                                        <section class="profile_section">
                                            <div class="row justify-content-center">
                                                <div class="col-md-8">
                                                    <div class="profile-area">
                                                        <div class="profile-item">
                                                            <div class="profile_pic">
                                                                <a href="">
                                                                    <img src="{{ asset($memberInfo->image) }}"
                                                                        style="width:100px;" alt="">
                                                                </a>
                                                            </div>
                                                            <div class="profile-item-text">
                                                                <p>{{ $memberInfo->name }}</p>
                                                                <p class="st_id">ID. {{ $memberInfo->roll_number }}</p>
                                                            </div>
                                                        </div>

                                                        <div class="profile-info">
                                                            <h3>Student Information</h3>
                                                            <table class="table table-bordered">
                                                                <tbody>
                                                                    <tr>
                                                                        <td>Admission Date</td>
                                                                        <td>{{ date('M, d, Y', strtotime($memberInfo->adDate)) }}
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Name</td>
                                                                        <td>{{ $memberInfo->name }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Name</td>
                                                                        <td>{{ $memberInfo->s_number }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Type</td>
                                                                        <td>{{ $memberInfo->type == 1 ? 'Academic' : 'Admission' }}
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>ID</td>
                                                                        <td>{{ $memberInfo->roll_number }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Batch</td>
                                                                        <td>{{ $memberInfo->batch ? $memberInfo->batch->name : '' }}
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Date Of Birth</td>
                                                                        <td>{{ date('M, d, Y', strtotime($memberInfo->dob)) }}
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>College Name</td>
                                                                        <td>{{ $memberInfo->institute }}</td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>

                                                        <div class="profile-info">
                                                            <h3>Address Details</h3>
                                                            <table class="table table-bordered">
                                                                <tbody>
                                                                    <tr>
                                                                        <td>Address</td>
                                                                        <td class="st_address">{!! $memberInfo->address !!}</td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>

                                                        <div class="profile-info">
                                                            <h3>Parent / Guardian Details</h3>
                                                            <table class="table table-bordered">
                                                                <tbody>
                                                                    <tr>
                                                                        <td> Father Name </td>
                                                                        <td>{{ $memberInfo->fathername }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td> Mother Name </td>
                                                                        <td>{{ $memberInfo->mothername }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Guardian's Contact Number</td>
                                                                        <td>{{ $memberInfo->g_number }}</td>
                                                                    </tr>

                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </section>
                                        <section>
                                            <!-- Edit Profile Modal -->
                                            <div class="modal fade" id="editProfile" tabindex="-1"
                                                aria-labelledby="editProfileLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">

                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="editProfileLabel">Profile Edit</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>

                                                        <div class="modal-body">
                                                            <form action="{{ route('student.profile_update') }}"
                                                                method="POST" enctype="multipart/form-data">
                                                                @csrf
                                                                <div class="mb-3">
                                                                    <label class="form-label">Full Name</label>
                                                                    <input type="text" class="form-control"
                                                                        name="fullName"
                                                                        value="{{ $memberInfo->fullName }}">
                                                                </div>

                                                                <div class="mb-3">
                                                                    <label class="form-label">Phone/Email</label>
                                                                    <input type="text" class="form-control"
                                                                        name="phoneOremail"
                                                                        value="{{ $memberInfo->phoneOremail }}">
                                                                </div>

                                                                <div class="mb-3">
                                                                    <label class="form-label">Address</label>
                                                                    <textarea class="form-control" name="address" rows="3">{!! $memberInfo->address !!}</textarea>
                                                                </div>

                                                                <div class="mb-3">
                                                                    <label class="form-label">Image</label>
                                                                    <input type="file" class="form-control"
                                                                        name="image">
                                                                    <div class="mt-2">
                                                                        <img src="{{ asset($memberInfo->image) }}"
                                                                            alt="Profile Image"
                                                                            style="width: 50px; height: 50px; border-radius: 50%;">
                                                                    </div>
                                                                </div>

                                                                <div class="mb-3 text-end">
                                                                    <button type="submit" class="btn btn-success">Save
                                                                        Change</button>
                                                                </div>
                                                            </form>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </section>
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
