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
                <a href="#">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex no-block">
                                <div class="mr-3 align-self-center"><span
                                        class="lstick d-inline-block align-middle"></span><img
                                        src="/templates/theme-forest-admin-pro/main/admin-pro/src/assets/images/icon/income.png"
                                        alt="Income" /></div>
                                <div class="align-self-center">
                                    <h6 class="text-muted mt-2 mb-0">Active checklists</h6>
                                    {{-- <h2 class="info">{{ $checklists }}</h2> --}}
                                    <h2 class="info">{{ $vt_checklists }}</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-4 col-md-6">
                <a href="#">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex no-block">
                                <div class="mr-3 align-self-center"><span
                                        class="lstick d-inline-block align-middle"></span><img
                                        src="/templates/theme-forest-admin-pro/main/admin-pro/src/assets/images/icon/expense.png"
                                        alt="Income" /></div>
                                <div class="align-self-center">
                                    <h6 class="text-muted mt-2 mb-0">Pending items</h6>
                                   {{--  <h2 class="warning">{{ $cl_items }}</h2> --}}
                                    <h2 class="warning">{{ $vt_cl_items }}</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-4 col-md-6">
                <a href="#">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex no-block">
                                <div class="mr-3 align-self-center"><span
                                        class="lstick d-inline-block align-middle"></span><img
                                        src="/templates/theme-forest-admin-pro/main/admin-pro/src/assets/images/icon/assets.png"
                                        alt="Income" /></div>
                                <div class="align-self-center">
                                    <h6 class="text-muted mt-2 mb-0">Active cases</h6>
                                    <h2 class="success">{{ $vt_active_cases }}</h2>
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
            <div class="col-lg-9">
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
                                    <td> <a href="{{ route('show_case', [$case->id])}}"> {{ $case->ticket_title }}</a></td>
                                    <td>{{ $case->ticketcategories }} </td>
                                    <td>{{ $case->ticketstatus }} </td>
                                </tr>
                            @endforeach
                            {{-- @foreach ($cases as $case)
                                <tr id="1" class="gradeX">
                                    <td> <a href="{{ route('show_case', [$case->id])}}"> {{ $case->title }}</a></td>
                                    <td>{{ $case->type }} </td>
                                    <td>{{ $case->status }} </td>
                                </tr>
                            @endforeach --}}
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
            <!-- ============================================================== -->
            <!-- visit charts-->
            <!-- ============================================================== -->
            <div class="col-lg-3">
                @include('features.commboard')
                {{-- <div class="card">
                            <div class="card-body">
                                <h4 class="card-title"><span class="lstick"></span>Visit Separation</h4>
                                <div id="visitor" style="height:290px; width:100%;"></div>
                                <table class="table vm font-14">
                                    <tr>
                                        <td class="b-0">Mobile</td>
                                        <td class="text-right font-medium b-0">38.5%</td>
                                    </tr>
                                    <tr>
                                        <td>Tablet</td>
                                        <td class="text-right font-medium">30.8%</td>
                                    </tr>
                                    <tr>
                                        <td>Desktop</td>
                                        <td class="text-right font-medium">7.7%</td>
                                    </tr>
                                    <tr>
                                        <td>Other</td>
                                        <td class="text-right font-medium">23.1%</td>
                                    </tr>
                                </table>
                            </div>
                        </div> --}}
            </div>
        </div>

    </div>


@endsection
