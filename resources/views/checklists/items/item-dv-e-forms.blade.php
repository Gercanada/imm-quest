@extends('layouts.app')

@section('title')
    CL Item DetailView Upload
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <a href="{{route('show_checklist')}}" class="btn btn-outline-info btn-rounded float-left"><i class=" fas fa-arrow-circle-left">Back</i></a>
            <h2 class="card-title">CL Item <b>XXX 01</b></h2>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="card-row">
                <div class="col border py-2">
                    <p>Case & checklist info</p>

                </div>

            </div>

        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="col border py-2">
                <p>CL info</p>
            </div>
        </div>
    </div>
    <br>
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md 6"> Help <br> Link</div>
                <div class="col-md 6">Status <br> Pending</div>
            </div>
        </div>
    </div>
@endsection
