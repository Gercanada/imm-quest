@extends('layouts.app')
@section('title')
    Accepted quotes | Quote{{ $quote->subject }}
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <a href="{{ route('quotes') }}" class="btn btn-outline-info btn-rounded float-left"><i
                    class=" fas fa-arrow-circle-left">Back</i></a>
            <h4 class="card-title mb-3"> <span class="lstick d-inline-block align-middle"></span> Accepted Quote <b>
                    {{ $quote->subject }}</b></h4>
        </div>
    </div>
    <ul class="nav nav-tabs nav-bordered mb-3 customtab">
        <li class="nav-item">
            <a href="#home-b1" data-toggle="tab" aria-expanded="false" class="nav-link">
                <i class="mdi mdi-home-variant d-lg-none d-block mr-1"></i>
                <span class="d-none d-lg-block">Quote details</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="#profile-b1" data-toggle="tab" aria-expanded="true" class="nav-link active">
                <i class="mdi mdi-account-circle d-lg-none d-block mr-1"></i>
                <span class="d-none d-lg-block">Payment plan</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="#settings-b1" data-toggle="tab" aria-expanded="false" class="nav-link">
                <i class="mdi mdi-settings-outline d-lg-none d-block mr-1"></i>
                <span class="d-none d-lg-block">Files</span>
            </a>
        </li>
    </ul>

    <div class="tab-content shadow-lg p-1">
        <div class="tab-pane" id="home-b1">
            <div class="card ">
                <div class="card-body">
                    Quote info read only fields
                </div>
            </div>
            <br>
            <div class="col-md-4 float-right ml-3 bg-secondary">
                <p>Accepted and signed at <b>2021/11/19</b></p>
            </div>
            </br>
            <div class="card ">
                <div class="card-body">
                    Quote product details
                </div>
            </div>
        </div>
        <div class="tab-pane show active" id="profile-b1">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Schedule</th>
                            <th scope="col">Amount</th>
                            <th scope="col">Description</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($iTrackers as $itracker)
                            <tr>
                                <td>{{ $itracker->cf_1165 }}</td>
                                <td>{{ number_format($itracker->cf_1163, 2) }}</td>
                                <td>{{ $itracker->description }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="tab-pane" id="settings-b1">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Type of file</th>
                            <th scope="col">File</th>
                            <th scope="col">date</th>
                            <th scope="col">download</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($itDocuments as $document)
                            <tr>
                                {{-- <td>{{ $document->filetype }}</td> --}}
                                <td>{{ $document->cf_1491 }}</td>
                                <td>{{ $document->filename }}</td>
                                <td>{{ $document->cf_2134 }}</td>
                                {{-- <td>{{ $document->filelocationtype }}}</td> --}}
                                <td>
                                    <a class="btn btn-outline-success btn-rounded"><i class="fas fa-download"></i></a>
                                </td>
                            </tr>

                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- </div> <!-- end card-body-->
    </div> <!-- end card--> --}}
@endsection
