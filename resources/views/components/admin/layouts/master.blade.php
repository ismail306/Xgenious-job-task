<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bytedash - Admin Template</title>

    <!-- favicon -->
    <link rel=icon href="{{asset('html/favicons.png') }}" sizes="16x16" type="icon/png">
    <!-- animate -->
    <link rel="stylesheet" href="{{asset('html/assets/css/animate.css') }}">
    <!-- bootstrap -->
    <link rel="stylesheet" href="{{asset('html/assets/css/bootstrap.min.css') }}">
    <!-- All Icon -->
    <link rel="stylesheet" href="{{asset('html/assets/css/icon.css') }}">
    <!-- slick carousel  -->
    <link rel="stylesheet" href="{{asset('html/assets/css/slick.css') }}">
    <!-- Select2 Css -->
    <link rel="stylesheet" href="{{asset('html/assets/css/select2.min.css') }}">
    <!-- Sweet alert Css -->
    <link rel="stylesheet" href="{{asset('html/assets/css/sweetalert.css') }}">
    <!-- Flatpickr Css -->
    <link rel="stylesheet" href="{{asset('html/assets/css/flatpickr.min.css') }}">
    <!-- Fancy box Css -->
    <link rel="stylesheet" href="{{asset('html/assets/css/fancybox.css') }}">
    <!-- Main Stylesheet -->
    <link rel="stylesheet" href="{{asset('html/assets/css/dashboard.css') }}">
    <!-- dark css -->

</head>

<body>



    <!-- Dashboard start -->
    <div class="dashboard__area">
        <div class="container-fluid p-0">
            <div class="dashboard__contents__wrapper">
                @if (Auth::check())
                <x-admin.layouts.partials.sidebar />
                @endif
                <div id="loader" style="display: none; position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); z-index: 9999;">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
                @if (Auth::check())
                <div class="dashboard__right">
                    <x-admin.layouts.partials.header />
                    @endif
                    {{$slot}}
                </div>
            </div>
        </div>
    </div>
    <!-- Dashboard end -->


    <x-admin.layouts.partials.scripts />
    @stack('scripts')

</body>

</html>