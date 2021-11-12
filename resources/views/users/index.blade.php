@extends('layouts.app')

@section('title')
    My profile
@endsection


@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row" id="app">
                <user-component></user-component>
            </div>
        </div>
    </section>

@endsection
