@extends('layouts.site')
@section('styles')
<link rel="stylesheet" href="/css/gridview.css">
@endsection
@section('content')
<div class="row full-height scrolled">
    @foreach ($collection ?? [] as $item)
    <div class="column">
        <img src="{{ isset($item) ? asset("storage/" . $item->cover_pic) : asset('storage/assets/default.png') }}" />
    </div>
    @endforeach
</div>
@endsection
@section('scripts')
<script src="/js/gridview.js"></script>
@endsection
