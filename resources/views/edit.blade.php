@extends('layouts.site')
@section('content')
    <b-row>
        <b-col>
            <create-update-form :item="{{$game}}"></create-update-form>
        </b-col>
    </b-row>
@endsection
