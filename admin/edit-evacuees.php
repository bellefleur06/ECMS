<?php include '../includes/config.php';

$page = 'evacuee';

if (!isset($_SESSION['id'])) {
    header('Location: ../index.php');
}

// load info

if (!isset($_GET['edit_id'])) {

    $_SESSION['evacuee-not-found'] = "Evacuee Not Found.";
    header('Location: manage-evacuees.php');
} else {
    $evacuee_id = $_GET['edit_id'];

    $query = "SELECT * FROM calamity_types, evacuation_centers, barangays, evacuees WHERE calamity_type_id = calamity_types.id AND evacuation_center_id = evacuation_centers.id AND barangay_id = barangays.id AND evacuees.id =:evc_id LIMIT 1";
    $statement = $conn->prepare($query);
    $data = [':evc_id' => $evacuee_id];
    $statement->execute($data);

    $results = $statement->fetch(PDO::FETCH_OBJ);

    if ($results) {
    } else {

        $_SESSION['evacuee-not-found'] = "Evacuee Not Found.";
        header('Location: manage-evacuees.php');
    }
}

if ($_GET['edit_id'] = "") {

    $_SESSION['evacuee-not-found'] = "Evacuee Not Found.";
    header('Location: manage-evacuees.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Evacuees</title>
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
                            <h1 class="m-0" style="color: rgb(31,108,163);"><span class="fa fa-address-card"></span> Edit Evacuee</h1>
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                                <li class="breadcrumb-item active">Edit Evacuee</li>
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

                <?php if (isset($_SESSION['edit-evacuee-success'])) : ?>
                    <h5 id="alert" class="alert alert-success"><?php echo $_SESSION['edit-evacuee-success']; ?></h5>
                <?php
                    unset($_SESSION['edit-evacuee-success']);
                endif;
                ?>
                <?php if (isset($_SESSION['edit-evacuee-failed'])) : ?>
                    <h5 id="alert" class="alert alert-danger"><?php echo $_SESSION['edit-evacuee-failed']; ?></h5>
                <?php
                    unset($_SESSION['edit-evacuee-failed']);
                endif;
                ?>

                <div class="container-fluid">
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Evacuees Information</h3>
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
                                                    <label>Last Name</label>
                                                    <input type="text" name="last_name" class="form-control" autocomplete="off" required value="<?php echo $results->last_name; ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>First Name</label>
                                                    <input type="text" name="first_name" class="form-control" autocomplete="off" required value="<?php echo $results->first_name; ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Middle Name</label>
                                                    <input type="text" name="middle_name" class="form-control" placeholder="(Optional)" autocomplete="off" value="<?php echo $results->middle_name; ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Contact No.</label>
                                                    <input type="number" name="contact_number" min="0" class="form-control" placeholder="ex. 09864723647" autocomplete="off" required value="<?php echo $results->contact_number; ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Age</label>
                                                    <input type="number" name="age" min="0" class="form-control" autocomplete="off" required value="<?php echo $results->age; ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Gender</label>
                                                    <select name="gender" class="form-control">
                                                        <option value="Male" <?php echo ($results->gender == "Male") ? 'selected' : ''; ?>>Male</option>
                                                        <option value="Female" <?php echo ($results->gender == "Female") ? 'selected' : ''; ?>>Female</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Barangay</label>
                                                    <select name="barangay" class="form-control">
                                                        <option value="<?php echo $results->barangay_id; ?>"><?php echo $results->barangay; ?></option>
                                                        <?php
                                                        $query = "SELECT * FROM barangays ORDER BY barangay ASC";
                                                        try {
                                                            $statement = $conn->prepare($query);
                                                            $statement->execute();

                                                            $statement->setFetchMode(PDO::FETCH_OBJ);
                                                            $result = $statement->fetchAll();
                                                        } catch (PDOException $e) {

                                                            echo ($e->getMessage());
                                                        } ?>
                                                        <?php foreach ($result as $row) { ?>
                                                            <option value="<?php echo $row->id; ?>"><?php echo $row->barangay; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Address</label>
                                                    <textarea name="address" class="form-control" required><?php echo $results->address; ?></textarea>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Head of the Family</label>
                                                    <input type="text" name="family_head" class="form-control" autocomplete="off" required value="<?php echo $results->family_head; ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Evacuation Center</label>
                                                    <select name="calamity_type" class="form-control">
                                                        <option value="<?php echo $results->calamity_type_id; ?>"><?php echo $results->calamity_type; ?></option>
                                                        <?php
                                                        $query = "SELECT * FROM calamity_types ORDER BY calamity_type ASC";
                                                        try {
                                                            $statement = $conn->prepare($query);
                                                            $statement->execute();

                                                            $statement->setFetchMode(PDO::FETCH_OBJ);
                                                            $result = $statement->fetchAll();
                                                        } catch (PDOException $e) {

                                                            echo ($e->getMessage());
                                                        } ?>
                                                        <?php foreach ($result as $row) { ?>
                                                            <option value="<?php echo $row->id; ?>"><?php echo $row->calamity_type; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Evacuation Center</label>
                                                    <select name="evacuation_center" class="form-control">
                                                        <option value="<?php echo $results->evacuation_center_id; ?>"><?php echo $results->center_name; ?></option>
                                                        <?php
                                                        $query = "SELECT * FROM evacuation_centers ORDER BY center_name ASC";
                                                        try {
                                                            $statement = $conn->prepare($query);
                                                            $statement->execute();

                                                            $statement->setFetchMode(PDO::FETCH_OBJ);
                                                            $result = $statement->fetchAll();
                                                        } catch (PDOException $e) {

                                                            echo ($e->getMessage());
                                                        } ?>
                                                        <?php foreach ($result as $row) { ?>
                                                            <option value="<?php echo $row->id; ?>"><?php echo $row->center_name; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" name="edit_evacuee" class="btn btn-primary">Update</button>
                                <a href="manage-evacuees.php" class="btn btn-danger" style="float:right">Back</a>
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