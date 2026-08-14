<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Title -->
    <title>{{ session('account') ? __('app.'.session('account')) : env('APP_TITLE') }}</title>
    <!-- Description -->
    <meta content="" name="{{ env('APP_DESCRIPTION') }}">
    <meta content="" name="keywords">

    <meta property="og:title" content="{{ session('account') ? __('app.'.session('account')) : env('APP_TITLE') }}" />
    <meta property="og:description" content="{{ env('APP_TITLE') }}" />
    <meta property="og:image" content="{{ env('APP_LOGO') }}" />
    <meta property="og:type" content="website" />

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset(env('APP_FAVICON')) }}">

    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{ asset('assets/bootstrap/5.3.8/css/bootstrap.min.css') }}">
    <!-- Font Awesome Icon -->
    <link rel="stylesheet" href="{{ asset('assets/fontawesome/6.7.2/css/all.min.css') }}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('assets/select2/4.0.13/css/select2.css') }}" />
    <!-- Toastr -->
    <link rel="stylesheet" href="{{ asset('assets/toastr/toastr.css') }}">

    <!-- Common App CSS -->
    <link href="{{ asset('assets/common/css/app.css') }}" rel="stylesheet">
    <!-- Admin Auth -->
    <link href="{{ asset('assets/theme-auth/css/app.css') }}" rel="stylesheet">
</head>

<body class="position-relative pb-5">
<nav class="navbar navbar-expand-lg navbar-light bg-primary">
    <div class="container">
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a href="tel:{{ env('APP_PHONE') }}" class="nav-link text-white"><span>Hotline: {{ env('APP_PHONE') }}</span></a>
                </li>
                <li class="nav-item">
                    <a href="javascript:void(0)" class="nav-link text-white">|</a>
                </li>
                <li class="nav-item">
                    <a href="mail-to:{{ env('APP_EMAIL') }}" class="nav-link text-white"><span>Email: {{ env('APP_EMAIL') }}</span></a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-12 text-center mb-5">
            <a href="{{ route('index') }}">
                <img src="{{ asset(env('APP_LOGO')) }}" alt="logo" class="img-250">
            </a>
        </div>
    </div>
    @yield('content')
</div>

<footer class="position-fixed bg-light text-secondary pt-3 pb-3 w-100">
    <div class="container-fluid">
        <div class="row">
            <div class="col-6">
                <div class="text-right">
                    <p class="mb-0">&copy; {{ date('Y') }} HVG.</p>
                </div>
            </div>
            <div class="col-6">
                <div class="float-end">
                    <p class="mb-0">
                        Designed by <strong><a href="https://hvg.edu.vn/" target="_blank"> Hoàng Vũ Group.</a></strong>
                    </p>
                </div>
            </div>
        </div>
    </div>
</footer>

<!-- jQuery  -->
<script src="{{ asset('assets/jquery/3.6.4/jquery.min.js') }}"></script>
<!-- Bootstrap -->
<script src="{{ asset('assets/bootstrap/5.3.8/js/bootstrap.bundle.min.js') }}"></script>
<!-- Select2 -->
<script src="{{ asset('assets/select2/4.0.13/js/select2.min.js') }}"></script>
<!-- Toastr -->
<script src="{{ asset('assets/toastr/toastr.min.js') }}"></script>
<!-- Theme Admin DoubleScroll -->
<script src="{{ asset('assets/theme-admin/js/jquery.doubleScroll.js') }}"></script>

@include('common')

</body>
</html>
