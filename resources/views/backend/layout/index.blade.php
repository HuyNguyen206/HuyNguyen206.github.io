<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title>AdminLTE 3 | Starter</title>
    <base href="{{asset('')}}">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="backend/adminLTE/plugins/fontawesome-free/css/all.min.css">
    @yield('style')
    <!-- Theme style -->
    <link rel="stylesheet" href="backend/adminLTE/dist/css/adminlte.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <link rel="stylesheet" href="backend/assets/css/huy.css">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

    <!-- Navbar -->
@include('backend.layout.header')
<!-- /.navbar -->

    <!-- Main Sidebar Container -->
@include('backend.layout.sidebar')

<!-- Content Wrapper. Contains page content -->
@yield('content')
<!-- /.content-wrapper -->

    <!-- Main Footer -->
    @include('backend.layout.footer')
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="backend/adminLTE/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="backend/adminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
@yield('script')
<!-- AdminLTE App -->
<script src="backend/adminLTE/dist/js/adminlte.min.js"></script>
</body>
</html>
