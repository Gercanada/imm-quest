@extends('layouts.app')
@section('title')
    My documents
@endsection
@section('content')
    <div class="card-header">
        My documents
    </div>

    <div class="card">
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
@endsection
