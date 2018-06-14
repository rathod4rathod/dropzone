<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} @yield('title')</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    @include('admin.css')
    @yield('pagecss')
</head>
<body class="hold-transition skin-blue sidebar-mini">
    
        <div class="wrapper"><!-- Wrapper-start -->
            @include('admin.header')        
            @include('admin.sidebar')
            @yield('content')
            @include('admin.footer')            
        </div><!-- Wrapper-End -->
    

    @include('admin.js')
    @yield('footerscript')

</body>
</html>
