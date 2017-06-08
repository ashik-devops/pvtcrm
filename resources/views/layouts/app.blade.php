@include('layouts.header')
@include('layouts.main-navigation')
@include('layouts.copyright')
@include('layouts.side-panel')

<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    @yield('before-head-style')
    <link href="//fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800" rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="{{asset('storage/assets/css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('storage/assets/css/bootstrap.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
    <link rel="stylesheet" href="{{asset('storage/assets/css/font-awesome.css')}}">
    <link rel="stylesheet" href="{{asset('storage/assets/css/elegant-icons.css')}}">
    <link rel="stylesheet" href="{{asset('storage/assets/css/pe-7-icons.css')}}">
    <link rel="stylesheet" href="{{asset('storage/assets/css/pe-7-icons-helper.css')}}">
    <link rel="stylesheet" href="{{asset('storage/assets/css/tether-shepherd.css')}}">
    <link rel="stylesheet" href="{{asset('storage/assets/css/jstree-default.css')}}">
    <link rel="stylesheet" href="{{asset('storage/assets/css/select2.min.css')}}">
    @yield('after-head-style')
    <link rel="stylesheet" href="{{asset('storage/assets/css/styles.css')}}">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
		  <script src="https:/oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		  <script src="https:/oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>

    @yield('before-head-script')
    @yield('after-head-script')
    <!-- Styles -->

</head>
<body class="preload nav-toggled">

        @yield('header')
        @yield('main-nav')

        @yield('content')

        <footer>
            @yield('copyright')
        </footer>
        @yield('modal')
        @yield('side-panel')

        @yield('before-footer-script')
        <script src="{{asset('storage/assets/js/jquery.js')}}"></script>
        <script src="{{asset('storage/assets/js/bootstrap.js')}}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
        <script src="{{asset('storage/assets/js/metisMenu.js')}}"></script>
        <script src="{{asset('storage/assets/js/notify.js')}}"></script>
        <script src="{{asset('storage/assets/js/imagesloaded.js')}}"></script>
        <script src="{{asset('storage/assets/js/masonry.js')}}"></script>
        <script src="{{asset('storage/assets/js/pace.js')}}"></script>
        <script src="{{asset('storage/assets/js/tether.js')}}"></script>
        <script src="{{asset('storage/assets/js/tether-shepherd.js')}}"></script>
        <script src="{{asset('storage/assets/js/select2.full.min.js')}}"></script>
        <script src="{{asset('storage/assets/js/main.js')}}"></script>
        @yield('after-footer-script')
        @yield('company-create-edit-delete-scripts')
        @yield('customer-create-edit-delete-scripts')





</body>
</html>
