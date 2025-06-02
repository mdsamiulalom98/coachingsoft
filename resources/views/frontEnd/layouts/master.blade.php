<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>@yield('title')</title>
	<link rel="stylesheet" href="{{asset('public/frontEnd/css/all.min.css')}}">
	<link rel="stylesheet" href="{{asset('public/frontEnd/css/bootstrap.min.css')}}">
	@stack('css')
	<link rel="stylesheet" href="{{asset('public/frontEnd/css/animate.min.css')}}">
	<link rel="stylesheet" href="{{asset('public/backEnd/assets/')}}/css/toastr.min.css">
	<link rel="stylesheet" href="{{asset('public/frontEnd/css/style.css')}}">
	<link rel="stylesheet" href="{{asset('public/frontEnd/css/responsive.css')}}">
</head>
<body>
	{{-- header section --}}
	<div class="header-section">
		<header>
			<div class="main-header">
				<div class="container">
					<div class="row">
						<div class="col-sm-12">
							<div class="logo-menu-auth animate__backOutDown">
								<div class="logo">
									<a href="{{route('home')}}">
									   <img src="{{asset($setting->dark_logo)}}" alt="">
									</a>
								</div>
								{{-- logo end --}}
								<div class="menu">
									<ul>
										<li><a href="{{route('home')}}">হোম</a></li>
										<li><a href="{{route('courses')}}">কোর্স</a></li>
										<li><a href="{{route('books')}}">বই</a></li>
										<li><a href="{{route('home')}}">পিডিএফ</a></li>
										<li><a href="{{route('home')}}">টেস্ট</a></li>
										<li><a href="{{route('notice')}}">নোটিশ</a></li>
									</ul>
								</div>
								{{-- menu end --}}
								<div class="auth">
									<ul>
										@if(Auth::guard('student')->check())
										<li><a href="{{route('student.dashboard')}}">{{Auth::guard('student')->user()->name}}</a></li>
										@else
										<li><a href="{{route('student.login')}}">লগইন</a></li>
										<li><a href="{{route('student.login')}}" class="active">রেজিস্টার</a></li>
										@endif
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			{{-- main header end --}}
			<div class="mobile-header">
	            <div class="mobile-logo">
	                <div class="menu-logo">
	                    <a href="{{route('home')}}"><img src="{{asset($setting->white_logo)}}" alt="" /></a>
	                </div>
	                <div class="menu-bar">
	                    <a class="toggle" id="toggle">
	                        <span class="bar-one"></span>
	                        <span class="bar-two"></span>
	                        <span class="bar-three"></span>
	                    </a>
	                </div>
	            </div>
	        </div>
	        <div class="mobile-menu">
	              <div class="mobile-menu-wrap">
	                  <div class="user-and-notification">
	                      <div class="mobile-auth">
	                          <ul>
								<li><a href="{{route('student.login')}}"> Login</a></li>
								<li><a href="{{route('student.register')}}"> Register</a></li>
	                         </ul>
	                      </div>
	                  </div>
	                  <ul class="mobile-nav">
	                    <li><a href="{{route('home')}}">হোম</a></li>
						<li><a href="{{route('courses')}}">কোর্স</a></li>
						<li><a href="{{route('books')}}">বই</a></li>
						<li><a href="{{route('home')}}">পিডিএফ</a></li>
						<li><a href="{{route('home')}}">টেস্ট</a></li>
						<li><a href="{{route('notice')}}">নোটিশ</a></li>
	                  </ul>
	              </div>
	          </div>
	      
		</header>
	</div>
	@yield('content')
	<footer>
		<div class="footer-top">
			<div class="container">
				<div class="row">
					<div class="col-sm-4">
						<div class="footer-social">
							  <div class="footer-logo">
							    <a href="{{route('home')}}">
							      <img src="{{asset($setting->white_logo)}}" alt="logo">
							    </a>
							  </div>
							  <ul>
							  	@if($contact->facebook)
							    <li>
							      <a href="{{$contact->facebook}}" target="_blank">
							        <i class="fa-brands fa-facebook"></i>
							      </a>
							    </li>
							    @endif
							  	@if($contact->youtube)
							    <li>
							      <a href="{{$contact->youtube}}" target="_blank">
							        <i class="fa-brands fa-youtube"></i>
							      </a>
							    </li>
							    @endif
							  	@if($contact->telegram)
							    <li>
							      <a href="{{$contact->telegram}}" target="_blank">
							        <i class="fa-brands fa-telegram"></i>
							      </a>
							    </li>
							    @endif
							  	@if($contact->whatsapp)
							    <li>
							      <a href="{{$contact->whatsapp}}" target="_blank">
							        <i class="fa-brands fa-whatsapp"></i>
							      </a>
							    </li>
							    @endif
							  	@if($contact->messenger)
							    <li>
							      <a href="{{$contact->messenger}}" target="_blank">
							       <i class="fa-brands fa-facebook-messenger"></i>
							      </a>
							    </li>
							    @endif
							  </ul>
						</div>
					</div>
					{{-- col-end --}}
					<div class="col-sm-4">
						<div class="footer-quick">
							<h4 class="quick-title">কুইক লিঙ্ক</h4>
							<ul>
								<li><a href="{{route('courses')}}">কোর্স</a></li>
								<li><a href="{{route('books')}}">বই</a></li>
								<li><a href="{{route('home')}}">পিডিএফ</a></li>
								<li><a href="{{route('home')}}">টেস্ট</a></li>
								<li><a href="{{route('home')}}">নোটিশ</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-4">
						<div class="footer-contact">
							<h4 class="quick-title">যোগাযোগের ঠিকানা</h4>
							<ul>
								<li><i class="fa-solid fa-map"></i> <a href="{{route('home')}}">{{$contact->address}}</a></li>
								<li><i class="fa-solid fa-phone"></i> <a href="tel:$contact->phone">{{$contact->phone}}</a></li>
								<li><i class="fa-solid fa-envelope"></i> <a href="mailto:{{$contact->email}}">{{$contact->email}}</a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="footer-bottom">
			<div class="container">
				<div class="row">
					<div class="col-sm-12">
						<div class="copyright">
							<p>© {{date('Y')}} {{$setting->name}}, All rights reserved</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</footer>
	<div class="side_cart">
		<a href="{{route('checkout')}}">
			<p><i class="fa-solid fa-shopping-cart"></i></p>
		    <span>{{Cart::content()->count()}}</span>
		</a>
	</div>
	<script src="{{asset('public/frontEnd/js/jquery-3.7.1.min.js')}}"></script>
	<script src="{{asset('public/frontEnd/js/bootstrap.min.js')}}"></script>
	<script src="{{asset('public/frontEnd/js/counterup.js')}}"></script>
	<script>
		$(".counter-up-start").counterUp();
		$(".counter").counterUp();
	</script>
	 <script>
        $(".toggle").on("click", function (event) {
            event.stopPropagation();
            $(".overlay").show();
            $(".mobile-menu").toggleClass("active");
            $(this).toggleClass('show');
        });
    </script>
	@stack('script')
	<script src="{{asset('public/backEnd/assets/')}}/js/toastr.min.js"></script>
	{!! Toastr::message() !!}
</body>
</html>