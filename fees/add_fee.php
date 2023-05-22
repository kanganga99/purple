
<?php
session_start();
include "../config/db.php";
$companyid = $_SESSION['companyid'];
if (isset($_POST['submit'])) {
    $description = $_POST['description'];
    $amount = $_POST['amount'];
    $companyid = $_SESSION['companyid'];
    $classname = $_POST['classname'];
    $query = "SELECT id FROM classes WHERE classname = '$classname'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    $class_id = $row['id'];
    $query = "INSERT INTO fees (id,class_id,description,amount,classname,companyid) VALUES (NULL,'$class_id','$description','$amount','$classname','$companyid')";
    $result = mysqli_query($conn, $query);
    if ($result) {
        header("Location: index.php");
    } else {
        echo "Failed:" . mysqli_error($conn);
    }
}
?>







