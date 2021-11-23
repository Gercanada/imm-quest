@extends('layouts.app')
@section('title')
    Enable/Disable modules
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        Enable or disable tools
                    </div>
                    <form method="POST" action="{{ route('configTypes') }}">
                        @csrf
                        <div class="card-body">
                            @foreach ($vt_types as $type)
                                <div class="form-group">
                                    <input type="checkbox" id="typeID{{ $type->name }}" name="{{ $type->name }}"
                                        class="chk-col-indigo material-inputs" value="{{ $type->name }}"

                                        @if ($type->active == 0) checked @endif
                                       >
                                    <label for="typeID{{ $type->name }}">{{ $type->name }}</label>
                                </div>
                            @endforeach
                        </div>
                </div>
                <div class="card-footer">
                    <button class="btn btn-primary" type="submit"><i class=" fas fa-save"></i> Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
