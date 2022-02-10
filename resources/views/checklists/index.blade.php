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
                <div class="card shadow  p-1 rounded">
                    <div class="card-body">
                        <h4 class="card-title"><span class="lstick d-inline-block align-middle"></span> My active
                            checklist
                        </h4>

                        <div class="table-responsive">
                            <table class="table dt_alt_pagination table-striped table-bordered display" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Case NO</th>
                                        <th>Checklist title</th>
                                        <th>Checklist type</th>
                                        <th>Checklist for</th>
                                        <th> % Completed</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($active_checklists as $activeChecklist)
                                        <tr>
                                            <td>{{ $activeChecklist->cf_1199 }}</td>
                                            <td>
                                                <a href="{{ route('show_checklist', [$activeChecklist->id]) }}">
                                                    {{ $activeChecklist->name }}
                                                </a>
                                            </td>
                                            <td>{{ $activeChecklist->cf_1706 }}</td>
                                            <td>{{ $activeChecklist->cf_1181 }}</td>
                                            <td>
                                                @if ($activeChecklist->cf_2079)
                                                    <span class="bg-warning">{{ $activeChecklist->cf_2079 }}%</span>
                                                @endif
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
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>

                </div>
            </div>

            <div class="col-md-12">
                <div class="card shadow  p-1 rounded">
                    <div class="card-body">
                        <h4 class="card-title"> <span class="lstick d-inline-block align-middle"></span> My completed
                            checklist</h4>

                        <div class="table-responsive">
                            <table class="table dt_alt_pagination table-striped table-bordered display" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Case NO</th>
                                        <th>Checklist title</th>
                                        <th>Checklist type</th>
                                        <th>Checklist for</th>
                                        <th> % Completed</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($completed_checklists as $completed_cl)
                                        <tr>
                                            <td>{{ $activeChecklist->cf_1199 }}</td>
                                            <td> <a href="{{ route('show_checklist', [$activeChecklist->id]) }}">
                                                    {{ $activeChecklist->name }}
                                                </a>

                                            </td>
                                            <td>{{ $activeChecklist->cf_1706 }}</td>
                                            <td>{{ $activeChecklist->cf_1181 }}</td>
                                            <td><span class="bg-success">{{ $activeChecklist->cf_2079 }}</span> </td>
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
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
