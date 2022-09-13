<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
@php
$setting = SiteHelpers::setting();
@endphp
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="Materialize is a Material Design Admin Template,It's modern, responsive and based on Material Design by Google.">
    <meta name="keywords" content="materialize, admin template, dashboard template, flat admin template, responsive admin template, eCommerce dashboard, analytic dashboard">
    <meta name="author" content="ThemeSelect">
    <title>{{ $setting->application_name }}</title>
    <link rel="apple-touch-icon" href="{{ asset('upload/setting/' . $setting->small_icon) }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('upload/setting/' . $setting->small_icon) }}">
    <!-- <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"> -->
    <link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">
    <!-- BEGIN: VENDOR CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/vendors.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/select2/select2.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/select2/select2-materialize.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/animate-css/animate.css') }}">
    <!-- END: VENDOR CSS-->
    <!-- BEGIN: Page Level CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/themes/vertical-modern-menu-template/materialize.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/themes/vertical-modern-menu-template/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/pages/app-sidebar.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/pages/app-email.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/pages/form-select2.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/pages/dashboard-modern.css') }}">
    <!-- END: Page Level CSS-->
    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/custom/custom.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/font-awesome/css/all.css') }}">
    <!-- END: Custom CSS-->

    @yield('style')

    <script>
        function formatRupiah(objek, separator) {
            a = objek.value;
            b = a.replace(/[^\d]/g, "");
            c = "";
            panjang = b.length;
            j = 0;
            for (i = panjang; i > 0; i--) {
                j = j + 1;
                if (((j % 3) == 1) && (j != 1)) {
                    c = b.substr(i - 1, 1) + separator + c;
                } else {
                    c = b.substr(i - 1, 1) + c;
                }
            }
            objek.value = c;
        }
    </script>
</head>
<!-- END: Head-->

<body class="vertical-layout vertical-menu-collapsible page-header-dark vertical-modern-menu preload-transitions 2-columns   " data-open="click" data-menu="vertical-modern-menu" data-col="2-columns">

    <!-- BEGIN: Header-->
    <header class="page-topbar" id="header">
        <div class="navbar navbar-fixed">
            <nav class="navbar-main navbar-color nav-collapsible sideNav-lock navbar-dark no-shadow gradient-45deg-light-blue-cyan">
                <div class="nav-wrapper">
                    <ul class="navbar-list right">
                        <li class="hide-on-med-and-down"><a class="waves-effect waves-block waves-light toggle-fullscreen" href="javascript:void(0);"><i class="material-icons">settings_overscan</i></a></li>
                        <li>
                            <a class="waves-effect waves-block waves-light profile-button" href="javascript:void(0);" data-target="profile-dropdown">
                                <span class="avatar-status avatar-online">
                                    @if (Auth::user()->foto)
                                    <img src="{{ asset('upload/foto/' . Auth::user()->foto) }}" alt="avatar"><i></i>
                                    @else
                                    <img src="{{ asset('assets/images/avatar/avatar-7.png') }}" alt="avatar"><i></i>
                                    @endif
                                </span>
                            </a>
                        </li>
                    </ul>
                    <!-- profile-dropdown-->
                    <ul class="dropdown-content" id="profile-dropdown">
                        <li><a class="grey-text text-darken-1" href="{{ url('profil/' . Auth::user()->id) }}"><i class="material-icons">person_outline</i> Profil</a></li>
                        @if(Auth::user()->group_id == 1)
                            <li><a class="grey-text text-darken-1" href="{{ url('setting') }}"><i class="material-icons">settings</i> Setting</a></li>
                        @endif
                        <li>
                            <a class="grey-text text-darken-1" href="{{ url('logout-sistem') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();" class="btn btn-google btn-flat"><i class="material-icons">keyboard_tab</i>Sign out</a>
                            <form id="logout-form" action="{{ url('logout-sistem') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </div>
                <nav class="display-none search-sm">
                    <div class="nav-wrapper">
                        <form id="navbarForm">
                            <div class="input-field search-input-sm">
                                <input class="search-box-sm mb-0" type="search" required="" id="search" placeholder="Explore Materialize" data-search="template-list">
                                <label class="label-icon" for="search"><i class="material-icons search-sm-icon">search</i></label><i class="material-icons search-sm-close">close</i>
                                <ul class="search-list collection search-list-sm display-none"></ul>
                            </div>
                        </form>
                    </div>
                </nav>
            </nav>
        </div>
    </header>
    <!-- END: Header-->

    <!-- BEGIN: SideNav-->
    <aside class="sidenav-main nav-expanded nav-lock nav-collapsible sidenav-light sidenav-active-square">
        <div class="brand-sidebar">
            <h1 class="logo-wrapper">
                <center>
                    <a class="brand-logo darken-1" href="{{ url('/') }}">
                        <center><img class="hide-on-med-and-down" src="{{ asset('upload/setting/' . $setting->large_icon) }}" style="height: 50px;margin-top: -10px;margin-left: -15px;" /></center>
                        <center><img class="show-on-medium-and-down hide-on-med-and-up" src="{{ asset('upload/setting/' . $setting->large_icon) }}" style="height: 55px;margin-top: -16px;margin-left: 150px;" /></center>
                    </a>
                </center>
            </h1>
        </div>
        <ul class="sidenav sidenav-collapsible leftside-navigation collapsible sidenav-fixed menu-shadow" id="slide-out" data-menu="menu-navigation" data-collapsible="menu-accordion">
            <li class="bold {{ request()->is('dashboard*') ? 'active' : '' }}">
                <a class="waves-effect waves-cyan {{ request()->is('dashboard*') ? 'active gradient-shadow gradient-45deg-light-blue-cyan' : '' }} " href="{{ url('dashboard') }}">
                    <i class="fa fa-home"></i>
                    <span class="menu-title" data-i18n="Mail">Dashboard </span>
                </a>
            </li>
            @foreach (SiteHelpers::main_menu() as $v)
            @if ($v->link == '#')
            <li class="@foreach (SiteHelpers::submenu($v->id) as $x) {{ request()->is($x->link . '*') ? 'active' : '' }} @endforeach bold">
                <a class="collapsible-header waves-effect waves-cyan " href="JavaScript:void(0)">
                    <i class="{{ $v->attribute }}"></i>
                    <span class="menu-title" data-i18n="Dashboard">{{ $v->menu_name }}</span>
                    @if($v->menu_name == "Data Aduan")<span id="count_all"></span>@endif
                </a>
                <div class="collapsible-body">
                    <ul class="collapsible collapsible-sub" data-collapsible="accordion">
                        @foreach (SiteHelpers::submenu($v->id) as $x)
                        <li>
                            <a class="{{ request()->is($x->link . '*') ? 'active' : '' }}" href="{{ url($x->link) }}">
                                <i class="material-icons">radio_button_unchecked</i>
                                <span data-i18n="Modern">{{ $x->sub_menu_name }}</span>
                                @if($x->sub_menu_name == "Masuk")<span id="count_request"></span>@endif
                                @if($x->sub_menu_name == "Proses")<span id="count_process"></span>@endif
                                @if($x->sub_menu_name == "Terima")<span id="count_accept"></span>@endif
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </li>
            @else
            <li class="bold {{ request()->is($v->link . '*') ? 'active' : '' }}">
                <a class="waves-effect waves-cyan {{ request()->is($v->link . '*') ? 'active gradient-shadow gradient-45deg-light-blue-cyan' : '' }}" href="{{ url($v->link) }}">
                    <i class="{{ $v->attribute }}"></i>
                    <span class="menu-title" data-i18n="Mail">{{ $v->menu_name }}</span>
                </a>
            </li>
            @endif
            @endforeach

            <li class="navigation-header"><a class="navigation-header-text">Pengaturan</a><i class="navigation-header-icon material-icons">more_horiz</i></li>

            @foreach (SiteHelpers::config_menu() as $v)
            @if ($v->link == '#')
            <li class="@foreach (SiteHelpers::submenu($v->id) as $x) {{ request()->is($x->link . '*') ? 'active' : '' }} @endforeach bold">
                <a class="collapsible-header waves-effect waves-cyan " href="JavaScript:void(0)">
                    <i class="{{ $v->attribute }}"></i>
                    <span class="menu-title" data-i18n="Dashboard">{{ $v->menu_name }}</span>
                </a>
                <div class="collapsible-body">
                    <ul class="collapsible collapsible-sub" data-collapsible="accordion">
                        @foreach (SiteHelpers::submenu($v->id) as $x)
                        <li>
                            <a class="{{ request()->is($x->link . '*') ? 'active' : '' }}" href="{{ url($x->link) }}">
                                <i class="material-icons">radio_button_unchecked</i>
                                <span data-i18n="Modern">{{ $x->sub_menu_name }}</span></a>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </li>
            @else
            <li class="bold {{ request()->is($v->link . '*') ? 'active' : '' }}">
                <a class="waves-effect waves-cyan {{ request()->is($v->link . '*') ? 'active gradient-shadow gradient-45deg-light-blue-cyan' : '' }}" href="{{ url($v->link) }}">
                    <i class="{{ $v->attribute }}"></i>
                    <span class="menu-title" data-i18n="Mail">{{ $v->menu_name }}</span>
                </a>
            </li>
            @endif
            @endforeach
        </ul>

        <div class="navigation-background"></div><a class="sidenav-trigger btn-sidenav-toggle btn-floating btn-medium waves-effect waves-light hide-on-large-only" href="#" data-target="slide-out"><i class="material-icons">menu</i></a>
    </aside>
    <!-- END: SideNav-->


    @yield('konten')

    </div>
    <div class="content-overlay"></div>
    </div>
    </div>
    </div>
    <!-- END: Page Main-->

    <!-- BEGIN: Footer-->

    <footer class="page-footer footer footer-static footer-dark gradient-45deg-light-blue-cyan gradient-shadow navbar-border navbar-shadow">
        <div class="footer-copyright">
            <div class="container"><span>&copy; {{ date('Y') }} <a href="#">TECHNOS STUDIO</a> All rights reserved.</span></div>
        </div>
    </footer>

    <!-- END: Footer-->
    <!-- BEGIN VENDOR JS-->
    <script src="{{ asset('assets/js/vendors.min.js') }}"></script>
    <!-- BEGIN VENDOR JS-->
    <script src="{{ asset('assets/vendors/select2/select2.full.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/quill/quill.min.js') }}"></script>
    <!-- END PAGE VENDOR JS-->
    <!-- BEGIN THEME  JS-->
    <script src="{{ asset('assets/js/datepicker.js') }}"></script>
    <script src="{{ asset('assets/js/plugins.js') }}"></script>
    <script src="{{ asset('assets/js/search.js') }}"></script>
    <script src="{{ asset('assets/js/custom/custom-script.js') }}"></script>
    <script src="{{ asset('assets/js/scripts/customizer.js') }}"></script>
    <script src="{{ asset('assets/js/scripts/advance-ui-modals.js') }}"></script>
    <script src="{{ asset('assets/js/scripts/form-select2.js') }}"></script>
    <script src="{{ asset('assets/js/scripts/advance-ui-carousel.js') }}"></script>
    <!-- <script src="{{ asset('assets/js/scripts/app-email.js') }}"></script> -->
    <script src="{{ asset('assets/js/scripts/form-elements.js') }}"></script>
    <!-- END THEME  JS-->

    {{-- -------------- ONLINE SCRIPT ------------ --}}
    {{-- SWEET ALERT --}}
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    
    <script src="{{ asset('assets/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('assets/ckfinder/ckfinder.js') }}"></script>
    {{-- END SWEET ALERT --}}

    <script>
        $(document).ready(function() {
            
            // CKEDITOR
            var editor = document.getElementById("editor");
                CKEDITOR.replace(editor,{
                language:'en-gb'
            });
            CKEDITOR.config.allowedContent = true;

        })
    </script>
    @yield('script')

</body>

<script type="text/javascript">
    function cek(){
        
        $.ajax({
            url:"{{ url('/count_complaint/all') }}",
            cache: false,
            success: function(msg){
                $("#count_all").html(msg);
            }
        });
        var waktu = setTimeout("cek()",3000);
    }

    $(document).ready(function(){
        cek();
    });

    function cek2(){
        
        $.ajax({
            url:"{{ url('/count_complaint/request') }}",
            cache: false,
            success: function(msg){
                $("#count_request").html(msg);
                // var audio = new Audio('{{ asset("sound/audio_file.mp3") }}');
				// audio.play();
            }
        });
        var waktu = setTimeout("cek2()",3000);
    }

    $(document).ready(function(){
        cek2();
    });

    function cek3(){
        
        $.ajax({
            url:"{{ url('/count_complaint/process') }}",
            cache: false,
            success: function(msg){
                $("#count_process").html(msg);
            }
        });
        var waktu = setTimeout("cek3()",3000);
    }

    $(document).ready(function(){
        cek3();
    });

    function cek4(){
        
        $.ajax({
            url:"{{ url('/count_complaint/accept') }}",
            cache: false,
            success: function(msg){
                $("#count_accept").html(msg);
            }
        });
        var waktu = setTimeout("cek4()",3000);
    }

    $(document).ready(function(){
        cek4();
    });

    // function play_sound() {
    //     var audioElement = document.createElement('audio');
    //     audioElement.setAttribute('src', '{{ asset("sound/audio_file.mp3") }}');
    //     audioElement.setAttribute('autoplay', 'autoplay');
    //     audioElement.load();
    //     audioElement.play();
    // }
</script>
</html>