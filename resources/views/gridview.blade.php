@extends('layouts.site')
@section('content')
<b-row>
    <b-col>
        <tile-filter></tile-filter>
    </b-col>
</b-row>
<b-row>
    <b-col>
        <tiles-view :collection="{{ json_encode($collection) }}"></tiles-view>
    </b-col>
</b-row>
@endsection
