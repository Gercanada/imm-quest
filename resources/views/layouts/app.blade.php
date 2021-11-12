<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16"
        href="/templates/theme-forest-admin-pro/main/admin-pro/src/assets/images/favicon.png">
    <title>Adminpro admin Template - The Ultimate Multipurpose admin template</title>
    <link rel="canonical" href="https://www.wrappixel.com/templates/adminpro/" />

    <link rel="stylesheet"
        href="/templates/theme-forest-admin-pro/main/admin-pro/src/assets/libs/chartist/dist/chartist.min.css">
    <link rel="stylesheet"
        href="/templates/theme-forest-admin-pro/main/admin-pro/dist/js/pages/chartist/chartist-init.css">
    <link rel="stylesheet"
        href="/templates/theme-forest-admin-pro/main/admin-pro/src/assets/libs/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.css">
    <link rel="stylesheet" href="/templates/theme-forest-admin-pro/main/admin-pro/src/assets/libs/c3/c3.min.css">
    <link rel="stylesheet"
        href="/templates/theme-forest-admin-pro/main/admin-pro/src/assets/libs/jvectormap/jquery-jvectormap.css">
    <link rel="stylesheet" href="/templates/theme-forest-admin-pro/main/admin-pro/dist/css/style.min.css">

    <!-- Vector CSS -->
    <!-- Custom CSS -->
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body>
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        @if (Auth::user())
            <header class="topbar">
                @include('layouts.navbar')
            </header>
        @endif
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        {{-- @include('layouts.side-panel') --}}
        @if (Auth::user())
            @include('layouts.aside')
        @endif
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            @yield('content')
            <footer class="footer">
                © 2020 Admin Pro Admin by wrappixel.com
            </footer>
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
        </div>

    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- customizer Panel -->
    <!-- ============================================================== -->
    <div class="chat-windows"></div>
    <!-- ============================================================== -->


    <!-- Popper JS -->
    <script src="/templates/theme-forest-admin-pro/main/admin-pro/src/assets/libs/jquery/dist/jquery.min.js"></script>

    <script src="/templates/theme-forest-admin-pro/main/admin-pro/src/assets/libs/popper.js/dist/umd/popper.min.js">
    </script>
    <script src="/templates/theme-forest-admin-pro/main/admin-pro/src/assets/libs/bootstrap/dist/js/bootstrap.min.js">
    </script>
    <script src="/templates/theme-forest-admin-pro/main/admin-pro/dist/js/app.min.js"></script>
    <script src="/templates/theme-forest-admin-pro/main/admin-pro/dist/js/app.init.js"></script>
    <script src="/templates/theme-forest-admin-pro/main/admin-pro/dist/js/app-style-switcher.js"></script>
    <script
        src="/templates/theme-forest-admin-pro/main/admin-pro/src/assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js">
    </script>
    <script src="/templates/theme-forest-admin-pro/main/admin-pro/src/assets/extra-libs/sparkline/sparkline.js"></script>
    <script src="/templates/theme-forest-admin-pro/main/admin-pro/dist/js/waves.js"></script>
    <script src="/templates/theme-forest-admin-pro/main/admin-pro/dist/js/sidebarmenu.js"></script>
    <script src="/templates/theme-forest-admin-pro/main/admin-pro/dist/js/feather.min.js"></script>
    <script src="/templates/theme-forest-admin-pro/main/admin-pro/dist/js/custom.js"></script>
    <script src="/templates/theme-forest-admin-pro/main/admin-pro/src/assets/libs/chartist/dist/chartist.min.js"></script>
    <script
        src="/templates/theme-forest-admin-pro/main/admin-pro/src/assets/libs/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js">
    </script>
    <script src="/templates/theme-forest-admin-pro/main/admin-pro/src/assets/libs/d3/dist/d3.min.js"></script>
    <script src="/templates/theme-forest-admin-pro/main/admin-pro/src/assets/libs/c3/c3.min.js"></script>

    <script src="/templates/theme-forest-admin-pro/main/admin-pro/dist/js/pages/dashboards/dashboard2.js"></script>

    <!-- All scripts -->
    @yield('scripts')




</body>

</html>
