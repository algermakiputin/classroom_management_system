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
				<input type="submit" class="btn btn-primary">
			</div>
		</form>
	</div>
</div>
</body>
</html>