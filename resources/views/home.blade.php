@extends('layouts.site')
@section('content')
<div class="row text-center full-height">
    <div class="col-lg-3 col-md-3 items-sidenav">
        <div class="input-group" id="searchItems">
            <input class="form-control border-right-0 border" type="search" id="searchBox" placeholder="Search...">
            <div class="input-group-append">
                <div class="input-group-text bg-white">
                    <i class="fa fa-search"></i>
                </div>
            </div>
        </div>
        <br />
        <div class="list-group" id="listItems">
            @foreach ($list_items as $item)
                <a id={{$item->id}} href="#{{$item->id}}" class="list-group-item list-group-item-action">{{ $item->name }}</a>
            @endforeach
        </div>
    </div>
    <div class="col-lg-9 col-md-9">
        <h3 class="mt-4 mb-4">The Archive</h3>
        <hr />
        <div class="row">
            <div class="col-lg-8 col-md-7">
                <table id="info-table" class="table table-bordered table-striped fixed-width-table">
                    <tr>
                        <th>Title</th>
                        <td id="title">Example Product Name</td>
                    </tr>
                    <tr>
                        <th>Release Date</th>
                        <td id="releaseDate">20xx</td>
                    </tr>
                    <tr>
                        <th>Genre(s)</th>
                        <td id="genre">Example Genre</td>
                    </tr>
                    <tr>
                        <th>Platform(s)</th>
                        <td id="platform">Example platform</td>
                    </tr>
                    <tr>
                        <th>Publisher(s)</th>
                        <td id="publisher">Example Company</td>
                    </tr>
                    <tr>
                        <th>Rate</th>
                        <td id="rate">#/5</td>
                    </tr>
                </table>
            </div>
            <div class="col-lg-4 col-md-5">
                <div class="container-fluid">
                    <img id="cover-pic" class="img-fluid" src="http://via.placeholder.com/265x320" alt="Product Cover"
                        width="265" height="320">
                </div>
                <div class="container-fluid toolbar">
                    <a data-toggle="confirmation" data-title="Delete Product?" data-placement="left"
                        data-btn-cancel-class="btn-danger" data-popout="true" href="javascript:deleteProduct();">
                        <i class="icon fas fa-trash-alt"></i>
                    </a>
                    <i class="icon fas fa-thumbs-up"></i>
                    <a href="javascript:updateProduct();">
                        <i class="icon fas fa-edit"></i>
                    </a>
                    <a id="btn-action-checked" href="javascript:toggleCompletedTag();">
                        <i class="icon fas fa-check-circle"></i>
                    </a>
                </div>
            </div>
        </div>
        <hr>
        <div class="container-fluid">
            <p id="description">
                Full Description goes here in multiple lines providing more and detailed information about the product,
                like
                story line or
                history.
            </p>
        </div>
    </div>
</div>
@endsection
