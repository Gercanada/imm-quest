@extends('layouts.app')

@section('title')
    Quote {Quote name}
@endsection
@section('content')

    <div class="card">

        <div class="card-body">
            <h4 class="card-title">My Quotes</h4>
            <h6 class="card-subtitle">Here can i see my quotes</h6>
            <h6 class="card-title mt-5"><i class="mr-1 font-18 mdi mdi-numeric-1-box-multiple-outline"></i> My open quotes</h6>
            <div class="table-responsive">
                <table class="table">
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
                                    <a href="{{ route('pending_quotes') }}" type="button"
                                        class="btn btn-outline-success btn-rounded">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </td>
                            </tr>

                        @endforeach
                    </tbody>
                </table>
            </div>

            <h6 class="card-title mt-5"><i class="mr-1 font-18 mdi mdi-numeric-1-box-multiple-outline"></i> My accepted
                quotes</h6>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Quote Title</th>
                            <th scope="col">Grand Total</th>
                            <th scope="col">Status</th>
                            <th scope="col">Accepted Date</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($accepted_quotes as $acceptedQuote)
                            <tr>
                                <td>{{ $openQuote->title }}</td>
                                <td>{{ $openQuote->total }}</td>
                                <td>{{ $openQuote->accepted }}</td>
                                <td>{{ $openQuote->accepted_date }}</td>
                                <td>
                                    <a href="{{ route('accepted_quotes') }}" type="button"
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
@endsection
