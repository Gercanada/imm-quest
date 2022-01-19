@extends('layouts.app')

@section('title')
    Checklist {{ $check_list->name }}
@endsection

@section('content')
    <div class="card shadow-lg p-1">
        <div class="card-header">
            <a href="{{ route('checklists') }}" class="btn btn-outline-success btn-rounded"><i
                    class=" fas fa-arrow-circle-left"></i></a>
            <h4 class="card-title"><span class="lstick d-inline-block align-middle"></span> Checklist
                <b>{{ $check_list->name }}</b>
            </h4>
        </div>
        <div class="card-body">
            {{-- <h6 class="card-subtitle">Some case and checklist details <i>ok</i> </h6> --}}
            <h3 class="card-title mt-5"><i class="mr-1 font-18 mdi mdi-numeric-1-box-multiple-outline"></i> Pending items
            </h3>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">CL Item Name</th>
                            <th scope="col">Required by</th>
                            <th scope="col">Actions</th>
                            <th scope="col">Status</th>
                            <th scope="col">Help link</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($clitems as $clitem)
                            {{--  --}}
                            @if ($clitem->cf_1578 === 'Pending')
                                <tr>
                                    <td>{{ $clitem->name }}</td>
                                    <td>{{ $clitem->cf_1202 }}</td>
                                    <td>
                                        @if (count($clitem->files['files']) > 0 && $clitem->files['key'] === $clitem->clitemsno)
                                            @foreach ($clitem->files['files'] as $file)
                                                {{ $file }}
                                                <a href="{{ route('checklist_item', [$check_list->id, $clitem->id]) }}"
                                                    data-toggle="tooltip" title="Delete file to upload new"
                                                    class="btn btn-outline-danger btn-rounded"> <i
                                                        class="fas fa-trash"></i></a>
                                                <a href="{{ route('checklist_item', [$check_list->id, $clitem->id]) }}"
                                                    data-toggle="tooltip" title="Send file to manager"
                                                    class="btn btn-outline-success btn-rounded"> <i
                                                        class="fas fa-plane"></i></a>
                                            @endforeach
                                        @else
                                            <a href="{{ route('checklist_item', [$check_list->id, $clitem->id]) }}"
                                                data-toggle="tooltip" title="Upload file"
                                                class="btn btn-outline-success btn-rounded"> <i
                                                    class="fas fa-upload"></i></a>
                                        @endif

                                    </td>
                                    <td>{{ $clitem->cf_1578 }}</td>
                                    <td>{{ $clitem->cf_1212 }}</td>
                                </tr>
                            @endif
                            @php
                                unset($clitem->files);
                            @endphp
                        @endforeach
                    </tbody>
                </table>
            </div>
            <h3 class="card-title"><i class="mr-1 font-18 mdi mdi-numeric-2-box-multiple-outline"></i> Electronic
                forms</h3>
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
                            @if ($clitem->cf_1200 === 'IMM Form')
                                <tr>
                                    <td><a href="{{ route('checklist_item', [$check_list->id, $clitem->id]) }}">{{ $clitem->name }}
                                        </a></td>
                                    {{-- <td>{{ $clitem->name }}</td> --}}
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
                            @if ($clitem->cf_1578 === ('Received' || 'Accepted'))
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
