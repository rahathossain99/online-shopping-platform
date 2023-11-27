<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Administrative Panel</title>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset("admin-assets/plugins/fontawesome-free/css/all.min.css") }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset("admin-assets/css/adminlte.min.css") }}">
    <link rel="stylesheet" href="{{ asset("admin-assets/plugins/dropzone/min/dropzone.min.css") }}">
    <link rel="stylesheet" href="{{ asset('admin-assets/plugins/summernote/summernote-bs4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin-assets/plugins/select2/css/select2.css') }}">

    <link rel="stylesheet" href="{{ asset("admin-assets/css/custom.css") }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body class="hold-transition sidebar-mini">

<!-- Site wrapper -->
<div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
        </ul>
        <div class="navbar-nav pl-2">
            @yield('navbar')
        </div>
        @include("admin.layouts.navbar")
    </nav>
    <!-- /.navbar -->


    <!-- Main Sidebar Container -->
    @include("admin.layouts.side-bar")
    <!-- ./Sidebar Container -->


    <!-- Content Wrapper. Contains page content -->
    @yield('content')
    <!-- /.content-wrapper -->


    <!----footer------>
    <footer class="main-footer">
        <strong>Copyright &copy; 2014-2023 AmazingShop All rights reserved.</strong>
    </footer>
    <!----./footer------>

</div>
<!-- ./wrapper -->


<!-- jQuery -->
<script src="{{ asset("admin-assets/plugins/jquery/jquery.min.js") }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset("admin-assets/plugins/bootstrap/js/bootstrap.bundle.min.js") }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset("admin-assets/js/adminlte.min.js") }}"></script>
<script src="{{ asset("admin-assets/plugins/dropzone/min/dropzone.min.js") }}"></script>
<script src="{{ asset("admin-assets/plugins/summernote/summernote-bs4.min.js") }}"></script>
<script src="{{ asset("admin-assets/plugins/select2/js/select2.min.js") }}"></script>

<!-- AdminLTE for demo purposes -->
<script src="{{ asset("admin-assets/js/demo.js") }}"></script>

<script type="text/javascript">
    $.ajaxSetup({
        headers:{
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

</script>

<!-- customJS -->
@yield('customJs')
<!-- ./customJS -->

</body>
</html>
