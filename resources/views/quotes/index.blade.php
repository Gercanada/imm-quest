@extends('layouts.app')
@include('features.datatable')
@section('title')
    Quotes
@endsection
@section('content')

    <div class="row page-titles">
        <div class="col-md-5 col-12 align-self-center">
            <h3 class="text-themecolor mb-0"><span class="lstick d-inline-block align-middle"></span>My Quotes</h3>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card shadow-lg p-1">
                <div class="card-body">
                    <h4 class="card-title"><span class="lstick d-inline-block align-middle"></span>My Open Quotes</h4>
                    <div class="table-responsive">
                        <table class="table dt_alt_pagination table-striped table-bordered display">
                            <thead>
                                <tr>
                                    <th scope="col">Quote Title</th>
                                    <th scope="col">Grand Total</th>
                                    <th scope="col">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($open_quotes as $openQuote)
                                    <tr>
                                        <td> <a href="{{ route('showQuote', [$openQuote->id]) }}">
                                                {{ $openQuote->subject }}</a></td>
                                        <td>{{ $openQuote->hdnGrandTotal }}</td>
                                        <td>{{ $openQuote->quotestage }}</td>
                                        {{-- <td>
                                            <a href="{{ route('pending_quotes', [$openQuote->id]) }}" type="button"
                                                class="btn btn-outline-success btn-rounded">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        </td> --}}
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
                    <h4 class="card-title"><span class="lstick d-inline-block align-middle"></span>My Accepted Quotes</h4>
                    <div class="table-responsive">
                        <table class="table dt_alt_pagination table-striped table-bordered display">
                            <thead>
                                <tr>
                                    <th scope="col">Quote Title</th>
                                    <th scope="col">Grand Total</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">AProposal Date</th>
                                    {{-- <th scope="col">Accepted date</th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($accepted_quotes as $acceptedQuote)
                                    <tr>
                                        <td> <a href="{{ route('showQuote', [$acceptedQuote->id]) }}">
                                                {{ $acceptedQuote->subject }}</a></td>
                                        <td>{{ $acceptedQuote->hdnGrandTotal }}</td>
                                        <td>{{ $acceptedQuote->quotestage }}</td>
                                        <td>{{ $acceptedQuote->cf_966 }}</td>
                                        {{-- <td>
                                            <a href="{{ route('pending_quotes', [$acceptedQuote->id]) }}" type="button"
                                                class="btn btn-outline-success btn-rounded">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        </td> --}}
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
