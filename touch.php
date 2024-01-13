<?php 
require "connect.php";

if(isset($_GET)) {
  $id = $_GET["id"];
  
  $queryTitle = mysqli_query($conn, "SELECT title FROM blogg WHERE id=$id");
  $Title = mysqli_fetch_assoc($queryTitle);
  $title = $Title["title"];
  
  $queryContent = mysqli_query($conn, "SELECT content FROM blogg WHERE id=$id");
  $Content = mysqli_fetch_assoc($queryContent);
  $content = $Content["content"];
}

?>


<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="global.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title><?= $title ?></title>
</head>
<body style="padding: 15px;">
  
  <!-- BAGIAN CARD ARTIKEL -->
  <div class="head card shadow" style="padding: 10px;">
    <img src="image/<?= $title; ?>.png" style="width:100%;" class="card-img-top" alt="...">
    <h1 style="margin-top: 30px;opacity: 0.9;"><?= $title ?></h1>
    <b style="opacity: 0.4;font-size:0.3em;margin-left:5px;">22-10-23</b>
    <hr>
    <div style="opacity: 0.8;font-size:0.8em;"><?= nl2br($content) ?></div>
    <hr>
    <!--
    <div class="admin-dash mt-1 border">
      <div class="container text-center">
        <div class="row align-items-start">
          <div class="col">
            <i class="fa fa-thumbs-o-up" aria-hidden="true"></i><br>
          </div>
          <div class="col">
            <i class="fa fa-thumbs-o-down" aria-hidden="true"></i><br>
          </div>
        </div>
      </div>
    </div>
    -->
  </div>
  <!-- AKHIR DARI BAGIAN CARD ARTIKEL -->
  
  <!-- BAGIAN FOOTER -->
    <div class="footer-container">
      <div class="container">
        <footer class="py-3 my-4">
          <ul class="nav justify-content-center border-bottom pb-3 mb-3">
            <li class="nav-item"><a href="info.php?info=1" class="nav-link px-2 text-muted">FAQs</a></li>
            <li class="nav-item"><a href="info.php?info=2" class="nav-link px-2 text-muted">About</a></li>
            <li class="nav-item"><a href="info.php?info=3" class="nav-link px-2 text-muted">Kebijakan privasi</a></li>
          </ul>
          <p class="text-center text-muted">© 2022 Faqriansyah, V.1.5</p>
        </footer>
      </div>
    </div>
    <!-- AKHIR DARI BAGIAN FOOTER -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    
</body>
</html>