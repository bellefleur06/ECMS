<?php include '../includes/config.php';

$page = 'users';

if (!isset($_SESSION['id'])) {
    header('Location: ../index.php');
}

// load info

if (!isset($_GET['edit_id'])) {

    $_SESSION['user-not-found'] = "User Not Found.";
    header('Location: manage-user.php');
} else {
    $user_id = $_GET['edit_id'];

    $query = "SELECT * FROM users WHERE id =:usr_id LIMIT 1";
    $statement = $conn->prepare($query);
    $data = [':usr_id' => $user_id];
    $statement->execute($data);

    $results = $statement->fetch(PDO::FETCH_OBJ);

    if ($results) {
    } else {

        $_SESSION['user-not-found'] = "User Not Found.";
        header('Location: manage-user.php');
    }
}

if ($_GET['edit_id'] = "") {

    $_SESSION['user-not-found'] = "User Not Found.";
    header('Location: manage-user.php');
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit User</title>
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
                            <h1 class="m-0" style="color: rgb(31,108,163);"><span class="fa fa-user-lock"></span> Edit Users</h1>
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Edit Users</li>
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

                <?php if (isset($_SESSION['edit-user-success'])) : ?>
                    <h5 id="alert" class="alert alert-success"><?php echo $_SESSION['edit-user-success']; ?></h5>
                <?php
                    unset($_SESSION['edit-user-success']);
                endif;
                ?>
                <?php if (isset($_SESSION['edit-user-failed'])) : ?>
                    <h5 id="alert" class="alert alert-danger"><?php echo $_SESSION['edit-user-failed']; ?></h5>
                <?php
                    unset($_SESSION['edit-user-failed']);
                endif;
                ?>

                <div class="container-fluid">
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Users Information</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="../includes/actions.php" method="post">
                            <input type="hidden" name="id" value="<?php echo $results->id; ?>">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Full Name</label>
                                                    <input type="text" name="full_name" class="form-control" autocomplete="off" required value="<?php echo $results->full_name; ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Designation</label>
                                                    <input type="text" name="designation" class="form-control" autocomplete="off" required value="<?php echo $results->designation; ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Contact Info</label>
                                                    <input type="number" name="contact_number" class="form-control" placeholder="ex. 09876534764" autocomplete="off" required value="<?php echo $results->contact_number; ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Account Category</label>
                                                    <select name="account_category" class="form-control">
                                                        <option value="Admin" <?php echo ($results->account_category == "Admin") ? 'selected' : ''; ?>>Admin</option>
                                                        <option value="Encoder" <?php echo ($results->account_category == "Encoder") ? 'selected' : ''; ?>>Encoder</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Status</label>
                                                    <select name="status" class="form-control">
                                                        <option value="1" <?php echo ($results->status == "1") ? 'selected' : ''; ?>>Active</option>
                                                        <option value="0" <?php echo ($results->status == "0") ? 'selected' : ''; ?>>Inactive</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" name="edit_user" class="btn btn-primary">Update</button>
                                <a href="manage-user.php" class="btn btn-danger" style="float:right">Back</a>
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