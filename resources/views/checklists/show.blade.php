@extends('layouts.app')

@section('title')
    Checklist {{ $check_list->name }}
@endsection

@section('content')
    <div class="card">
        <div class="card">
            <div class="card-body">
                <h2 class="card-title">Checklist <b>{{ $check_list->name }}</b></h2>
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
                            @foreach ($clitems as $clitem)
                                @if ($clitem->cf_1578 != 'Pending')
                                    <tr>
                                        <td>{{ $clitem->name }}</td>
                                        <td>{{ $clitem->cf_1202 }}</td>
                                        <td><a href="{{ route('checklist_item', [$check_list->id, $clitem->id]) }}"
                                                class="btn btn-outline-success btn-rounded"> <i
                                                    class="fas fa-upload"></i></a></td>
                                        <td>{{ $clitem->cf_1212}}</td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <h3 class="card-title"><i class="mr-1 font-18 mdi mdi-numeric-2-box-multiple-outline"></i> Electronic forms</h3>
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
                        @foreach ($clitems as $clitem)
                            @if ($clitem->cf_1578 != 'Accepted')
                                <tr>
                                    <td>{{ $clitem->name }}</td>
                                    <td>{{ $clitem->cf_1202 }}</td>
                                    <td>{{ $clitem->cf_1212 }}</td>
                                    <td>{{ $clitem->cf_1578 }}</td>
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

                        @foreach ($clitems as $clitem)
                            @if ($clitem->cf_1578 != 'Completed')
                                <tr>
                                    <td>{{ $clitem->name }}</td>
                                    <td>{{ $clitem->cf_1578 }}</td>
                                    <td>{{ $clitem->cf_1970 }}</td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
