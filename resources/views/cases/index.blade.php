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
                <h3 class="text-themecolor mb-0">My cases</h3>
            </div>
        </div>
        <!-- Start row -->

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">My active cases</h4>
                        <h6 class="card-subtitle">When using tables to display data, you will often wish to
                            display column information in groups. DataTables fully supports
                            <code> colspan</code> and <code> rowspan</code> in the table's header, assigning the
                            required order listeners to the TH element suitable for that column.
                        </h6>
                        <div class="table-responsive">
                            <table  class="table dt_alt_pagination table-striped table-bordered display"
                                style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Case title</th>
                                        <th>Case type</th>
                                        <th>Status</th>
                                        <th>options</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($active_cases as $active_case)
                                        <tr>
                                            <td>{{ $active_case->title }}</td>
                                            <td>{{ $active_case->type }}</td>
                                            <td>{{ $active_case->status }}</td>
                                            <td>
                                                <a href="{{ route('show_case', [$active_case->id])}}" type="button"
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
                                        <th>options</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">My completed case</h4>
                        <h6 class="card-subtitle">When using tables to display data, you will often wish to
                            display column information in groups. DataTables fully supports
                            <code> colspan</code> and <code> rowspan</code> in the table's header, assigning the
                            required order listeners to the TH element suitable for that column.
                        </h6>
                        <div class="table-responsive">
                            <table class="table dt_alt_pagination table-striped table-bordered display"
                                style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Case title</th>
                                        <th>Case type</th>
                                        <th>Status</th>
                                        <th>Options</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($completed_cases as $completed_case)
                                        <tr>
                                            <td>{{ $active_case->title }}</td>
                                            <td>{{ $active_case->type }}</td>
                                            <td>{{ $active_case->status }}</td>
                                            <td>
                                                <a href="{{ route('show_case', [$active_case->id])}}" type="button"
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
                                        <th>Options</th>
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
