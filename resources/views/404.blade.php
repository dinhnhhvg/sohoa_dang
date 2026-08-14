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
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <!-- Font Awesome icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" />
    <!-- Flatpickr -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <!-- Toastr -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    <!-- Common CSS -->
    <link href="{{ asset('assets/common/css/app.css') }}" rel="stylesheet">
    <!-- Theme Admin CSS -->
    <link href="{{ asset('assets/theme-admin/css/app.css') }}" rel="stylesheet">
</head>

<body>

<main>
    <div class="container">
        <section class="section error-404 min-vh-100 d-flex flex-column align-items-center justify-content-center">
            <h1>404</h1>
            <h2>{{ __('app.message.the_page_you_are_looking_for_doesnt_exist') }}</h2>
            <a class="btn" href="{{ route('index') }}">{{ __('app.back_to_home') }}</a>
            <img src="{{ asset('assets/common/img/not-found.svg') }}" class="img-fluid py-5" alt="Page Not Found">
            <div class="credits">
                Designed by <a href="https://hvg.edu.vn/"> Hoàng Vũ Group.</a>
            </div>
        </section>

    </div>
</main>

<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<!--  Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<!-- Jquery -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<!-- Select2 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<!-- Flatpickr -->
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<!-- Toastr -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<!-- SweetAlert2 JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- CKEditor -->
<script src="{{ asset('vendor/ckeditor/ckeditor.js') }}"></script>

<!-- Theme Admin DoubleScroll -->
<script src="{{ asset('assets/theme-admin/js/jquery.doubleScroll.js') }}"></script>
<!-- Theme Admin JS -->
<script src="{{ asset('assets/theme-admin/js/app.js') }}"></script>

</body>
</html>
