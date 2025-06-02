@extends('frontEnd.layouts.student.master')
@section('title', 'Enroll Courses')
@section('content')
    <section class="wsit-container">
        <div class="wsit-content">
            <div class="page-header">
                <div class="page-block">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-auto">
                            <div class="page-header-title">
                                <h4 class="m-b-10">Enrolled Course</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="page-content">
                <div class="container">
                    <div class="row">
                        @foreach ($enrcourses as $key => $value)
                            <div class="col-sm-4">
                                <div class="course-item">
                                    <div class="course-img">
                                        <a href="{{ route('course.details', ['id' => $value->id]) }}">
                                            <img src="{{ asset($value->course->image) }}" alt="">
                                        </a>
                                    </div>
                                    <div class="course-content">
                                        <a href="{{ route('course.details', ['id' => $value->id]) }}"
                                            class="course_name">{{ $value->course->title }}</a>
                                        <ul>
                                            <li class="course_fee">
                                                @if ($value->old_fee)
                                                    <del>{{ $value->old_fee }}</del>
                                                @endif {{ $value->course_fee }} Tk
                                            </li>
                                            <li>{{ $value->total_class }}</li>
                                        </ul>
                                        <a href="{{ route('course.details', ['id' => $value->id]) }}" class="course_btn">
                                            এনরোল করুন
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
