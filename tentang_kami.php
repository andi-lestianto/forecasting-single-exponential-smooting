<?php

session_start();

if (!isset($_SESSION["username"])) {
  header("Location: login.php");
}

?>

<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Welcome - SB Group</title>
  <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css'>
  <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css'>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins">
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <!-- partial:index.partial.html -->
  <?php
  include_once 'sidebar.php';
  ?>

  <div class="content-container">

    <div class="container-fluid">

      <!-- Main component for a primary marketing message or call to action -->
      <div class="jumbotron">
        <h2>Tentang Kami</h2>
        <p>Website forecasting data penjualan di CV Samudra Group Indonesia ini dibuat oleh :
          <div style="display:flex; justify-content: space-around;">
            <div class="card" style="width:300px">
              <img class="card-img-top" src="img/andi.jpg" alt="Card image" style="width: 300px; height: 300px; object-fit: cover;">
              <div class="card-body">
                <h4 class="card-title">Andi Lestianto</h4>
                <p class="card-text">190103178/TI19B1</p>
                <a href="https://instagram.com/andi_lestianto" class="btn btn-primary" target="_blank">See Profile</a>
              </div>
            </div>
            <div class="card" style="width:300px">
              <img class="card-img-top" src="img/kiki.jpg" alt="Card image" style="width: 300px; height: 300px; object-fit: cover;">
              <div class="card-body">
                <h4 class="card-title">Kiki Priadani</h4>
                <p class="card-text">190103191/TI19B1</p>
                <a href="https://instagram.com/kikipriad" class="btn btn-primary" target="_blank">See Profile</a>
              </div>
            </div>
          </div>

        </div>

      </div>
    </div>
    <!-- partial -->
    <script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js'></script>
  </body>
  </html>