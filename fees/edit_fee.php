<?php
session_start();
include "../config/db.php";
if (isset($_POST)) {
    $id = $_POST['id'];
    $description = $_POST['description'];
    $amount = $_POST['amount'];
    $classname = $_POST['classname'];
    $query = "UPDATE `fees` SET `description`= if('$description'='',description,'$description'), amount='$amount', classname=if('$classname'='', classname, '$classname' WHERE id='$id'  ";
    $result = mysqli_query($conn, $query);
    if ($result) {
        header("Location: ./index.php");
    } else {
        echo "Failed:" . mysqli_error($conn);
    }
}
?>
