@extends('layouts.site')
@section('styles')
<link rel="stylesheet" href="/css/gridview.css">
@endsection
@section('content')
<div id="grid-container" class="row full-height scrolled">
    @foreach ($collection ?? [] as $item)
    <div class="column">
        <img id="{{ isset($item->id) ? $item->id : '0' }}"
            src="{{ isset($item->cover_pic) ? asset("storage/" . $item->cover_pic) : asset('storage/assets/default.png') }}" />
    </div>
    @endforeach
</div>
@endsection
@section('scripts')
<script src="/js/gridview.js"></script>
@endsection
