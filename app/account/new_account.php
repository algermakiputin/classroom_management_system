<?php include('../../Includes/database.php') ?>
<?php include('../../Includes/functions.php') ?>
<?php session_start(); ?>
<?php isLogin() ?>	
<?php

if (isset($_POST['submit'])) {

	$name = mysqli_real_escape_string($con,$_POST['name']);
	$username = mysqli_real_escape_string($con,$_POST['username']);
	$password = mysqli_real_escape_string($con,$_POST['password']);
	$conf_password = mysqli_real_escape_string($con,$_POST['conf_password']);
	$date = getDateTime();

	//Account Validation 
	$save = AccountRegistrationValidation($name, $username, $password, $conf_password);


	if ($save) {

		$hash_pwd = password_hash($password, PASSWORD_BCRYPT);

		$sql = "INSERT INTO accounts (name,username,password,date_created) VALUES ('$name','$username','$hash_pwd','$date')";

		$saveAccount = mysqli_query($con, $sql);

		if ($saveAccount) {

			$_SESSION['success'] = "Account Created Successfully";
		
		}else {

			$_SESSION['error'] = "Something Went Wrong Please Try Again";

		}

	}
}


?>
<!DOCTYPE html>
<html>
<?php include('../layout/head.php') ?>
<body>
<div class="header">
	<div class="navbar navbar-default">
		<div class="container">
			<div class="navbar-header">
				<a href="" class="navbar-brand">Classroom Management System</a>
			</div>
		</div>
	</div>
</div>
<?php include('../layout/navigation.php') ?>
<div class="container">
<div class="row">
<div class="col-md-12 accounts">
	<div class="row">
		<div class="col-md-2 accounts-side-nav">
			<div class="row">
				<div class="accounts-menu-header" >
					Accounts Menu
				</div>
				<ul>
					<li><a href="account.php">Accounts</a></li>
					<li><a href="new_account.php">New Account</a></li>
				</ul>
			</div>
		</div>
		<div class="col-md-10 accounts-main-wrapper">
			<div class="col-md-12 accounts-main">
				<div class="row">
					<div class="accounts-main-header">
						-- Register Account --
					</div>
					<div class="col-md-12">
					<?php echo errorMessage(); ?>
					<?php echo successMessage(); ?>
					</div>
				</div>
				<form method="POST" action="new_account.php">
					<div class="form-group">
						<label for="name">Name *</label>
						<input placeholder="Full Name" type="text" name="name" class="form-control" >
					</div>
					<div class="form-group">
						<label for="username">Username *</label>
						<input placeholder="Username" type="text" name="username" class="form-control" >
					</div>
					<div class="form-group">
						<label for="password">Password *</label>
						<input placeholder="Password" type="password" name="password" class="form-control" >
					</div>
					<div class="form-group">
						<label for="conf_password">Confirm Password *</label>
						<input placeholder="Confirm Password" type="password" name="conf_password" class="form-control" >
					</div>
					<div class="form-group">
						<input type="submit" name="submit" class="btn btn-primary" value="Register">
					</div>
				</form>
				<?php if (isset($save)) : ?>
					<?php if (is_array($save)) : ?>
						<div class="row">
							<div class="col-md-12">
								<div class="alert alert-danger">
									<ul>
						<?php foreach ($save as $error) : ?>
						
								<li><?php echo $error ?></li>
									
						<?php endforeach; ?>
									</ul>
								</div>
							</div>
						</div>
					<?php endif; ?>
				<?php endif; ?>
			</div>
			
		</div>
	</div>
</div>
</div>

</div>
</body>
</html>