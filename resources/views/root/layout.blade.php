<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <!-- Title -->
    <title>{{ session('account') ? __('app.'.session('account')) : env('HVG_TITLE') }}</title>
    <!-- Description -->
    <meta content="" name="{{ session('account') ? __('app.'.session('account')) : env('HVG_TITLE') }}">
    <meta content="" name="keywords">

    <meta property="og:title" content="{{ session('account') ? __('app.'.session('account')) : env('HVG_TITLE') }}" />
    <meta property="og:description" content="{{ env('HVG_TITLE') }}" />
    <meta property="og:image" content="{{ env('HVG_LOGO') }}" />
    <meta property="og:type" content="website" />

    <!-- Favicons -->
    <link href="{{ asset(env('HVG_FAVICON')) }}" rel="icon">
    <link href="{{ asset(env('HVG_FAVICON')) }}" rel="apple-touch-icon">

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

    <!-- Common CSS -->
    <link href="{{ asset('assets/common/css/app.css') }}" rel="stylesheet">
    <!-- Theme Admin CSS -->
    <link href="{{ asset('assets/theme-admin/css/app.css') }}" rel="stylesheet">

    <!-- CSS -->
    @yield('css-content')
</head>

<body>
<!-- Main -->
<main id="root-main" class="main">
    @yield('content')
</main>
<!-- End Main -->

<!-- ======= Footer ======= -->
<footer id="root-footer" class="footer d-flex align-items-center justify-content-between">
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
<!-- CKEditor -->
<script src="{{ asset('assets/ckeditor/ckeditor.js') }}"></script>

<!-- Theme Admin DoubleScroll -->
<script src="{{ asset('assets/theme-admin/js/jquery.doubleScroll.js') }}"></script>
<!-- Theme Admin JS -->
<script src="{{ asset('assets/theme-admin/js/app.js') }}"></script>

@include('common')

<!-- JS -->
@yield('js-content')

</body>
</html>
