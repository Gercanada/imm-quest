@extends('layouts.app')

@section('title')
    My payments
@endsection

@section('content')


<div class="card">
    <div class="card-body">
        <h4 class="card-title">My Payments</h4>

        <div class="btn-list float-rigth">
            <a type="button" class="btn btn-secondary btn-sm waves-effect waves-light btn-sm "><i class="feather feather-edit-3 feather-icon">Report a payment</i></a>
                    <a type="button"  class="btn btn-secondary btn-sm waves-effect waves-light btn-sm"><i class="feather feather-edit-3 feather-icon">Make a payment</i></a>
        </div>

        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Invoice No</th>
                        <th scope="col">Payment date</th>
                        <th scope="col">Payment method</th>
                        <th scope="col">Amount</th>
                        <th scope="col">Currency</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($payments as $payment)
                    <tr>
                        <td>{{$payment->invoice->id}}</td>
                        <td>{{$payment->payment_date}}</td>
                        <td>{{$payment->payment_method}}</td>
                        <td>{{$payment->amount}}</td>
                        <td>{{$payment->currency}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
</h1>
@endsection

