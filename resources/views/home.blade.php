@extends('layouts.site')
@section('content')
<b-row class="text-center full-height">
    <b-col md="3" class="side-bar-container">
        <side-bar :items="{{ $list_items }}"></side-bar>
    </b-col>
    <b-col md="9" class="info-area-container">
        <h3 class="mt-4 pt-3 mb-4 d-none d-md-block">The Archive</h3>
        <hr class="d-none d-md-block" />
        <br class="d-block d-md-none" />
        <info-area :item="{{ $game }}"></info-area>
    </b-col>
</b-row>
@endsection
@section('modals')
    <delete-modal></delete-modal>
@endsection
