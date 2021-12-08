@extends('layouts.app')
@include('features.datatable')
@section('title')
    Invoices
@endsection

@section('content')
    <div class="row page-titles">
        <div class="col-md-5 col-12 align-self-center">
            <h3 class="text-themecolor mb-0"><span class="lstick d-inline-block align-middle"></span>My Invoices</h3>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow-lg p-1">
                <div class="card-body">
                    <h4 class="card-title"><span class="lstick d-inline-block align-middle"></span> My open
                        invoices</h4>
                    <div class="table-responsive">
                        <table class="table dt_alt_pagination table-striped table-bordered display" style="width:100%">
                            <thead>
                                <tr>
                                    <th scope="col">Invoice Titlee</th>
                                    <th scope="col">Grand Total</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Make or Report A Payment</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($open_invoices as $openInvoice)
                                    <tr>
                                        <td> <a href="{{ route('show_invoice', [$openInvoice->id]) }}">
                                                {{ $openInvoice->subject }}
                                            </a>
                                        </td>
                                        <td>{{ $openInvoice->hdnSubTotal }}</td>
                                        <td>{{ $openInvoice->invoicestatus }}</td>
                                        <td class="text-center">
                                            <a href="" type="button" class="btn btn-outline-success btn-rounded">
                                                <i class="fas fa-dollar-sign "></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="card shadow-lg p-1">
                <div class="card-body">
                    <h4 class="card-title"><span class="lstick d-inline-block align-middle"></span>Invoices Paid in Full</h4>
                    <div class="table-responsive">
                        <table  class="table dt_alt_pagination table-striped table-bordered display">
                            <thead>
                                <tr>
                                    <th scope="col">Invoice Title</th>
                                    <th scope="col">Grand Total</th>
                                    <th scope="col">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($paid_invoices as $paidInvoice)
                                    <tr>
                                        <td>
                                            <a href="{{ route('show_invoice', [$paidInvoice->id]) }}">
                                                {{ $paidInvoice->subject }}
                                            </a>
                                        </td>
                                        <td>{{ $paidInvoice->hdnSubTotal }}</td>
                                        <td>{{ $paidInvoice->invoicestatus }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
