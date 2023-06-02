<?php
session_start();
include "../config/db.php";
$_SESSION['companyname'] = 'companyname';
if (isset($_SESSION['companyid'])) { ?>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Dashboard</title>
    <link rel="stylesheet" href="../assets/purple/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="../assets/purple/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="../assets/purple/css/style.css">
    </head>

    <body>
        <div class="container-scroller">
            <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
                <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
                    <a href="../home/"><img src="../assets/purple/images/logo1.PNG" /></a>
                    <!-- <a class="navbar-brand brand-logo-mini" href="../home/"><img src="../assets/purple/images/logo-mini.svg" alt="logo" /></a> -->
                </div>
                <div class="navbar-menu-wrapper d-flex align-items-stretch">
                    <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
                        <span class="mdi mdi-menu"></span>
                    </button>
                    <div class="search-field d-none d-md-block">
                        <form class="d-flex align-items-center h-100" action="#">
                            <div class="input-group">
                                <div class="input-group-prepend bg-transparent">
                                    <i class="input-group-text border-0 mdi mdi-magnify"></i>
                                </div>
                                <input type="text" class="form-control bg-transparent border-0" placeholder="Search">
                            </div>
                        </form>
                    </div>
                    <ul class="navbar-nav navbar-nav-right">
                        <li class="nav-item nav-profile dropdown">
                            <a class="nav-link dropdown-toggle" id="profileDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="nav-profile-img">
                                    <img src="../assets/purple/images/faces/avatar.PNG" alt="image">
                                    <span class="availability-status online"></span>
                                </div>
                                <div class="nav-profile-text">
                                    <p class="mb-1 text-black">Admin</p>
                                </div>
                            </a>
                            <div class="dropdown-menu navbar-dropdown" aria-labelledby="profileDropdown">
                                <!-- <a class="dropdown-item" href="#">
                                    <i class="mdi mdi-cached me-2 text-success"></i> Activity Log </a> -->
                                <!-- <div class="dropdown-divider"></div> -->
                                <a class="dropdown-item" href="../home/logout.php" style="background-color:#ede8f0">
                                    <i class="mdi mdi-logout"></i> Signout </a>
                                <!-- <li style="background-color:#28becd;"><a href="../logout.php" class="dropdown-item"><i class='fa fa-sign-out'></i> Logout</a></li> -->
                            </div>
                        </li>
                        <li class="nav-item d-none d-lg-block full-screen-link">
                            <a class="nav-link">
                                <i class="mdi mdi-fullscreen" id="fullscreen-button"></i>
                            </a>
                        </li>
                    </ul>
                    <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
                        <span class="mdi mdi-menu"></span>
                    </button>
                </div>
            </nav>
            <div class="container-fluid page-body-wrapper">
                <nav class="sidebar sidebar-offcanvas" id="sidebar">
                    <ul class="nav">
                        <li class="nav-item">
                            <a class="nav-link" href="../home/">
                                <span class="menu-title">Dashboard</span>
                                <i class="mdi mdi-home menu-icon"></i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../admins/">
                                <span class="menu-title">Admins</span>
                                <i class="mdi mdi-account menu-icon"></i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../students/">
                                <span class="menu-title">Students</span>
                                <i class="mdi mdi-account-multiple menu-icon"></i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../classes/">
                                <span class="menu-title">Classes</span>
                                <i class="mdi mdi-google-classroom menu-icon"></i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../fees/">
                                <span class="menu-title">Fees</span>
                                <i class="mdi mdi-format-list-bulleted menu-icon"></i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../transactions/">
                                <span class="menu-title">Transactions</span>
                                <i class="mdi mdi-cash menu-icon"></i>
                            </a>
                        </li>
                        <!-- <li class="nav-item">
                            <a class="nav-link" href="../report/">
                                <span class="menu-title">Payment Report</span>
                                <i class="mdi mdi-report menu-icon"></i>
                            </a>
                        </li> -->
                    </ul>
                </nav>
                <script src="../assets/purple/vendors/js/vendor.bundle.base.js"></script>
                <script src="../assets/purple/js/off-canvas.js"></script>
                <script src="../assets/purple/js/hoverable-collapse.js"></script>
                <script src="../assets/purple/js/misc.js"></script>
                <script src="../assets/purple/vendors/chart.js/Chart.min.js"></script>
                <script src="../assets/purple/js/jquery.cookie.js" type="text/javascript"></script>
                <script src="../assets/purple/js/dashboard.js"></script>
                <script src="../assets/purple/js/todolist.js"></script>
    </body>
<?php
} else {
    header("Location: ../logout.php");
}
?>