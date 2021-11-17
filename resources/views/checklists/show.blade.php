@extends('layouts.app')

@section('title')
    Checklist {{ $check_list->title }}
@endsection


@section('content')
    <div class="card">
        <div class="card">
            <div class="card-body">
                <h2 class="card-title">Checklist <b>{{ $check_list->title }}</b></h2>
                <h6 class="card-subtitle">Some case and checklist details <i>ok</i> </h6>
                <h3 class="card-title mt-5"><i class="mr-1 font-18 mdi mdi-numeric-1-box-multiple-outline"></i> Pending items
                </h3>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">CL Item Name</th>
                                <th scope="col">Required by</th>
                                <th scope="col">Upload</th>
                                <th scope="col">Help link</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($check_list->clitems as $clitem)
                                @if ($clitem->status != 'Pending')
                                    <tr>
                                        <td>{{ $clitem->subject }}</td>
                                        <td>{{ $clitem->required_to }}</td>
                                        <td><a href="#" class="btn"> <i class="fas fa-upload"></i></a></td>
                                        <td>{{ $clitem->help_link }}</td>
                                        <td>
                                            <a href="{{ route('checklist_item', [$check_list], [$clitem->id]) }}"
                                                type="button" class="btn btn-outline-success btn-rounded">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <h3 class="card-title"><i class="mr-1 font-18 mdi mdi-numeric-2-box-multiple-outline"></i> Electronic
                    forms</h3>
            </div>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">CL Item Name</th>
                            <th scope="col">Required by</th>
                            <th scope="col">Help link</th>
                            <th scope="col">Status</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($check_list->clitems as $clitem)
                            @if ($clitem->status != 'Accepted')
                                <tr>
                                    <td>{{ $clitem->subject }}</td>
                                    <td>{{ $clitem->required_to }}</td>
                                    <td>{{ $clitem->help_link }}</td>
                                    <td>{{ $clitem->status }}</td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
            <h3 class="card-title"><i class="mr-1 font-18 mdi mdi-numeric-2-box-multiple-outline"></i>Submited items
            </h3>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">CL Item Name</th>
                            <th scope="col">Status</th>
                            <th scope="col">File name</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($check_list->clitems as $clitem)
                            @if ($clitem->status != 'Completed')
                                <tr>
                                    <td>{{ $clitem->subject }}</td>
                                    <td>{{ $clitem->status }}</td>
                                    <td>{{ $clitem->file_name }}</td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
