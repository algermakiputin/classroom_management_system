<?php include('Includes/database.php') ?>
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
		<div class="col-md-12 new-room">
			<div class="new-room-content">
				<div class="new-room-title">
					<div class="">Recently Added Room</div>	
				</div>
				<div class="new-room-body">
					<table class="table table-hover table-striped">
						<tr>
							<th></th>
							<th>Room No.</th>
							<th>Floor Level</th>
							<th>Date Time</th>
						</tr>
					<?php
					$sql = "SELECT * FROM room ORDER BY room_id DESC LIMIT 5";
					$exec = mysqli_query($con, $sql);
					$count = 1;
					while ($row = mysqli_fetch_assoc($exec)) {
						?>
						<tr>
							<td><?php echo $count ?></td>
							<td><?php echo $row['room_number'] ?></td>
							<td><?php echo $row['floor_level'] ?></td>
							<td><?php echo $row['date_added'] ?></td>
						</tr>
						<?php
						$count++;
					}
					?>
					</table>
				</div>
			</div>
		</div>
		<div class="col-md-12 new-schedule">
			<div class="new-schedule-content">
				<div class="new-schedule-title">
					<div class="">Recently Added Schedule</div>
				</div>
				<div class="new-schedule-body">
					<table class="table table-striped table-hover">
					<tr>
						<th></th>
						<th>Room Number</th>
						<th>Subject</th>
						<th>Time</th>
						<th>Day</th>
					</tr>
					<?php
					$sql = "SELECT * FROM schedule ORDER BY schedule_id LIMIT 5";
					$exec = mysqli_query($con,$sql);
					$count = 1;
					while ($row = mysqli_fetch_assoc($exec)) {
				
						?>
						<tr>
							<td><?php echo $count ?></td>
							<td><?php echo $row['r_number'] ?></td>
							<td><?php echo $row['subject_name'] ?></td>
							<td><?php echo $row['start_time'] . ' - ' . $row['end_time'] ?></td>
							<td><?php echo $row['day'] ?></td>
						</tr>

						<?php
						$count++;
					}
					?>
					</table>
				</div>
			</div>
		</div>
		<div class="col-md-12 new-account">
			<div class="new-account-content">
				<div class="new-account-title">
					<div class="">Recently Added Account</div>
				</div>
				<div class="new-account-body">
					<table class="table table-hover table-striped">
						<tr>
							<th></th>
							<th>Name</th>
							<th>Date Time</th>
						</tr>
					<?php
						$num = 1;
						$sql = "SELECT * FROM accounts ORDER BY id DESC";
						$exec = mysqli_query($con, $sql);
						while ($row = mysqli_fetch_assoc($exec)) {
							?>
							<tr>
								<td><?php echo $num ?></td>
								<td><?php echo $row['name'] ?></td>
								<td><?php echo $row['date_created']?></td>
							</tr>

							<?php
							$num++;
						}
					?>
					</table>
				</div>
			</div>
		</div>
</div>
</div>

</div>
</body>
</html>