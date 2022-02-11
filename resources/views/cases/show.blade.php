@extends('layouts.app')

@section('title')
    {{ $case->ticket_title }}
@endsection

@section('scripts')
    <script>
        $('#surveyAlert').delay(10000).hide(0);
    </script>
@endsection
@section('content')
    <show-case-component></show-case-component>
@endsection
