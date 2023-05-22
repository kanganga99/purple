<?php
session_start();
include "../config/db.php";
if (isset($_POST)) {
    $id = $_POST['id'];
    $student_id = $_POST['student_id'];
    $amount = $_POST['amount'];
    $remarks = $_POST['remarks'];
    $sql = "UPDATE `transactions` SET student_id='$student_id',amount='$amount',remarks='$remarks' WHERE id='$id'  ";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        header("Location: ./index.php");
    } else {
        echo "Failed:" . mysqli_error($conn);
    }
}
?>
