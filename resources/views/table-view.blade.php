@extends('layouts.site')
@section('content')
  <b-row>
    <b-col>
      <table-view :data='@json($all_items)'></table-view>
    </b-col>
  </b-row>
@endsection
