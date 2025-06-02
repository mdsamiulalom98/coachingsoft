@extends('frontEnd.layouts.master')
@section('title','Home')
@push('css')
	<link rel="stylesheet" href="{{asset('public/frontEnd/css/owl.carousel.min.css')}}">
	<link rel="stylesheet" href="{{asset('public/frontEnd/css/owl.theme.default.min.css')}}">
@endpush

@section('content')
<div class="slider-section">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<div class="slider owl-carousel">
					@foreach($sliders as $key=>$value)
					<div class="slider-item">
						<img src="{{asset($value->image)}}" alt="">
					</div>
					@endforeach
				</div>
			</div>
		</div>
		{{-- row end --}}
	</div>
	{{-- container end --}}
</div>
{{-- slider section end --}}

<div class="counter-section">
	<div class="container">
		<div class="row">
			<div class="row">
				<div class="col-sm-12">
					<div class="counter-heading">
						<h2>উচ্চ মাধ্যমিক ও মেডিকেল ভর্তি পরীক্ষায় সফলতার নির্ভরযোগ্য ঠিকানা</h2>
						<p>নিশ্চিত সফলতার পথচলায় তোমার সঙ্গী — অনলাইন ও অফলাইনে এক্সপার্ট মেন্টরদের সাথে স্মার্ট প্রস্তুতির সম্পূর্ণ প্যাকেজ!</p>
					</div>
				</div>
			</div>
			{{-- counter heading end --}}
			<div class="row">
				<div class="col-sm-3 col-6">
					<div class="counter-item">
						<div class="counter-content">
							<i class="fa-solid fa-user-doctor"></i>
							<h6 class="total_counter counter" data-target="1250" data-duration="1000">0</h6>
							<p class="counter_title">Total Success</p>
						</div>
					</div>
				</div>
				{{-- counter item end --}}
				<div class="col-sm-3 col-6">
					<div class="counter-item orange-color">
						<div class="counter-content">
							<i class="fa-solid fa-user-graduate"></i>
							<h6 class="total_counter counter" data-target="350" data-duration="1000">0+</h6>
							<p class="counter_title">Success In 2025</p>
						</div>
					</div>
				</div>
				{{-- counter item end --}}
				<div class="col-sm-3 col-6">
					<div class="counter-item cyan-color">
						<div class="counter-content">
							<i class="fa-solid fa-award"></i>
							<h6 class="total_counter counter" data-target="250" data-duration="1000">0+</h6>
							<p class="counter_title">Success In 2024</p>
						</div>
					</div>
				</div>
				{{-- counter item end --}}
				<div class="col-sm-3 col-6">
					<div class="counter-item red-color">
						<div class="counter-content">
							<i class="fa-solid fa-graduation-cap"></i>
							<h6 class="total_counter counter" data-target="210" data-duration="1000">0+</h6>
							<p class="counter_title">Success In 2023</p>
						</div>
					</div>
				</div>
				{{-- counter item end --}}
			</div>
		</div>
	</div>
</div>
{{-- counter section end --}}

<div class="about-section">
	<div class="container">
		<div class="row">
			<div class="col-sm-6">
				<div class="about-img">
					<img src="{{asset($about->image)}}" alt="">
				</div>
			</div>
			{{-- col end --}}
			<div class="col-sm-6">
				<div class="about-content">
					<h1>{{$about->title}}</h1>
					<p>{{$about->sub_title}}</p>
					<div>
              {!! $about->short_description !!}
					</div>
					<a href="" class="more-details">বিস্তারিত জানুন</a>
				</div>
			</div>
		</div>
	</div>
</div>
{{-- about us section end --}}

<div class="course-section">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<div class="section-heading">
					<h1>অনলাইন কোর্স সমুহ</h1>
					<a href="{{route('courses')}}" class="all_btns">সকল কোর্স</a>
				</div>
			</div>
		</div>
		{{-- courease heading end --}}
		<div class="row">
			@include('frontEnd.layouts.partial.course')
		</div>
	</div>
</div>
{{-- course end --}}
@foreach($categories as $key=>$category)
<div class="book-section">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<div class="section-heading">
					<h1>{{$category->name}}</h1>
					<a href="{{route('courses')}}" class="all_btns">সকল বই</a>
				</div>
			</div>
			@php
				$books = App\Models\Book::where(['category_id'=>$category->id])->orderByDesc('id')->limit(4)->get();
			@endphp
			@include('frontEnd.layouts.partial.book')
		</div>
	</div>
</div>
@endforeach
{{-- book section end --}}

<div class="success-history-section">
	<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<div class="section-heading">
						<h1>আমাদের চান্সপ্রাপ্ত স্টুডেন্ট সমূহ </h1>
						<a href="{{route('courses')}}" class="all_btns">সকল স্টুডেন্ট</a>
					</div>
				</div>
				<div class="col-sm-12">
					<div class="session-tab">
						<ul>
							<li><a>সব</a></li>
							@foreach($success_years as $s_year)
							<li><a href="{{route('success.student')}}">{{$s_year->name}}</a></li>
							@endforeach
						</ul>
					</div>
				</div>
				<div class="col-sm-12">
					<div class="success-students owl-carousel">
						@foreach($students as $key=>$value)
						<div class="student-inner">
							<div class="student-img">
								<img src="{{asset($value->image)}}" alt="">
							</div>
							<div class="student-info">
								<h5>{{$value->name}}</h5>
								<p>{{$value->institute}}</p>
								<p>@if($value->merit_position) Merit Position - {{$value->merit_position}} @endif  Session - {{$value->session}}</p>
							</div>
						</div>
						@endforeach
					</div>
				</div>
			</div>
	</div>
</div>

@endsection

@push('script')
<script src="{{asset('public/frontEnd/js/owl.carousel.min.js')}}"></script>
<script>
  $('.slider').owlCarousel({
        loop:true,
        margin:0,
        nav:true,
        items:1,
        dots:true,
        video:true,
        autoplay: true,
        autoplayTimeout:5000,
        smartSpeed: 1000,
        animateIn: 'animate__fadeIn',
        animateOut: 'animate__fadeOut',
        responsiveClass: true,
          responsive: {
              0: {
                  nav: false,
              },
              600: {
                  nav: false,
              },
              1000: {
                  nav: false,
              },
          },
    });
</script>
<script>
  $('.success-students').owlCarousel({
        loop:true,
        margin:0,
        nav:true,
        items:3,
        dots:true,
        video:true,
        autoplay: true,
        autoplayTimeout:5000,
        smartSpeed: 1000,
        animateIn: 'animate__fadeIn',
        animateOut: 'animate__fadeOut',
        responsiveClass: true,
          responsive: {
              0: {
                  nav: false,
                  items:1,
              },
              600: {
                  nav: false,
                  items:2,
              },
              1000: {
                  nav: false,
                  items:3,
              },
          },
    });
</script>
@endpush