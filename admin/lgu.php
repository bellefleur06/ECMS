<?php include '../includes/config.php';

$page = 'lgu';

if (!isset($_SESSION['id'])) {
   header('Location: ../index.php');
}

$id = $_SESSION['id'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <title>LGU Settings</title>
   <!-- Font Awesome -->
   <link rel="stylesheet" href="../asset/fontawesome/css/all.min.css">
   <link rel="stylesheet" href="../asset/css/adminlte.min.css">
   <link rel="stylesheet" href="../asset/css/style.css">
   <style type="text/css">
      td a.btn {
         font-size: 0.7rem;
      }

      td p {
         padding-left: 0.5rem !important;
      }

      th {
         padding: 1rem !important;
      }

      table tr td {
         padding: 0.3rem !important;
         font-size: 13px;
      }
   </style>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
   <div class="wrapper">
      <!-- Navbar -->

      <?php include '../includes/navbar.php'; ?>

      <!-- /.navbar -->
      <!-- Main Sidebar Container -->

      <?php include '../includes/sidebar.php'; ?>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
         <!-- Content Header (Page header) -->
         <div class="content-header">
            <div class="container-fluid">
               <div class="row mb-2">
                  <div class="col-sm-6 animated bounceInRight">
                     <h1 class="m-0" style="color: rgb(31,108,163);"><span class="fa fa-landmark"></span> LGU Settings</h1>
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-6">
                     <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                        <li class="breadcrumb-item active">LGU Settings</li>
                     </ol>
                  </div>
                  <!-- /.col -->
               </div>
               <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
         </div>
         <!-- /.content-header -->
         <!-- Main content -->
         <section class="content">

            <?php if (isset($_SESSION['incorrect-password'])) : ?>
               <h5 id="alert" class="alert alert-warning"><?php echo $_SESSION['incorrect-password']; ?></h5>
            <?php
               unset($_SESSION['incorrect-password']);
            endif;
            ?>
            <?php if (isset($_SESSION['edit-lgu-info-success'])) : ?>
               <h5 id="alert" class="alert alert-success"><?php echo $_SESSION['edit-lgu-info-success']; ?></h5>
            <?php
               unset($_SESSION['edit-lgu-info-success']);
            endif;
            ?>
            <?php if (isset($_SESSION['edit-lgu-info-failed'])) : ?>
               <h5 id="alert" class="alert alert-danger"><?php echo $_SESSION['edit-lgu-info-failed']; ?></h5>
            <?php
               unset($_SESSION['edit-lgu-info-failed']);
            endif;
            ?>

            <?php

            // load info

            $query = "SELECT * FROM lgu_settings";
            $statement = $conn->prepare($query);
            $statement->execute();

            $results = $statement->fetch(PDO::FETCH_OBJ);

            ?>

            <div class="container-fluid">
               <div class="card card-info">
                  <div class="card-header">
                     <h3 class="card-title">LGU Information</h3>
                  </div>
                  <!-- /.card-header -->
                  <!-- form start -->
                  <form action="../includes/actions.php" method="post">
                     <input type="hidden" name="id" value="<?php echo $results->id; ?>">
                     <input type="hidden" name="user_id" value="<?php echo $id; ?>">
                     <div class="card-body">
                        <div class="row">
                           <div class="col-md-12">
                              <div class="row">
                                 <div class="col-md-4">
                                    <div class="form-group">
                                       <label>City</label>
                                       <input type="text" name="city" class="form-control" value="<?php echo $results->city; ?>" placeholder="ex. Pasig" required>
                                    </div>
                                 </div>
                                 <div class="col-md-4">
                                    <div class="form-group">
                                       <label>Contact No.</label>
                                       <input type="number" name="contact_number" class="form-control" value="<?php echo $results->contact_number; ?>" placeholder="ex. 09090898574" required>
                                    </div>
                                 </div>
                                 <div class="col-md-4">
                                    <div class="form-group">
                                       <label>Email Address</label>
                                       <input type="email" name="email_address" class="form-control" value="<?php echo $results->email_address; ?>" placeholder="ex. email.@gmail.com" required>
                                    </div>
                                 </div>
                                 <div class="col-md-4">
                                    <div class="form-group">
                                       <label>Website Name</label>
                                       <input type="text" name="website_name" class="form-control" value="<?php echo $results->website_name; ?>" placeholder="https://website.com/websitename" required>
                                    </div>
                                 </div>
                                 <div class="col-md-4">
                                    <div class="form-group">
                                       <label>Facebook Page Name</label>
                                       <input type="text" name="facebook_page" class="form-control" value="<?php echo $results->facebook_page; ?>" placeholder="https://facebook.com/fbpagename" required>
                                    </div>
                                 </div>
                                 <div class="col-md-4">
                                    <div class="form-group">
                                       <label>Password</label>
                                       <input type="password" name="password" class="form-control" placeholder="Enter Password To Save Changes" required>
                                    </div>
                                 </div>

                              </div>
                           </div>
                        </div>

                     </div>
                     <!-- /.card-body -->
                     <div class="card-footer">
                        <button type="submit" name="edit_lgu_info" class="btn btn-primary">Save</button>
                     </div>
                  </form>
               </div>
            </div>
            <!-- /.container-fluid -->
         </section>
         <!-- /.content -->
      </div>
      <!-- /.content-wrapper -->
   </div>
   <!-- ./wrapper -->
   <!-- jQuery -->
   <script src="../asset/jquery/jquery.min.js"></script>
   <script src="../asset/js/adminlte.js"></script>

</body>

</html>