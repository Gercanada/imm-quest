@extends('layouts.app')

@section('title')
    CL Item DetailView Upload
@endsection

@section('content')
    <clitem-component :csrf-token="{{ csrf_token() }}"></clitem-component>
  {{--  <uploader-component></uploader-component> --}}
@endsection
