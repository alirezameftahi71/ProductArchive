@extends('layouts.site')
@section('content')
<b-row class="full-height scrolled-y">
    <b-col>
        <b-container>
            <b-row>
                <b-col>
                    <tile-filter></tile-filter>
                </b-col>
            </b-row>
            <tiles-view :collection="{{ json_encode($collection) }}"></tiles-view>
        </b-container>
    </b-col>
</b-row>
@endsection
