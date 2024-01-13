<?php 
$title = $_POST['title'];
$content = $_POST['content'];
$title = $_POST['title'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>preview : <?= $title ?> </title>
  <link rel="stylesheet" href="global.css">
  <link rel="stylesheet" href="bt/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
 <?php if(isset($_POST))  { ?>
  <!-- BAGIAN BADAN PREVIEW -->
  <div class="head card shadow" style="padding: 10px;">
    <h1 style="margin-top: 30px;opacity: 0.9;"><?= $title ?></h1>
    <b style="opacity: 0.4;font-size:0.3em;margin-left:5px;">${ tgl }</b>
    <hr>
    <div style="opacity: 0.8;font-size:0.8em;"><?= nl2br($content) ?></div>
    <hr>
  <!-- BAGIAN BADAN PREVIEW -->
  </div>
  <?php } ?>
</body>
</html>