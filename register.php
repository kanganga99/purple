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
		else {
			$hash = password_hash($password, PASSWORD_DEFAULT);
			$sql = "SELECT * FROM admins WHERE email='$email'";
			$result = mysqli_query($conn, $sql);
			if (!$result->num_rows > 0) {
				$query = mysqli_query($conn, "INSERT INTO admins (companyname, email, password, companyid,phonenumber)VALUES ('$companyname1', '$email', '$password', '$companyid','$phonenumber')");
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


	<!-- <!DOCTYPE html>
	<html lang="en">

	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<title>Purple Admin</title>
		<link rel="stylesheet" href="./assets/purple/vendors/mdi/css/materialdesignicons.min.css">
		<link rel="stylesheet" href="./assets/purple/vendors/css/vendor.bundle.base.css">
		<link rel="stylesheet" href="./assets/purple/css/style.css">
	</head>

	<body>
		<div class="container-scroller">
			<div class="container-fluid page-body-wrapper full-page-wrapper">
				<div class="content-wrapper d-flex align-items-center auth">
					<div class="row flex-grow">
						<div class="col-lg-4 mx-auto">
							<div class="auth-form-light text-left p-5">
								<p>Create an account to get started</p>
								<form action="" class="pt-3">
									<div class="form-group">
										<input type="text" class="form-control form-control-lg" placeholder="Company name" name="companyname" value="<?php echo $companyname1; ?>" required>
									</div>
									<div class="form-group">
										<input type="email" class="form-control form-control-lg" placeholder="Email address" name="email" value="<?php echo $email; ?>" required>
									</div>
									<div class="form-group">
										<input type="text" class="form-control form-control-lg" placeholder="phonenumber" name="phonenumber" value="<?php echo $phonenumber; ?>" required>
									</div>
									<div class="form-group">
										<input type="password"  class="form-control form-control-lg" placeholder="Password" name="password" value="<?php echo $_POST['password']; ?>" required>
									</div>
									<div class="form-group">
										<input type="password" class="form-control form-control-lg" placeholder="Confirm Password" name="cpassword" value="<?php echo $_POST['cpassword']; ?>" required>
									</div>
									<div class="mt-3">
										<a class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn" href="../../index.html">SIGN UP</a>
									</div>
									<div class="text-center mt-4 font-weight-light"> Already have an account? <a href="login.php" class="text-primary">Login</a>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<script src="./assets/purple/vendors/js/vendor.bundle.base.js"></script>
		<script src="./assets/purple/js/off-canvas.js"></script>
		<script src="./assets/purple/js/hoverable-collapse.js"></script>
		<script src="./assets/purple/js/misc.js"></script>
	</body>
	</html> -->
<?php } else {
	header("Location: home/");
} ?>