<!-- include the header  -->
<?php include "../include/_layout/header.php";?>

<!-- load css for this page  -->
<link rel="stylesheet" href="../include/_css/index.css">

<!-- load js for this page  -->
<script src="../include/_js/index.js"></script>

<!-- parent area -->
<div class="row text-center full-height">
  <!-- the side menu -->
  <div class="col-md-2 items-sidenav">
    <div class="input-group" id="searchItems">
      <input class="form-control border-right-0 border" type="search" id="searchBox" placeholder="Search...">
      <span class="input-group-append">
        <div class="input-group-text bg-white">
          <i class="fa fa-search"></i>
        </div>
      </span>
    </div>
    <br>
    <div class="list-group" id="list-items">
    </div>
  </div>

  <!-- the main area -->
  <div class="col-md-10">
    <h3 class="mt-4 mb-4">The Game Archive</h3>
    <hr />
    <div class="row">
      <div class="col-md-8">
        <table class="table table-bordered table-striped fixed-width-table mt-5">
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
      <div class="col-md-4">
        <div class="container-fluid">
          <img id="cover-pic" class="img-fluid" src="../resource/_img/cover-placeholder-265x320.png" alt="Product Cover"
            width="265" height="320">
        </div>
        <div class="container-fluid toolbar">
          <a data-toggle="confirmation" data-title="Delete Product?" data-placement="left"
            data-btn-cancel-class="btn-danger" data-popout="true" class="m-btn" href="javascript:deleteProduct();">
            <i class="icon red-hover fas fa-trash-alt"></i>
          </a>
          <a class="m-btn" href="#">
            <i class="icon fas fa-thumbs-up"></i>
          </a>
          <a class="m-btn" href="javascript:updateProduct();">
            <i class="icon fas fa-edit"></i>
          </a>
          <a class="m-btn" id="checked-btn" href="javascript:toggleCompletedTag();">
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
    <?php include "../include/_layout/footer.php";?>
  </div>