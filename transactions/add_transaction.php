<?php
session_start();
include "../config/db.php";
$companyid = $_SESSION['companyid'];
if (isset($_POST['submit'])) {
    // $companyname = $_POST['companyname'];
    $student_id = $_POST['student_id'];
    $amount = $_POST['amount'];
    $remarks = $_POST['remarks'];
    $companyid = $_SESSION['companyid'];
    $sql = "INSERT INTO transactions(student_id,class_id,amount,remarks,companyid) SELECT '$student_id',class_id,'$amount','$remarks','$companyid' from students WHERE student_id='$student_id'";
    $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
    if ($result) {
        header("Location: index.php");
    } else {
        echo "Failed:" . mysqli_error($conn);
    }
}
?>






