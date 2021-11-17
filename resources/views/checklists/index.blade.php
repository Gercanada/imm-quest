@extends('layouts.app')
@include('features.datatable')
@section('title')
    Checklists
@endsection

@section('content')
    <div class="row page-titles">
        <div class="col-md-5 col-12 align-self-center">
            <h3 class="text-themecolor mb-0">My checklists</h3>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title"> My active checklist</h4>
                    <h6 class="card-subtitle">Some about
                    </h6>
                    <div class="table-responsive">
                        <table class="table dt_alt_pagination table-striped table-bordered display" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Case NO</th>
                                    <th>Checklist title</th>
                                    <th>Checklist type</th>
                                    <th>Checklist for</th>
                                    <th> % Completed</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($active_checklists as $activeChecklist)
                                    <tr>
                                        <td>{{ $activeChecklist->case->id }}</td>
                                        <td>{{ $activeChecklist->title }}</td>
                                        <td>{{ $activeChecklist->type }}</td>
                                        <td>{{ $activeChecklist->type }}</td>
                                        <td><span class="bg-warning">{{ $activeChecklist->completed }}%</span> </td>
                                        <td>
                                            <a href="{{ route('show_checklist', [$activeChecklist->id]) }}" type="button"
                                                class="btn btn-outline-success btn-rounded">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Case NO</th>
                                    <th>Checklist title</th>
                                    <th>Checklist type</th>
                                    <th>Checklist for</th>
                                    <th> % Completed</th>
                                    <th></th>
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
                    <h4 class="card-title"> My completed checklist</h4>
                    <h6 class="card-subtitle">Some about
                    </h6>
                    <div class="table-responsive">
                        <table class="table dt_alt_pagination table-striped table-bordered display" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Case NO</th>
                                    <th>Checklist title</th>
                                    <th>Checklist type</th>
                                    <th>Checklist for</th>
                                    <th> % Completed</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($completed_checklists as $completed_cl)
                                    <tr>
                                        <td>{{ $activeChecklist->case->id }}</td>
                                        <td>{{ $activeChecklist->title }}</td>
                                        <td>{{ $activeChecklist->type }}</td>
                                        <td>{{ $activeChecklist->type }}</td>
                                        <td><span class="bg-success">{{ $activeChecklist->completed }}</span> </td>
                                        <td>
                                            <a href="{{ route('show_checklist', [$activeChecklist->id]) }}" type="button"
                                                class="btn btn-outline-success btn-rounded">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Case NO</th>
                                    <th>Checklist title</th>
                                    <th>Checklist type</th>
                                    <th>Checklist for</th>
                                    <th> % Completed</th>
                                    <th></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
