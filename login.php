<?php
include('koneksi.php');
include('models/proses_login.php');
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
  <br><br><br><br>
  <title>Penjualan HP SBD</title>
  <?php include('css/css.php'); ?>
</head>


<body class="bg-gradient-login">
  <!-- Login Content -->
  <div class="container-login">
    <div class="row justify-content-center">
      <div class="col-xl-6 col-lg-12 col-md-9">
        <div class="card shadow-sm my-5">
          <div class="card-body p-0">
            <div class="row">
              <div class="col-lg-12">
                <div class="login-form">
                <div class="text-center">
            <img src="img/logologin.svg" style="max-height: 105px">
            <br><br><br>
          </div>
          <?php if (isset($error_message)) { ?>
            <div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                    Username atau password salah!
                  </div>
    <?php } ?>
                  <form method="POST" class="user">
                    <div class="form-group">
                      <input type="email" class="form-control" name="username" id="username" aria-describedby="emailHelp"
                        placeholder="Enter Email Address" required >
                    </div>
                    <div class="form-group">
                      <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
                    </div>
                    <div class="form-group">
                    </div>
                    <div class="form-group">
                    <input type="submit" class="btn btn-primary btn-block" name="submit" value="Login" id="toast-success">
                    </div>                    
                  </form>
                  <div class="text-center">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Login Content -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="js/ruang-admin.min.js"></script>
</body>

</html>
</html>