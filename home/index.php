<?php
include '../includes/header.php';
$companyid = $_SESSION['companyid'];

if (isset($_GET['msg'])) {
    $msg = $_GET['msg'];
    echo '  <div class="alert alert-warning alert-dismissible fade show" role="alert">
    ' . $msg . '
<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
}

$conn = new mysqli($servername, $username, $password, $dbname);
$sql1 = "SELECT * FROM expenses WHERE companyid = '$companyid'";
$sql2 = "SELECT * FROM admins WHERE companyid = '$companyid'";
$sql3 = "SELECT * FROM classes WHERE companyid = '$companyid'";
$sql4 = "SELECT * FROM students WHERE companyid = '$companyid'";
$sql5 = "SELECT * FROM fees WHERE companyid = '$companyid'";

//admins
$resultadmins = mysqli_query($conn, $sql2);
$rowcountadmins = mysqli_num_rows($resultadmins);
//schools
$resultclasses = mysqli_query($conn, $sql3);
$rowcountclasses = mysqli_num_rows($resultclasses);
//students
$resultstudents = mysqli_query($conn, $sql4);
$rowcountstudents = mysqli_num_rows($resultstudents);
//fees
$resultfees = mysqli_query($conn, $sql5);
$rowcountfees = mysqli_num_rows($resultfees);

// $resultcourses = mysqli_query($conn, $sql6);
// $rowcountcourses = mysqli_num_rows($resultcourses);
?>
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-3 stretch-card grid-margin">
                <div class="card bg-gradient-primary card-img-holder text-white">
                    <div class="card-body">
                        <img src="../assets/purple/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                        <h4 class="font-weight-normal mb-3">Number of admins<i class="mdi mdi-account mdi-24px float-right"></i>
                        </h4>
                        <h2 class="mb-5"><?php echo $rowcountadmins ?></h2>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="../admins/"></a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 stretch-card grid-margin">
                <div class="card bg-gradient-info card-img-holder text-white">
                    <div class="card-body">
                        <img src="../assets/purple/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                        <h4 class="font-weight-normal mb-3">Number of students <i class="mdi mdi-account-multiple mdi-24px float-right"></i>
                        </h4>
                        <h2 class="mb-5"><?php echo $rowcountstudents ?></h2>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="../students/"></a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 stretch-card grid-margin">
                <div class="card bg-gradient-danger card-img-holder text-white">
                    <div class="card-body">
                        <img src="../assets/purple/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                        <h4 class="font-weight-normal mb-3">Number of classes<i class="mdi mdi-google-classroom mdi-24px float-right"></i>
                        </h4>
                        <h2 class="mb-5"><?php echo $rowcountclasses; ?></h2>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="../classes/"></a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 stretch-card grid-margin">
                <div class="card bg-gradient-success card-img-holder text-white">
                    <div class="card-body">
                        <img src="../assets/purple/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                        <h4 class="font-weight-normal mb-3">Number of fees
                            <br>
                            <i class="mdi mdi mdi-format-list-bulleted mdi-24px float-right"></i>
                        </h4>
                        <h2 class="mb-5"><?php echo $rowcountfees ?></h2>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="../fees/"></a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>