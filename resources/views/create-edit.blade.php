@extends('layouts.site')
@section('content')
    <b-row class='h-100' align-v='center'>
        <b-col>
            <create-update-form :item='@json($game ?? '')'></create-update-form>
        </b-col>
    </b-row>
@endsection
