<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "receipt";
$conn =mysqli_connect($servername, $username, $password, $dbname);
if(!$conn){
    die("Error in database connection" );
}
?>
