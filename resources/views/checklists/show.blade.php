@extends('layouts.app')

@section('title')
    Checklist {{ $check_list->name }}
@endsection

@section('scripts')
    <script>
        $('#surveyAlert').delay(10000).hide(0);
    </script>
@endsection

@section('content')
    <div class="card shadow  p-1 rounded">
        <div class="card-header shadow pb-1 pt-0 mt-0">
            <a href="{{ route('checklists') }}" class="btn btn-outline-success btn-rounded"><i
                    class=" fas fa-arrow-circle-left"></i></a>
            <h4 class="card-title"><span class="lstick d-inline-block align-middle"></span> Checklist
                <b>{{ $check_list->name }}</b>
            </h4>
        </div>
        <div class="card-body">
            {{-- <h6 class="card-subtitle">Some case and checklist details <i>ok</i> </h6> --}}
            <div class="shadow p-1 mt-4 rounded">
                <h3 class="card-title "><i class="mr-1 font-18 mdi mdi-timelapse"></i> Pending items
                </h3>
                <div class="table-responsive mt-4">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">CL Item Name</th>
                                <th scope="col">Status</th>
                                <th scope="col">Help link</th>
                                <th scope="col">View</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($clitems as $clitem)
                                @if (($clitem->cf_1578 === 'Pending' || $clitem->cf_1578 === 'Replacement Needed') && $clitem->cf_1200 === 'Document')
                                    <tr>
                                        <td>{{ $clitem->name }}</td>
                                        <td>{{ $clitem->cf_1578 }}</td>
                                        <td> <a href="{{ $clitem->cf_1212 }}">{{ $clitem->cf_1212 }}</a></td>
                                        <td>
                                            <a href="{{ route('checklist_item', [$check_list->id, $clitem->id]) }}"
                                                data-toggle="tooltip" title="View details"
                                                class="btn btn-outline-success btn-rounded"> <i
                                                    class="fas fa-eye"></i></a>
                                        </td>
                                    </tr>
                                @endif
                                @php
                                    unset($clitem->files);
                                @endphp
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
            <div class="shadow p-1 mt-4 rounded">
                <h3 class="card-title"><i class="mr-1 font-18 mdi mdi-textbox"></i> Electronic
                    forms</h3>
                <div class="table-responsive mt-4">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">CL Item Name</th>
                                <th scope="col">Help link</th>
                                <th scope="col">Status</th>
                                <th>View</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($clitems as $clitem)
                                @if ($clitem->cf_1200 === 'IMM Form')
                                    <tr>
                                        <td>{{ $clitem->cf_1202 }}</td>
                                        <td>{{ $clitem->cf_1578 }}</td>
                                        <td><a href="{{ route('checklist_item', [$check_list->id, $clitem->id]) }}">{{ $clitem->name }}
                                            </a></td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="shadow p-1 mt-4 rounded">
                <h3 class="card-title"><i class="mr-1 font-18 mdi mdi-help-circle-outline"></i>Questionnaire</h3>
                <div class="table-responsive mt-4">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">CL Item Name</th>
                                <th scope="col">Help link</th>
                                <th scope="col">Status</th>
                                <th>Refresh status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($clitems as $clitem)
                                @if (($clitem->cf_1578 === 'Pending' || $clitem->cf_1578 === 'Replacement Needed' || $clitem->cf_1578 === '') && $clitem->cf_1200 === 'Questionnaire')
                                    <tr>
                                        <td>{{ $clitem->name }}</td>
                                        <td> <a href="{{ $clitem->cf_1212 }}"
                                                target="_blank">{{ $clitem->cf_1212 }}</a></td>
                                        <td>{{ $clitem->cf_1578 }}
                                        </td>
                                        <td>
                                            <form action="{{ route('export_response') }}" method="post">
                                                @csrf
                                                <input type="hidden" name="surveyurl" id="surveyurl"
                                                    value="{{ $clitem->cf_1212 }}">
                                                <input type="hidden" name="clitemsno" id="clitemsno"
                                                    value="{{ $clitem->clitemsno }}">
                                                <button type="submit" class="btn btn-outline-success btn-rounded">
                                                    <i class="icon-refresh"></i></button>

                                                {{-- <a href="{{ route('checklist_item', [$check_list->id, $clitem->id]) }}"
                                                            data-toggle="tooltip" title="View details"
                                                            class="btn btn-outline-success btn-rounded"> <i
                                                                class="fas fa-eye"></i></a> --}}
                                            </form>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                    @if (session('status') === 'success')
                        <div class="alert alert-success text-info text-center font-weight-bold " id="surveyAlert">
                            ✔ This survey has been answered and sent to manager. ✔ Await a few minutes to get this record
                            updated
                        </div>
                    @elseif (session('status') === 'error')
                        <div class="alert alert-danger text-warning text-center font-weight-bold" id="surveyAlert">
                            ❌ This survey has NOT answered. Please open the link and answer the survey. ❌
                        </div>
                    @elseif (session('status') === 'waiting')
                        <div class="alert alert-danger text-warning text-center font-weight-bold" id="surveyAlert">
                            This file was sent. Please await for the manager updates the record. If problem persists contactyour manager.
                        </div>
                    @endif
                </div>
            </div>
            <div class="shadow p-1 mt-4 rounded">
                <h3 class="card-title">
                    <i class="mr-1 font-18 mdi mdi-telegram"></i>Submited items
                </h3>
                <div class="table-responsive mt-4">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">CL Item Name</th>
                                <th scope="col">File Name</th>
                                <th scope="col">Category</th>
                                <th scope="col">Status</th>
                                <th>View</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($clitems as $clitem)
                                @if ($clitem->cf_1578 === 'Received' || $clitem->cf_1578 === 'Accepted' || $clitem->cf_1578 === 'Not Required Anymore')
                                    <tr>
                                        <td>{{ $clitem->name }}</td>
                                        <td>{{ $clitem->cf_1970 }}</td>
                                        <td>{{ $clitem->cf_1200 }}</td>
                                        <td>{{ $clitem->cf_1578 }}
                                        </td>
                                        <td>
                                            <a href="{{ route('checklist_item', [$check_list->id, $clitem->id]) }}"
                                                data-toggle="tooltip" title="View details"
                                                class="btn btn-outline-success btn-rounded"> <i
                                                    class="fas fa-eye"></i></a>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
