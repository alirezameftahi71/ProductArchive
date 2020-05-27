@extends('layouts.site')
@section('content')
<b-row class="full-height">
    <b-col class="area-container">
        <b-row align-h="center">
            <b-col lg="10" md="12">
                <h3 class="text-center mt-4 mb-4">
                    Create new product
                </h3>
                <hr />
                <create-form></create-form>
            </b-col>
        </b-row>
    </b-col>
</b-row>
@endsection
