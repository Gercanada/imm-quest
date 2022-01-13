@extends('layouts.app')
@section('title')
    Quotes | Quote {{ $quote->subject }}
@endsection

@section('content')
    <div class="card  shadow-lg p-1">
        <div class="card-header">
            <a href="{{ route('quotes') }}" class="btn btn-outline-success btn-rounded">
                <i class=" fas fa-arrow-circle-left"></i></a>
            <h4 class="card-title mb-3">
                <span class="lstick d-inline-block align-middle"></span>Quote
                <b>{{ $quote->subject }}</b>
            </h4>
        </div>

        <ul class="nav nav-tabs nav-bordered mb-3 customtab">
            <li class="nav-item">
                <a href="#home-b1" data-toggle="tab" aria-expanded="false" class="nav-link" data-toggle="tooltip"
                    title="Quote details">
                    <i class="mdi mdi-eye d-lg-none d-block mr-1"></i>
                    <span class="d-none d-lg-block">Quote details</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="#profile-b1" data-toggle="tab" aria-expanded="true" class="nav-link active" data-toggle="tooltip"
                    title="Payment plan">
                    <i class="mdi mdi-calendar-today d-lg-none d-block mr-1"></i>
                    <span class="d-none d-lg-block">Payment plan</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="#settings-b1" data-toggle="tab" aria-expanded="false" class="nav-link" data-toggle="tooltip"
                    title="Files">
                    <i class="mdi mdi-file-document d-lg-none d-block mr-1"></i>
                    <span class="d-none d-lg-block">Files</span>
                </a>
            </li>
        </ul>

        <div class="tab-content ">
            <div class="tab-pane" id="home-b1">
                <div class="card">
                    <div class="card-body">
                        <table class="table v-middle fs-3 mb-0 mt-4">
                            <tbody>
                                <tr>
                                    <td>Title</td>
                                    <td class="text-end font-weight-medium">{{ $quote->subject }}</td>
                                </tr>
                                <tr>
                                    <td>Quote Number</td>
                                    <td class="text-end font-weight-medium">
                                        {{ $quote->quote_no }}</td>
                                </tr>
                                <tr>
                                    <td>Proposal Date</td>
                                    <td class="text-end font-weight-medium">
                                        {{ $quote->cf_966 }}</td>
                                </tr>

                                <tr>
                                    <td>Valid Until</td>
                                    <td class="text-end font-weight-medium">
                                        {{ $quote->validtill }}</td>
                                </tr>
                                <tr>
                                    <td>Number of Payments</td>
                                    <td class="text-end font-weight-medium">
                                        {{ $quote->cf_1877 }}</td>
                                </tr>
                                <tr>
                                    <td>Revision</td>
                                    <td class="text-end font-weight-medium">
                                        {{ $quote->cf_2170 }}</td>
                                </tr>
                                <tr>
                                    <td>Professional Services</td>
                                    <td class="text-end font-weight-medium">
                                        {{ $quote->cf_962 }}</td>
                                </tr>
                                <tr>
                                    <td>Government Fee Subtotal</td>
                                    <td class="text-end font-weight-medium">
                                        {{ $quote->cf_964 }}</td>
                                </tr>
                                <tr>
                                    <td>Taxes</td>
                                    <td class="text-end font-weight-medium">
                                        {{ $quote->cf_1576 }}</td>
                                </tr>
                                <tr>
                                    <td>Client Approval Date</td>
                                    <td class="text-end font-weight-medium"></td>
                                </tr>
                                <tr>
                                    <td>Client Response to Quote</td>
                                    <td class="text-end font-weight-medium"></td>
                                </tr>
                                <tr>
                                    <td>Client Approval Signature</td>
                                    <td class="text-end font-weight-medium"></td>
                                </tr>

                                <tr></tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <br>
                <a class="btn btn-secondary"><i class="feather feather-edit-3 feather-icon">Accept and sign quote</i></a>
                </br>
                </br>

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
                                    <td>{{ $document->cf_1491 }}</td>
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

    <div class="card">
        <div class="card shadow-lg p-1 ">
            <div class="card-header">

                <h4 class="card-title mb-3">
                    <span class="lstick d-inline-block align-middle"></span> Quote product details
                </h4>
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
                                    {{ $quote->currency->currency_name }}({{ $quote->currency->currency_symbol }})
                                </th>
                                <th colspan="3" class="lineItemBlockHeader">
                                    Tax Mode : {{ $quote->hdnTaxType }}
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
                                                {{ $quote->product->productname }}</b>
                                        </h5>
                                    </div>
                                    <div>
                                    </div>
                                    <div>
                                        {{ $quote->comment }}
                                    </div>
                                </td>
                                <td>
                                    {{ $quote->quantity }}
                                </td>
                                <td>
                                    {{ number_format($quote->purchase_cost, 2, '.', ',') }}
                                </td>
                                <td style="white-space: nowrap;">
                                    <div>
                                        {{ number_format($quote->listprice, 2, '.', ',') }}
                                    </div>
                                    <div>
                                        (-)&nbsp; <strong><a class="individualDiscount inventoryLineItemDetails"
                                                tabindex="0" id="example">Discount</a> :
                                        </strong>
                                    </div>
                                    <div>
                                        <strong>Total After Discount :</strong>
                                    </div>
                                </td>
                                <td>
                                    @php
                                        if ($quote->discount_amount === '') {
                                            $discountPercent = $quote->discount_percent != '' ? number_format($quote->discount_percent) : 0;
                                            $disc = $quote->purchase_cost - ($quote->purchase_cost - ($quote->purchase_cost * $discountPercent) / 100);
                                            $result = $disc;
                                        } else {
                                            $result = $quote->discount_amount != '' ? number_format($quote->discount_amount, 2, '.', ',') : 0;
                                        }
                                    @endphp
                                    <div align="right"> {{ number_format($quote->listprice, 2, '.', ',') }}</div>
                                    <div align="right">{{ number_format($result, 2, '.', ',') }}</div>
                                    <div align="right">{{ number_format($quote->hdnSubTotal, 2, '.', ',') }}</div>
                                </td>
                                <td>
                                    <div align="right">{{ number_format($quote->margin, 2, '.', ',') }}</div>
                                </td>
                                <td>
                                    <div align="right">{{ number_format($quote->hdnSubTotal, 2, '.', ',') }}</div>
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
                                            <strong>{{ number_format($quote->hdnSubTotal, 2, '.', ',') }}</strong>
                                        </span>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td width="83%">
                                    <div align="right">
                                        (-)&nbsp;<strong>
                                            <a class="inventoryLineItemDetails" id="finalDiscount" tabindex="0"
                                                role="tooltip">Overall Discount</a></strong>
                                    </div>
                                </td>
                                <td>
                                    <div align="right">
                                        {{ $quote->discount_amount != '' ? number_format($quote->discount_amount, 2, '.', ',') : 0 }}
                                    </div>

                                </td>
                            </tr>
                            <tr>
                                <td width="83%">
                                    <div align="right">
                                        (+)&nbsp;<strong><a class="inventoryLineItemDetails" tabindex="0"
                                                role="tooltip">Charges</a></strong>
                                    </div>
                                </td>
                                <td>
                                    <div align="right">
                                        {{ number_format($quote->hdnS_H_Amount, 2, '.', ',') }}
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
                                        {{ number_format($quote->pre_tax_total, 2, '.', ',') }}
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td width="83%">
                                    <div align="right">
                                        (+)&nbsp;<strong><a class="inventoryLineItemDetails" tabindex="0"
                                                role="tooltip">Tax</a></strong>
                                    </div>
                                </td>
                                <td>
                                    @php
                                        $ammount = $quote->hdnSubTotal;
                                        $tax1 = $quote->tax1 != '' ? number_format($quote->tax1) : 0;
                                        $tax2 = $quote->tax2 != '' ? number_format($quote->tax2) : 0;
                                        $tax3 = $quote->tax3 != '' ? number_format($quote->tax3) : 0;

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
                                        (+)&nbsp;<strong><a class="inventoryLineItemDetails" tabindex="0">
                                                Taxes On Charges </a></strong>
                                    </div>
                                </td>
                                <td>
                                    <div align="right">
                                        {{ number_format($quote->hdnS_H_Percent, 2, '.', ',') }}
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td width="83%">
                                    <div align="right">
                                        (-)&nbsp;<strong><a class="inventoryLineItemDetails" tabindex="0">
                                                Deducted Taxes </a></strong>
                                    </div>
                                </td>
                                <td>
                                    <div align="right">
                                        {{ number_format($quote->cf_2123, 2, '.', ',') }}
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
                                        {{ number_format($quote->txtAdjustment, 2, '.', ',') }}
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
                                        {{ number_format($quote->hdnGrandTotal, 2, '.', ',') }}
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
                                        {{ number_format($quote->received, 2, '.', ',') }}
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
                                        {{ number_format($quote->balance, 2, '.', ',') }}
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
@endsection
