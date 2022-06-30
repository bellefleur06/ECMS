<?php include '../includes/config.php';

$page = 'evacuee';

if (!isset($_SESSION['id'])) {
   header('Location: ../index.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <title>Manage Evacuees</title>
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
                     <h1 class="m-0" style="color: rgb(31,108,163);"><span class="fa fa-address-card"></span> Manage Evacuees</h1>
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-6">
                     <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Evacuees</li>
                     </ol>
                  </div>
                  <div class="col-12 mt-3">
                     <a href="add-evacuees.php" class="btn btn-info">Add New</a>
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

            <?php if (isset($_SESSION['add-evacuee-success'])) : ?>
               <h5 id="alert" class="alert alert-success"><?php echo $_SESSION['add-evacuee-success']; ?></h5>
            <?php
               unset($_SESSION['add-evacuee-success']);
            endif;
            ?>
            <?php if (isset($_SESSION['evacuee-not-found'])) : ?>
               <h5 id="alert" class="alert alert-warning"><?php echo $_SESSION['evacuee-not-found']; ?></h5>
            <?php
               unset($_SESSION['evacuee-not-found']);
            endif;
            ?>
            <?php if (isset($_SESSION['delete-evacuee-success'])) : ?>
               <h5 id="alert" class="alert alert-success"><?php echo $_SESSION['delete-evacuee-success']; ?></h5>
            <?php
               unset($_SESSION['delete-evacuee-success']);
            endif;
            ?>
            <?php if (isset($_SESSION['delete-evacuee-failed'])) : ?>
               <h5 id="alert" class="alert alert-danger"><?php echo $_SESSION['delete-evacuee-failed']; ?></h5>
            <?php
               unset($_SESSION['delete-evacuee-failed']);
            endif;
            ?>

            <div class="container-fluid">
               <div class="card card-info">
                  <div class="col-md-12">
                     <table id="example1" class="table table-bordered table-striped">
                        <thead>
                           <tr>
                              <th>#</th>
                              <th>Evacuees info</th>
                              <th>Barangay</th>
                              <th>Address</th>
                              <th>Head of Family</th>
                              <th>Evacuation Center</th>
                              <th class="text-right">Action</th>
                           </tr>
                        </thead>
                        <tbody>
                           <?php

                           $query = "SELECT * FROM evacuation_centers, barangays, evacuees WHERE evacuation_center_id = evacuation_centers.id AND barangay_id = barangays.id";
                           $statement = $conn->prepare($query);
                           $statement->execute();
                           $statement->setFetchMode(PDO::FETCH_OBJ);
                           $result = $statement->fetchAll();

                           if ($result) {

                              foreach ($result as $row) {

                           ?>
                                 <tr>
                                    <td><?php echo $row->id; ?></td>
                                    <td>
                                       <p class="info">Name: <b><?php echo $row->first_name . " " . $row->last_name; ?></b></p>
                                       <p class="info"><small>Age: <b><?php echo $row->age; ?></b></small></p>
                                       <p class="info"><small>Gender: <b><?php echo $row->gender; ?></b></small></p>
                                       <p class="info"><small>Contact No.: <b><?php echo $row->contact_number; ?></b></small></p>
                                    </td>
                                    <td><?php echo $row->barangay; ?></td>
                                    <td><b><?php echo $row->address; ?></b></td>
                                    <td><?php echo $row->family_head; ?></td>
                                    <td><?php echo $row->center_name; ?></td>
                                    <td class="text-right">
                                       <a class="btn btn-sm btn-success" href="edit-evacuees.php?edit_id=<?php echo $row->id; ?>"><i class="fa fa-edit"></i> Edit</a>
                                       <a class="btn btn-sm btn-danger" data-id="<?php echo $row->id; ?>" onclick="confirmDelete(this);"><i class="fa fa-trash-alt"></i> Delete</a>
                                    </td>
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

            <!-- /.container-fluid -->
         </section>
         <!-- /.content -->
      </div>
      <!-- /.content-wrapper -->
   </div>
   <!-- ./wrapper -->
   <div id="delete" class="modal animated rubberBand delete-modal" role="dialog">
      <div class="modal-dialog modal-dialog-centered">
         <div class="modal-content">
            <div class="modal-body text-center">
               <img src="../asset/img/sent.png" alt="" width="50" height="46">
               <h3>Are you sure want to delete this record?</h3>
               <div class="m-t-20">
                  <form action="../includes/actions.php" method="post" id="delete_evacuee_form">
                     <input type="hidden" name="id">
                     <a href="#" class="btn btn-dark" data-dismiss="modal">Close</a>
                     <button type="submit" name="delete_evacuee" form="delete_evacuee_form" class="btn btn-danger">Delete</button>
                  </form>
               </div>
            </div>
         </div>
      </div>
   </div>
   <!-- jQuery -->
   <script src="../asset/jquery/jquery.min.js"></script>
   <script src="../asset/js/bootstrap.bundle.min.js"></script>
   <script src="../asset/js/adminlte.js"></script>
   <!-- DataTables  & Plugins -->
   <script src="../asset/tables/datatables/jquery.dataTables.min.js"></script>
   <script src="../asset/tables/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
   <script src="../asset/tables/datatables-responsive/js/responsive.bootstrap4.min.js"></script>s
   <script src="../asset/tables/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
   <script>
      $(function() {
         $("#example1").DataTable({
            "sScrollX": "100%",
            "sScrollXInner": "100%",
            "bScrollCollapse": true
         });
      });
   </script>
</body>

</html>

<script>
   setTimeout(function() {
      document.getElementById("alert").style.display = "none";
   }, 3000);
</script>

<script>
   function confirmDelete(self) {
      var id = self.getAttribute("data-id");

      document.getElementById("delete_evacuee_form").id.value = id;
      $("#delete").modal("show");
   }
</script>