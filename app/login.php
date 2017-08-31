<?php
session_start();
require('../includes/database.php');
require('../includes/functions.php');
if (isset($_SESSION['userData'])) {

	header('location: /app/dashboard.php');
	
}

if (isset($_POST['submit'])) {
	
	$username = mysqli_real_escape_string($con,$_POST['username']);
	$password = mysqli_real_escape_string($con,$_POST['password']);	

	$validation = loginValidation($username, $password);


	if (is_bool($validation) && $validation == true) {

		$sql = "SELECT * FROM accounts WHERE username = '$username'";

		$select = mysqli_query($con, $sql);

		$row = mysqli_fetch_assoc($select);

		$hash_pwd = $row['password'];

		if (password_verify($password, $hash_pwd)) {

			$_SESSION['userData']['id'] = $row['id'];
			$_SESSION['userData']['name'] = $row['name'];
			$_SESSION['userData']['username'] = $row['username'];

			// die(var_dump($_SESSION['userData']));
			$_SESSION['success'] = "Login Successfully";
		    header('location: /app/dashboard.php');
		}else {

			$_SESSION['error'] = "Incorrect Username or Password";

		}

	}

}

?>

<!DOCTYPE html>
<html>
<?php include('layout/head.php') ?>
<body>
<div class="header">
	<div class="navbar navbar-default">
		<div class="contai
			<div class="navbar-header">
				<a href="" class="navbar-brand">Classroom Management System</a>
			</div>
		</div>
	</div>
</div>
<div class="col-md-6 col-md-offset-3">
	<div class="form-wrapper">
		<h1>Sign In</h1>
		<hr>
		<form method="POST" action="login.php">
			<div class="form-group">
				<label>Username</label>
				<input type="text" name="username" class="form-control">
			</div>
			<div class="form-group">
				<label>Password</label>
				<input type="password" name="password" class="form-control">
			</div>
			<div class="form-group">
				<input type="submit" name="submit" class="btn btn-primary">
			</div>
		</form>
		<?php if (isset($validation)) : ?>
			<?php if (is_array($validation)) : ?>
			<div class="row">
				<div class="col-md-12">
					<div class="alert alert-danger">
						<ul>
							<?php foreach ($validation as $error) : ?>
							<li><?php echo $error ?></li>
						<?php endforeach ?>
						</ul>
					</div>
				</div>
			</div>
			<?php endif ?>
		<?php endif ?>
		<?php echo errorMessage() ?>
		<?php echo successMessage() ?>
	</div>
</div>
</body>
</html>