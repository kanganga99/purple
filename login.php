<?php
session_start();
include "config/db.php";
if (isset($_POST['submit'])) {
	$email = test_input($_POST['email']);
	$password = test_input($_POST['password']);
	function test_input($data)
	{
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}
	if (empty($email)) {
		header("Location: index.php?error=Email is Required");
	} else if (empty($password)) {
		header("Location: index.php?error=Password is Required");
	} else {
		$password = md5($password);
		$sql = "SELECT * FROM admins WHERE email='$email' AND password='$password' LIMIT 1";
	};
	$result = mysqli_query($conn, $sql);
	if (mysqli_num_rows($result) === 1) {
		$row = mysqli_fetch_assoc($result);
		if ($row['password'] === $password) {
			// $_SESSION['email'] = $row['email'];
			// $_SESSION['id'] = $row['id'];
			// $_SESSION['email'] = $row['email'];
			$_SESSION['companyid'] = $row['companyid'];
			if ($_SESSION['companyid'] == 'companyid') {
				header("Location: home/");
			} else {
				header("Location: index.php");
			}
		} else {
			header("Location: index.php?error=Incorect Email or password");
		}
	} else {
		header("Location: index.php?error=Incorect Email or password");
	}
} else {
	header("Location: index.php");
}
