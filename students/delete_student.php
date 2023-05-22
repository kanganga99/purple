<?php
include "../config/db.php"; 
$id = $_GET['student_id'];
$sql ="DELETE t1,t2 FROM expenses AS t1 INNER JOIN students AS t2 ON t1.student_id= t2.student_id WHERE t2.student_id = '$id'";

$result = mysqli_query($conn, $sql);
if($result){
    header("Location: ./index.php?msg=Record deleted");
}
else{
    echo "Failed" . mysqli_error($con);
}
$query=mysqli_query($conn,"SELECT * FROM students");
$number=1;
while($row=mysqli_fetch_array($query)){
    $id=$row['id'];
    $sql = "UPDATE students SET id=$number WHERE id=$id";
    if($conn->query($sql) == TRUE){
        echo "Record RESET succesfully<br>";
    }
    $number++;
}
$sql = "ALTER TABLE students AUTO_INCREMENT =1";
if($conn->query($sql) == TRUE){
    echo "Record ALTER succesfully";
}else{
    echo"Error ALTER record: " . $conn->error;
} 
?>

