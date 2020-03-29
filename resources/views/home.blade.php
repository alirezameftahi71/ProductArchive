@extends('layouts.site')
@section('styles')
<link rel="stylesheet" href="/css/home.css">
@endsection
@section('content')
<div class="row text-center full-height">
    <sidebar :items="{{ $list_items }}"></sidebar>
    <infoarea :item="{{ $game }}"></infoarea>
</div>
@endsection
@section('modals')
    @include('layouts.delete-modal')
@endsection
@section('scripts')
<script src="/js/home.js"></script>
@endsection
