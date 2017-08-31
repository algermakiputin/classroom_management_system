<?php include('../../Includes/database.php') ?>
<?php include('../../Includes/functions.php') ?>
<?php session_start(); ?>
<?php isLogin() ?>	
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