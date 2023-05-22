<?php
include 'includes/header.php';

include "../config/db.php";
if (isset($_SESSION['companyame']) && isset($_SESSION['id'])) {   ?>
    <!-- <?php if ($_SESSION['role'] == 'admin') { ?> -->
        <?= $_SESSION['companyname'] ?>

        <?php include '../members.php';
        if (mysqli_num_rows($res) > 0) { ?>
        <?php } ?>
    <?php } else { ?>
        <?= $_SESSION['companyname'] ?>

    <?php } ?>
<?php } else {
    header("Location: ../index.php");
} ?>

<!DOCTYPE html>
<html lang="en">


<body class="sb-nav-fixed">
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h3 class="mt-4"></h3>
            </div>

        </main>

    </div>

    <script src="../assets/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/main.js"></script>
    <script src="../assets/js/chart.min.js"></script>
    <script src="../assets/js/datatables.js"></script>
</body>

</html>