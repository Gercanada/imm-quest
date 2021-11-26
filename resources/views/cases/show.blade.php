@extends('layouts.app')

@section('title')
    {{ $case->ticket_title }}
@endsection


@section('content')
    <show-case-component></show-case-component>
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Case {{ $case->ticket_title }}</h4>
            <h6 class="card-subtitle">Some info abouth this case as read only</h6>

            <ul class="nav nav-tabs nav-bordered mb-3 customtab">
                @foreach ($checklists as $count => $checklist)
                    @if ($checklist)
                        <li class="nav-item">
                            <a href="#tab_{{ $checklist->id }}" data-toggle="tab" @if ($count == 0) aria-expanded="true" class="nav-link active"
                            @else aria-expanded="false" class="nav-link"
                    @endif>
                    <i class="mdi mdi-home-variant d-lg-none d-block mr-1"></i>
                    <span class="d-none d-lg-block">{{ $checklist->name }}</span>
                    </a>
                    </li>
                @endif
                @endforeach
            </ul>

            <div class="tab-content">

                @foreach ($checklists as $count => $checklist)
                    <div @if ($count == 0)
                        class="tab-pane show active"
                    @else class="tab-pane"
                @endif
                @if ($checklist != null)
                    id="tab_{{ $checklist->id }}"
                @endif
                >
                <h6 class="card-title mt-5"><i class="mr-1 font-18 mdi mdi-numeric-1-box-multiple-outline"></i>
                    Pending items</h6>

                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">CL Item name</th>
                                        <th scope="col">Required by</th>
                                        <th scope="col">Upload</th>
                                        <th scope="col">Help link</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($clitems as $clitem)
                                        @if ($clitem != null &&
        $clitem->cf_1216 == $checklist->id
        /*  && $clitem->cf_1578 != 'Pending' */)
                                            <tr>
                                                <td>{{ $clitem->name }}</td>
                                                <td>{{ $clitem->cf_1202 }}</td>
                                                <td>{{ $clitem->cf_acf_ulf_1778 }}

                                                    <a href="#" class="btn btn-primary" data-toggle="modal"
                                                        data-target="#myModal"><i class="fas fa-file"></i></a>
                                                </td>
                                                <td>{{ $clitem->cf_1212 }}</td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- sample modal content -->
                        <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="myModalLabel">Modal Heading</h4>
                                        <button type="button" class="close" data-dismiss="modal"
                                            aria-hidden="true">×</button>
                                    </div>
                                    <div class="modal-body">
                                        <h6>Text in a modal</h6>
                                        <p>Duis mollis, est non commodo luctus, nisi erat porttitor ligula.</p>
                                        <hr>
                                        <h6>Overflowing text to show scroll behavior</h6>
                                        <p>Cras mattis consectetur purus sit amet fermentum. Cras justo odio,
                                            dapibus ac facilisis in, egestas eget quam. Morbi leo risus, porta
                                            ac consectetur ac, vestibulum at eros.</p>
                                        <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur et.
                                            Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor
                                            auctor.</p>
                                        <p>Aenean lacinia bibendum nulla sed consectetur. Praesent commodo
                                            cursus magna, vel scelerisque nisl consectetur et. Donec sed odio
                                            dui. Donec ullamcorper nulla non metus auctor fringilla.</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary">Save changes</button>
                                    </div>
                                </div><!-- /.modal-content -->
                            </div><!-- /.modal-dialog -->
                        </div><!-- /.modal -->
                        <h6 class="card-title"><i class="mr-1 font-18 mdi mdi-numeric-2-box-multiple-outline"></i>
                            Electronic forms</h6>
                    </div>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">CL Item name</th>
                                    <th scope="col">Required by</th>
                                    <th scope="col">Help link</th>
                                    <th scope="col">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($clitems as $clitem)
                                    @if ($clitem && $clitem->cf_1216 == $checklist->id && $clitem->cf_1578 != 'Accepted')
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
                    <h6 class="card-title"><i class="mr-1 font-18 mdi mdi-numeric-2-box-multiple-outline"></i>Submited
                        items</h6>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">CL Item name</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">File name</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($clitems as $clitem)
                                    @if ($clitem && $clitem->cf_1216 == $checklist->id && $clitem->cf_1578 != 'Completed')
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
                @endforeach
            </div>
        </div>

    </div> <!-- end card-body-->
    </div> <!-- end card-->
@endsection
