@extends('layouts.site')
@section('content')
<div class="row text-center full-height">
    <div class="col-lg-3 col-md-3 side-bar-container">
        <side-bar :items="{{ $list_items }}"></side-bar>
    </div>
    <div class="col-lg-9 col-md-9 info-area-container">
        <h3 class="mt-4 pt-3 mb-4 d-none d-md-block">The Archive</h3>
        <hr class="d-none d-md-block" />
        <br class="d-block d-md-none" />
        <info-area :item="{{ $game }}"></info-area>
    </div>
</div>
@endsection
@section('modals')
    <delete-modal></delete-modal>
@endsection
