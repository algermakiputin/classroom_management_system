<?php include('../Includes/database.php') ?>
<?php include('../Includes/functions.php') ?>
<?php session_start(); ?>
<!DOCTYPE html>
<html>

<?php include('layout/head.php') ?>

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
<?php include('layout/navigation.php') ?>
<div class="container">
<div class="row">
<div class="col-md-12 dashboard">
	<?php
		$query = "SELECT * from room";

		$exec = mysqli_query($con, $query);

		$roomCount = mysqli_num_rows($exec);

		$query = "SELECT * from accounts";

		$exec = mysqli_query($con, $query);

		$accountCount = mysqli_num_rows($exec);
	?>
	<a href="/app/classroom/room.php">
		<div class="col-md-4 dashboard-card">
			<div class="bg-success">
				<img src="/Assets/image/classroom.png">
				<h2>Classrooms (<?php echo $roomCount ?>)</h2>
			</div>
		</div>
	</a>
	<a href="/app/account/account.php">
		<div class="col-md-4 dashboard-card">
			<div class="bg-success">
				<span class="glyphicon glyphicon-user"></span>
				<h2>Accounts (<?php echo $accountCount ?>)</h2>
			</div>
		</div>
	</a>
	<a>
		<div class="col-md-4 dashboard-card">
			<div class="bg-warning">
			<h3>School Year: 2017-2018</h3>
			<h3>Semester: 1st</h3>
			</div>
		</div>
	</a>
</div>
</div>

</div>
</body>
</html>