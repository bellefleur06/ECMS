<?php include '../includes/config.php';

$page = 'barangay';

if (!isset($_SESSION['id'])) {
   header('Location: ../index.php');
}

$edit = false;

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <title>Barangays</title>
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
                     <h1 class="m-0" style="color: rgb(31,108,163);"><span class="fa fa-university"></span> Barangay Information</h1>
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-6">
                     <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                        <li class="breadcrumb-item active">Barangay Information</li>
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

            <?php if (isset($_SESSION['add-barangay-success'])) : ?>
               <h5 id="alert" class="alert alert-success"><?php echo $_SESSION['add-barangay-success']; ?></h5>
            <?php
               unset($_SESSION['add-barangay-success']);
            endif;
            ?>
            <?php if (isset($_SESSION['add-barangay-failed'])) : ?>
               <h5 id="alert" class="alert alert-danger"><?php echo $_SESSION['add-barangay-failed']; ?></h5>
            <?php
               unset($_SESSION['add-barangay-failed']);
            endif;
            ?>
            <?php if (isset($_SESSION['edit-barangay-success'])) : ?>
               <h5 id="alert" class="alert alert-success"><?php echo $_SESSION['edit-barangay-success']; ?></h5>
            <?php
               unset($_SESSION['edit-barangay-success']);
            endif;
            ?>
            <?php if (isset($_SESSION['edit-barangay-failed'])) : ?>
               <h5 id="alert" class="alert alert-danger"><?php echo $_SESSION['edit-barangay-failed']; ?></h5>
            <?php
               unset($_SESSION['edit-barangay-failed']);
            endif;
            ?>
            <?php if (isset($_SESSION['delete-barangay-success'])) : ?>
               <h5 id="alert" class="alert alert-success"><?php echo $_SESSION['delete-barangay-success']; ?></h5>
            <?php
               unset($_SESSION['delete-barangay-success']);
            endif;
            ?>
            <?php if (isset($_SESSION['delete-barangay-failed'])) : ?>
               <h5 id="alert" class="alert alert-danger"><?php echo $_SESSION['delete-barangay-failed']; ?></h5>
            <?php
               unset($_SESSION['delete-barangay-failed']);
            endif;
            ?>

            <?php

            // edit button

            if (isset($_GET['edit_id'])) {

               $barangay_id = $_GET['edit_id'];
               $edit = true;

               $query = "SELECT * FROM barangays WHERE id=:brgy_id LIMIT 1";
               $statement = $conn->prepare($query);
               $data = [':brgy_id' => $barangay_id];
               $statement->execute($data);

               $results = $statement->fetch(PDO::FETCH_OBJ);
            }

            ?>

            <div class="container-fluid">
               <div class="card card-info">
                  <!-- form start -->
                  <form action="../includes/actions.php" method="post">
                     <div class="card-body">
                        <div class="row">
                           <div class="col-md-3">
                              <div class="card-header">
                                 <span class="fa fa-university"> Barangay Information</span>
                              </div>
                              <div class="row">
                                 <div class="col-md-12">
                                    <div class="form-group">
                                       <br>
                                       <label>Barangay Name</label>
                                       <?php if ($edit == true) : ?>
                                          <input type="hidden" name="id" value="<?php echo $results->id; ?>">
                                       <?php endif ?>
                                       <input type="text" name="barangay" class="form-control" autocomplete="off" required <?php if ($edit == true) : ?> value="<?php echo $results->barangay; ?>" <?php endif ?>>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-md-12">
                                 <?php if ($edit == true) : ?>
                                    <button type="submit" name="edit_barangay" class="btn btn-primary">Update</button>
                                 <?php else : ?>
                                    <button type="submit" name="add_barangay" class="btn btn-primary">Save</button>
                                 <?php endif ?>
                                 <a href="barangay.php" class="btn btn-danger">Cancel</a>
                              </div>
                  </form>
               </div>

               <div class="col-md-9" style="border-left: 1px solid #ddd;">
                  <table id="example1" class="table table-bordered table-hover">
                     <thead>
                        <tr>
                           <th>Barangay Name</th>
                           <th class="text-right">Action</th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php

                        $query = "SELECT * FROM barangays";
                        $statment = $conn->prepare($query);
                        $statment->execute();
                        $statment->setFetchMode(PDO::FETCH_OBJ);
                        $result = $statment->fetchAll();

                        if ($result) {

                           foreach ($result as $row) {

                        ?>
                              <tr>
                                 <td><?php echo $row->barangay; ?></td>
                                 <td class="text-right">
                                    <a class="btn btn-sm btn-success" href="barangay.php?edit_id=<?php echo $row->id; ?>"><i class="fa fa-edit"></i> Edit</a>
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

   </div>
   <!-- /.card-body -->
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
                  <form action="../includes/actions.php" method="post" id="delete_barangay_form">
                     <input type="hidden" name="id">
                     <a href="#" class="btn btn-dark" data-dismiss="modal">Close</a>
                     <button type="submit" name="delete_barangay" form="delete_barangay_form" class="btn btn-danger">Delete</button>
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
         $("#example1").DataTable();
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

      document.getElementById("delete_barangay_form").id.value = id;
      $("#delete").modal("show");
   }
</script>