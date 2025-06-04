@extends('frontEnd.layouts.student.master')
@section('title', 'Enrolled Courses')
@push('css')
    <link rel="stylesheet" href="{{ asset('public/frontEnd/css/grt-youtube-popup.css') }}">
@endpush
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
            <div class="video-details-inner">
                <div class="course-video-details">
                    <div class="accordion accordion-flush" id="accordion_video">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#course_video" aria-expanded="false">
                                    কোর্স কারিকুলাম
                                </button>
                            </h2>
                            <div id="course_video" class="accordion-collapse collapse show"
                                data-bs-parent="#accordion_video">
                                <div class="accordion-body">
                                    @foreach ($chapters as $chapter)
                                        <ul>
                                            <li>{{ $chapter->title }}</li>
                                        </ul>
                                        @foreach ($chapter->lesson as $value)
                                            @php
                                                $isActive = request('play') == $value->id;
                                            @endphp
                                            <div class="video_item {{ $isActive ? 'active' : '' }}">
                                                <div class="video_name">
                                                    <span><i class="fa-brands fa-youtube"></i></span>
                                                    <span>
                                                        @if ($value->video)
                                                            <a
                                                                href="{{ route('course.video', ['course' => $value->course_id, 'play' => $value->id]) }}">
                                                                {{ Str::limit(strip_tags($value->title), 25) }} </a>
                                                        @else
                                                            {{ Str::limit(strip_tags($value->title), 25) }} </a>
                                                        @endif
                                                    </span>
                                                </div>
                                                <div class="video_length">
                                                    <span>{{ $value->duration }} -- {{ request('play') }}</span>
                                                    <span><i class="fa-solid fa-lock"></i></span>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="course-details-img">
                    <div class="video-inner">
                        <iframe src="https://www.youtube.com/embed/{{ $play_video->video }}" frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                            referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                    </div>
                </div>
            </div>
        </div>
    </section>




@endsection
