<aside class="main-sidebar sidebar-dark-primary elevation-4" style="background-color: rgba(44,62,80);">
    <!-- Brand Logo -->
    <a href="dashboard.php" class="brand-link animated swing">
        <img src="../asset/img/logo1.png" alt="DSMS Logo" width="200" style="margin-top: -20px;margin-bottom: -60px;">
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="dashboard.php" class='nav-link <?php if ($page == 'dashboard') {
                                                                echo 'active';
                                                            } ?>'>
                        <i class="nav-icon fa fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="calamity-type.php" class='nav-link <?php if ($page == 'calamity') {
                                                                    echo 'active';
                                                                } ?>'>
                        <i class="nav-icon fa fa-globe-asia"></i>
                        <p>
                            Calamity Type
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="barangay.php" class='nav-link <?php if ($page == 'barangay') {
                                                                echo 'active';
                                                            } ?>'>
                        <i class="nav-icon fa fa-university"></i>
                        <p>
                            Barangays
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="evacuation-center.php" class='nav-link <?php if ($page == 'center') {
                                                                        echo 'active';
                                                                    } ?>'>
                        <i class="nav-icon fa fa-hotel"></i>
                        <p>
                            Evacuation Centers
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class='nav-link <?php if ($page == 'evacuee') {
                                                    echo 'active';
                                                } ?>'>
                        <i class="nav-icon fas fa-address-card"></i>
                        <p>
                            Evacuees
                        </p>
                        <i class="right fas fa-angle-left"></i>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="add-evacuees.php" class="nav-link">
                                <i class="nav-icon fa fa-plus"></i>
                                <p>New</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="manage-evacuees.php" class="nav-link">
                                <i class="nav-icon fa fa-address-book"></i>
                                <p>Manage</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <?php if ($_SESSION['account_category'] == "Admin") : ?>
                    <li class="nav-item">
                        <a href="lgu.php" class='nav-link <?php if ($page == 'lgu') {
                                                                echo 'active';
                                                            } ?>'>
                            <i class="nav-icon fa fa-landmark"></i>
                            <p>
                                LGU Settings
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class='nav-link <?php if ($page == 'users') {
                                                        echo 'active';
                                                    } ?>'>
                            <i class="nav-icon fas fa-user-lock"></i>
                            <p>
                                Users
                            </p>
                            <i class="right fas fa-angle-left"></i>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="add-user.php" class="nav-link">
                                    <i class="nav-icon fa fa-plus"></i>
                                    <p>New</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="manage-user.php" class="nav-link">
                                    <i class="nav-icon fa fa-address-book"></i>
                                    <p>Manage</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                <?php endif; ?>
                <li class="nav-item">
                    <a href="#" class='nav-link <?php if ($page == 'reports') {
                                                    echo 'active';
                                                } ?>'>
                        <i class="nav-icon fas fa-chart-bar"></i>
                        <p>
                            Reports
                        </p>
                        <i class="right fas fa-angle-left"></i>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="evacuees-report.php" class="nav-link">
                                <i class="nav-icon fa fa-users"></i>
                                <p>Evacuees</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="gender-report.php" class="nav-link">
                                <i class="nav-icon fa fa-venus-mars"></i>
                                <p>Evacuees by Gender</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="barangay-report.php" class="nav-link">
                                <i class="nav-icon fa fa-archway"></i>
                                <p>Evacuees by Brgy</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="age-report.php" class="nav-link">
                                <i class="nav-icon fa fa-sort-numeric-up-alt"></i>
                                <p>Evacuees by Age</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="calamity-report.php" class="nav-link">
                                <i class="nav-icon fa fa-globe-asia"></i>
                                <p>Evacuees by Calamity</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="center-report.php" class="nav-link">
                                <i class="nav-icon fa fa-hospital-alt"></i>
                                <p>Evacuees by Center</p>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>