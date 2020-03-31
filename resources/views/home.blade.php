@extends('layouts.site')
@section('content')
<div class="row text-center full-height">
    <sidebar :items="{{ $list_items }}"></sidebar>
    <infoarea :item="{{ $game }}"></infoarea>
</div>
@endsection
@section('modals')
    @include('layouts.delete-modal')
@endsection
