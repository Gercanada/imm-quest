@extends('layouts.app')

@section('title')
    Case [001]
@endsection


@section('content')
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Case {{$case->title}}</h4>
            <h6 class="card-subtitle">Some info abouth this case as read only</h6>

            <ul class="nav nav-tabs nav-bordered mb-3 customtab">
                @foreach ($checklists as $count => $checklist)
                    <li class="nav-item">

                        <a href="#tab_{{ $checklist->id }}" data-toggle="tab" @if ($count == 0)  aria-expanded="true" class="nav-link active" @else aria-expanded="false" class="nav-link" @endif>
                            <i class="mdi mdi-home-variant d-lg-none d-block mr-1"></i>
                            <span class="d-none d-lg-block">{{ $checklist->title }}</span>
                        </a>
                    </li>
                @endforeach
            </ul>

            {{-- <ul class="nav nav-tabs nav-bordered mb-3 customtab">
                <li class="nav-item">
                    <a href="#home-b1" data-toggle="tab" aria-expanded="false" class="nav-link">
                        <i class="mdi mdi-home-variant d-lg-none d-block mr-1"></i>
                        <span class="d-none d-lg-block">Checklist 1</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#profile-b1" data-toggle="tab" aria-expanded="true" class="nav-link active">
                        <i class="mdi mdi-account-circle d-lg-none d-block mr-1"></i>
                        <span class="d-none d-lg-block">Checklist 2</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#settings-b1" data-toggle="tab" aria-expanded="false" class="nav-link">
                        <i class="mdi mdi-settings-outline d-lg-none d-block mr-1"></i>
                        <span class="d-none d-lg-block">Checklist 3</span>
                    </a>
                </li>
            </ul> --}}

            <div class="tab-content">

                @foreach ($checklists as $count => $checklist)
                    <div @if ($count == 0)
                        class="tab-pane show active"
                    @else
                        class="tab-pane"
                @endif

                id="tab_{{ $checklist->id }}">
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
                                    @foreach ($checklist->clitems as $clitem)
                                        @if ($clitem->status != 'Pending')
                                            <tr>
                                                <td>{{ $clitem->subject }}</td>
                                                <td>{{ $clitem->required_to }}</td>
                                                <td>file uploaded <a href="#" class="btn"><i
                                                            class="fas fa-file"></i></a></td>
                                                <td>{{ $clitem->help_link }}</td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
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
                                @foreach ($checklist->clitems as $clitem)
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
                                @foreach ($checklist->clitems as $clitem)
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

            @endforeach
            {{-- <div class="tab-pane show active" id="profile-b1">
                    <p>Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim
                        justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis
                        eu pede mollis pretium. Integer tincidunt.Cras dapibus. Vivamus elementum
                        semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor
                        eu, consequat vitae, eleifend ac, enim.</p>
                </div> --}}
        </div>

    </div> <!-- end card-body-->
    </div> <!-- end card-->
@endsection
