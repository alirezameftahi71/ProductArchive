{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    
                    You are logged in! your name is {{$user->name}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}
@extends('layouts.site')
@section('content')
    <b-row>
        <b-col>
            You are logged in! your name is {{$user->name}}
        </b-col>
    </b-row>
@endsection
