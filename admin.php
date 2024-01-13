<?php 
require "connect.php";
// MENTOTALKAN JUMLAH ARTIJEL

$activeArticle = 0;
$query = mysqli_query($conn, "SELECT * FROM blogg");
while($x = mysqli_fetch_assoc($query)) {
  $activeArticle++;
}

//AKHIR DAR MENTOTALKAN JUMLAH ARTIKEL



// AKHIR DARI DEKLARASI FUNGSI
?>

<?php 

// MEMPROSES AKSI MASUKKAN DATA KE DB
if (isset($_POST["insert"])) {
    $title = $_POST["title"];
    $content = $_POST["content"];
    $description = $_POST["description"];
    
    $name = $_FILES['image']['name'];
    $tmp_name = $_FILES['image']['tmp_name'];
    
    $target = "image/";
    
    $final = $target.$title.".png";
    
    $upload = move_uploaded_file($tmp_name, $final);
    
    $insertQuery = mysqli_query($conn, "INSERT INTO blogg (title, content, description) VALUES ('$title', '$content', '$description')");
    
    if (!$insertQuery) {
      echo "<script>alert('upload gagal')</script>";
      echo "<script><?= $insertQuery ?></script>";
    } else {
      echo "<script>alert('upload berhasil')</script>";
    }
} else if(isset($_GET['delid'])) {
  $id = $_GET['delid'];
  $deleteQuery = mysqli_query($conn, "DELETE FROM blogg WHERE id =$id");
} else if(isset($_POST["updateQ"])) {
  $id = $_POST['id'];
  $title = $_POST["title"];
  $content = $_POST["content"];
  $description = $_POST["description"];
  
  $updateQuery = mysqli_query($conn, "UPDATE blogg SET title='$title', content='$content' WHERE id=$id");
} else if (isset($_POST['preview'])) {
  $title = $_POST["title"];
  $content = $_POST["content"];
  $description = $_POST["description"];
  
  echo "
    <form action='preview.php' id='previewForm' method='POST'>
      <input type='hidden' value='{$_POST['title']}' name='title'>
      <input type='hidden' value='{$_POST['content']}' name='content'>
      <input type='hidden' value='{$_POST['description']}' name='description'>
      <button type='submit' id='previewSubmit'></button>
    </form>
    <script>
      document.getElementById('previewForm').submit();
    </script>
  ";
}
// AKHIR DARI MEMPROSES AKSI MASUKKAN DATA KE DB

?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="global.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>ADMIN ONLY</title>
</head>
<body>
<body>
    <header class="blog-header" style="padding: 7px;">
        <h2 class="blog-title text-center primary shadow" style="padding:5px;border-radius:7px;"><b>WELCOME ADMIN</b></h2>
    </header>
    
    <div class="card shadow" style="margin:5px;padding:5px;">
    <!-- KETIKA ADA UPDATE -->
    <?php if(isset($_GET["update"])) {
            $id = $_GET["update"];
            $Query = mysqli_query($conn, "SELECT * FROM blogg WHERE id=$id");
            $y = mysqli_fetch_assoc($Query); ?>
    <form action="" method="post">
      <input type="hidden" name="id" value="<?= $y['id'] ?>">
      <div style="padding:10px;">
        <div class="form-floating mb-3">
          <input type="text" class="form-control" id="emaill" name="title" value="<?= $y['title'] ?>">
          <label for="emaill">Judul artikel</label>
        </div>
        <div class="input-group input-group-sm mb-3">
          <div class="form-floating mb-3">
              <input type="text" class="form-control" id="descc" placeholder="" name="description" value="<?= $y['description'] ?>">
              <label for="descc">Deskripsi singkat</label>
          </div>
        </div>
        <div class="form-floating mb-3">
          <textarea class="form-control" id="message" rows="3" name="content" style="height: 800px;"><?= $y['content'] ?></textarea>
          <label for="message" class="form-label">Isi konten</label>
        </div>
        <button type="submit" name="updateQ" class="btn btn-success mt-3 shadow" style="width: 70px;"><i class="fa fa-wrench"></i></button>
        <a href="admin.php" class="btn btn-danger shadow"><i class="fa fa-reply"></i></a>
        <button type="submit" name="preview" class="btn btn-secondary shadow"><i class="fa fa-eye"></i></button>
      </div>
    </form>
    <!-- AKHIR DARI KETIKA ADA UPDATE -->
    
    
    <!-- KETIKA TIDAK ADA UPDATE -->
    <?php } else { ?>
      <form action="admin.php" method="post" enctype="multipart/form-data">
      <div style="padding:10px;">
        <div class="input-group input-group-sm mb-3">
          <div class="form-floating mb-3">
              <input type="text" class="form-control" id="title" placeholder="name@example.com" name="title" required>
              <label for="title">Judul artikel</label>
          </div>
        </div>
        <div class="input-group input-group-sm mb-3">
          <div class="form-floating mb-3">
              <input type="text" class="form-control" id="desc" placeholder="" name="description" required>
              <label for="desc">Deskripsi singkat</label>
          </div>
        </div>
        <div class="mb-3">
          <input class="form-control form-control-sm" id="formFileSm" type="file" name="image" value="placeholder.png"required>
        </div>
        <div class="form-floating mb-3">
          <textarea contenteditable="true" class="form-control" id="message" rows="3" style="height: 800px;" name="content" required></textarea>
          <label for="message" class="form-label">Paste konten</label>
        </div>
        <button type="submit" name="insert" class="btn btn-primary mt-3 shadow" style="width: 70px;"><i class="fa fa-paper-plane"></i></button>
        <a href="admin.php" class="btn btn-danger shadow"><i class="fa fa-refresh"></i></a>
        <button type="submit" name="preview" class="btn btn-secondary shadow"><i class="fa fa-eye"></i></button>
      </div>
    </form>
    <?php } ?>
    <!-- AKHIR DARI KETIKA TIDAK ADA UPDATE -->
    </div>
    
    <!-- DASHBOARD STATISTIK -->
    <div class="admin-dash mt-5">
      <div class="container text-center">
        <div class="row align-items-start">
          <div class="col">
            <i class="fa fa-eye" aria-hidden="true"></i><br>
            0
          </div>
          <div class="col">
            <i class="fa fa-newspaper-o" aria-hidden="true"></i><br>
            <?= $activeArticle ?>
          </div>
          <div class="col">
            <i class="fa fa-trash-o" aria-hidden="true"></i><br>
            0
          </div>
        </div>
        <div class="row align-items-start">
          <div class="col">
            <i class="fa fa-thumbs-o-up" aria-hidden="true"></i><br>
            0
          </div>
          <div class="col">
            <i class="fa fa-thumbs-o-down" aria-hidden="true"></i><br>
            0
          </div>
        </div>
      </div>
    </div>
    <!-- AKHIR DARI DASHBOARD STATISTIK -->
    
    <!-- BAGIAN TOMBOL NAVIGASI -->
    <div class="nav-button-container" style="padding:10px;">
      <a href="mes.php" class="btn btn-primary mt-3" style="width:100%;"><i class="fa fa-envelope"></i></a>
      <a href="index.php" class="btn btn-primary mt-3" style="width:100%;"><i class="fa fa-home"></i></a>
      <a href="index.php" class="btn btn-primary mt-3" style="width:100%;"><i class="fa fa-trash"></i></a>
    </div>
    <!-- AKHIR DARI BAGIAN TOMBOL NAVIGASI -->
    
    <!-- LOOPING UNTUK MENAMPILKAN SEMUA ARTIKEL -->
    <h4 style="margin-left: 17px;margin-top: 100px;"></h4>    
    <main>
      <div class="" style="padding:5px;margin:10px;">
      <?php 
        $query = mysqli_query($conn, "SELECT * FROM blogg");
        while($x = mysqli_fetch_assoc($query)) {
      ?>
        <div class="card-wrapper" style="padding: 20px;margin-top:10px;">
        <div class="card shadow">
          <img src="image/<?= $x['title']; ?>.png" style="" class="card-img-top" alt="DISINI SEHARUSNYA THUMBNAIL KAN?">
          <div class="card-body">
            <b style="opacity: 0.4;font-size:0.3em;margin-top:0;"><?= $x['created'] ?></b>
            <h5 class="card-title">
              <b>
                <a href="touch.php?id=<?= $x['id'] ?>" style="color:black;text-decoration:none;">
                  <?= $x['title'] ?>
                </a>
              </b>
            </h5>
            <p class="card-text" style="opacity: 0.8;font-size:0.8em;"><?= $x['description'] ?></p>
            <div style="display:flex">
              <a href="admin.php?update=<?= $x["id"] ?>" style="margin:3px;text-decoration:none;" class="btn btn-success shadow"><i class="fa fa-pencil"></i></a>
              <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delidModal<?= $x['id'] ?>"><i class="fa fa-trash"></i></button>
              <div class="row align-items-center justify-content-center" style="margin-left: 10px;font-size:0.7em">
            </div>
            </div>
          </div>
        </div>
      </div>
    <div class="modal fade" id="delidModal<?= $x['id'] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="staticBackdropLabel">Yakin Ingin Menghapus artikel "<?= $x['title'] ?>"?</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-success shadow" data-bs-dismiss="modal"><i class="fa fa-ban"></i></button>
            <a href="admin.php?delid=<?= $x['id'] ?>" style="margin:3px;text-decoration:none;" class="btn btn-danger shadow"><i class="fa fa-trash-o"></i></a>
            </form>
          </div>
        </div>
      </div>
    </div>
      <?php } ?>
      </div>
    <!-- AKHIR DARI LOOPING UNTUK MENAMPILKAN SEMUA ARTIKEL -->
    
    <!-- BAGIAN MODAL -->
    <!-- AKHIR DARI BAGIAN MODAL -->
    
    </main>
    
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