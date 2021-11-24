@extends('layouts.app')

@section('title')
    Enable/Disable modules
@endsection

@section('styles')
    <link rel="stylesheet"
        href="/templates/theme-forest-admin-pro/main/admin-pro/src/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css">

    <link rel="stylesheet" type="text/css" --}}
        href="/templates/theme-forest-admin-pro/main/admin-pro/src/assets/libs/select2/dist/css/select2.min.css">

    <link href="/templates/theme-forest-admin-pro/main/admin-pro/dist/css/style.min.css" rel="stylesheet">
@endsection

@section('content')
    <user-portal-tools></user-portal-tools>
@endsection

@section('scripts')
    <!-- apps -->
    <script src="/templates/theme-forest-admin-pro/main/admin-pro/dist/js/app.min.js"></script>
    {{-- <script src="/templates/theme-forest-admin-pro/main/admin-pro/dist/js/app.init.stylish-menu.js"></script> --}}
    <!-- slimscrollbar scrollbar JavaScript -->
    <!--Menu sidebar -->
    <script src="/templates/theme-forest-admin-pro/main/admin-pro/dist/js/sidebar-stylish.js"></script>
    <!-- This Page JS -->
    <script src="/templates/theme-forest-admin-pro/main/admin-pro/src/assets/libs/select2/dist/js/select2.full.min.js">
    </script>
    <script src="/templates/theme-forest-admin-pro/main/admin-pro/src/assets/libs/select2/dist/js/select2.min.js"></script>
    <script src="/templates/theme-forest-admin-pro/main/admin-pro/dist/js/pages/forms/select2/select2.init.js"></script>

    <script src="/templates/theme-forest-admin-pro/main/admin-pro/src/assets/libs/select2/dist/js/select2.full.min.js">
    </script>
    <script src="/templates/theme-forest-admin-pro/main/admin-pro/src/assets/libs/select2/dist/js/select2.min.js">
    </script>
    <script src="/templates/theme-forest-admin-pro/main/admin-pro/dist/js/pages/forms/select2/select2.init.js">
    </script>

    <script
        src="/templates/theme-forest-admin-pro/main/admin-pro/src/assets/libs/datatables/media/js/jquery.dataTables.min.js">
    </script>
    <script src="/templates/theme-forest-admin-pro/main/admin-pro/dist/js/pages/datatable/custom-datatable.js"></script>
    <script src="/templates/theme-forest-admin-pro/main/admin-pro/dist/js/pages/datatable/datatable-basic.init.js">
    </script>

@endsection
