@extends('layouts.site')
@section('styles')
<link rel="stylesheet" href="/css/gridview.css">
@endsection
@section('content')
<div class="row full-height scrolled">
    <div class="col-12">
        <form action="">
            <div id="filter-container" class="form-row">
                <div class="form-group col-md-3">
                    <select id="is-checked" class="form-control custom-select" name="is-checked">
                        <option value="0">Disable Only UnChecked</option>
                        <option value="1" {{Request::get('is-checked') == '1' ? "selected" : ""}}>Enable Only UnChecked</option>
                    </select>
                </div>

                <div class="form-group col-md-3">
                    <select id="high-rate" class="form-control custom-select" name="high-rate">
                        <option value="0">Disable High Rate</option>
                        <option value="1" {{Request::get('high-rate') == '1' ? "selected" : ""}}>Enable High Rate</option>
                    </select>
                </div>

                <div class="form-group col-md-3">
                    <button type="submit" class="btn btn-primary">Apply Filter</button>
                </div>
            </div>
        </form>
        <div id="grid-container" class="row">
            @foreach ($collection ?? [] as $item)
            <div class="column">
                <div class="tile">
                    <a href="/?id={{ isset($item->id) ? $item->id : '0' }}">
                        <img id="{{ isset($item->id) ? $item->id : '0' }}"
                            src="{{ isset($item->cover_pic) ? asset("storage/" . $item->cover_pic) : asset('storage/assets/default.png') }}" />
                        <div class="overlay">
                            <p class="tile-label">
                                {{ isset($item->name) ? $item->name : '' }}
                            </p>
                        </div>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

@endsection
@section('scripts')
<script src="/js/gridview.js"></script>
@endsection
