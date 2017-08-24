<?php include('../../Includes/database.php') ?>
<?php include('../../Includes/functions.php') ?>
<?php session_start(); ?>
<?php
if (isset($_GET['delete_account'])) {
	$id = mysqli_real_escape_string($con, $_GET['delete_account']);
	$sql = "DELETE FROM accounts WHERE id = '$id'";
	$exec = mysqli_query($con, $sql);

	if ($exec) {

		$_SESSION['success'] = "Account Delete Successfully";
		redirect('account');

	}else {
		$_SESSION['error'] = "Opps.. Something Went Wrong, Please Try Again";
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
					<li><a href="">Accounts</a></li>
					<li><a href="new_account.php">New Account</a></li>
				</ul>
			</div>
		</div>
		<div class="col-md-10 accounts-main-wrapper">
			<div class="col-md-12 accounts-main">
				<div class="row">
				<?php echo errorMessage(); ?>
				<?php echo successMessage(); ?>
					<table class="table table-striped table-hover">
						<tr>
							<th></th>
							<th>Name</th>
							<th>Username</th>
							<th>Date Created</th>
							<th>Action</th>
						</tr>
						<?php
						$sql = "SELECT * FROM accounts";
						$exec = mysqli_query($con,$sql);
						$count = 1;
						while ($row = mysqli_fetch_assoc($exec)) {
							?>
							<tr>
								<td><?php echo $count; ?></td>
								<td><?php echo $row['name'] ?></td>
								<td><?php echo $row['username'] ?></td>
								<td><?php echo $row['date_created'] ?></td>
								<td>
									<a href="account.php?update_account=<?php echo $row['id'] ?>" class="btn btn-primary">Edit</a>
									<a href="account.php?delete_account=<?php echo $row['id'] ?>" class="btn btn-danger">Delete</a>
								</td>
							</tr>

							<?php
							$count++;
						}

						?>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
</div>

</div>
</body>
</html>