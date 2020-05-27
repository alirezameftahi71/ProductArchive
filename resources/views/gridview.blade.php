@extends('layouts.site')
@section('styles')
<link rel="stylesheet" href="/css/gridview.css">
@endsection
@section('content')
<b-row class="full-height scrolled-y">
    <b-col>
        <tile-filter></tile-filter>
        <b-row id="grid-container">
            @foreach ($collection ?? [] as $item)
            <game-tile :item="{{$item}}"></game-tile>
            @endforeach
        </b-row>
    </b-col>
</b-row>
@endsection
