<?php 
require "connect.php";

if (isset($_GET['sendMes'])) {
  $name = $_GET['name'];
  $email = $_GET['email'];
  $message = $_GET['message'];
  
  $mesQuery = mysqli_query($conn, "INSERT INTO contact (name, email, message) VALUES ( '$name', '$email', '$message')");
  
  if ($mesQuery) {
    echo "<script>alert('pesan berhasil dikirim, akan dibalas melalui email')</script>";
    unset($_GET['sendMes']);
  } else {
    echo "<script>alert('ada yang salah coba lagi nanti')</script>";
  }
  header("Location : index.php");
}

?>


<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="rgba(88, 85, 245, 1)">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="global.css">
    <title>Kodeteria | Home</title>
</head>
<body>
    <!-- BAGIAN HERO -->
    <div class="px-4 py-5 my-5 text-center">

    <img class="d-block mx-auto mb-4" src="hero.png" alt="" width="250" height="200">

      <h1 class="display-5 fw-bold">KODETERIA</h1>
      <div class="col-lg-6 mx-auto">
        <p class="lead mb-4">Ini website blog, baca aja dijamin nambah ilmunya😂</p>
        <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
        <a href="#startRead" type="button" class="btn btn-primary btn-lg px-4 gap-3 primary" style="border: none;">Mulai baca!</a>
        <button class="btn btn-outline-secondary btn-lg px-4" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample" style="border: none;">Kontak kami</button>
      </div>
    </div>
    </div>
    <!-- AKHIR DARI BAGIAN HERO -->
    
    <!-- BAGIAN ARTIKEL -->
    <style>
    @media screen and (min-width: 1024px) {
        .card-wrapper {
            padding: 100px;   
        }
    }
        
    </style>
    <div id="startRead"></div>
    <h1 class="text-center">Baca Artikel</h1>
    <div class="category" style="margin-top: 70px;">
        <?php 
          $query = mysqli_query($conn, "SELECT * FROM blogg");
          while($x = mysqli_fetch_assoc($query)) {
        ?>
      <div class="card-wrapper" style="padding: 20px;margin-top:10px;">
        <div class="card shadow-sm">
          <img src="image/<?= $x['title']; ?>.png" style="width:100%;" class="card-img-top" alt="...">
          <div class="card-body">
            <b style="opacity: 0.4;font-size:0.3em;margin-top:0;"><?= $x['created'] ?></b>
            <h5 class="card-title"><b><?= $x['title'] ?></b></h5>
            <p class="card-text" style="opacity: 0.8;font-size:0.8em;"><?= $x['description'] ?></p>
            <a href="touch.php?id=<?= $x['id'] ?>" class="btn primary" style="border: none;">BACA</a>
          </div>
        </div>
      </div>
      <?php } ?>
    </div>
    <!-- AKHIR DARI BAGIAN ARTIKEL -->
    
    <!-- BAGIAN KONTAK-->
    <div class="contact-container">
      <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
        <div class="offcanvas-header primary shadow">
          <h5 class="offcanvas-title" id="offcanvasExampleLabel">HUBUNGI SAYA</h5>
          <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close" ></button>
        </div>
        <div class="offcanvas-body">
          <form action="" style="padding: 10px">
            <div class="form-floating mb-3">
              <input type="text" class="form-control" id="emaill" placeholder="name@example.com" name="name">
              <label for="emaill">Nama anda</label>
            </div>
            <div class="form-floating mb-3">
              <input type="email" class="form-control" id="emaill" placeholder="name@example.com" name="email">
              <label for="emaill">Email anda</label>
            </div>
            <div class="form-floating mb-3">
              <textarea class="form-control" id="message" rows="3" style="height: 300px;" name="message"></textarea>
              <label for="message" class="form-label">Pesan yang ingin dikirim</label>
            </div>
            <input type="submit" name="sendMes" id="sendMes" value="KIRIM!" class="btn primary" />
          </form>
        </div>
      </div>
    </div>
    <!-- AKHIR DARI BAGIAN KONTAK-->
    
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
    <script>
        history.pushState({}, "", "index.php");
    </script>
</body>
</html>