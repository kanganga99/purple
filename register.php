<?php
session_start();
$msg = "";
if (!isset($_SESSION['companyname']) && !isset($_SESSION['id'])) {
	include './config/db.php';
	error_reporting(0);
	session_start();

	if (isset($_SESSION['companyname'])) {
		header("Location: index.php");
	}

	if (isset($_POST['submit'])) {
		$companyname1 = $_POST['companyname'];
		$email = $_POST['email'];
		$password = md5($_POST['password']);
		$cpassword = md5($_POST['cpassword']);
		$phonenumber = $_POST['phonenumber'];
		$companyid = mt_rand(100000, 999999);
		if ($password != $cpassword) 
		$msg = "Please check your passwords";
		else{
			$hash = password_hash($password, PASSWORD_DEFAULT);	
			$sql = "SELECT * FROM admins WHERE email='$email'";
			$result = mysqli_query($conn, $sql);
			if (!$result->num_rows > 0) {
				$query = mysqli_query($conn,"INSERT INTO admins (companyname, email, password, companyid,phonenumber)VALUES ('$companyname1', '$email', '$password', '$companyid','$phonenumber')");
				$query1 = mysqli_query($conn, "INSERT INTO companies (companyname,companyid,phonenumber) VALUES ('$companyname1','$companyid','$phonenumber')");
				// $query1 = mysqli_query($conn, "INSERT INTO admins (companyid,username,email,`password`)VALUES('$companyid','$username','$email','$password')");    
				// $result = mysqli_query($conn, $sql);
				if ($query) {

					header("Location: register.php?success=User Registered succesfully");
					//  header("Location: home/");
					$companyname1 = "";
					$email = "";
					$_POST['password'] = "";
					$_POST['cpassword'] = "";
					$companyId = "";
				} else {
					header("Location: register.php?error=Something went wrong");
				}
			} else {
				header("Location: register.php?error=Email already exists");
			}
		}
	}
?>
	<!DOCTYPE html>
	<html>
	<head>
		<title>Register</title>
		<link href="assets/css/bootstrap.min.css/bootstrap.min.css" rel="stylesheet">
		<link href="page/style.css" rel="stylesheet">
	</head>
	<body>
		<div class="container">
			<p>Create an account to get started</p>
			<?php if (isset($_GET['error'])) { ?>
				<div class="alert alert-danger" role="alert">
					<?= $_GET['error'] ?>
				</div>
			<?php } ?>
			<?php if (isset($_GET['success'])) { ?>
				<div class="alert alert-success" role="alert">
					<?= $_GET['success'] ?>
				</div>
			<?php } ?>
			<form action="" method="POST" class="login-email">
				<div class="input-group">
					<input type="text" placeholder="Company name" name="companyname" value="<?php echo $companyname1; ?>" required>
				</div>
				<div class="input-group">
					<input type="email" placeholder="Email address" name="email" value="<?php echo $email; ?>" required>
				</div>
				<div class="input-group">
					<input type="text" placeholder="phonenumber" name="phonenumber" value="<?php echo $phonenumber; ?>" required>
				</div>
				<div class="input-group">
					<input type="password" placeholder="Password" name="password" value="<?php echo $_POST['password']; ?>" required>
				</div>
				<div class="input-group">
					<input type="password" placeholder="Confirm Password" name="cpassword" value="<?php echo $_POST['cpassword']; ?>" required>
				</div>
				<div class="input-group">
					<button name="submit" class="btn">Register</button>
				</div>
				<p class="login-register-text">Have an account? <a href="index.php">Login Here</a>.</p>
			</form>
		</div>
	</body>
	</html>
<?php } else {
	header("Location: home/");
} ?>