@extends('layouts.site')
@section('content')
    <b-row>
        <b-col>
            <dashboard :user='@json($user)'></dashboard>
        </b-col>
    </b-row>
@endsection
