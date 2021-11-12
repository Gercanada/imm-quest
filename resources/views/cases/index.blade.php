@extends('layouts.app')
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
        <!-- ============================================================== -->
        <!-- End Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <!-- Start row -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">My active cases</h4>
                        <h6 class="card-subtitle">Just click on word which you want to change and enter</h6>
                        <table class="table table-striped table-bordered" id="editable-datatable">
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
                                    <tr id="2" class="gradeC">
                                        <td>{{ $active_case->title }}</td>
                                        <td>{{ $active_case->type }}</td>
                                        <td>{{ $active_case->status }}</td>
                                        <td>
                                            <a href="{{ route('show_case') }}" type="button"
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
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">My completed cases</h4>
                        <h6 class="card-subtitle">Just click on word which you want to change and enter</h6>
                        <table class="table table-striped table-bordered" id="editable-datatable">
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
                                    <tr id="2" class="gradeC">
                                        <td>{{ $active_case->title }}</td>
                                        <td>{{ $active_case->type }}</td>
                                        <td>{{ $active_case->status }}</td>
                                        <td>
                                            <a href="{{ route('show_case') }}" type="button"
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
@endsection
