@extends('layouts.app')
@include('features.datatable')
@section('title')
    Quote {Quote name}
@endsection
@section('content')

<div class="row page-titles">
    <div class="col-md-5 col-12 align-self-center">
        <h3 class="text-themecolor mb-0">My Quotes</h3>
    </div>
</div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">My Quotes</h4>
                    <div class="table-responsive">
                        <table class="table dt_alt_pagination table-striped table-bordered display">
                            <thead>
                                <tr>
                                    <th scope="col">Quote Title</th>
                                    <th scope="col">Grand Total</th>
                                    <th scope="col">Status</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($open_quotes as $openQuote)
                                    <tr>
                                        <td>{{ $openQuote->title }}</td>
                                        <td>{{ $openQuote->total }}</td>
                                        <td>{{ $openQuote->accepted }}</td>
                                        <td>
                                            <a href="{{ route('pending_quotes' , [$openQuote->id]) }}" type="button"
                                                class="btn btn-outline-success btn-rounded">
                                                <i class="fas fa-eye"></i>
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
    </div>
@endsection
