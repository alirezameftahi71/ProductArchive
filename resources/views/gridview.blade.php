@extends('layouts.site')
@section('styles')
<link rel="stylesheet" href="/css/gridview.css">
@endsection
@section('content')
<div class="row full-height scrolled-y">
    <div class="col-12">
        <tile-filter></tile-filter>
        <div id="grid-container" class="row">
            @foreach ($collection ?? [] as $item)
            <game-tile :item="{{$item}}"></game-tile>
            @endforeach
        </div>
    </div>
</div>
@endsection
