<?php include '../includes/config.php';

$page = 'dashboard';

if (!isset($_SESSION['id'])) {
   header('Location: ../index.php');
}

$id = $_SESSION['id'];

$query = "SELECT * FROM users WHERE id=:usr_id";
$statement = $conn->prepare($query);
$data = [':usr_id' => $id];

$statement->execute($data);
$results = $statement->fetch();

$_SESSION['account_category'] = $results['account_category'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <title>Dashboard</title>
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
                  <div class="col-sm-6">
                     <h1 class="m-0" style="color: rgb(31,108,163);"><span class="fa fa-tachometer-alt"></span> Dashboard</h1>
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-6">
                     <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
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
            <div class="container-fluid">
               <!-- Small boxes (Stat box) -->
               <div class="row">
                  <div class="col-12 col-sm-6 col-md-6">
                     <a href="manage-evacuees.php" style="color:#212529">
                        <div class="info-box">
                           <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>
                           <div class="info-box-content">
                              <span class="info-box-text">Families</span>
                              <?php $count = $conn->query("SELECT count(*) FROM evacuees")->fetchColumn(); ?>
                              <span class="info-box-number"><?php echo $count; ?></span>
                           </div>
                           <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                     </a>
                  </div>

                  <div class="col-12 col-sm-6 col-md-6">
                     <a href="manage-evacuees.php" style="color:#212529">
                        <div class="info-box">
                           <span class="info-box-icon bg-info elevation-1"><i class="fas fa-user"></i></span>

                           <div class="info-box-content">
                              <span class="info-box-text">Evacuees</span>
                              <?php $count = $conn->query("SELECT count(*) FROM evacuees")->fetchColumn(); ?>
                              <span class="info-box-number"><?php echo $count; ?></span>
                           </div>
                           <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                     </a>
                  </div>
                  <!-- /.col -->

                  <div class="col-12 col-sm-6 col-md-6">
                     <a href="gender-report.php" style="color:#212529">
                        <div class="info-box mb-3">
                           <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-venus"></i></span>

                           <div class="info-box-content">
                              <span class="info-box-text">Females</span>
                              <?php $count = $conn->query("SELECT count(*) FROM evacuees WHERE gender = 'Female'")->fetchColumn(); ?>
                              <span class="info-box-number"><?php echo $count; ?></span>
                           </div>
                           <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                     </a>
                  </div>
                  <!-- /.col -->

                  <!-- fix for small devices only -->
                  <div class="clearfix hidden-md-up"></div>

                  <div class="col-12 col-sm-6 col-md-6">
                     <a href="gender-report.php" style="color:#212529">
                        <div class="info-box mb-3">
                           <span class="info-box-icon bg-success elevation-1"><i class="fas fa-mars"></i></span>

                           <div class="info-box-content">
                              <span class="info-box-text">Males</span>
                              <?php $count = $conn->query("SELECT count(*) FROM evacuees WHERE gender = 'Male'")->fetchColumn(); ?>
                              <span class="info-box-number"><?php echo $count; ?></span>
                           </div>
                           <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                     </a>
                  </div>
                  <!-- fix for small devices only -->
                  <div class="clearfix hidden-md-up"></div>

                  <div class="col-12 col-sm-6 col-md-6">
                     <a href="barangay.php" style="color:#212529">
                        <div class="info-box mb-3">
                           <span class="info-box-icon bg-info elevation-1"><i class="fas fa-university"></i></span>

                           <div class="info-box-content">
                              <span class="info-box-text">Barangays</span>
                              <?php $count = $conn->query("SELECT count(*) FROM barangays")->fetchColumn(); ?>
                              <span class="info-box-number"><?php echo $count; ?></span>
                           </div>
                           <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                     </a>
                  </div>
                  <!-- fix for small devices only -->
                  <div class="clearfix hidden-md-up"></div>

                  <div class="col-12 col-sm-6 col-md-6">
                     <a href="evacuation-center.php" style="color:#212529">
                        <div class="info-box mb-3">
                           <span class="info-box-icon bg-indigo elevation-1"><i class="fas fa-hotel"></i></span>

                           <div class="info-box-content">
                              <span class="info-box-text">Evacuation Centers</span>
                              <?php $count = $conn->query("SELECT count(*) FROM evacuation_centers")->fetchColumn(); ?>
                              <span class="info-box-number"><?php echo $count; ?></span>
                           </div>
                           <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                     </a>
                  </div>
               </div>
            </div>
            <!-- /.row -->
            <!-- /.row (main row) -->
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