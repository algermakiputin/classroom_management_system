<?php include('Includes/database.php') ?>
<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
	<title>Classroom Management System</title>
	<link rel="stylesheet" type="text/css" href="Assets/bootstrap/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="Assets/css/style.css">
</head>
<body>
<div class="header">
	<div class="navbar navbar-default">
		<div class="container">
			<div class="navbar-header">
				<a href="" class="navbar-brand">Classroom CMS</a>
			</div>
		</div>
	</div>
</div>
<div>
	<nav class="navi">
		<div class="container">
			<div class="row">
				<ul class="nav-btn">
					<a href="dashboard.php"><li>Dashboard</li></a>
					<a href="room.php"><li>Classrooms</li></a>
					<a href="set_schedule.php"><li>Set Schedule</li></a>
					<a href="schedule.php"><li>Schedule</li></a>
					<a href="account.php"><li>Accounts</li></a>
				</ul>
				<div style="float: right;font-weight: bolder;font-size: 22px;color: silver;padding: 3px;margin-top: -2.8px;">
					-- Dashboard --
				</div>
			</div>
			
		</div>
	</nav>
</div>
<div class="container">
<div class="row">
<div class="col-md-12 dashboard">
		<div class="col-md-6 new-room">
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
		<div class="col-md-6 new-schedule">
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
		<div class="col-md-6 new-account">
			<div class="new-account-content">
				<div class="new-account-title">
					<div class="">Recently Added Account</div>
				</div>
				<div class="new-account-body">
					
				</div>
			</div>
		</div>
</div>
</div>

</div>
</body>
</html>