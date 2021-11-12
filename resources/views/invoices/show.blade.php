@extends('layouts.app')
@section('title')
    Invoice {XXX01}
@endsection

@section('content')

    <div class="card">
        <div class="card-header">
            <a href="{{ route('invoices') }}" class="btn btn-outline-info btn-rounded float-left"><i
                    class=" fas fa-arrow-circle-left">Back</i></a>
            <h4 class="card-title mb-3">My invoices <b>Invoice xx01</b></h4>
        </div>
    </div>
    {{-- <div class="card">
        <div class="card-body"> --}}
    <ul class="nav nav-tabs nav-bordered mb-3 customtab">
        <li class="nav-item">
            <a href="#home-b1" data-toggle="tab" aria-expanded="false" class="nav-link">
                <i class="mdi mdi-home-variant d-lg-none d-block mr-1"></i>
                <span class="d-none d-lg-block">Invoice details</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="#profile-b1" data-toggle="tab" aria-expanded="true" class="nav-link active">
                <i class="mdi mdi-account-circle d-lg-none d-block mr-1"></i>
                <span class="d-none d-lg-block">Payments</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="#settings-b1" data-toggle="tab" aria-expanded="false" class="nav-link">
                <i class="mdi mdi-settings-outline d-lg-none d-block mr-1"></i>
                <span class="d-none d-lg-block">Payment plan</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="#receipts-b1" data-toggle="tab" aria-expanded="false" class="nav-link">
                <i class="mdi mdi-settings-outline d-lg-none d-block mr-1"></i>
                <span class="d-none d-lg-block">Receipts and account statement</span>
            </a>
        </li>
    </ul>

    <div class="tab-content">
        <div class="tab-pane" id="home-b1">
            <div class="card ">
                <div class="card-body">
                    Invoice info read only fields
                </div>
            </div>
            <br>


            <div class="card">
                <div class="btn-list float-rigth">
                    <a type="button" class="btn btn-secondary btn-sm waves-effect waves-light btn-sm "><i class="feather feather-edit-3 feather-icon">Report
                            a payment</i></a>
                            <a type="button"  class="btn btn-secondary btn-sm waves-effect waves-light btn-sm"><i class="feather feather-edit-3 feather-icon">Make
                                    a payment</i></a>
                </div>
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
                            <th scope="col">Payment date</th>
                            <th scope="col">Payment method</th>
                            <th scope="col">Amount</th>
                            <th scope="col">Currency</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>2021/11/12</td>
                            <td>Visa Card</td>
                            <td>1000</td>
                            <td>USD</td>
                        </tr>
                        <tr>
                            <td>Jacob</td>
                            <td>Cash</td>
                            <td>1000</td>
                            <td>USD</td>
                        </tr>
                        <tr>
                            <td>Larry</td>
                            <td>Master card</td>
                            <td>1000</td>
                            <td>USD</td>
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
                            <th scope="col">Schedule</th>
                            <th scope="col">Amount</th>
                            <th scope="col">Description</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>2021/10/10</td>
                            <td>1000</td>
                            <td>Otto.pdf</td>
                        </tr>
                        <tr>
                            <td>2021/10/10</td>
                            <td>1000</td>
                            <td>Thornton.doc</td>
                        </tr>
                        <tr>
                            <td>2021/10/10</td>
                            <td>1000</td>
                            <td>the Bird.pdf</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="tab-pane" id="receipts-b1">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Type of file</th>
                            <th scope="col">File</th>
                            <th scope="col">Date</th>
                            <th scope="col">Download</th>
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
