<?php
session_start();
include './config/db.php';
if (!isset($_SESSION['companyid'])) {
	error_reporting(0);
	// echo "hi";
	if (isset($_SESSION['companyid'])) {
		header("Location: home/");
	}
	if (isset($_POST['submit'])) {
		$email = $_POST['email'];
		$password = $_POST['password'];
		$sql = "SELECT * FROM admins WHERE email='$email'";
		$result = mysqli_query($conn, $sql);
		if ($result->num_rows > 0) {
			$row = mysqli_fetch_assoc($result);
			$_SESSION['companyid'] = $row['companyid'];
			echo $_SESSION['companyid'];
			header("Location: home/");
		} else {
			header("Location: index.php?error=Incorrect Username or password");
		}
	}
?>
	<!DOCTYPE html>
	<html>

	<head>
		<title>Login</title>
		<link href="assets/css/bootstrap.min.css/bootstrap.min.css" rel="stylesheet">
		<link href="page/style.css" rel="stylesheet">
	</head>
	<!-- <style>
		.bing {
			background-color: #e0d1e0;
		}
	</style> -->
	<body>
		<div >
			<div class="container">
				<form action="" method="POST" class="login-email">
					<p>To login, enter your registered username and password</p>
					<?php if (isset($GET['error'])) { ?>
						<div class="alert alert-danger" role="alert">
							<? $_GET['error'] ?>
						</div>
					<?php } ?>
					<div class="input-group">
						<input type="email" placeholder="Email" name="email" value="<?php echo $email; ?>" required>
					</div>
					<div class="input-group">
						<input type="password" placeholder="Password" name="password" value="<?php echo $_POST['password']; ?>" required>
					</div>
					<div class="input-group">
						<button id="linkButton" name="submit" class="btn">Login</button>
					</div>
					<p class="login-register-text">Don't have an account? <a href="register.php">Register Here</a>.</p>
				</form>
			</div>
		</div>
	</body>
	</html>
<?php } else {
	header("Location: home/");
} ?>