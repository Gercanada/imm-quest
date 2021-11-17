@extends('layouts.app')
@include('features.datatable')

@section('title')
    My payments
@endsection

@section('content')
    <div class="row page-titles">
        <div class="col-md-5 col-12 align-self-center">
            <h3 class="text-themecolor mb-0">Payments</h3>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">My payments</h4>

                    <div class="btn-list float-rigth">
                        <a type="button" class="btn btn-secondary btn-sm waves-effect waves-light btn-sm "><i
                                class="feather feather-edit-3 feather-icon">Report a payment</i></a>
                        <a type="button" class="btn btn-secondary btn-sm waves-effect waves-light btn-sm"><i
                                class="feather feather-edit-3 feather-icon">Make a payment</i></a>
                    </div>

                    <div class="table-responsive">
                        <table class="table dt_alt_pagination table-striped table-bordered display" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Invoice No</th>
                                    <th>Payment date</th>
                                    <th>Payment method</th>
                                    <th>Amount</th>
                                    <th>Currency</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($payments as $payment)
                                    <tr>
                                        <td>{{ $payment->invoice->id }}</td>
                                        <td>{{ $payment->payment_date }}</td>
                                        <td>{{ $payment->payment_method }}</td>
                                        <td>{{ $payment->amount }}</td>
                                        <td>{{ $payment->currency }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Invoice No</th>
                                    <th>Payment date</th>
                                    <th>Payment method</th>
                                    <th>Amount</th>
                                    <th>Currency</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
