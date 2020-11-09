@extends('layouts.site')
@section('content')
<b-row class='text-center h-100'>
    <b-col md='12' lg='3' class='side-bar-container'>
        <side-bar :items='@json($all_items)' />
    </b-col>
    <b-col md='12' lg='9'>
        <b-row align-v='center' class='h-100 mt-md-2'>
            <b-col>
                <details-area 
                    :item='@json($game)' 
                    :hearted='@json($is_hearted)' 
                    :lists='@json($user_lists)' />
            </b-col>
        </b-row>
    </b-col>
</b-row>
@endsection
@section('modals')
    <delete-modal />
@endsection