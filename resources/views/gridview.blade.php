@extends('layouts.site')
@section('content')
<b-row class="full-height scrolled-y">
    <b-col>
        <b-container>
            <b-row class="mb-1 mt-3">
                <b-col>
                    <tile-filter></tile-filter>
                </b-col>
            </b-row>
            <b-row class="mb-3 mt-1">
                <tiles-view :collection="{{ json_encode($collection) }}"></tiles-view>
            </b-row>
        </b-container>
    </b-col>
</b-row>
@endsection
