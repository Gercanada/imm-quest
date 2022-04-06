@extends('layouts.app')
@section('title')
    Dashboard
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
        {{-- dark --}}
    @endif
@endsection

@section('scripts')
    <script>
        $("[data-toggle=popover]").popover({
            html: true
        });

       /*  function() {
            $('[data-toggle="popover"]').popover();
        }); */
    </script>
@endsection

@section('content')
        <!-- ============================================================== -->
        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <div class="row page-titles">
            <div class="col-md-5 col-12 align-self-center">
                <h3 class="card-title text-themecolor mb-0">Dashboard
                </h3>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- Start Row -->
        {{-- <div class="myDIV">Hover over me.</div>
    <div class="hide">I am shown when someone hovers over the div above.</div> --}}

        <div class="row ">
            <div class="col-lg-4 col-md-6">
                <a href="{{ route('checklists') }}">
                    <div class="card shadow  p-1 rounded">
                        <div class="card-body">
                            <div class="d-flex no-block">
                                <div class="mr-3 align-self-center"><span class="lstick d-inline-block align-middle"></span>
                                    <i class="fas fa-clipboard-check fa-3x"></i>
                                </div>
                                <div class="align-self-center">
                                    <h6 class="text-muted mt-2 mb-0">Active checklists</h6>
                                    <h2 class="text-center">{{ $vt_checklists }}</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-lg-4 col-md-6">
                {{-- <a href="#" data-placement="right" data-toggle="popover" title="Go to clitem"
                    data-content="<a href='' title='test add link'>link 1 </a> </br> <a href=''  title='test add link'>link 2 </a>"
                    class="bg-info"> --}}
                    <div class="card shadow  p-1 rounded">
                        <div class="card-body">
                            <div class="d-flex no-block">
                                <div class="mr-3 align-self-center"><span class="lstick d-inline-block align-middle">
                                    </span>
                                    <i style="font-size: 36px; rotate(180deg);" class="mdi mdi-timer-sand "></i>
                                </div>
                                <div class="align-self-center">
                                    <h6 class="text-muted mt-2 mb-0">Pending items</h6>
                                    <h2 class="text-center">{{ count($vt_cl_items) }}</h2>
                                </div>
                            </div>
                        </div>
                    </div>
               {{--  </a> --}}
            </div>
            <div class="col-lg-4 col-md-6  ">
                <a href="{{ route('cases') }}">
                    <div class="card shadow  p-1 rounded">
                        <div class="card-body">
                            <div class="d-flex no-block">
                                <div class="mr-3 align-self-center"><span
                                        class="lstick d-inline-block align-middle"></span><i
                                        class="fas fa-ticket-alt fa-3x"></i></div>
                                <div class="align-self-center">
                                    <h6 class="text-muted mt-2 mb-0">Active cases</h6>
                                    <h2 class="text-center">{{ $vt_active_cases }}</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

        </div>
        {{-- <div class="hide">I am shown when someone hovers over the div another.</div> --}}

        <!-- End Row -->
        <!-- Start row -->
        <div class="row pt-3">
            <div class="col-lg-8">
                <div class="card shadow  p-1 rounded">
                    <div class="card-header">
                        <h2 class="card-title"><span class="lstick d-inline-block align-middle"></span>My cases
                        </h2>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Case title</th>
                                        <th>Case type</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($vtCases as $case)
                                        <tr id="1" class="gradeX">
                                            <td> <a href="{{ route('show_case', [$case->id]) }}">
                                                    {{ $case->ticket_title }}</a></td>
                                            <td>{{ $case->ticketcategories }} </td>
                                            <td>{{ $case->ticketstatus }} </td>
                                        </tr>
                                    @endforeach
                                </tbody>

                                <tfoot>
                                    <tr>
                                        <th>Case title</th>
                                        <th>Case type</th>
                                        <th>Status</th>
                                    </tr>
                                </tfoot>

                            </table>
                        </div>
                    </div>

                </div>
                <div class="card shadow  p-1 rounded">
                    <div class="card-header">
                        <h2 class="card-title">
                            <span class="lstick d-inline-block align-middle"></span>Submit pending documents
                        </h2>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Checklist name</th>
                                        <th>Pending items</th>
                                        <th>Completed items</th>
                                        <th>Active items</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($pending_checklists as $checklist)
                                        <tr id="1" class="gradeX">
                                            <td>
                                                <a href="{{ route('show_checklist', [$checklist->id]) }}">
                                                    {{ $checklist->name }}</a>
                                            </td>
                                            <td>{{ $checklist->cf_1187 }} </td>
                                            <td>{{ $checklist->cf_1189 }} </td>
                                            <td>{{ $checklist->cf_1185 }} </td>
                                        </tr>
                                    @endforeach
                                </tbody>

                                <tfoot>
                                    <tr>
                                        <th>Checklist name</th>
                                        <th>Pending items</th>
                                        <th>Completed items</th>
                                        <th>Active items</th>
                                    </tr>
                                </tfoot>

                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
           {{--  <div class="col-lg-4">
                <commboard-component></commboard-component>
            </div> --}}
        </div>
@endsection
