<!-- load php functions  -->
<?php require_once "../include/_php/functions.php"; ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>The Archive</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <link rel="stylesheet" href="../include/_css/library/normalize.css" />
  <link rel="stylesheet" href="../include/_css/library/fontawesome/css/all.min.css" />
  <link rel="stylesheet" href="../include/_css/library/bootstrap.min.css" />
  <link rel="stylesheet" href="../include/_css/library/tagmanager.min.css" />
  <link rel="stylesheet" href="../include/_css/library/bootstrap-table.min.css" />
  <link rel="stylesheet" href="../include/_css/library/bootstrap4-toggle.min.css" />
  <link rel="stylesheet" href="../include/_css/site.css">

  <script src="../include/_js/library/jquery-3.3.1.min.js"></script>
  <script src="../include/_js/library/popper.min.js"></script>
  <script src="../include/_js/library/bootstrap.min.js"></script>
  <script src="../include/_js/library/bootstrap-confirmation.min.js"></script>
  <script src="../include/_js/library/tagmanager.min.js"></script>
  <script src="../include/_js/library/bootstrap3-typeahead.min.js"></script>
  <script src="../include/_js/library/bootstrap-table.min.js"></script>
  <script src="../include/_js/library/bootstrap4-toggle.min.js"></script>
  <script src="../include/_js/library/bootbox.all.min.js"></script>
  <script src="../include/_js/library/highcharts.src.js"></script>
  <script src="../include/_js/library/sand-signika.js"></script>
  <script src="../include/_js/functions.js"></script>
  <script src="../include/_js/site.js"></script>

  <link rel="shortcut icon" type="image/png" href="favicon.png" />
</head>

<body>
  <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
    <a class="navbar-brand fas fa-archive" href="index.php"></a>
    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#myNavbar">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item">
          <a class="nav-link" href="index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="add_product.php">Add/Update</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="queries.php">Queries</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="chart.php">Charts</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="about.php">About</a>
        </li>
      </ul>
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="#">
            <span class="fas fa-sign-in-alt"></span>Login</a>
        </li>
      </ul>
    </div>
  </nav>
  <div id="arm-body" class="container-fluid">