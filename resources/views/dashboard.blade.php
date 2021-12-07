@extends('layouts.app')
@section('title')
    Dashboard
@endsection

@section('content')
    <div class="container-fluid">
        <!-- ============================================================== -->
        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <div class="row page-titles">
            <div class="col-md-5 col-12 align-self-center">
                <h3 class="text-themecolor mb-0">Dashboard </h3>
            </div>{{-- <div class="col-md-7 col-12 align-self-center d-none d-md-block">
                <ol class="breadcrumb mb-0 p-0 bg-transparent float-right">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                    <li class="breadcrumb-item active">Dashboard 2</li>
                </ol>
            </div> --}}
        </div>
        <!-- ============================================================== -->
        <!-- End Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <!-- Start Row -->
        <div class="row">
            <div class="col-lg-4 col-md-6">
                <a href="{{ route('checklists') }}">
                    <div class="card">
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
                <a href="{{ route('checklists') }}">
                    <div class="card">

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
                </a>
            </div>
            <div class="col-lg-4 col-md-6">
                <a href="{{ route('cases') }}">
                    <div class="card">

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
        <!-- End Row -->
        <!-- Start row -->
        <div class="row">
            <div class="col-lg-8">

                <div class="card">
                    <div class="card-header">
                        <h2>My cases</h2>
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
                <div class="card">
                    <div class="card-header">
                        <h2>Submit pending documents</h2>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Checklist name</th>
                                        <th>Pending items</th>
                                        <th>Completed items</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($pending_checklists as $checklist)
                                        <tr id="1" class="gradeX">
                                            <td> <a href="{{ route('show_checklist', [$checklist->id]) }}">
                                                    {{ $checklist->name }}</a></td>
                                            <td>{{ $checklist->cf_1187 }} </td>
                                            <td>{{ $checklist->cf_1189 }} </td>
                                        </tr>
                                    @endforeach
                                </tbody>

                                <tfoot>
                                    <tr>
                                        <th>Checklist name</th>
                                        <th>Case type</th>
                                        <th>Status</th>
                                    </tr>
                                </tfoot>

                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- visit charts-->
            <!-- ============================================================== -->
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title"><span class="lstick d-inline-block align-middle"></span>Commboard
                        </h4>
                    </div>
                    <div class="comment-widgets scrollable mb-2 common-widget ps-container ps-theme-default ps-active-y"
                        style="height: auto;" data-ps-id="0d80a00e-e8b5-f9c2-4133-ff5bf6a8f98f">
                        <!-- Comment Row -->
                        @foreach ($commboards as $comm)
                            <div class="d-flex flex-row comment-row border-bottom p-3">
                                <div class="p-2"><span
                                        class="round text-white d-inline-block text-center rounded-circle bg-info"><img
                                            src="/templates/theme-forest-admin-pro/main/admin-pro/src/assets/images/users/1.jpg"
                                            class="rounded-circle" alt="user" width="50"></span></div>
                                <div class="comment-text w-100 p-3">
                                    <h5>{{ $comm->cf_2224 }}</h5>
                                    <p class="mb-1 overflow-hidden">{{ $comm->description }}</p>
                                    <div class="comment-footer"> <span
                                            class="text-muted pull-right">{{ $comm->cf_2226 }}</span> <span
                                            class="badge badge-info rounded-pill">{{ $comm->cf_2220 }}</span>
                                    </div>
                                </div>
                            </div>

                            <form method="POST" action="{{ route('send_comment') }}">
                                @csrf
                                <div class="card-body border-top">
                                    <div class="row">
                                        <input type="hidden" name="threadid" value="{{ $comm->cf_2218 }}">
                                        <div class="col-8">
                                            <textarea placeholder="Send comment" class="form-control border-0"
                                                name="comment"
                                                style="margin-top: 0px; margin-bottom: 0px; height: 105px;"></textarea>
                                        </div>
                                        <div class="col-4 text-right">
                                            <button type="submit" class="btn btn-info btn-circle btn-lg">
                                                <i class="far fa-paper-plane"></i> </button>
                                        </div>
                                    </div>
                                </div>

                            </form>
                        @endforeach

                        <div class="ps-scrollbar-x-rail" style="left: 0px; bottom: -126px;">
                            <div class="ps-scrollbar-x" tabindex="0" style="left: 0px; width: 0px;"></div>
                        </div>
                        <div class="ps-scrollbar-y-rail" style="top: 126px; right: 3px; height: 450px;">
                            <div class="ps-scrollbar-y" tabindex="0" style="top: 99px; height: 351px;"></div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- <div class="col-lg-3">
                @include('features.commboard')

            </div> --}}
        </div>

    </div>


@endsection
