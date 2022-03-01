@extends('layouts.app')

@section('title')
    Checklist {{ $check_list->name }}
@endsection

@section('scripts')
    <script>
        $('#surveyAlert').delay(10000).hide(0);
    </script>
@endsection

@section('content')
    <div class="card shadow  p-1 rounded">
        <div class="card-header shadow pb-1 pt-0 mt-0">
            <a href="{{ route('checklists') }}" class="btn btn-outline-success btn-rounded"><i
                    class=" fas fa-arrow-circle-left"></i></a>
            <h4 class="card-title"><span class="lstick d-inline-block align-middle"></span> Checklist
                <b>{{ $check_list->name }}</b>
            </h4>
        </div>
        <checklist-component></checklist-component>
    </div>
@endsection
