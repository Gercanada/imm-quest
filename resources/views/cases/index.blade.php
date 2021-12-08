@extends('layouts.app')
@include('features.datatable')

@section('title')
    Cases
@endsection

@section('content')
    <div class="container-fluid">
        <!-- ============================================================== -->
        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <div class="row page-titles">
            <div class="col-md-5 col-12 align-self-center">
                <h3 class="card-title text-themecolor mb-0"><span class="lstick d-inline-block align-middle"></span>My cases
                </h3>
            </div>
        </div>
        <!-- Start row -->
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow-lg p-1">
                    <div class="card-body">
                        <h4 class="card-title"><span class="lstick d-inline-block align-middle"></span>My active cases
                        </h4>
                        <div class="table-responsive">
                            <table class="table dt_alt_pagination table-striped table-bordered display" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Case title</th>
                                        <th>Case type</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($active_cases as $active_case)
                                        <tr>
                                            <td>
                                                <a href="{{ route('show_case', [$active_case->id]) }}">
                                                    {{ $active_case->ticket_title }}
                                                </a>
                                            </td>
                                            <td>{{ $active_case->ticketcategories }}</td>
                                            <td>{{ $active_case->ticketstatus }}</td>
                                            {{-- <td>
                                                <a href="{{ route('show_case', [$active_case->id])}}" type="button"
                                                    class="btn btn-outline-success btn-rounded">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                            </td> --}}
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

            </div>
            <div class="col-md-12">
                <div class="card shadow-lg p-1">
                    <div class="card-body">
                        <h4 class="card-title"><span class="lstick d-inline-block align-middle"></span>My completed case
                        </h4>
                        <div class="table-responsive">
                            <table class="table dt_alt_pagination table-striped table-bordered display" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Case title</th>
                                        <th>Case type</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($completed_cases as $completed_case)
                                        <tr>
                                            <td>
                                                {{ $completed_case->ticket_title }}
                                                <a href="{{ route('show_case', [$completed_case->id]) }}">
                                                </a>
                                            </td>
                                            <td>{{ $completed_case->ticketcategories }}</td>
                                            <td>{{ $completed_case->ticketstatus }}</td>
                                            <td>
                                                <a href="{{ route('show_case', [$completed_case->id]) }}" type="button"
                                                    class="btn btn-outline-success btn-rounded">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                            </td>
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

            </div>
        </div>
    </div>
@endsection
