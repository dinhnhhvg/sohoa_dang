<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <!-- Title -->
    <title>{{ session('account') ? __('app.'.session('account')) : env('APP_TITLE') }}</title>
    <!-- Description -->
    <meta content="" name="{{ env('APP_DESCRIPTION') }}">
    <meta content="" name="keywords">

    <meta property="og:title" content="{{ session('account') ? __('app.'.session('account')) : env('APP_TITLE') }}" />
    <meta property="og:description" content="{{ env('APP_TITLE') }}" />
    <meta property="og:image" content="{{ env('APP_LOGO') }}" />
    <meta property="og:type" content="website" />

    <!-- Favicons -->
    <link href="{{ asset(env('APP_FAVICON')) }}" rel="icon">
    <link href="{{ asset(env('APP_FAVICON')) }}" rel="apple-touch-icon">

    <!-- Google Fonts -->
{{--    <link href="https://fonts.gstatic.com" rel="preconnect">--}}
{{--    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">--}}

    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{ asset('assets/bootstrap/5.3.8/css/bootstrap.min.css') }}">
    <!-- Font Awesome icon -->
    <link rel="stylesheet" href="{{ asset('assets/fontawesome/6.7.2/css/all.min.css') }}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('assets/select2/4.0.13/css/select2.css') }}" />
    <!-- Flatpickr -->
    <link rel="stylesheet" href="{{ asset('assets/flatpickr/flatpickr.min.css') }}">
    <!-- Toastr -->
    <link rel="stylesheet" href="{{ asset('assets/toastr/toastr.css') }}">
    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="{{ asset('assets/sweetalert2/dist/sweetalert2.css') }}">
    <!-- Fancybox CSS -->
    <link rel="stylesheet" href="{{ asset('assets/fancyapps/6.1.0/fancybox/fancybox.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/fancyapps/6.1.0/carousel/carousel.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/fancyapps/6.1.0/carousel/carousel.arrows.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/fancyapps/6.1.0/carousel/carousel.thumbs.css') }}">

    <!-- Alohub CSS -->
    <link rel="stylesheet" href="{{ asset('alohub/lib/styles.css') }}">
    <!-- Common CSS -->
    <link href="{{ asset('assets/common/css/app.css') }}" rel="stylesheet">
    <!-- Theme Admin CSS -->
    <link href="{{ asset('assets/theme-admin/css/app.css') }}" rel="stylesheet">

    <!-- CSS -->
    @yield('css-content')
</head>

<body>
<!-- ======= Header ======= -->
<header id="header" class="header fixed-top d-flex align-items-center">
    <div class="d-flex align-items-center justify-content-between">
        <a href="{{ route('index') }}" class="logo d-flex align-items-center">
            <img src="{{ asset(env('APP_FAVICON')) }}" alt="img">
            <span class="d-none d-lg-block">{{ env('APP_TITLE') }}</span>
        </a>
        <i class="fa-solid fa-bars toggle-sidebar-btn"></i>
    </div>

    <nav class="header-nav ms-auto">
        <ul class="d-flex align-items-center">
            <li class="nav-item dropdown">
                <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
                    <img src="{{ asset('assets/common/img/language/'.$activeLanguage.'.png') }}" alt="Image" class="language-image aspect-ratio-11 mb-1">
                </a>
                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow languages">
                    <li class="dropdown-header"><h5 class="text-primary mb-0">{{ __('app.change_language') }}</h5></li>
                    <li><hr class="dropdown-divider"></li>
                    @foreach($activeLanguages as $locale => $language)
                        <li class="language-item">
                            <a href="{{ route('language.change', ['locale' => $locale]) }}" class="d-flex align-items-center p-3">
                                <img src="{{ asset('assets/common/img/language/'.$locale.'.png') }}" alt="Image" class="language-image aspect-ratio-11 me-2">
                                <p class="mb-0 text-primary">{{ $language }}</p>
                            </a>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                    @endforeach
                </ul>
            </li>

            <li class="nav-item dropdown">
                <a class="nav-link nav-icon" href="javascript:void(0)" onclick="showNoteValue()">
                    <i class="fa-regular fa-file"></i>
                </a>
            </li>

            <li class="nav-item dropdown d-none">
                <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
                    <i class="fa-regular fa-bell"></i>
                    <span class="badge bg-danger badge-number">0</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">
                    //
                </ul>
            </li>
            <li class="nav-item dropdown d-none">
                <a class="nav-link nav-icon" href="javascript:void(0)" onclick="conversationIndex()">
                    <i class="bi bi-chat-left-text"></i>
                    <i class="fa-regular fa-comment-dots"></i>
                    <span class="badge bg-danger badge-number unread_conversations_count">0</span>
                </a>
            </li>
            <li class="nav-item dropdown pe-3">
                <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                    <img src="{{ asset(session('user_avatar') ?: env('APP_DEFAULT_AVATAR')) }}" alt="Profile" class="rounded-circle">
                    <span class="d-none d-md-block dropdown-toggle ps-2">{{ session('user_name') }}</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                    <li class="dropdown-header">
                        <h6>{{ session('user_name') }}</h6>
                        <span>{{ session('role_name') }}</span>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="javascript:void(0)"
                           onclick="commonShowModal('{{ route('admin.user.profile', ['user' => session('user_id')]) }}', '#common-modal-fullscreen')">
                            <i class="fa-solid fa-user"></i>
                            <span>{{ __('app.profile') }}</span>
                        </a>
                    </li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <div class="dropdown-item d-flex align-items-center">
                            <i class="fa-solid fa-right-from-bracket"></i>
                            <form method="POST" action="{{ route('admin.logout') }}">
                                @csrf
                                <button type="submit" class="btn-reset">{{ __('app.logout') }}</button>
                            </form>
                        </div>
                    </li>
                </ul>
            </li>
        </ul>
    </nav>
</header>
<!-- ======= End Header ======= -->

<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">
        @foreach($activeMenus as $activeMenu)
            @if($activeMenu['is_menu'])
                <li class="nav-item">
                    @if(count($activeMenu['menus']))
                        <a class="nav-link collapsed" data-bs-target="#{{ $activeMenu['name'] }}-nav" data-bs-toggle="collapse" href="#">
                            <i class="{{ $activeMenu['icon'] }}"></i>
                            <span>{{ __('app.'.$activeMenu['name']) }}</span>
                            <i class="fas fa-chevron-down ms-auto"></i>
                        </a>
                        <ul id="{{ $activeMenu['name'] }}-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                            @foreach($activeMenu['menus'] as $activeSubMenu)
                                @if($activeSubMenu['is_menu'])
                                    <li>
                                        <a href="{{ route($activeSubMenu['router']) }}">
                                            <i class="fa-solid fa-circle-dot fs-11"></i><span>{{ __('app.'.$activeSubMenu['name']) }}</span>
                                        </a>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    @else
                        <a class="nav-link collapsed" href="{{ route($activeMenu['router']) }}">
                            <i class="{{ $activeMenu['icon'] }}"></i>
                            <span>{{ __('app.'.$activeMenu['name']) }}</span>
                        </a>
                    @endif
                </li>
            @endif
        @endforeach
    </ul>
</aside>
<!-- End Sidebar-->

<!-- Main -->
<main id="main" class="main">
    @yield('content')
</main>
<!-- End Main -->

<!-- ======= Footer ======= -->
<footer id="footer" class="footer d-flex align-items-center justify-content-between">
    <div class="copyright ms-4">
        {{ date('Y') }} © <strong><span>HVG</span></strong>.
    </div>
    <div class="credits me-4">
        Designed by <strong><a href="https://hvg.edu.vn/" target="_blank"> Hoàng Vũ Group.</a></strong>
    </div>
</footer>
<!-- End Footer -->

<!-- Jquery -->
<script src="{{ asset('assets/jquery/3.6.4/jquery.min.js') }}"></script>
<!--  Bootstrap -->
<script src="{{ asset('assets/bootstrap/5.3.8/js/bootstrap.bundle.min.js') }}"></script>
<!-- Select2 -->
<script src="{{ asset('assets/select2/4.0.13/js/select2.min.js') }}"></script>
<!-- Flatpickr -->
<script src="{{ asset('assets/flatpickr/flatpickr.min.js') }}"></script>
<!-- Toastr -->
<script src="{{ asset('assets/toastr/toastr.min.js') }}"></script>
<!-- SweetAlert2 JS -->
<script src="{{ asset('assets/sweetalert2/dist/sweetalert2.all.js') }}"></script>
<!-- Fancybox JS -->
<script src="{{ asset('assets/fancyapps/6.1.0/fancybox/fancybox.umd.js') }}"></script>
<script src="{{ asset('assets/fancyapps/6.1.0/carousel/carousel.umd.js') }}"></script>
<script src="{{ asset('assets/fancyapps/6.1.0/carousel/carousel.arrows.umd.js') }}"></script>
<script src="{{ asset('assets/fancyapps/6.1.0/carousel/carousel.thumbs.umd.js') }}"></script>
<!-- CKEditor -->
<script src="{{ asset('assets/ckeditor/ckeditor.js') }}"></script>
<!-- Chart JS -->
<script type="module" src="{{ asset('assets/chart.js/4.4.1/chart.umd.js') }}"></script>

<!-- Theme Admin DoubleScroll -->
<script src="{{ asset('assets/theme-admin/js/jquery.doubleScroll.js') }}"></script>
<!-- Theme Admin JS -->
<script src="{{ asset('assets/theme-admin/js/app.js') }}"></script>

@include('conversation')
@include('common')
@include('note')

<!-- JS -->
@yield('js-content')

<!-- Alohub start -->
<div class="row mb-0">
    <div id="alohub_sipml5">
        <audio id="audio_remote" autoplay="autoplay"></audio>
        <audio id="ringtone" loop="" src="{{ asset('alohub/lib/sounds/ringtone.wav') }}"></audio>
        <audio id="ringBackTone" loop="" src="{{ asset('alohub/lib/sounds/ringBackTone.wav') }}"></audio>
        <audio id="dtmfTone" src="{{ asset('alohub/lib/sounds/dtmf.wav') }}"></audio>
    </div>
</div>

@if(isset($alohubData) && $alohubData)
    <script>
        window.localStorage.setItem('alohubData', '<?= json_encode($alohubData) ?>');
    </script>

    <script src="{{ asset('alohub/lib/jssip.min.js') }}"></script>
    <script src="{{ asset('alohub/lib/sipjs.js') }}"></script>
@endif
<!-- Alohub end -->

</body>
</html>
