<?php include '../includes/config.php';

$page = 'reports';

if (!isset($_SESSION['id'])) {
   header('Location: ../index.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <title>Evacuation Center Management System</title>
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
                     <h1 class="m-0" style="color: rgb(31,108,163);"><span class="fa fa-chart-pie"></span> Reports by Age Bracket</h1>
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-6">
                     <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Reports</li>
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
               <div class="row">
                  <div class="col-12 col-md-4 col-lg-4 col-xl-4">
                     <div class="card">
                        <div class="card-body">
                           <table class="table table-bordered mytable">
                              <thead>
                                 <tr>
                                    <th>Age Bracket</th>
                                    <th>Number</th>
                                 </tr>
                              </thead>
                              <tbody>
                                 <?php

                                 $query = "SELECT 
                                          CASE WHEN age <= 5 THEN '00 to 05'
                                             WHEN age <= 10 THEN '06 to 10'
                                             WHEN age <= 20 THEN '11 to 20'
                                             WHEN age <= 30 THEN '21 to 30'
                                             WHEN age <= 40 THEN '31 to 40'
                                             WHEN age <= 50 THEN '41 to 50'
                                             WHEN age <= 60 THEN '51 to 60'
                                             WHEN age <= 100 THEN '60 up' END AS age_range, COUNT(*) total_count FROM evacuees GROUP BY age_range";
                                 $statement = $conn->prepare($query);
                                 $statement->execute();
                                 $statement->setFetchMode(PDO::FETCH_OBJ);
                                 $result = $statement->fetchAll();

                                 if ($result) {

                                    foreach ($result as $row) {

                                 ?>
                                       <tr>
                                          <td><?php echo $row->age_range; ?></td>
                                          <td><?php echo $row->total_count; ?></td>
                                       </tr>
                                 <?php
                                    }
                                 }
                                 ?>
                              </tbody>
                           </table>
                        </div>
                     </div>
                  </div>
                  <div class="col-12 col-md-8 col-lg-8 col-xl-8">
                     <div class="card">
                        <div class="card-body">
                           <canvas id="bargraph"></canvas>
                        </div>
                     </div>
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
   <script src="../asset/js/chart.js"></script>

   <?php

   $query = "SELECT 
            CASE WHEN age <= 5 THEN '00 to 05'
               WHEN age <= 10 THEN '06 to 10'
               WHEN age <= 20 THEN '11 to 20'
               WHEN age <= 30 THEN '21 to 30'
               WHEN age <= 40 THEN '31 to 40'
               WHEN age <= 50 THEN '41 to 50'
               WHEN age <= 60 THEN '51 to 60'
               WHEN age <= 100 THEN '60 up' END AS age_range, COUNT(*) total_count FROM evacuees GROUP BY age_range";
   $statement = $conn->prepare($query);
   $statement->execute();

   foreach ($statement as $data) {

      $age_range[] = $data['age_range'];
      $total_count[] = $data['total_count'];
   }

   ?>

   <script>
      document.addEventListener("DOMContentLoaded", function() {

         // Bar Chart

         var barChartData = {
            labels: <?php echo json_encode($age_range); ?>,
            datasets: [{
               label: 'Evacuees',
               backgroundColor: 'rgb(79,129,189)',
               borderColor: 'rgba(0, 158, 251, 1)',
               borderWidth: 1,
               data: <?php echo json_encode($total_count); ?>,
            }]
         };

         var ctx = document.getElementById('bargraph').getContext('2d');
         window.myBar = new Chart(ctx, {
            type: 'bar',
            data: barChartData,
            options: {
               responsive: true,
               legend: {
                  display: false,
               }
            }
         });

      });
   </script>
</body>

</html>