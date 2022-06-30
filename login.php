<?php include 'includes/config.php';

if (isset($_SESSION['id'])) {
   header('Location: admin/dashboard.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <title>Evacuation Center Management System</title>
   <!-- Google Font: Source Sans Pro -->
   <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
   <!-- Font Awesome -->
   <link rel="stylesheet" href="asset/fontawesome/css/all.min.css">
   <!-- Theme style -->
   <link rel="stylesheet" href="asset/css/adminlte.min.css">
   <!-- Bootstrap -->
   <link rel="stylesheet" href="asset/bootstrap/css/bootstrap.min.css" />
   <script src="asset/bootstrap/js/bootstrap.bundle.min.js"></script>

   <style>
      body::before {
         display: block;
         content: "";
         height: 60px;
      }

      #map {
         width: 100%;
         height: 100%;
         border-radius: 10px;
      }

      @media (min-width: 768px) {
         .news-input {
            width: 50%;
         }
      }
   </style>
</head>

<body class="hold-transition login-page">
   <!-- Navbar -->
   <nav class="navbar navbar-expand-lg bg-dark navbar-dark py-3 fixed-top">
      <div class="container">
         <a href="index.php" class="navbar-brand">ECMS</a>

         <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
            <span class="navbar-toggler-icon"></span>
         </button>

         <div class="collapse navbar-collapse" id="navMenu">
            <ul class="navbar-nav ms-auto">
               <li class="nav-item">
                  <a href="index.php" class="nav-link">HOME</a>
               </li>
            </ul>
         </div>
      </div>
   </nav>



   <div class="login-box">
      <?php if (isset($_SESSION['login-failed'])) : ?>
         <br>
         <h5 id="alert" class="alert alert-danger"><?php echo $_SESSION['login-failed']; ?></h5>
      <?php
         unset($_SESSION['login-failed']);
      endif;
      ?>
      <!-- /.login-logo -->
      <div class="card card-outline card-info">
         <div class="card-header text-center">
            <a href="index.php" class="brand-link">
               <img src="asset/img/logo.png" alt="DSMS Logo" width="200">
            </a>
         </div>
         <div class="card-body">
            <form action="includes/actions.php" method="post">
               <div class="input-group mb-3">
                  <input type="text" name="username" class="form-control" placeholder="Username" autocomplete="off" required>
                  <div class="input-group-append">
                     <div class="input-group-text">
                        <span class="fas fa-user"></span>
                     </div>
                  </div>
               </div>
               <div class="input-group mb-3">
                  <input type="password" name="password" class="form-control" placeholder="Password" autocomplete="off" required>
                  <div class="input-group-append">
                     <div class="input-group-text">
                        <span class="fas fa-lock"></span>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-6 offset-3">
                     <button type="submit" name="login" class="btn btn-block btn-bg" style="background-color: rgb(31,108,163); color:#fff">Sign In</button>
                  </div>
               </div>
            </form>
         </div>
         <!-- /.card-body -->
      </div>
      <!-- /.card -->
   </div>
   <!-- /.login-box -->
</body>

</html>