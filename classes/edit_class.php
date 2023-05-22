<?php
session_start();
include_once("../config/db.php");
if (isset($_POST['editbtn'])) {
	$id = $_POST['id'];
    $classname = $_POST['classname'];
    $level = $_POST['level'];
    $sql ="UPDATE `classes` SET `classname`='$classname', `level`= '$level'  WHERE id='$id'  ";
    $result = mysqli_query($conn, $sql);
    if($result){
        header("Location: index.php");
    }
    else{
        echo "Failed:" . mysqli_error($conn);
    }
}
?>
