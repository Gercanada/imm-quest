@extends('layouts.app')
@section('title')
    Invoice {{ $invoice->subject }}
@endsection

@section('content')
    <div class="card shadow  p-1 rounded">
        <div class="card-header">
            <a href="{{ route('invoices') }}" class="btn btn-outline-success btn-rounded"><i
                    class=" fas fa-arrow-circle-left"></i></a>
            <h4 class="card-title mb-3"><span class="lstick d-inline-block align-middle"></span> Invoice
                <b>{{ $invoice->subject }}</b>
            </h4>
        </div>
        <ul class="nav nav-tabs nav-bordered mb-3 customtab">
            <li class="nav-item">
                <a href="#invoice-details" data-toggle="tab" aria-expanded="false" class="nav-link"
                    data-toggle="tooltip" title="Invoice details">
                    <i class="mdi mdi-file-document d-lg-none d-block mr-1"></i>
                    <span class="d-none d-lg-block">Invoice details</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="#invoice-payments" data-toggle="tab" aria-expanded="true" class="nav-link active"
                    data-toggle="tooltip" title="Payments">
                    <i class="mdi mdi-cash-multiple d-lg-none d-block mr-1"></i>
                    <span class="d-none d-lg-block">Payments</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="#invoice-paymentplan" data-toggle="tab" aria-expanded="false" class="nav-link"
                    data-toggle="tooltip" title="Payment plan">
                    <i class="mdi mdi-square-inc-cash d-lg-none d-block mr-1"></i>
                    <span class="d-none d-lg-block">Payment plan</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="#invoice-receipts" data-toggle="tab" aria-expanded="false" class="nav-link"
                    data-toggle="tooltip" title="Receipts and account statement">
                    <i class="mdi mdi-receipt d-lg-none d-block mr-1"></i>
                    <span class="d-none d-lg-block">Receipts and account statement</span>
                </a>
            </li>
        </ul>

        <div class="tab-content">
            <div class="tab-pane" id="invoice-details">
                <div class="card ">
                    <div class="card-body">
                        {{-- Invoice info read only fields --}}
                        <table class="table v-middle fs-3 mb-0 mt-4">
                            <tbody>
                                <tr>
                                    <td>Invoice Number</td>
                                    <td class="text-end font-weight-medium">{{ $invoice->invoice_no }}</td>
                                </tr>
                                <tr>
                                    <td>Invoice Date</td>
                                    <td class="text-end font-weight-medium">{{ $invoice->invoicedate }}</td>
                                </tr>
                                <tr>
                                    <td>Number of Payments</td>
                                    <td class="text-end font-weight-medium">{{ $invoice->cf_2121 }}</td>
                                </tr>
                                <tr>
                                    <td>Professional Services</td>
                                    <td class="text-end font-weight-medium">{{ $invoice->cf_1574 }}</td>
                                </tr>

                                <tr>
                                    <td>Government Fee Subtotal</td>
                                    <td class="text-end font-weight-medium">{{ $invoice->cf_1572 }}</td>
                                </tr>
                                <tr>
                                    <td>Taxes</td>
                                    <td class="text-end font-weight-medium">{{ $invoice->cf_2123 }}</td>
                                </tr>
                                <tr>
                                    <td>Invoice Balance</td>
                                    <td class="text-end font-weight-medium">{{ $invoice->cf_905 }}</td>
                                </tr>
                                <tr>
                                    <td>Payments Received</td>
                                    <td class="text-end font-weight-medium">{{ $invoice->cf_901 }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <br>

                <div class="card">
                    <div class="btn-list float-rigth">
                        <a type="button" class="btn btn-secondary btn-sm waves-effect waves-light btn-sm "><i
                                class="feather feather-edit-3 feather-icon">Report
                                a payment</i></a>
                        <a type="button" class="btn btn-secondary btn-sm waves-effect waves-light btn-sm"><i
                                class="feather feather-edit-3 feather-icon">Make
                                a payment</i></a>
                    </div>
                </div>
                </br>

            </div>
            <div class="tab-pane show active" id="invoice-payments">
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
                            @foreach ($payments as $invoice_payment)
                                <tr>
                                    <td>{{ $invoice_payment->cf_1146 }}</td>
                                    <td>{{ $invoice_payment->cf_1148 }}</td>
                                    <td>{{ $invoice_payment->cf_1144 }}</td>
                                    <td>{{ $invoice_payment->cf_1150 }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="tab-pane" id="invoice-paymentplan">
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
            <div class="tab-pane" id="invoice-receipts">
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
                            @foreach ($documents as $document)
                                <tr>
                                    <td>{{ $document->filetype }}</td>
                                    <td>{{ $document->filename }}</td>
                                    <td>{{ $document->modifiedtime }}</td>
                                    <td>
                                        @if ($document->cf_2271 != '')
                                            <a href="{{ $document->cf_2271 }}"
                                                class="btn btn-outline-success btn-rounded" target="_blank" download>
                                                <i class="fas fa-download"></i></a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
    <div class="card shadow  p-1 rounded ">
        <div class="card-header">
            Quote product details
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered lineItemsTable" style="margin-top:15px">
                    <thead>
                        <tr>
                            <th colspan="2" class="lineItemBlockHeader">
                                Item Details
                            </th>
                            <th colspan="2" class="lineItemBlockHeader">
                                Currency :
                                {{ $invoice->currency->currency_name }}({{ $invoice->currency->currency_symbol }})
                            </th>
                            <th colspan="3" class="lineItemBlockHeader">
                                Tax Mode : {{ $invoice->hdnTaxType }}
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="lineItemFieldName">
                                <span class="redColor">*</span><strong>Item Name</strong>
                            </td>
                            <td class="lineItemFieldName">
                                <strong>Quantity</strong>
                            </td>
                            <td class="lineItemFieldName">
                                <strong>Overall Cost</strong>
                            </td>
                            <td style="white-space: nowrap;">
                                <strong>Selling Price</strong>
                            </td>
                            <td class="lineItemFieldName">
                                <strong class="pull-right">Total</strong>
                            </td>
                            <td class="lineItemFieldName">
                                <strong class="pull-right">Margin</strong>
                            </td>
                            <td class="lineItemFieldName">
                                <strong class="pull-right">Net Price</strong>
                            </td>
                        </tr>
                        <tr>

                            <td>
                                <div>
                                    <h5>
                                        <b class="fieldValue" target="_blank">
                                            {{ $invoice->product->productname }}</b>
                                    </h5>
                                </div>
                                <div>

                                </div>
                                <div>

                                    {{ $invoice->comment }}
                                </div>
                            </td>

                            <td>
                                {{ $invoice->quantity }}
                            </td>

                            <td>
                                {{ number_format($invoice->purchase_cost, 2, '.', ',') }}
                            </td>

                            <td style="white-space: nowrap;">
                                <div>
                                    {{ number_format($invoice->listprice, 2, '.', ',') }}
                                </div>
                                <div>
                                    (-)&nbsp; <strong><a class="individualDiscount inventoryLineItemDetails"
                                            tabindex="0">Discount</a> :
                                    </strong>
                                </div>
                                <div>
                                    <strong>Total After Discount :</strong>
                                </div>
                            </td>

                            <td>
                                @php
                                    if ($invoice->discount_amount === '') {
                                        $disc = $invoice->purchase_cost - ($invoice->purchase_cost - ($invoice->purchase_cost * $invoice->discount_percent) / 100);
                                        $result = $disc;
                                    } else {
                                        $result = $invoice->discount_amount;
                                    }
                                @endphp

                                <div align="right"> {{ number_format($invoice->listprice, 2, '.', ',') }}</div>
                                <div align="right">{{ number_format($result, 2, '.', ',') }}</div>
                                <div align="right">{{ number_format($invoice->hdnSubTotal, 2, '.', ',') }}</div>
                            </td>
                            <td>
                                <div align="right">{{ number_format($invoice->margin, 2, '.', ',') }}</div>
                            </td>
                            <td>
                                <div align="right">{{ number_format($invoice->hdnSubTotal, 2, '.', ',') }}</div>
                            </td>
                        </tr>
                    </tbody>
                </table>
                {{--  --}}
                <table class="table table-bordered lineItemsTable">
                    <tbody>
                        <tr>
                            <td width="83%">
                                <div class="pull-right">
                                    <strong>Items Total</strong>
                                </div>
                            </td>
                            <td>
                                <div align="right">
                                    <span class="pull-right">
                                        <strong>{{ number_format($invoice->hdnSubTotal, 2, '.', ',') }}</strong>
                                    </span>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td width="83%">
                                <div align="right">
                                    (-)&nbsp;<strong><a class="inventoryLineItemDetails">Overall Discount</a></strong>
                                </div>
                            </td>
                            <td>
                                <div align="right">
                                    0.000
                                </div>

                            </td>
                        </tr>
                        <tr>
                            <td width="83%">
                                <div align="right">
                                    (+)&nbsp;<strong><a class="inventoryLineItemDetails" tabindex="0">Charges</a></strong>
                                </div>
                            </td>
                            <td>
                                <div align="right">
                                    {{ number_format($invoice->hdnS_H_Amount, 2, '.', ',') }}
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td width="83%">
                                <div align="right">
                                    <strong>Pre Tax Total </strong>
                                </div>
                            </td>
                            <td>
                                <div align="right">
                                    {{ number_format($invoice->pre_tax_total, 2, '.', ',') }}
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td width="83%">
                                <div align="right">
                                    (+)&nbsp;<strong><a class="inventoryLineItemDetails">Tax</a></strong>
                                </div>
                            </td>
                            <td>
                                @php
                                    $ammount = $invoice->hdnSubTotal;
                                    $tax1 = $invoice->tax1 != '' ? number_format($invoice->tax1) : 0;
                                    $tax2 = $invoice->tax2 != '' ? number_format($invoice->tax2) : 0;
                                    $tax3 = $invoice->tax3 != '' ? number_format($invoice->tax3) : 0;
                                    $res1 = $ammount - ($ammount - ($ammount * $tax1) / 100);
                                    $res2 = $ammount - ($ammount - ($ammount * $tax2) / 100);
                                    $res3 = $ammount - ($ammount - ($ammount * $tax3) / 100);
                                    $totTax = $res1 + $res2 + $res3;
                                @endphp
                                <div align="right">
                                    {{ number_format($totTax, 2, '.', ',') }}
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td width="83%">
                                <div align="right">
                                    (+)&nbsp;<strong><a class="inventoryLineItemDetails">
                                            Taxes On Charges </a></strong>
                                </div>
                            </td>
                            <td>
                                <div align="right">
                                    {{ number_format($invoice->hdnS_H_Percent, 2, '.', ',') }}
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td width="83%">
                                <div align="right">
                                    (-)&nbsp;<strong><a class="inventoryLineItemDetails">
                                            Deducted Taxes </a></strong>
                                </div>
                            </td>
                            <td>
                                <div align="right">
                                    {{ number_format($invoice->cf_2123, 2, '.', ',') }}
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td width="83%">
                                <div align="right">
                                    <strong>Adjustment</strong>
                                </div>
                            </td>
                            <td>
                                <div align="right">
                                    {{ number_format($invoice->txtAdjustment, 2, '.', ',') }}
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td width="83%">
                                <div align="right">
                                    <strong>Grand Total</strong>
                                </div>
                            </td>
                            <td>
                                <div align="right">
                                    {{ number_format($invoice->hdnGrandTotal, 2, '.', ',') }}
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td width="83%">
                                <div align="right">
                                    <strong>Received</strong>
                                </div>
                            </td>
                            <td>
                                <div align="right">
                                    {{ number_format($invoice->received, 2, '.', ',') }}
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td width="83%">
                                <div align="right">
                                    <strong>Balance</strong>
                                </div>
                            </td>
                            <td>
                                <div align="right">
                                    {{ number_format($invoice->balance, 2, '.', ',') }}
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>

            </div>
        </div>
    </div>
@endsection
