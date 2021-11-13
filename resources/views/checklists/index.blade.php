@extends('layouts.app')
@section('title')
    Checklists
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">My checklists</h4>
            <h6 class="card-subtitle">Here can i see my checklists</h6>
            <h6 class="card-title mt-5"><i class="mr-1 font-18 mdi mdi-numeric-1-box-multiple-outline"></i> My active
                checklist</h6>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Case NO</th>
                            <th scope="col">Checklist title</th>
                            <th scope="col">Checklist type</th>
                            <th scope="col">Checklist for</th>
                            <th scope="col"> % Completed</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        'active_checklists', 'completed_checklists'
                        @foreach ($active_checklists as $activeChecklist)
                            <tr>
                                <td>{{ $activeChecklist->case->id }}</td>
                                <td>{{ $activeChecklist->title }}</td>
                                <td>{{ $activeChecklist->type }}</td>
                                <td>{{ $activeChecklist->type }}</td>
                                <td><span class="bg-warning">{{ $activeChecklist->completed }}%</span> </td>
                                <td>
                                    <a href="{{ route('show_checklist') }}" type="button"
                                        class="btn btn-outline-success btn-rounded">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <h6 class="card-title mt-5"><i class="mr-1 font-18 mdi mdi-numeric-1-box-multiple-outline"></i> My completed
                checklist</h6>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Case NO</th>
                            <th scope="col">Checklist title</th>
                            <th scope="col">Checklist type</th>
                            <th scope="col">Checklist for</th>
                            <th scope="col"> % Completed</th>
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
                                    <a href="{{ route('show_checklist') }}" type="button"
                                        class="btn btn-outline-success btn-rounded">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
