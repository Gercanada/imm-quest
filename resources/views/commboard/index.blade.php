@extends('layouts.app')
@section('title')
    Comm board
@endsection
@section('content')
<commboard-component></commboard-component>
@endsection
@section('scripts')
    <script src="/{{ env('ASSET_URL') }}templates/theme-forest-admin-pro/main/admin-pro/dist/js/pages/chat/chat.js">
    </script>
@endsection
