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
    @if (env('APP_ENV') === 'local')
        <link rel="icon" type="image/png" sizes="16x16" href="/{{ env('ASSET_URL') }}images/immvisassquarelight.png">
    @else
        <link rel="icon" type="image/png" sizes="16x16" href="/{{ env('ASSET_URL') }}images/immvisassquare.png">
    @endif
    <title>GetCanada CP | @yield('title') </title>
    <link rel="canonical" href="https://www.wrappixel.com/{{ env('ASSET_URL') }}templates/adminpro/" />

    <link rel="stylesheet"
        href="/{{ env('ASSET_URL') }}templates/theme-forest-admin-pro/main/admin-pro/src/assets/libs/chartist/dist/chartist.min.css">
    <link rel="stylesheet"
        href="/{{ env('ASSET_URL') }}templates/theme-forest-admin-pro/main/admin-pro/dist/js/pages/chartist/chartist-init.css">
    <link rel="stylesheet"
        href="/{{ env('ASSET_URL') }}templates/theme-forest-admin-pro/main/admin-pro/src/assets/libs/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.css">
    <link rel="stylesheet"
        href="/{{ env('ASSET_URL') }}templates/theme-forest-admin-pro/main/admin-pro/src/assets/libs/c3/c3.min.css">
    <link rel="stylesheet"
        href="/{{ env('ASSET_URL') }}templates/theme-forest-admin-pro/main/admin-pro/src/assets/libs/jvectormap/jquery-jvectormap.css">

    <link rel="stylesheet"
        href="/{{ env('ASSET_URL') }}templates/theme-forest-admin-pro/main/admin-pro/src/assets/libs/bootstrap-switch/dist/css/bootstrap3/bootstrap-switch.min.css">

    <link rel="stylesheet"
        href="/{{ env('ASSET_URL') }}templates/theme-forest-admin-pro/main/admin-pro/src/assets/libs/select2/dist/css/select2.min.css">

    <link rel="stylesheet"
        href="/{{ env('ASSET_URL') }}templates/theme-forest-admin-pro/main/admin-pro/dist/css/style.min.css">
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

    {{-- @if (Auth::check())
        @php
            $user_auth_data = [
                'isLoggedin' => true,
                'user' => Auth::user(),
            ];
        @endphp
    @else
        @php
            $user_auth_data = [
                'isLoggedin' => false,
            ];
        @endphp
    @endif
    <script>
        window.Laravel = JSON.parse(atob('{{ base64_encode(json_encode($user_auth_data)) }}'));
    </script> --}}

    <div id="main-wrapper">
        <!-- ============================================================== -->
        <!-- Main wrapper - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <header class="topbar">
            @include('layouts.navbar')
        </header>
        @include('layouts.aside')

        @if (!Auth::user())
            {{-- @yield('content') --}}{{-- login view --}}
            @php
                $user_auth_data = [
                    'isLoggedin' => false,
                ];
            @endphp
        @endif
        {{-- @else --}}
        @if (Auth::user())
            {{-- <header class="topbar">
            @include('layouts.navbar')
             </header> --}}
            @php
                $user_auth_data = [
                    'isLoggedin' => true,
                    'user' => Auth::user(),
                ];
            @endphp
        @endif
        {{-- aside --}}
        @if (Auth::user())
            {{-- @include('layouts.aside') --}}
        @endif
        {{-- body --}}
        <div class="page-wrapper">
            {{-- <div class="container-fluid"> --}}
            @yield('content')
            @if (Auth::user())
                {{-- @yield('content') --}}
            @endif
            {{-- </div> --}}
            <footer class="footer">
                © 2020 Admin Pro Admin by wrappixel.com
            </footer>
        </div>
        {{-- @endif --}}


    </div>
    <script>
        window.Laravel = JSON.parse(atob('{{ base64_encode(json_encode($user_auth_data)) }}'));
    </script>

    <script
        src="/{{ env('ASSET_URL') }}templates/theme-forest-admin-pro/main/admin-pro/src/assets/libs/jquery/dist/jquery.min.js">
    </script>
    <script
        src="/{{ env('ASSET_URL') }}templates/theme-forest-admin-pro/main/admin-pro/src/assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js">
    </script>

    <script
        src="/{{ env('ASSET_URL') }}templates/theme-forest-admin-pro/main/admin-pro/src/assets/libs/popper.js/dist/umd/popper.min.js">
    </script>
    <script
        src="/{{ env('ASSET_URL') }}templates/theme-forest-admin-pro/main/admin-pro/src/assets/libs/bootstrap/dist/js/bootstrap.min.js">
    </script>
    <script src="/{{ env('ASSET_URL') }}templates/theme-forest-admin-pro/main/admin-pro/dist/js/app.min.js"></script>

    @if (Auth::user() && Auth::user()->themme_layout === 0)
        <script src="/{{ env('ASSET_URL') }}templates/theme-forest-admin-pro/main/admin-pro/dist/js/app.init.darks5.js">
        </script>
    @elseif (Auth::user() && Auth::user()->themme_layout === 1)
        <script src="/{{ env('ASSET_URL') }}templates/theme-forest-admin-pro/main/admin-pro/dist/js/app.init.ligth.js">
        </script>
    @else
        <script src="/{{ env('ASSET_URL') }}templates/theme-forest-admin-pro/main/admin-pro/dist/js/app.init.darks5.js">
        </script>
    @endif
    <script src="/{{ env('ASSET_URL') }}templates/theme-forest-admin-pro/main/admin-pro/dist/js/app-style-switcher.js">
    </script>

    <script
        src="/{{ env('ASSET_URL') }}templates/theme-forest-admin-pro/main/admin-pro/src/assets/extra-libs/sparkline/sparkline.js">
    </script>
    <script src="/{{ env('ASSET_URL') }}templates/theme-forest-admin-pro/main/admin-pro/dist/js/waves.js"></script>
    <script src="/{{ env('ASSET_URL') }}templates/theme-forest-admin-pro/main/admin-pro/dist/js/sidebarmenu.js"></script>
    <script src="/{{ env('ASSET_URL') }}templates/theme-forest-admin-pro/main/admin-pro/dist/js/feather.min.js"></script>
    <script src="/{{ env('ASSET_URL') }}templates/theme-forest-admin-pro/main/admin-pro/dist/js/custom.min.js"></script>

    <script
        src="/{{ env('ASSET_URL') }}templates/theme-forest-admin-pro/main/admin-pro/src/assets/libs/d3/dist/d3.min.js">
    </script>
    <script src="/{{ env('ASSET_URL') }}templates/theme-forest-admin-pro/main/admin-pro/src/assets/libs/c3/c3.min.js">
    </script>


    <script
        src="/{{ env('ASSET_URL') }}templates/theme-forest-admin-pro/main/admin-pro/src/assets/libs/sweetalert2/dist/sweetalert2.all.min.js">
    </script>

    <script
        src="/{{ env('ASSET_URL') }}templates/theme-forest-admin-pro/main/admin-pro/src/assets/extra-libs/sweetalert2/sweet-alert.init.js">
    </script>

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
    @if (env('APP_ENV') === 'local')
        {{-- <script src="/{{ env('ASSET_URL') }}js/app.js"></script> --}}
    @else
        {{-- <script src="/{{ env('ASSET_URL') }}js/app.min.js"></script> --}}
    @endif

    @yield('scripts')

</body>


</html>
