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
    <link rel="stylesheet" type="text/css"
        href="/{{ env('ASSET_URL') }}templates/theme-forest-admin-pro/main/admin-pro/src/assets/libs/select2/dist/css/select2.min.css">
    <!-- Custom CSS -->
    <link href="/{{ env('ASSET_URL') }}templates/theme-forest-admin-pro/main/admin-pro/dist/css/style.min.css"
        rel="stylesheet">@yield('styles')

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
        {{-- @if (!Auth::user()) --}}
        {{-- @yield('content') --}}
        {{-- login view --}}
        {{-- @else --}}
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
        {{-- <div class=""> --}}
        <div class="page-wrapper">
            <div class="container-fluid">
                @yield('content'){{-- temp --}}
                {{-- @if (Auth::user())
                    @yield('content')
                @endif --}}
            </div>
            <footer class="footer">
                © 2020 Admin Pro Admin by wrappixel.com
            </footer>
        </div>
        {{-- @endif --}}

    </div>

    <!-- ============================================================== -->
    {{-- <div class="chat-windows"></div> --}}
    <!-- ============================================================== -->
    <!-- Popper JS -->
    <script
        src="/{{ env('ASSET_URL') }}templates/theme-forest-admin-pro/main/admin-pro/src/assets/libs/jquery/dist/jquery.min.js">
    </script>
    <!-- Bootstrap tether Core JavaScript -->
    <script
        src="/{{ env('ASSET_URL') }}templates/theme-forest-admin-pro/main/admin-pro/src/assets/libs/popper.js/dist/umd/popper.min.js">
    </script>
    <script
        src="/{{ env('ASSET_URL') }}templates/theme-forest-admin-pro/main/admin-pro/src/assets/libs/bootstrap/dist/js/bootstrap.min.js">
    </script>
    <!-- apps -->
    <script src="/{{ env('ASSET_URL') }}templates/theme-forest-admin-pro/main/admin-pro/dist/js/app.min.js"></script>


    @if (Auth::user() && Auth::user()->themme_layout === 0)
    @elseif (Auth::user() && Auth::user()->themme_layout === 1)
        <script src="/{{ env('ASSET_URL') }}templates/theme-forest-admin-pro/main/admin-pro/dist/js/app.init.js"></script>
    @else
        {{-- <script src="/{{ env('ASSET_URL') }}templates/theme-forest-admin-pro/main/admin-pro/dist/js/app.init.js"></script> --}}
    @endif

    <script src="/{{ env('ASSET_URL') }}templates/theme-forest-admin-pro/main/admin-pro/dist/js/app-style-switcher.js">
    </script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script
        src="/{{ env('ASSET_URL') }}templates/theme-forest-admin-pro/main/admin-pro/src/assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js">
    </script>
    <script
        src="/{{ env('ASSET_URL') }}templates/theme-forest-admin-pro/main/admin-pro/src/assets/extra-libs/sparkline/sparkline.js">
    </script>
    <!--Wave Effects -->
    <script src="/{{ env('ASSET_URL') }}templates/theme-forest-admin-pro/main/admin-pro/dist/js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="/{{ env('ASSET_URL') }}templates/theme-forest-admin-pro/main/admin-pro/dist/js/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
    <script src="/{{ env('ASSET_URL') }}templates/theme-forest-admin-pro/main/admin-pro/dist/js/feather.min.js"></script>
    <script src="/{{ env('ASSET_URL') }}templates/theme-forest-admin-pro/main/admin-pro/dist/js/custom.min.js"></script>
    <!-- This Page JS -->
    <script
        src="/{{ env('ASSET_URL') }}templates/theme-forest-admin-pro/main/admin-pro/src/assets/libs/select2/dist/js/select2.full.min.js">
    </script>
    <script
        src="/{{ env('ASSET_URL') }}templates/theme-forest-admin-pro/main/admin-pro/src/assets/libs/select2/dist/js/select2.min.js">
    </script>
    <script
        src="/{{ env('ASSET_URL') }}templates/theme-forest-admin-pro/main/admin-pro/dist/js/pages/forms/select2/select2.init.js">
    </script>


    <script src="/{{ env('ASSET_URL') }}js/app.js"></script>

    @yield('scripts')
</body>


</html>
