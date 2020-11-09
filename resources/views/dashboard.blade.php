@extends('layouts.site')
@section('content')
    <b-row>
        <b-col>
            <dashboard :user='@json($user)' />
        </b-col>
    </b-row>
@endsection
