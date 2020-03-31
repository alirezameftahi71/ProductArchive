@extends('layouts.site')
@section('content')
<div class="row text-center full-height">
    <div class="col-lg-3 col-md-3 side-bar-container">
        <side-bar :items="{{ $list_items }}"></side-bar>
    </div>
    <info-area :item="{{ $game }}"></info-area>
</div>
@endsection
@section('modals')
    <delete-modal></delete-modal>
@endsection
