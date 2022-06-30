<?php include '../includes/config.php';

$page = 'center';

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
                     <h1 class="m-0" style="color: rgb(31,108,163);"><span class="fa fa-hotel"></span> Evacuation Center</h1>
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-6">
                     <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Evacuation <Center></Center>
                        </li>
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

            <?php if (isset($_SESSION['add-evacuation-center-success'])) : ?>
               <h5 id="alert" class="alert alert-success"><?php echo $_SESSION['add-evacuation-center-success']; ?></h5>
            <?php
               unset($_SESSION['add-evacuation-center-success']);
            endif;
            ?>
            <?php if (isset($_SESSION['add-evacuation-center-failed'])) : ?>
               <h5 id="alert" class="alert alert-danger"><?php echo $_SESSION['add-evacuation-center-failed']; ?></h5>
            <?php
               unset($_SESSION['add-evacuation-center-failed']);
            endif;
            ?>
            <?php if (isset($_SESSION['edit-evacuation-center-success'])) : ?>
               <h5 id="alert" class="alert alert-success"><?php echo $_SESSION['edit-evacuation-center-success']; ?></h5>
            <?php
               unset($_SESSION['edit-evacuation-center-success']);
            endif;
            ?>
            <?php if (isset($_SESSION['edit-evacuation-center-failed'])) : ?>
               <h5 id="alert" class="alert alert-danger"><?php echo $_SESSION['edit-evacuation-center-failed']; ?></h5>
            <?php
               unset($_SESSION['edit-evacuation-center-failed']);
            endif;
            ?>
            <?php if (isset($_SESSION['delete-evacuation-center-success'])) : ?>
               <h5 id="alert" class="alert alert-success"><?php echo $_SESSION['delete-evacuation-center-success']; ?></h5>
            <?php
               unset($_SESSION['delete-evacuation-center-success']);
            endif;
            ?>
            <?php if (isset($_SESSION['delete-evacuation-center-failed'])) : ?>
               <h5 id="alert" class="alert alert-danger"><?php echo $_SESSION['delete-evacuation-center-failed']; ?></h5>
            <?php
               unset($_SESSION['delete-evacuation-center-failed']);
            endif;
            ?>

            <?php

            // edit button

            if (isset($_GET['edit_id'])) {

               $evacuation_center_id = $_GET['edit_id'];
               $edit = true;

               $query = "SELECT * FROM evacuation_centers WHERE id=:evcton_cntr_id LIMIT 1";
               $statement = $conn->prepare($query);
               $data = [':evcton_cntr_id' => $evacuation_center_id];
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
                                 <span class="fa fa-hotel"> Evacuation Center Info</span>
                              </div>
                              <div class="row">
                                 <div class="col-md-12">
                                    <div class="form-group">
                                       <br>
                                       <label>Center Name</label>
                                       <?php if ($edit == true) : ?>
                                          <input type="hidden" name="id" value="<?php echo $results->id; ?>">
                                       <?php endif ?>
                                       <input type="text" name="center_name" class="form-control" autocomplete="off" required <?php if ($edit == true) : ?> value="<?php echo $results->center_name; ?>" <?php endif ?>>
                                    </div>
                                 </div>
                                 <div class="col-md-12">
                                    <div class="form-group">
                                       <label>Address</label>
                                       <textarea name="address" class="form-control" autocomplete="off" width="100" required><?php if ($edit == true) : ?><?php echo $results->address; ?><?php endif ?></textarea>
                                    </div>
                                 </div>
                                 <div class="col-md-12">
                                    <div class="form-group">
                                       <label>Contact No.</label>
                                       <input type="number" name="contact_number" min="0" class="form-control" placeholder="ex. 09827373213" autocomplete="off" required <?php if ($edit == true) : ?> value="<?php echo $results->contact_number; ?>" <?php endif ?>>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-md-12">
                                 <?php if ($edit == true) : ?>
                                    <button type="submit" name="edit_evacuation_center" class="btn btn-primary">Update</button>
                                 <?php else : ?>
                                    <button type="submit" name="add_evacuation_center" class="btn btn-primary">Save</button>
                                 <?php endif ?>
                                 <a href="evacuation-center.php" class="btn btn-danger">Cancel</a>
                              </div>
                  </form>
               </div>

               <div class="col-md-9" style="border-left: 1px solid #ddd;">
                  <table id="example1" class="table table-bordered table-hover">
                     <thead>
                        <tr>
                           <th>Center Name</th>
                           <th>Address</th>
                           <th>Contact</th>
                           <th class="text-right">Action</th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php

                        $query = "SELECT * FROM evacuation_centers";
                        $statment = $conn->prepare($query);
                        $statment->execute();
                        $statment->setFetchMode(PDO::FETCH_OBJ);
                        $result = $statment->fetchAll();

                        if ($result) {

                           foreach ($result as $row) {

                        ?>
                              <tr>
                                 <td><?php echo $row->center_name; ?></td>
                                 <td><?php echo $row->address; ?></td>
                                 <td><?php echo $row->contact_number; ?></td>
                                 <td class="text-right">
                                    <a class="btn btn-sm btn-success" href="evacuation-center.php?edit_id=<?php echo $row->id; ?>"><i class="fa fa-edit"></i> Edit</a>
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
                  <form action="../includes/actions.php" method="post" id="delete_evacuation_center_form">
                     <input type="hidden" name="id">
                     <a href="#" class="btn btn-dark" data-dismiss="modal">Close</a>
                     <button type="submit" name="delete_evacuation_center" form="delete_evacuation_center_form" class="btn btn-danger">Delete</button>
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

      document.getElementById("delete_evacuation_center_form").id.value = id;
      $("#delete").modal("show");
   }
</script>