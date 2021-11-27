@extends('layouts.app')

@section('title')
    {{ $case->ticket_title }}
@endsection


@section('content')
    <show-case-component></show-case-component>

@endsection
