<?php
require "connect.php"

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="global.css">
  <link rel="stylesheet" href="bt/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <style>
    .marginBut {
      margin: 3px;
    }
  </style>
  <title>ADMIN ONLY</title>
</head>
<body style="margin:0;padding:0;box-sizing:border-box;">
  
  <!-- BAGIAN HEADER -->
  <div class="header-mes primary" style="height:70px;display:flex;justify-content:space-between;align-items:center;padding:3px;">
    <div class="header-mes-edit">
      <a href="#" class="btn"><i class="fa fa-pencil"></i></a>
    </div>
    <div class="header-mes-title" style="text-align:center;">
      <h2><b>PESAN</b></h2>
    </div>
    <div class="header-mes-menu">
      <a href="admin.php" class="btn"><i class="fa fa-reply"></i></a>
    </div>
  </div>
  <marquee><b style="opacity:0.5">suara publik! tidak boleh dihapus</b></marquee>
  <!-- AKHIR DARI BAGIAN HEADER -->
  
  <!-- BAGIAN CONTENT -->
  <?php  
    $query = mysqli_query($conn, "SELECT * FROM contact ORDER BY id DESC");
    $i;
    while($x = mysqli_fetch_assoc($query)) {
  ?>
  <div class="content-container mt-4" style="padding:10px;">
    <input type="hidden" id="input<?= $x['id'] ?>" value="<?= $x['email'] ?>">
    <hr>
      <b id="name" class="" style="opacity:0.9;">
        From : <?= $x['email'] ?> <br>
        Name : <?= $x['name'] ?> <br>
        Date : <?= $x['tanggal'] ?>
      </b>
    <div class="content-mes" style="display:grid;padding:5px;max-height:300px;overflow:auto;">
      <p style="opacity:0.8;"><?= nl2br($x['message']) ?></p>
    </div>
    <div class="button-group" style="padding:3px;display:flex;align-items:end;">
      <hr>
      <a href="" class="btn btn-info marginBut"><i class="fa fa-comments-o"></i></a>
    </div>
    <hr>
  </div>
  <?php } ?>
  <!-- AKHIR DARI BAGIAN CONTENT -->
  <script src="bt/js/bootstrap.min.js"></script>
</body>
</html>