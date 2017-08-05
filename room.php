<?php include('Includes/database.php') ?>
<?php
if (isset($_GET['del_room'])) {
	$room_id = mysqli_real_escape_string($con,$_GET['del_room']);
	if (empty($room_id)) {
		header("location:room.php");
	}else {
		$sql = "DELETE FROM room WHERE room_id = '$room_id'";
		$exec = mysqli_query($con, $sql);
		if ($exec) {
			header("location:room.php");
		}
	}
}

?>
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
	<div class="col-md-2 room-side-nav">
		<nav class="">
		<div class="room-side-nav-header">
			Room Menu
		</div>
			<ul class="room-menu">
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
					<th>Action</th>
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
						<td><a href="room.php?del_room=<?php echo $row['room_id']; ?> "><button class="btn btn-danger btn-sm">Delete</button></a></td>
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