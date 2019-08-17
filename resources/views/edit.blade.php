@extends('layouts.create-update')

@section('scripts')
<script src="/js/update.js"></script>
@endsection

@php
    $page_title = 'Update product';
@endphp
<script>    
    const game = {!! json_encode($game->toArray(), JSON_HEX_TAG) !!};
</script>