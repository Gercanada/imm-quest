@extends('layouts.app')

@section('title')
    Survey
@endsection

@section('styles')
    <style>
        .row {
            height: 1000px;
            max-height: 2000px;
        }

    </style>
    @if (Auth::user() && Auth::user()->themme_layout === 0)
        <style>
            .new-frame {
                opacity: 50%;
                background-color: blue;
                color: red;
                padding: 20px 0 0 2px;
                margin: 2px 0 0 2px;
            }

            #myIframe body .new-frame .navbar-collapse {
                opacity: 100%;
                background-color: green;
                color: red;
            }

            .new-frame body {
                border: 1px;
                background-color: black;
                color: red;
                position: absolute;
            }

            .navbar-form {
                background-color: #4f5467;
            }

        </style>
    @elseif (Auth::user() && Auth::user()->themme_layout === 1)
    @else
    @endif
@endsection
@section('content')
    <iframesurvey-component></iframesurvey-component>
@endsection
