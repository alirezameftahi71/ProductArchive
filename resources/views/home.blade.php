@extends('layouts.site')
@section('styles')
<link rel="stylesheet" href="/css/home.css">
@endsection
@section('content')
<div class="row text-center full-height">
    <sidebar :items="{{ $list_items }}"></sidebar>
    <div id="info-area" class="col-lg-9 col-md-9">
        <h3 class="mt-4 mb-4 d-none d-md-block">The Archive</h3>
        <hr class="d-none d-md-block" />
        <br class="d-block d-md-none" />
        <div class="row">
            <div class="col-lg-8 col-md-7 order-2 order-md-1 mt-4">
                <infogrid :item="{{$game}}"></infogrid>
            </div>
            <div class="col-lg-4 col-md-5 order-1 order-md-2">
                <div class="container-fluid">
                    <img id="cover-pic" class="img-fluid"
                        src="{{ isset($game) ? asset("storage/" . $game->cover_pic) : asset('storage/assets/default.png')}}"
                        alt="Product Cover" width="265" height="320">
                </div>
                <div class="container-fluid toolbar mt-2">
                    <a data-target="#delete-modal" href="javascript:void(0);" class="icon" data-toggle="modal">
                        <i class="fas fa-trash-alt"></i>
                    </a>
                    <a id="item-heart" href="javascript:void(0);" class="icon">
                        <i class="fas fa-thumbs-up"></i>
                    </a>
                    <a id="item-edit" href="javascript:void(0);" class="icon">
                        <i class="fas fa-edit"></i>
                    </a>
                    <a id="item-check" href="javascript:void(0);"
                        class="icon {{ isset($game) && $game->checked ? 'i-green' : '' }}">
                        <i class="fas fa-check-circle"></i>
                    </a>
                </div>
            </div>
        </div>
        <hr class="d-none d-md-block" />
        <div class="container-fluid">
            <p id="description">
                {{ isset($game) ? $game->description : null }}
            </p>
        </div>
    </div>
</div>
@endsection
@section('modals')
    @include('layouts.delete-modal')
@endsection
@section('scripts')
<script src="/js/home.js"></script>
@endsection
