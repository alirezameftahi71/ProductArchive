@extends('layouts.site')
@section('content')
@php
    $filters = [];
    $userListFilter = new \stdClass();
    $userListFilter->uniqueName = "userLists";
    $userListFilter->title = "Lists";
    $userListFilter->options = !is_null($userLists) && !empty($userLists) ? $userLists : [];
    $filters[] = $userListFilter;
@endphp
<b-row>
    <b-col>
        <tile-filter :items='@json($filters)'></tile-filter>
    </b-col>
</b-row>
<b-row>
    <b-col>
        <tiles-view :collection='@json($collection)'></tiles-view>
    </b-col>
</b-row>
@endsection
@section('scripts')

@endsection