@extends('frontEnd.layouts.master')
@section('title', $details->title)
@section('content')
    <div class="page-breadcumb text-start">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-banner">
                        <h2 class="page-name">{{ $details->title }}</h2>
                        <p>কাট্যেগরি - {{ $details->category }}</p>
                        <p>সময় : {{ $details->time }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- page-breadcrumb --}}

    <div class="course-details-section">
        <div class="container">
            <div class="row">
                <div class="col-sm-8">
                    <div class="course-details">
                        <div class="course-title">
                            <h4>কোর্স কারিকুলাম</h4>
                        </div>
                        <div class="course-curriculam">
                            <div class="accordion" id="course_accordion">
                                @foreach ($details->chapters as $key => $value)
                                    <div class="accordion-item">
                                        <h2 class="accordion-header">
                                            <button class="accordion-button collapsed" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#course_{{ $key }}"
                                                aria-expanded="true" aria-controls="course_{{ $key }}">
                                                {{ $key + 1 }}. {{ $value->title }}
                                            </button>
                                        </h2>
                                        <div id="course_{{ $key }}" class="accordion-collapse collapse"
                                            data-bs-parent="#course_accordion">
                                            <div class="accordion-body">
                                                @if (count($value->lesson) > 0)
                                                    <ul class="lesson-list">
                                                        @foreach ($value->lesson as $lesson)
                                                            <li>
                                                                <p><i class="fa-solid fa-lock"></i> {{ $lesson->title }}</p>
                                                                <p>{{ $lesson->duration }}</p>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                @else
                                                    No lessons available.
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="description-title">
                            <h4>বিস্তারিত</h4>
                        </div>
                        <div class="course-description">
                            <div>{!! $details->description !!}</div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="course-video">
                        <div class="youtube-video">
                            <iframe src="https://www.youtube.com/embed/s1Ui9n5ltTU?si=Qj3AdpIw9730o6tE" frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                        </div>
                        <div class="course-price course-modal">
                            <h1>{{ $details->course_fee }} Tk</h1>
                            <button class="course_btn" data-bs-toggle="modal" data-bs-target="#enroll_modal">এনরোল
                                করুন</button>
                            <div class="modal fade" id="enroll_modal" tabindex="-1" aria-labelledby="enroll_modalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog modal-dialog-scrollable">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title" id="enroll_modalLabel">Payment Form</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="payment-form-body">
                                                <form action="{{ route('course.order.save') }}" method="POST"
                                                    class="course-form row">
                                                    @csrf
                                                    <ul>
                                                        <li>
                                                            <h4>Course Fee</h4>
                                                            <p>{{ $details->course_fee }} Tk</p>
                                                        </li>
                                                        <li class="mt-2">
                                                            <h4>Bkash Number</h4>
                                                            <p>01742892725 (Send Money)</p>
                                                        </li>
                                                    </ul>
                                                    <input type="hidden" name="course_id" value="{{ $details->id }}" />
                                                    <div class="col-sm-12">
                                                        <div class="form-group mb-3">
                                                            <label for="name" class="mb-2"><i
                                                                    class="fa-solid fa-user"></i> Full Name *</label>
                                                            <input type="text" id="name"
                                                                class="form-control @error('name') is-invalid @enderror"
                                                                name="name"
                                                                value="{{ Auth::guard('student')->check() ? Auth::guard('student')->user()->name : old('name') }}"
                                                                placeholder="" required />
                                                            @error('name')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <!-- col-end -->
                                                    <div class="col-sm-12">
                                                        <div class="form-group mb-3">
                                                            <label for="phone" class="mb-2"><i
                                                                    class="fa-solid fa-phone"></i> Mobile Number *</label>
                                                            <input type="text" minlength="11" id="number"
                                                                maxlength="11" pattern="0[0-9]+"
                                                                title="please enter number only and 0 must first character"
                                                                title="Please enter an 11-digit number." id="phone"
                                                                class="form-control @error('phone') is-invalid @enderror"
                                                                name="phone"
                                                                value="{{ Auth::guard('student')->check() ? Auth::guard('student')->user()->phone_number : old('phone') }}"
                                                                placeholder="" required />
                                                            @error('phone')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <!-- col-end -->
                                                    <div class="col-sm-12">
                                                        <div class="form-group mb-3">
                                                            <label for="address" class="mb-2"><i
                                                                    class="fa-solid fa-map"></i> Full Address *</label>
                                                            <input type="address" id="address"
                                                                class="form-control @error('address') is-invalid @enderror"
                                                                name="address" placeholder=""
                                                                value="{{ Auth::guard('student')->check() ? Auth::guard('student')->user()->present_address : old('address') }}"
                                                                required />
                                                            @error('email')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="new">
                                                        <button type="submit"
                                                            class="btn-submit d-block course_btn">কনফার্ম করুন</button>
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
    </div>
    {{-- course end --}}

    @push('script')
        <script>
            let questions = document.querySelectorAll(".faq_question");

            questions.forEach((question) => {
                let icon = question.querySelector(".icon-shape");

                question.addEventListener("click", (event) => {
                    const active = document.querySelector(".faq_question.active");
                    const activeIcon = document.querySelector(".icon-shape.active");

                    if (active && active !== question) {
                        active.classList.toggle("active");
                        activeIcon.classList.toggle("active");
                        active.nextElementSibling.style.maxHeight = 0;
                    }

                    question.classList.toggle("active");
                    icon.classList.toggle("active");

                    const answer = question.nextElementSibling;

                    if (question.classList.contains("active")) {
                        answer.style.maxHeight = answer.scrollHeight + "px";
                    } else {
                        answer.style.maxHeight = 0;
                    }
                });
            });
        </script>
    @endpush

@endsection
