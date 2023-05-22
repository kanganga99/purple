<?php
session_start();
include "../config/db.php";
$companyid = $_SESSION['companyid'];
if(isset($_POST['submit'])){
    $classname = $_POST['classname'];
    $level = $_POST['level'];
    $check_duplicate_classname = "SELECT classname FROM classes WHERE classname= '$classname' ";
    $result = mysqli_query($conn, $check_duplicate_classname);
    $count = mysqli_num_rows($result);
    if ($count > 0) {
        echo "<script>alert('class already exist'); location.href='./index.php';</script>";
        return false;
    }
    $companyid = $_SESSION['companyid'];
  $sql ="INSERT INTO classes(id,classname,`level`,companyid) VALUES (NULL,'$classname','$level','$companyid')";
     $result = mysqli_query($conn, $sql);
     if($result){
         header("Location: index.php?msg=New class added");
     }                              
     else{
         echo "Failed:" . mysqli_error($conn);
     }
}
?>
