<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>@yield('title', $setting->name)</title>

	<link rel="icon" href="{{asset($setting->favicon)}}" type="image/x-icon" />

	<link rel="stylesheet" href="{{asset('public/backEnd/assets/')}}/css/bootstrap.min.css">
	<link rel="stylesheet" href="{{asset('public/backEnd/assets/')}}/fonts/feather.css">
	<link rel="stylesheet" href="{{asset('public/backEnd/assets/')}}/fonts/fontawesome.css">
	<!-- <link rel="stylesheet" href="fonts/tabler-icons.min.css"> -->
   <!-- Tabler Icons Webfont CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css">
  <!-- Tabler Icons -->
  @stack('css')
	<link rel="stylesheet" href="{{asset('public/backEnd/assets/')}}/css/select2.min.css">
	<link rel="stylesheet" href="{{asset('public/backEnd/assets/')}}/css/toastr.min.css">
	<link rel="stylesheet" href="{{asset('public/backEnd/assets/')}}/css/style.css">
	<link rel="stylesheet" href="{{asset('public/backEnd/assets/')}}/css/responsive.css">
	<link href='https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.min.css'>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.all.min.js"></script>
</head>
<body>

	<nav class="wsit-sidebar">
		<div class="navbar-wrapper">
			<div class="main-logo">
				<a href="{{route('dashboard')}}">
					<img src="{{asset($setting->white_logo)}}" alt="">
				</a>
			</div>
			<div class="sidebar-search">
				
			</div>
			<div class="navbar-content">

				<ul class="wsit-navbar">
					<li class="wsit-item">
						<a href="{{route('dashboard')}}" class="wsit-link"> 
							<span class="wsit-icon"><i class="ti ti-home"></i> </span>
							<span class="wsit-text">Dashboard</span> 
						</a>
					</li>
					{{-- nav item end --}}

					
					<li class="wsit-item">
						<a href="" class="wsit-link"> 
							<span class="wsit-icon"><i class="ti ti-school"></i> </span>
							<span class="wsit-text">Academic Setup</span> 
							<span class="wsit-arrow"><i data-feather="chevron-right"></i></span>
						</a>
						<ul class="wsit-submenu">
							<li class="wsit-item">
								<a href="{{route('departments.index')}}" class="wsit-link">
									<span class="wsit-text"><i class="ti ti-circle-dot"></i>Department</span>
								</a>
							</li>
							<li class="wsit-item">
								<a href="{{route('classrooms.index')}}" class="wsit-link">
									<span class="wsit-text"><i class="ti ti-circle-dot"></i>Class</span>
								</a>
							</li>
							<li class="wsit-item">
								<a href="{{route('sessions.index')}}" class="wsit-link">
									<span class="wsit-text"><i class="ti ti-circle-dot"></i>Session</span>
								</a>
							</li>
							<li class="wsit-item">
								<a href="{{route('batches.index')}}" class="wsit-link">
									<span class="wsit-text"><i class="ti ti-circle-dot"></i>Batch</span>
								</a>
							</li>
						</ul>
					</li>
					{{-- nav item end --}}
					<li class="wsit-item">
						<a href="" class="wsit-link"> 
							<span class="wsit-icon"><i class="ti ti-user"></i> </span>
							<span class="wsit-text">Student Info </span> 
							<span class="wsit-arrow"><i data-feather="chevron-right"></i></span>
						</a>
						<ul class="wsit-submenu">
							<li class="wsit-item">
								<a href="{{route('students.create')}}" class="wsit-link">
									<span class="wsit-text"><i class="ti ti-circle-dot"></i>Student Add</span>
								</a>
							</li>
							<li class="wsit-item">
								<a href="{{route('students.index')}}" class="wsit-link">
									<span class="wsit-text"><i class="ti ti-circle-dot"></i>Student List</span>
								</a>
							</li>
						</ul>
					</li>
					{{-- nav item end --}}
					<li class="wsit-item">
						<a href="" class="wsit-link"> 
							<span class="wsit-icon"><i class="ti ti-checkbox"></i> </span>
							<span class="wsit-text">Attendance </span> 
							<span class="wsit-arrow"><i data-feather="chevron-right"></i></span>
						</a>
						<ul class="wsit-submenu">
							<li class="wsit-item">
								<a href="{{route('attendances.create')}}" class="wsit-link">
									<span class="wsit-text"><i class="ti ti-circle-dot"></i>New Attendance</span>
								</a>
							</li>
							<li class="wsit-item">
								<a href="{{route('attendances.index')}}" class="wsit-link">
									<span class="wsit-text"><i class="ti ti-circle-dot"></i>Attendance List</span>
								</a>
							</li>
						</ul>
					</li>
					{{-- nav item end --}}
					<li class="wsit-item">
						<a href="" class="wsit-link"> 
							<span class="wsit-icon"><i class="ti ti-coin-taka"></i> </span>
							<span class="wsit-text">Payment </span> 
							<span class="wsit-arrow"><i data-feather="chevron-right"></i></span>
						</a>
						<ul class="wsit-submenu">
							<li class="wsit-item">
								<a href="{{route('payments.create')}}" class="wsit-link">
									<span class="wsit-text"><i class="ti ti-circle-dot"></i>New Payment</span>
								</a>
							</li>
							<li class="wsit-item">
								<a href="{{route('payments.index')}}" class="wsit-link">
									<span class="wsit-text"><i class="ti ti-circle-dot"></i>Payment List</span>
								</a>
							</li>
						</ul>
					</li>
					{{-- nav item end --}}
					<li class="wsit-item">
						<a href="" class="wsit-link"> 
							<span class="wsit-icon"><i class="ti ti-coin-taka"></i> </span>
							<span class="wsit-text">Exam & Result </span> 
							<span class="wsit-arrow"><i data-feather="chevron-right"></i></span>
						</a>
						<ul class="wsit-submenu">
							<li class="wsit-item">
								<a href="{{route('exams.index')}}" class="wsit-link">
									<span class="wsit-text"><i class="ti ti-circle-dot"></i> Exam</span>
								</a>
							</li>
							<li class="wsit-item">
								<a href="{{route('results.index')}}" class="wsit-link">
									<span class="wsit-text"><i class="ti ti-circle-dot"></i> Result Manage</span>
								</a>
							</li>
							<li class="wsit-item">
								<a href="{{route('results.create')}}" class="wsit-link">
									<span class="wsit-text"><i class="ti ti-circle-dot"></i> Manual Result</span>
								</a>
							</li>
							<li class="wsit-item">
								<a href="{{route('results.quick_result')}}" class="wsit-link">
									<span class="wsit-text"><i class="ti ti-circle-dot"></i> Quick Result</span>
								</a>
							</li>
						</ul>
					</li>
					{{-- nav item end --}}
					<li class="wsit-item">
						<a href="" class="wsit-link"> 
							<span class="wsit-icon"><i class="ti ti-user-square-rounded"></i> </span>
							<span class="wsit-text">User Manage</span> 
							<span class="wsit-arrow"><i data-feather="chevron-right"></i></span>
						</a>
						<ul class="wsit-submenu">
							<li class="wsit-item">
								<a href="{{route('users.index')}}" class="wsit-link">
									<span class="wsit-text"><i class="ti ti-circle-dot"></i>User</span>
								</a>
							</li>
							<li class="wsit-item">
								<a href="{{route('roles.index')}}" class="wsit-link">
									<span class="wsit-text"><i class="ti ti-circle-dot"></i>Role</span>
								</a>
							</li>
							<li class="wsit-item">
								<a href="{{route('permissions.index')}}" class="wsit-link">
									<span class="wsit-text"><i class="ti ti-circle-dot"></i>Permission</span>
								</a>
							</li>
						</ul>
					</li>
					{{-- nav item end --}}
					<li class="wsit-item">
						<a href="" class="wsit-link"> 
							<span class="wsit-icon"><i class="ti ti-settings"></i> </span>
							<span class="wsit-text">Website Setting</span> 
							<span class="wsit-arrow"><i data-feather="chevron-right"></i></span>
						</a>
						<ul class="wsit-submenu">

							<li class="wsit-item">
								<a href="{{route('settings.edit')}}" class="wsit-link">
									<span class="wsit-text"><i class="ti ti-circle-dot"></i>General Setting</span>
								</a>
							</li>
							<li class="wsit-item">
								<a href="{{route('banners.index')}}" class="wsit-link">
									<span class="wsit-text"><i class="ti ti-circle-dot"></i> Slider</span>
								</a>
							</li>
							<li class="wsit-item">
								<a href="{{route('about.index')}}" class="wsit-link">
									<span class="wsit-text"><i class="ti ti-circle-dot"></i>About Us</span>
								</a>
							</li>
							<li class="wsit-item">
								<a href="{{route('contact.index')}}" class="wsit-link">
									<span class="wsit-text"><i class="ti ti-circle-dot"></i>Contact</span>
								</a>
							</li>
							<li class="wsit-item">
								<a href="{{route('success_students.index')}}" class="wsit-link">
									<span class="wsit-text"><i class="ti ti-circle-dot"></i>Success Student</span>
								</a>
							</li>
							<li class="wsit-item">
								<a href="{{route('notices.index')}}" class="wsit-link">
									<span class="wsit-text"><i class="ti ti-circle-dot"></i> Notice </span>
								</a>
							</li>
							<li class="wsit-item">
								<a href="{{route('sitepdfs.index')}}" class="wsit-link">
									<span class="wsit-text"><i class="ti ti-circle-dot"></i> Pdf </span>
								</a>
							</li>
							<li class="wsit-item">
								<a href="{{route('testexams.index')}}" class="wsit-link">
									<span class="wsit-text"><i class="ti ti-circle-dot"></i> Exam Test </span>
								</a>
							</li>
						</ul>
					</li>
					{{-- nav item end --}}
					<li class="wsit-item">
						<a href="" class="wsit-link"> 
							<span class="wsit-icon"><i class="ti ti-chalkboard-teacher"></i> </span>
							<span class="wsit-text">Course Manage</span> 
							<span class="wsit-arrow"><i data-feather="chevron-right"></i></span>
						</a>
						<ul class="wsit-submenu">

							<li class="wsit-item">
								<a href="{{route('mentors.index')}}" class="wsit-link">
									<span class="wsit-text"><i class="ti ti-circle-dot"></i>Mentors</span>
								</a>
							</li>
							<li class="wsit-item">
								<a href="{{route('courses.index')}}" class="wsit-link">
									<span class="wsit-text"><i class="ti ti-circle-dot"></i> Course</span>
								</a>
							</li> 

							<li class="wsit-item">
								<a href="{{route('chapter.index')}}" class="wsit-link">
									<span class="wsit-text"><i class="ti ti-circle-dot"></i> Chapter</span>
								</a>
							</li> 

							<li class="wsit-item">
								<a href="{{route('lesson.index')}}" class="wsit-link">
									<span class="wsit-text"><i class="ti ti-circle-dot"></i> Lesson</span>
								</a>
							</li> 
							<li class="wsit-item">
								<a href="{{route('enroll.payment',['slug'=>'all'])}}" class="wsit-link">
									<span class="wsit-text"><i class="ti ti-circle-dot"></i> Enroll Payment</span>
								</a>
							</li> 
						</ul>
					</li>
					{{-- nav item end --}}
					<li class="wsit-item">
						<a href="" class="wsit-link"> 
							<span class="wsit-icon"><i class="ti ti-book"></i> </span>
							<span class="wsit-text">Book Manage</span> 
							<span class="wsit-arrow"><i data-feather="chevron-right"></i></span>
						</a>
						<ul class="wsit-submenu">

							<li class="wsit-item">
								<a href="{{route('categories.index')}}" class="wsit-link">
									<span class="wsit-text"><i class="ti ti-circle-dot"></i>Category</span>
								</a>
							</li>
							<li class="wsit-item">
								<a href="{{route('books.index')}}" class="wsit-link">
									<span class="wsit-text"><i class="ti ti-circle-dot"></i>Book</span>
								</a>
							</li>

							<li class="wsit-item">
						    <a href="{{ route('orderstatus.index') }}" class="wsit-link">
						        <span class="wsit-text"><i class="ti ti-circle-dot"></i> Order Status </span>
						    </a>
						</li>

						</ul>
					</li>
					{{-- nav item end --}}
					<li class="wsit-item">
					    <a href="" class="wsit-link">
					        <span class="wsit-icon"><i class="ti ti-book"></i> </span>
					        <span class="wsit-text">Order Manage</span>
					        <span class="wsit-arrow"><i data-feather="chevron-right"></i></span>
					    </a>
					    <ul class="wsit-submenu">

					        <li class="wsit-item">
					            <a href="{{ route('admin.orders', ['slug' => 'all']) }}" class="wsit-link">
					                <span class="wsit-text"><i class="ti ti-circle-dot"></i>All Orders</span>
					            </a>
					        </li>
					        @foreach ($orderstatuses as $key => $status)
					            <li class="wsit-item">
					                <a href="{{ route('admin.orders', ['slug' => $status->slug]) }}"
					                    class="wsit-link">
					                    <span class="wsit-text"><i
					                            class="ti ti-circle-dot"></i>{{ $status->name }}</span>
					                </a>
					            </li>
					        @endforeach

					    </ul>
					</li>
					{{-- nav item end --}}
					<li class="wsit-item">
						<a href="" class="wsit-link"> 
							<span class="wsit-icon"><i class="ti ti-chart-histogram"></i> </span>
							<span class="wsit-text">Reports</span> 
							<span class="wsit-arrow"><i data-feather="chevron-right"></i></span>
						</a>
						<ul class="wsit-submenu">

							<li class="wsit-item">
								<a href="{{route('attendances.reports')}}" class="wsit-link">
									<span class="wsit-text"><i class="ti ti-circle-dot"></i>Attendance Report</span>
								</a>
							</li>
							<li class="wsit-item">
								<a href="{{route('payments.reports')}}" class="wsit-link">
									<span class="wsit-text"><i class="ti ti-circle-dot"></i>Payment Report</span>
								</a>
							</li>
							<li class="wsit-item">
								<a href="{{route('results.reports')}}" class="wsit-link">
									<span class="wsit-text"><i class="ti ti-circle-dot"></i>Result Report</span>
								</a>
							</li>

						</ul>
					</li>
					{{-- nav item end --}}
				</ul>
			</div>
		</div>
	</nav>
	<header class="wsit-header">
  <div class="header-wrapper">
    <div class="me-auto wsit-mob-drp">
      <ul class="list-unstyled">
        <li class="wsit-h-item mob-hamburger">
          <a href="#!" class="wsit-head-link" id="mobile-collapse">
            <div class="hamburger hamburger--arrowturn">
              <div class="hamburger-box">
                <div class="hamburger-inner"></div>
              </div>
            </div>
          </a>
        </li>

        <li class="dropdown wsit-h-item drp-company">
          <a class="wsit-head-link dropdown-toggle arrow-none m-0" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
            <span class="theme-avtar">
              <img alt="#" src="{{asset(auth()->user()->image)}}" class="rounded border-2 border border-primary" style="width: 100%; height: 100%;" />
            </span>
            <span class="hide-mob ms-2">{{auth()->user()->name}}</span>
            <i class="ti ti-chevron-down drp-arrow nocolor hide-mob"></i>
          </a>
          <div class="dropdown-menu wsit-h-dropdown" style="">
            <a href="{{route('admin.profile')}}" class="dropdown-item">
              <i class="ti ti-user"></i>
              <span>Profile</span>
            </a>
            <a href="{{ route('logout') }}" onclick="event.preventDefault();
                document.getElementById('logout-form').submit();"  class="dropdown-item">
              <i class="ti ti-power"></i>
              <span>Logout</span>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                style="display: none;">
                @csrf
            </form>
          </div>
        </li>

      </ul>
    </div>

    <div class="ms-auto">
      <ul class="list-unstyled">
        <li class="wsit-h-item">
          <a class="wsit-head-link me-0" href="">
            <i class="ti ti-apps"></i>
            <span class="animate-charcter d-lg-block d-none">Dashboard</span>
          </a>
        </li>
        <li class="wsit-h-item">
          <a class="wsit-head-link me-0" href="">
            <i class="ti ti-message-circle"></i>
            <span class="bg-danger wsit-h-badge message-counter custom_messanger_counter">0<span class="sr-only"></span> </span>
          </a>
        </li>
        <li class="wsit-h-item">
          <a href="{{url('/')}}" target="_blank" class="wsit-head-link dropdown-toggle arrow-none me-0 cust-btn"  data-ajax-popup="true" data-title="Visit Site">
            <i class="ti ti-world-share"></i>
            <span class="hide-mob">Visit Site</span>
          </a>
        </li>
       
      </ul>
    </div>
  </div>
</header>
	@yield('content')

	<footer class="mt-5 wsit-footer">
	  <div class="footer-wrapper">
	    <div class="py-1">
	      <span class="text-muted">
	        © Copyright 2025 All Right Reserved. Developed by <a href="https://websolutionit.com/" target="_blank" class="develop_company">Websolution IT</a>
	      </span>
	    </div>
	  </div>
	</footer>


	<script src="{{asset('public/backEnd/assets/')}}/js/jquery.min.js"></script>
	<script src="{{asset('public/backEnd/assets/')}}/js/bootstrap.min.js"></script>
	<script src="{{asset('public/backEnd/assets/')}}/js/plugins/fontawesome.js"></script>
	<script src="{{asset('public/backEnd/assets/')}}/js/plugins/feather.min.js"></script>
	<script src="{{asset('public/backEnd/assets/')}}/js/jquery.scroll-spy.min.js"></script>
	<script src="{{asset('public/backEnd/assets/')}}/js/select2.min.js"></script>
	<script src="{{asset('public/backEnd/assets/')}}/js/toastr.min.js"></script>
	{!! Toastr::message() !!}
	<script src="{{asset('public/backEnd/assets/js/parsley.min.js')}}"></script>
  <script src="{{asset('public/backEnd/assets/js/particles-active.js')}}"></script>
  	
  	<script>
		$(document).on('click', '.delete_btn', function(event) {
		    var form = $(this).closest("form");
		    Swal.fire({
		        title: 'Delete Warning!',
		        text: "Are you sure you want to delete this record?",
		        icon: 'warning',
		        showCancelButton: true,
		        confirmButtonColor: '#3085d6',
		        cancelButtonColor: '#d33',
		        confirmButtonText: 'Yes, delete it!',
		        cancelButtonText: 'Cancel'
		    }).then((result) => {
		        if (result.isConfirmed) {
		            form.submit();
		        }
		    });
		});

	$(document).on('click', '.thumb_up', function(event) {
	    var form = $(this).closest("form");
	    Swal.fire({
	        title: 'Active Warning!',
	        text: "Are you sure you want to active this record?",
	        icon: 'warning',
	        showCancelButton: true,
	        confirmButtonColor: '#3085d6',
	        cancelButtonColor: '#d33',
	        confirmButtonText: 'Yes, active it!',
	        cancelButtonText: 'Cancel'
	    }).then((result) => {
	        if (result.isConfirmed) {
	            form.submit();
	        }
	    });
	});
	$(document).on('click', '.thumb_down', function(event) {
	    var form = $(this).closest("form");
	    Swal.fire({
	        title: 'Inactive Warning!',
	        text: "Are you sure you want to inactive this record?",
	        icon: 'warning',
	        showCancelButton: true,
	        confirmButtonColor: '#3085d6',
	        cancelButtonColor: '#d33',
	        confirmButtonText: 'Yes, inactive it!',
	        cancelButtonText: 'Cancel'
	    }).then((result) => {
	        if (result.isConfirmed) {
	            form.submit();
	        }
	    });
	});
  </script>

  <script type="text/javascript">
	  $(function () {
	    $('form').parsley();
	  });
  </script>

  @stack('script')
	<script src="{{asset('public/backEnd/assets/')}}/js/script.js"></script>
	
	 <script>
        feather.replace();
    </script>
    <script>
	    $(document).ready(function () {
		    $(".wsit-navbar").on("click", "a", function (e) {
		        var $clickedItem = $(this).parent(".wsit-item");
		        var $submenu = $clickedItem.children(".wsit-submenu");
		        var $arrow = $(this).find(".wsit-arrow svg"); 

		        if ($arrow.length > 0) {
		            e.preventDefault();

		            $clickedItem.siblings().children(".wsit-submenu").slideUp();
		            $clickedItem.siblings().find(".wsit-arrow svg").removeClass("rotated");

		            $clickedItem.find(".wsit-submenu").not($submenu).slideUp();
		            $clickedItem.find(".wsit-arrow svg").not($arrow).removeClass("rotated");

		            
		            $submenu.slideToggle();
		            $arrow.toggleClass("rotated");
		        } 
		        
		        else {
		            window.location.href = $(this).attr("href");
		        }
		    });
		});
    </script>
    <script>
    	$(document).ready(function(){
    		// dropdown menu
    		$('.dropdown').click(function(){
    			$('.dropdown-menu').toggle();
    		});

    		//  mobile menu
    		 $('.mob-hamburger').click(function(){
            $('.wsit-sidebar').addClass('wsit-sidebar-active');


            if ($('.wsit-menu-overlay').length === 0) {
                $('.wsit-sidebar').append('<div class="wsit-menu-overlay"></div>');
            }
        });
    		 $(document).on('click', '.wsit-menu-overlay', function(){
            $('.wsit-sidebar').removeClass('wsit-sidebar-active');
            $(this).remove();
        });

    		 // select2
    		 $('.select2').select2();

    		// scrollspy
    		$('.page-content').scrollSpy({
		        target: $('.scroll_menu a')
		    }).scroll();

    	});
    </script>

    <script>
    	$("#department_id").on("change", function() {
        var id = $(this).val();
        if (id) {
            $.ajax({
                type: "GET",
                data: {id},
                url: "{{ route('classrooms.ajax_class') }}",
                success: function(response) {
                    if (response) {
                        $("#class_id").empty();
                        $("#class_id").append('<option value="0">Select Class...</option>');
                        $.each(response, function(key, value) {
                            $("#class_id").append('<option value="' + key + '">' +
                                value + "</option>");
                        });
                    } else {
                        $("#class_id").empty();
                    }
                },
            });
        } else {
            $("#class_id").empty();
        }
    });
    </script>
    <script>
    	$("#session_id").on("change", function() {
        var department_id = $('#department_id').val();
        console.log(session_id);
        var class_id = $('#class_id').val();
        var session_id = $(this).val();
        if (session_id) {
            $.ajax({
                type: "GET",
                data: {department_id,class_id,session_id},
                url: "{{ route('students.ajax_batch') }}",
                success: function(response) {
                    if (response) {
                        $("#batch_id").empty();
                        $("#batch_id").append('<option value="0">Select Batch...</option>');
                        $.each(response, function(key, value) {
                            $("#batch_id").append('<option value="' + key + '">' +
                                value + "</option>");
                        });
                    } else {
                        $("#batch_id").empty();
                    }
                },
            });
        } else {
            $("#batch_id").empty();
        }
    });
    </script>
    <script>
    	$("#batch_id").on("change", function() {
        var batch_id = $('#batch_id').val();
        if (batch_id) {
            $.ajax({
                type: "GET",
                data: {batch_id},
                url: "{{ route('students.ajax_student') }}",
                success: function(response) {
                    if (response) {
                        $("#student_id").empty();
                        $("#student_id").append('<option value="0">Select Student...</option>');
                        $.each(response, function(key, value) {
                            $("#student_id").append('<option value="' + key + '">' +
                                value + "</option>");
                        });
                    } else {
                        $("#student_id").empty();
                    }
                },
            });
        } else {
            $("#student_id").empty();
        }
    });
    </script>
</body>
</html>