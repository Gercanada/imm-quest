@extends('layouts.app')
@section('title')
    Home
@endsection

@section('styles')
    <style>
        .popover {
            border: none;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
            border-radius: 0.25rem !important;
        }

        .popover a {
            border-bottom: 1px;
        }

        .popover .popover-header {
            border-bottom: none
        }

        .left .arrow::after {
            right: 0px;
            border-left-color: transparent;
        }
    </style>
    @if (Auth::user() && Auth::user()->themme_layout === 0)
        {{-- dark --}}
        <style>
            .bs-popover-auto[x-placement^=left]>.arrow::after,
            .bs-popover-left>.arrow::after {
                right: 1px;
                border-width: 0.5rem 0 0.5rem 0.5rem;
                border-left-color: #0a0a0a;
            }

            .popover {
                background-color: black;
            }

            .popover .popover-header {
                background-color: black;
            }

            .popover .popover-body {
                background-color: rgb(41, 41, 41);
            }
        </style>
    @elseif (Auth::user() && Auth::user()->themme_layout === 1)
        {{-- ligth --}}
        <style>
            .bs-popover-auto[x-placement^=left]>.arrow::after,
            .bs-popover-left>.arrow::after {
                right: 1px;
                border-width: 0.5rem 0 0.5rem 0.5rem;
                border-left-color: rgb(236, 236, 236);
                ;
            }

            .popover {
                background-color: white;
            }

            .popover .popover-header {
                background-color: rgb(236, 236, 236);
                border-bottom: none
            }

            .popover .popover-body {
                background-color: white;
                border-top: none
            }
        </style>
    @else
    @endif
@endsection

@section('scripts')
    <script>
        $("[data-toggle=popover]").popover({
            html: true
        });
    </script>
@endsection

@section('content')
    <template v-if="menu==0">
        <content-component />
    </template>

    <template v-if="menu==1">
        <user-component>
    </template>

    {{-- <main-component /> --}}
@endsection
