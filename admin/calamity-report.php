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
                     <h1 class="m-0" style="color: rgb(31,108,163);"><span class="fa fa-chart-pie"></span> Reports by Calamity</h1>
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
                           <table class="table table-hver custom-table mb-0 datatable">
                              <thead>
                                 <tr>
                                    <th>Calamity</th>
                                    <th>No. of Affected Citizen</th>
                                 </tr>
                              </thead>
                              <tbody>
                                 <?php

                                 $query = "SELECT calamity_type, calamity_type_id, COUNT(*) as total_count FROM calamity_types , evacuees WHERE calamity_types.id = evacuees.calamity_type_id GROUP BY evacuees.calamity_type_id";
                                 $statement = $conn->prepare($query);
                                 $statement->execute();
                                 $statement->setFetchMode(PDO::FETCH_OBJ);
                                 $result = $statement->fetchAll();

                                 if ($result) {

                                    foreach ($result as $row) {

                                 ?>

                                       <tr>
                                          <td><?php echo $row->calamity_type; ?></td>
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
                           <div class="chart chart-lg">
                              <canvas id="chartjs-pie"></canvas>
                           </div>
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
   <script>
      document.addEventListener("DOMContentLoaded", function() {
         // Pie chart
         new Chart(document.getElementById("chartjs-pie"), {
            type: "pie",
            data: {
               labels: ["Flood", "Typhoon", "Earthquake"],
               datasets: [{
                  data: [25, 50, 25],
                  backgroundColor: [
                     window.theme.primary,
                     window.theme.danger,
                     window.theme.warning,
                  ],
                  borderColor: "transparent"
               }]
            },
            options: {
               maintainAspectRatio: true,
               legend: {
                  display: true,
               }
            }
         });

      });
   </script>
</body>

</html>