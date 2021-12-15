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
        href="{{env('ASSET_URL')}}templates/theme-forest-admin-pro/main/admin-pro/src/assets/images/favicon.png">
    <title>GetCanada CP | @yield('title') </title>
    <link rel="canonical" href="https://www.wrappixel.com{{env('ASSET_URL')}}templates/adminpro/" />
    <link rel="stylesheet"
        href="{{env('ASSET_URL')}}templates/theme-forest-admin-pro/main/admin-pro/src/assets/libs/chartist/dist/chartist.min.css">
    <link rel="stylesheet"
        href="{{env('ASSET_URL')}}templates/theme-forest-admin-pro/main/admin-pro/dist/js/pages/chartist/chartist-init.css">
    <link rel="stylesheet"
        href="{{env('ASSET_URL')}}templates/theme-forest-admin-pro/main/admin-pro/src/assets/libs/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.css">
    <link rel="stylesheet" href="{{env('ASSET_URL')}}templates/theme-forest-admin-pro/main/admin-pro/src/assets/libs/c3/c3.min.css">
    <link rel="stylesheet"
        href="{{env('ASSET_URL')}}templates/theme-forest-admin-pro/main/admin-pro/src/assets/libs/jvectormap/jquery-jvectormap.css">
    <link rel="stylesheet" href="{{env('ASSET_URL')}}templates/theme-forest-admin-pro/main/admin-pro/dist/css/style.min.css">

    @yield('styles')

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
    <div id="main-wrapper">
        <!-- ============================================================== -->
        <!-- Main wrapper - style you can find in pages.scss -->
        <!-- ============================================================== -->
        @if (!Auth::user())
            @yield('content'){{-- login view --}}
        @else
            @if (Auth::user())
                <header class="topbar">
                    @include('layouts.navbar')
                </header>
            @endif
            {{-- aside --}}
            @if (Auth::user())
                @include('layouts.aside')
            @endif
            {{-- body --}}
            <div class="page-wrapper">
                <div class="container-fluid">
                    @if (Auth::user())
                        @yield('content')
                    @endif
                </div>
                <footer class="footer">
                    © 2020 Admin Pro Admin by wrappixel.com
                </footer>
            </div>
        @endif

    </div>

    <!-- ============================================================== -->
    {{-- <div class="chat-windows"></div> --}}
    <!-- ============================================================== -->
</body>

<!-- Popper JS -->
<script src="{{env('ASSET_URL')}}templates/theme-forest-admin-pro/main/admin-pro/src/assets/libs/jquery/dist/jquery.min.js"></script>

<script src="{{env('ASSET_URL')}}templates/theme-forest-admin-pro/main/admin-pro/src/assets/libs/popper.js/dist/umd/popper.min.js">
</script>
<script src="{{env('ASSET_URL')}}templates/theme-forest-admin-pro/main/admin-pro/src/assets/libs/bootstrap/dist/js/bootstrap.min.js">
</script>
<script src="{{env('ASSET_URL')}}templates/theme-forest-admin-pro/main/admin-pro/dist/js/app.min.js"></script>
<script src="{{env('ASSET_URL')}}templates/theme-forest-admin-pro/main/admin-pro/dist/js/app.init.darks5.js"></script>
<script src="{{env('ASSET_URL')}}templates/theme-forest-admin-pro/main/admin-pro/dist/js/app-style-switcher.js"></script>
<script
src="{{env('ASSET_URL')}}templates/theme-forest-admin-pro/main/admin-pro/src/assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js">
</script>
<script src="{{env('ASSET_URL')}}templates/theme-forest-admin-pro/main/admin-pro/src/assets/extra-libs/sparkline/sparkline.js"></script>
<script src="{{env('ASSET_URL')}}templates/theme-forest-admin-pro/main/admin-pro/dist/js/waves.js"></script>
<script src="{{env('ASSET_URL')}}templates/theme-forest-admin-pro/main/admin-pro/dist/js/sidebarmenu.js"></script>
<script src="{{env('ASSET_URL')}}templates/theme-forest-admin-pro/main/admin-pro/dist/js/feather.min.js"></script>
<script src="{{env('ASSET_URL')}}templates/theme-forest-admin-pro/main/admin-pro/dist/js/custom.js"></script>
<script src="{{env('ASSET_URL')}}templates/theme-forest-admin-pro/main/admin-pro/src/assets/libs/chartist/dist/chartist.min.js"></script>
<script
src="{{env('ASSET_URL')}}templates/theme-forest-admin-pro/main/admin-pro/src/assets/libs/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js">
</script>
<script src="{{env('ASSET_URL')}}templates/theme-forest-admin-pro/main/admin-pro/src/assets/libs/d3/dist/d3.min.js"></script>
<script src="{{env('ASSET_URL')}}templates/theme-forest-admin-pro/main/admin-pro/src/assets/libs/c3/c3.min.js"></script>

<script src="{{env('ASSET_URL')}}templates/theme-forest-admin-pro/main/admin-pro/dist/js/pages/dashboards/dashboard2.js"></script>

<!-- All scripts -->

<script src="{{env('ASSET_URL')}}templates/theme-forest-admin-pro/main/admin-pro/src/assets/libs/select2/dist/js/select2.full.min.js">
</script>
<script src="{{env('ASSET_URL')}}templates/theme-forest-admin-pro/main/admin-pro/src/assets/libs/select2/dist/js/select2.min.js">
</script>

<script src="{{env('ASSET_URL')}}templates/theme-forest-admin-pro/main/admin-pro/src/assets/libs/sweetalert2/dist/sweetalert2.all.min.js">
</script>
<script src="{{env('ASSET_URL')}}templates/theme-forest-admin-pro/main/admin-pro/src/assets/extra-libs/sweetalert2/sweet-alert.init.js">
</script>

<script src="{{env('ASSET_URL')}}templates/theme-forest-admin-pro/main/admin-pro/dist/js/pages/forms/select2/select2.init.js">
</script>
<script src="{{env('ASSET_URL')}}templates/theme-forest-admin-pro/main/admin-pro/dist/js/pages/forms/select2/select2.init.js">
</script>

<script src="{{env('ASSET_URL')}}js/app.js"></script>
@yield('scripts')

</html>
