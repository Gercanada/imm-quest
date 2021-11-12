@extends('layouts.app')


@section('content')

    <div class="card">
        <div class="card-body">
            <h4 class="card-title">My invoices</h4>
            <h6 class="card-subtitle">Here can i see my invpices</h6>
            <h6 class="card-title mt-5"><i class="mr-1 font-18 mdi mdi-numeric-1-box-multiple-outline"></i> My open invpices
            </h6>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Invoice Titlee</th>
                            <th scope="col">Grand Total</th>
                            <th scope="col">Status</th>
                            <th scope="col">Make or Report A Payment</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">1</th>
                            <td>Mark</td>
                            <td>Otto</td>
                            <td>
                                <a href="{{ route('show_checklist') }}" type="button"
                                    class="btn btn-outline-success btn-rounded">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">2</th>
                            <td>Jacob</td>
                            <td>Thornton</td>
                            <td>
                                <a href="{{ route('show_checklist') }}" type="button"
                                    class="btn btn-outline-success btn-rounded">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">3</th>
                            <td>Larry</td>
                            <td>the Bird</td>
                            <td>
                                <a href="{{ route('show_checklist') }}" type="button"
                                    class="btn btn-outline-success btn-rounded">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <h6 class="card-title mt-5"><i class="mr-1 font-18 mdi mdi-numeric-1-box-multiple-outline"></i>Invoices Paid in
                Full</h6>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Invoice Title</th>
                            <th scope="col">Grand Total</th>
                            <th scope="col">Status</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">1</th>
                            <td>Mark</td>
                            <td>Otto</td>
                            <td>
                                <a href="{{ route('show_checklist') }}" type="button"
                                    class="btn btn-outline-success btn-rounded">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">2</th>
                            <td>Jacob</td>
                            <td>Thornton</td>
                            <td>
                                <a href="{{ route('show_checklist') }}" type="button"
                                    class="btn btn-outline-success btn-rounded">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">3</th>
                            <td>Larry</td>
                            <td>the Bird</td>
                            <td>
                                <a href="{{ route('show_checklist') }}" type="button"
                                    class="btn btn-outline-success btn-rounded">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
