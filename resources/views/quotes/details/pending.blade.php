@extends('layouts.app')
@section('title')
    Pending quotes | Quote xx01
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <a href="{{route('quotes')}}" class="btn btn-outline-info btn-rounded float-left"><i class=" fas fa-arrow-circle-left">Back</i></a>
            <h4 class="card-title mb-3">My quotes <b>Quote xx01</b></h4>
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

    <div class="tab-content">
        <div class="tab-pane" id="home-b1">
            <div class="card">
                <div class="card-body">
                    Quote info read only fields
                </div>
            </div>
            <br>
            <a class="btn btn-secondary"><i class="feather feather-edit-3 feather-icon">Accept and sign quote</i></a>
        </br>
        </br>
            <div class="card">
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
                        <tr>
                            <td>x-Mark</td>
                            <td>Otto</td>
                            <td>Otto</td>
                        </tr>
                        <tr>
                            <td>Jacob</td>
                            <td>Thornton</td>
                            <td>Thornton</td>
                        </tr>
                        <tr>
                            <td>Larry</td>
                            <td>the Bird</td>
                            <td>the Bird</td>
                            <td><span class ="bg-success">100 %</span> </td>
                        </tr>
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
                        <tr>
                            <td>PDF</td>
                            <td>Otto.pdf</td>
                            <td>2021/10/10</td>
                            <td>
                                <a class="btn btn-outline-success btn-rounded"><i class="fas fa-download"></i></a>
                            </td>
                        </tr>
                        <tr>
                            <td>DOC</td>
                            <td>Thornton.doc</td>
                            <td>2021/10/10</td>
                            <td>
                                <a class="btn btn-outline-success btn-rounded"><i class="fas fa-download"></i></a>
                            </td>
                        </tr>
                        <tr>
                            <td>PDF</td>
                            <td>the Bird.pdf</td>
                            <td>2021/10/10</td>
                            <td>
                                <a class="btn btn-outline-success btn-rounded"><i class="fas fa-download"></i></a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
