<?php include 'includes/config.php';

if (isset($_SESSION['id'])) {
    header('Location: admin/dashboard.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Evacuation Center Management System</title>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="asset/bootstrap/css/bootstrap.min.css" />
    <script src="asset/bootstrap/js/bootstrap.bundle.min.js"></script>

    <style>
        body::before {
            display: block;
            content: "";
            height: 60px;
        }

        #map {
            width: 100%;
            height: 100%;
            border-radius: 10px;
        }

        @media (min-width: 768px) {
            .news-input {
                width: 50%;
            }
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg bg-dark navbar-dark py-3 fixed-top">
        <div class="container">
            <a href="index.php" class="navbar-brand">ECMS</a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navMenu">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a href="login.php" class="nav-link">LOGIN</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <?php

    // load info

    $query = "SELECT * FROM lgu_settings";
    $statement = $conn->prepare($query);
    $statement->execute();

    $results = $statement->fetch(PDO::FETCH_OBJ);

    ?>

    <!-- Contact and Map -->
    <section class="p-5">
        <br>
        <div class="container">
            <div class="row g-4">
                <div class="col-md">
                    <h2 class="text-center mb-4">Evacuation Center Management System</h2>
                    <ul class="list-group list-group-flush lead">
                        <li class="list-group-item">
                            <span class="fw-bold">Location:</span> <?php echo $results->city; ?>
                        </li>
                        <li class="list-group-item">
                            <span class="fw-bold">Contact No.:</span> <?php echo $results->contact_number; ?>
                        </li>
                        <li class="list-group-item">
                            <span class="fw-bold">Email Address:</span> <?php echo $results->email_address; ?>
                        </li>
                        <li class="list-group-item">
                            <span class="fw-bold">Website:</span>
                            <?php echo $results->website_name; ?>
                        </li>
                        <li class="list-group-item">
                            <span class="fw-bold">Facebook Page:</span>
                            <?php echo $results->facebook_page; ?>
                        </li>
                    </ul>
                </div>
                <div class="col-md">
                    <div class="container">
                        <img class="img-fluid d-sm-block" src="asset/img/cityhall.jpeg" width="500" />
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>