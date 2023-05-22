
<?php
session_start();
include "../config/db.php";
$companyid = $_SESSION['companyid'];
if (isset($_POST['submit'])) {
    // $companyname = $_POST['companyname'];
    $email = $_POST['email'];
    $phonenumber = $_POST['phonenumber'];
    $check_duplicate_email = "SELECT email FROM admins WHERE email= '$email' ";
    $result = mysqli_query($conn, $check_duplicate_email);
    $count = mysqli_num_rows($result);
    if ($count > 0) {
        echo "<script>alert('email already exist'); location.href='./index.php';</script>";
        return false;
    }
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $companyid = $_SESSION['companyid'];
    // $role = $_POST['role'];
    $sql = "INSERT INTO admins(id,email,password,companyid,phonenumber) VALUES (NULL,'$email','$password','$companyid','$phonenumber')";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        header("Location: index.php");
    } else {
        echo "Failed:" . mysqli_error($conn);
    }
}
?>






