<?php include('Includes/database.php') ?>
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
				<div style="float: right;font-weight: bolder;font-size: 22px;color: silver;padding: 4px;margin-top: -2.8px;">
					-- Classrooms --
				</div>
			</div>
		</div>
	</nav>
</div>
<div class="container">
<div class="row">
	<div class="col-md-2 room-side-nav">
		<nav class="">
		<div class="room-side-nav-header">
			Room Menu
		</div>
			<ul>
				<li><a href="">Classrooms</a></li>
				<li><a href="new_classroom.php">New Classroom</a></li>
			</ul>
		</nav>
	</div>
	<div class="col-md-10 room-main">
		<div id="room-main">
			<?php
			$sql = "SELECT * FROM room ORDER BY room_number";
			$exec = mysqli_query($con, $sql);
			?>
			<table class="table table-striped table-hover">
				<tr>
					<th></th>
					<th>Room No.</th>
					<th>Room Name</th>
					<th>Floor Level</th>
				</tr>
				<?php 
				$no = 1;
				while ($row = mysqli_fetch_assoc($exec)) {
					?>
					<tr>
						<td><?php echo $no; ?></td>
						<td><?php echo  $row['room_number'] ?></td>
						<td><?php echo  $row['room_name'] ?></td>
						<td><?php echo  $row['floor_level'] ?></td>
					</tr>
					<?php
					$no++;
				}
				?>
			</table>
		</div>
	</div>
</div>

</div>
</body>
</html>