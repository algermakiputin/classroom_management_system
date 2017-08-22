<?php include('Includes/database.php') ?>
<?php include('Includes/functions.php') ?>
<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
	<title>Classroom Management System</title>
	<link rel="stylesheet" type="text/css" href="Assets/bootstrap/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="Assets/css/style.css">
	<link rel="stylesheet" type="text/css" href="Assets/font-awesome-4.7.0/css/font-awesome.min.css">
</head>
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
<div>
	<nav class="navi">
		<div class="container">
			<div class="row">
				<ul class="nav-btn">
					<a href="dashboard.php"><li>
					<i class="fa fa-tachometer" aria-hidden="true"></i> Dashboard</li></a>
					<a href="room.php"><li>
					<i class="fa fa-door" aria-hidden="true"></i>
					<i class="fa fa-university" aria-hidden="true"></i> Classrooms</li></a>
					<a href="set_schedule.php"><li>
					<i class="fa fa-clock-o"></i> Set Schedule</li></a>
					<a href="schedule.php"><li>
					<i class="fa fa-calendar" aria-hidden="true"></i> Schedule</li></a>
					<a href="account.php"><li>
					<i class="fa fa-user-circle-o" aria-hidden="true"></i> Accounts</li></a>
					<a href="setting.php"><li>
					<i class="fa fa-cog" aria-hidden="true"></i> Settings</li></a>
				</ul>
			</div>
		</div>
	</nav>
</div>
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
	<a href="room.php">
		<div class="col-md-4 dashboard-card">
			<div class="bg-success">
				<img src="Assets/image/classroom.png">
				<h2>Classrooms (<?php echo $roomCount ?>)</h2>
			</div>
		</div>
	</a>
	<a href="account.php">
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