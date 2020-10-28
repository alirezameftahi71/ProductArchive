@extends('layouts.site')
@section('content')
    <b-row>
        <b-col>
            You are logged in! your name is {{$user->name}}
        </b-col>
    </b-row>
@endsection
