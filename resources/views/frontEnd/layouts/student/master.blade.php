<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', $setting->name)</title>

    <link rel="icon" href="{{ asset($setting->favicon) }}" type="image/x-icon" />

    <link rel="stylesheet" href="{{ asset('public/backEnd/assets/') }}/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('public/backEnd/assets/') }}/fonts/feather.css">
    <link rel="stylesheet" href="{{ asset('public/backEnd/assets/') }}/fonts/fontawesome.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css">
    <!-- Tabler Icons -->
    @stack('css')
    <link rel="stylesheet" href="{{ asset('public/backEnd/assets/') }}/css/select2.min.css">
    <link rel="stylesheet" href="{{ asset('public/backEnd/assets/') }}/css/toastr.min.css">
    <link rel="stylesheet" href="{{ asset('public/backEnd/assets/') }}/css/style.css">
    <link rel="stylesheet" href="{{ asset('public/backEnd/assets/') }}/css/responsive.css">
    <link href='https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.min.css'>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.all.min.js"></script>
</head>

<body>
    <nav class="wsit-sidebar student">
        <div class="navbar-wrapper">
            <div class="main-logo">
                <a href="{{ route('student.dashboard') }}">
                    <img src="{{ asset($setting->white_logo) }}" alt="">
                </a>
            </div>
            <div class="sidebar-search">

            </div>
            <div class="navbar-content">

                <ul class="wsit-navbar">
                    <li class="wsit-item">
                        <a href="{{ route('student.dashboard') }}" class="wsit-link">
                            <span class="wsit-icon"><i class="ti ti-home"></i> </span>
                            <span class="wsit-text">Dashboard</span>
                        </a>
                    </li>
                    {{-- nav item end --}}
                    <li class="wsit-item">
                        <a href="{{ route('student.profile') }}" class="wsit-link">
                            <span class="wsit-icon"><i class="ti ti-user-edit"></i> </span>
                            <span class="wsit-text">Profile</span>
                        </a>
                    </li>
                    {{-- nav item end --}}
                    <li class="wsit-item">
                        <a href="{{ route('student.enrollcourse') }}" class="wsit-link">
                            <span class="wsit-icon"><i class="ti ti-brand-youtube"></i> </span>
                            <span class="wsit-text">Enrolled Courses</span>
                        </a>
                    </li>
                    {{-- nav item end --}}
                    <li class="wsit-item">
                        <a href="{{ route('student.change_pass') }}" class="wsit-link">
                            <span class="wsit-icon"><i class="ti ti-user-cog"></i> </span>
                            <span class="wsit-text">Change Password</span>
                        </a>
                    </li>
                    {{-- nav item end --}}
                    <li class="wsit-item">
                        <a href="#" class="wsit-link"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <span class="wsit-icon"><i class="ti ti-logout"></i></span>
                            <span class="wsit-text">Logout</span>
                        </a>

                        <form id="logout-form" action="{{ route('student.logout') }}" method="POST"
                            style="display: none;">
                            @csrf
                        </form>
                    </li>
                    {{-- nav item end --}}



                    </ul>
            </div>
        </div>
    </nav>
    <header class="wsit-header student">
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
                        <a class="wsit-head-link dropdown-toggle arrow-none m-0" data-bs-toggle="dropdown"
                            href="#" role="button" aria-haspopup="false" aria-expanded="false">
                            <span class="theme-avtar">
                                <img alt="#" src="{{ asset(Auth::guard('student')->user()->image) }}"
                                    class="rounded border-2 border border-primary" style="width: 100%; height: 100%;" />
                            </span>
                            <span class="hide-mob ms-2">{{ Auth::guard('student')->user()->name }}</span>
                            <i class="ti ti-chevron-down drp-arrow nocolor hide-mob"></i>
                        </a>
                        <div class="dropdown-menu wsit-h-dropdown" style="">
                            <a href="{{ route('student.profile') }}" class="dropdown-item">
                                <i class="ti ti-user"></i>
                                <span>Profile</span>
                            </a>
                            <a href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                document.getElementById('logout-form').submit();"
                                class="dropdown-item">
                                <i class="ti ti-power"></i>
                                <span>Logout</span>
                            </a>
                            <form id="logout-form" action="{{ route('student.logout') }}" method="POST"
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
                        <a href="{{ url('/') }}" target="_blank"
                            class="wsit-head-link dropdown-toggle arrow-none me-0 cust-btn" data-ajax-popup="true"
                            data-title="Visit Site">
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
                    © Copyright {{ date('Y') }} All Right Reserved. Developed by <a
                        href="https://websolutionit.com/" target="_blank" class="develop_company">Websolution IT</a>
                </span>
            </div>
        </div>
    </footer>


    <script src="{{ asset('public/backEnd/assets/') }}/js/jquery.min.js"></script>
    <script src="{{ asset('public/backEnd/assets/') }}/js/bootstrap.min.js"></script>
    <script src="{{ asset('public/backEnd/assets/') }}/js/plugins/fontawesome.js"></script>
    <script src="{{ asset('public/backEnd/assets/') }}/js/plugins/feather.min.js"></script>
    <script src="{{ asset('public/backEnd/assets/') }}/js/jquery.scroll-spy.min.js"></script>
    <script src="{{ asset('public/backEnd/assets/') }}/js/select2.min.js"></script>
    <script src="{{ asset('public/backEnd/assets/') }}/js/toastr.min.js"></script>
    {!! Toastr::message() !!}

    @stack('script')
    <script src="{{ asset('public/backEnd/assets/') }}/js/script.js"></script>

    <script>
        feather.replace();
    </script>
    <script>
        $(document).ready(function() {
            $(".wsit-navbar").on("click", "a", function(e) {
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
                } else {
                    window.location.href = $(this).attr("href");
                }
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            // dropdown menu
            $('.dropdown').click(function() {
                $('.dropdown-menu').toggle();
            });

            //  mobile menu
            $('.mob-hamburger').click(function() {
                $('.wsit-sidebar').addClass('wsit-sidebar-active');


                if ($('.wsit-menu-overlay').length === 0) {
                    $('.wsit-sidebar').append('<div class="wsit-menu-overlay"></div>');
                }
            });
            $(document).on('click', '.wsit-menu-overlay', function() {
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

</body>

</html>
