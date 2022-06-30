<?php include '../includes/config.php';

$page = 'users';

if (!isset($_SESSION['id'])) {
   header('Location: ../index.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <title>Manage Users</title>
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
                     <h1 class="m-0" style="color: rgb(31,108,163);"><span class="fa fa-user-lock"></span> Manage Users</h1>
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-6">
                     <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Users</li>
                     </ol>
                  </div>
                  <div class="col-12 mt-3">
                     <a href="add-user.php" class="btn btn-info">Add New</a>
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

            <?php if (isset($_SESSION['add-user-success'])) : ?>
               <h5 id="alert" class="alert alert-success"><?php echo $_SESSION['add-user-success']; ?></h5>
            <?php
               unset($_SESSION['add-user-success']);
            endif;
            ?>
            <?php if (isset($_SESSION['user-not-found'])) : ?>
               <h5 id="alert" class="alert alert-warning"><?php echo $_SESSION['user-not-found']; ?></h5>
            <?php
               unset($_SESSION['user-not-found']);
            endif;
            ?>
            <?php if (isset($_SESSION['delete-user-success'])) : ?>
               <h5 id="alert" class="alert alert-success"><?php echo $_SESSION['delete-user-success']; ?></h5>
            <?php
               unset($_SESSION['delete-user-success']);
            endif;
            ?>
            <?php if (isset($_SESSION['delete-user-failed'])) : ?>
               <h5 id="alert" class="alert alert-danger"><?php echo $_SESSION['delete-user-failed']; ?></h5>
            <?php
               unset($_SESSION['delete-user-failed']);
            endif;
            ?>

            <div class="container-fluid">
               <div class="card card-info">
                  <div class="col-md-12">
                     <table id="example1" class="table table-bordered table-hover">
                        <thead>
                           <tr>
                              <th>#</th>
                              <th>Users info</th>
                              <th>Account Category</th>
                              <th>Account Status</th>
                              <th class="text-right">Action</th>
                           </tr>
                        </thead>
                        <tbody>
                           <?php

                           $query = "SELECT * FROM users";
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
                                       <p class="info">Name: <b><?php echo $row->full_name; ?></b></p>
                                       <p class="info"><small>Designation: <b><?php echo $row->designation; ?></b></small></p>
                                       <p class="info"><small>Contact: <b><?php echo $row->contact_number; ?></b></small></p>
                                    </td>
                                    <td><?php echo $row->account_category; ?></td>
                                    <?php if ($row->status == '1') : ?>
                                       <td><span class="badge bg-success">Active</span></td>
                                    <?php else : ?>
                                       <td><span class="badge bg-danger">Inactive</span></td>
                                    <?php endif; ?>
                                    <td class="text-right">
                                       <a class="btn btn-sm btn-success" href="edit-user.php?edit_id=<?php echo $row->id; ?>"><i class="fa fa-edit"></i> Edit</a>
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
                  <form action="../includes/actions.php" method="post" id="delete_user_form">
                     <input type="hidden" name="id">
                     <a href="#" class="btn btn-dark" data-dismiss="modal">Close</a>
                     <button type="submit" name="delete_user" form="delete_user_form" class="btn btn-danger">Delete</button>
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

      document.getElementById("delete_user_form").id.value = id;
      $("#delete").modal("show");
   }
</script>