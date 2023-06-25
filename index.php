<?php
session_start();
$namayanglogin=$_SESSION['namayanglogin'];
if(empty($_SESSION['namayanglogin'])){
  header('location:login.php');
}


function ribuan ($nilai){
  return number_format ($nilai, 0, ',', '.');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link href="img/logo/logohp.png" rel="icon">
  <title>Penjualan HP SBD</title>
  <?php include('css/css.php'); ?>
</head>

<body id="page-top">
  <div id="wrapper">
    <?php include('view/index/menu.php'); ?>
    <div id="content-wrapper" class="d-flex flex-column">
      <div id="content">
        <?php include('view/index/header.php'); ?>
       <!---Container Fluid-->
        <?php include('view/halaman.php'); ?>
      </div>
    </div>
    <?php include('view/index/footer.php'); ?>
  </div>
  </div>

  
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>
<!-- Javascript nya -->
  <?php include('js/js.php'); ?>
</body>

</html>