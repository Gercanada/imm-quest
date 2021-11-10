@extends('layouts.app')
@section('body_contend')
    @if (Auth::check())
        <template v-if="menu==0">
            <dashboard-component></dashboard-component>
        </template>
        <template v-if="menu==1">
            <user-component></user-component>
        </template>
        <template v-if="menu==2">
            <documets-component></documets-component>
        </template>
    @endif
    <template v-if="menu==0">
        <dashboard-component></dashboard-component>
    </template>

    <template v-if="menu==3">
        <login-component></login-component>
    </template>
@endsection
