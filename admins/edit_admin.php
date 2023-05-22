<?php
session_start();
include "../config/db.php";
if (isset($_POST)) {
    $id = $_POST['id'];
    $companyname = $_POST['companyname'];
    $email = $_POST['email'];
    $sql = "UPDATE admins SET companyname='$companyname',email='$email' WHERE id='$id'  ";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        header("Location: ./index.php");
    } else {
        echo "Failed:" . mysqli_error($conn);
    }
}
?>
