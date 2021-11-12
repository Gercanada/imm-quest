<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

     <!-- CSRF Token -->
     <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Customers portal | Dashboard</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="/css/adminlte.css">


</head>

<body @auth class="dark-mode  layout-navbar-fixed" @else class=" dark-mode  layout-navbar-fixed sidebar-collapse sidebar-closed" @endauth>
    <div class="wrapper">

        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="images/mapple-leafs.png" alt="AdminLTELogo" height="260" width="260">
        </div>


        <!-- Main Sidebar Container -->
        <div id="app">
            <!-- Navbar -->
            @include('layouts.navbar')
            <!-- /.navbar -->
            @if (Auth::user())
            @include('layouts.aside-l')
            @endif
            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                {{-- @yield('body_contend') --}}
                @yield('content')
            </div>
        </div>

        <!-- /.content-wrapper -->
        @include('layouts.footer')

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    @yield('scripts')
    <script src="js/app.js"></script>




    {{-- <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script> --}}



</body>

</html>
