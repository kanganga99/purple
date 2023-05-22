<?php
session_start();
include "../config/db.php";
$_SESSION['companyname'] = 'companyname';
if (isset($_SESSION['companyid'])) { ?>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Dashboard</title>
    <link href="../assets/css/style.css" rel="stylesheet" />
    <script src="../assets/js/all.js"></script>
    <link href="../assets//css/bootstrap.min.css/bootstrap5.min.css" rel="stylesheet">
    <link href="../assets/css/bootstrap.min.css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        .navbar-dark {
            background-color: #1e360b;
        }

        .sb-sidenav {
            background-color: #1e360b;
        }

        .sb-sidenav-dark .sb-sidenav-menu .nav-link {
            color: #fff;
        }

        a:hover {
            text-decoration: none;
            color: #fff;
            background-color: #AAAAAA;
        }

        a:focus {
            text-decoration: none;
            color: #fff;
            background-color: #AAAAAA;
        }

        .nav-link {
            font-weight: 800px;
            color: #62b1cc;
            /* color: #1d1f20e3; */
        }

        .nav-link:focus {
            color: #fff;
        }

        .nav-link:hover {
            color: #fff;
        }

        .active:focus {
            color: #fff;
        }

        .mt-2 {

            box-shadow: 2px 5px #888888;
        }
    </style>
    <nav class="sb-topnav navbar navbar-expand navbar-dark ">
        <!-- <a class="navbar-brand ps-3" href="../home/"><b><?php echo $_SESSION['companyname'] ?></b></a> -->
        <a class="navbar-brand ps-3" href="../home/"><b>Receipt</b></a>
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0 mr-5" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
        </form>
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="../changepassword/">Update Password</a></li>
                    <li>
                        <hr class="dropdown-divider" />
                    </li>
                    <li style="background-color:#28becd;"><a href="../logout.php" class="dropdown-item"><i class='fa fa-sign-out'></i> Logout</a></li>
                </ul>
            </li>
        </ul>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
        <nav class="sidebar sidebar-offcanvas" id="sidebar">
                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link" href="index.html">
                            <span class="menu-title">Admins</span>
                            <i class="mdi mdi-home menu-icon"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
                            <span class="menu-title">Students</span>
                            <!-- <i class="menu-arrow"></i> -->
                            <i class="mdi mdi-account-group-outline menu-icon"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="pages/icons/mdi.html">
                            <span class="menu-title">Classes</span>
                            <i class="mdi mdi-contacts menu-icon"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="pages/forms/basic_elements.html">
                            <span class="menu-title">Fees</span>
                            <i class="mdi mdi-format-list-bulleted menu-icon"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="pages/charts/chartjs.html">
                            <span class="menu-title">Transactions</span>
                            <i class="mdi mdi-cash menu-icon"></i>
                        </a>
                    </li>
                </ul>
            </nav>
        <?php
    } else {
        header("Location: ../logout.php");
    }
        ?>