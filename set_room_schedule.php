<?php include('Includes/database.php') ?>
<?php include('Includes/functions.php') ?>
<?php session_start(); ?>
<?php
	$sql = "SELECT * FROM setting";
	$exec = mysqli_query($con, $sql);
	$setting = mysqli_fetch_assoc($exec);

	if (isset($_POST['update_sched'])) {
		if (empty($_POST['subject_name'])) {
			$_SESSION['error'] = "Subject Name is Required";
 		}else if (empty($_POST['day'])){
 			$_SESSION['error'] = "Day is Required";
		}else if (empty($_POST['start_time'])) {
			$_SESSION['error'] = "Start Time is Required";
		}else if (empty($_POST['end_time'])) {
			$_SESSION['error'] = "End Time is Required";
		}else {
			$subject_name = mysqli_real_escape_string($con,$_POST['subject_name']);
			$day = mysqli_real_escape_string($con,$_POST['day']);
			$start_time = mysqli_real_escape_string($con,$_POST['start_time']);
			$end_time = mysqli_real_escape_string($con,$_POST['end_time']);
			$date = getDateTime();
			$room_id = mysqli_real_escape_string($con, $_GET['id']);
			$room_num = mysqli_real_escape_string($con, $_GET['room_no']);
			$start = date('h:i a',strtotime($start_time));
			$end = date('h:i a',strtotime($end_time));

			$query = "INSERT INTO schedule (r_number,subject_name,start_time,end_time,day,date,room_id,sy_from,sy_to,semester) VALUES('$room_num','$subject_name','$start','$end','$day','$date','$room_id', '$setting[sy_from]', '$setting[sy_to]', '$setting[sem]'  )";
			
			$exec = mysqli_query($con, $query);

			if ($exec) {
				header("location:set_schedule.php?update=$_GET[room_no]");
				$_SESSION['success'] = 'Schedule Updated';
			}else {
				$_SESSION['error'] = 'Opps.. Something went wrong please try again';
				printf(mysqli_error($con));
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
</head>
<body>
<div class="header">
	<div class="navbar navbar-default">
		<div class="container">
			<div class="navbar-header">
				<a href="" class="navbar-brand">Classroom Management System</a>
				<link rel="stylesheet" type="text/css" href="Assets/font-awesome-4.7.0/css/font-awesome.min.css">
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
				<div style="float: right;font-weight: bolder;font-size: 22px;color: silver;padding: 4px;margin-top: -2.8px;">
					Set Room Schedule
				</div>
			</div>
		</div>
	</nav>
</div>
<div class="container">
<div class="row">
	<div class="col-md-12 set-schedule-main">
		<div class="row">
			<?php
			 if (isset($_GET['room_no'])) {
				if (empty($_GET['room_no'])) {
					header('location:http://localhost/classroom_management_system/set_schedule.php');
				?>

				<?php
				}else {
					$room_id = mysqli_real_escape_string($con,$_GET['id']);
					$room_no = mysqli_real_escape_string($con,$_GET['room_no']);
					?>
					<div class="row">
						<div class="col-md-12">
							<div class="set_schedule_header" >
								Room No. <?php echo $room_no; ?> - Set Schedule 
							</div>
							
 							<div class="col-md-6">

								<form method="POST" action="set_room_schedule.php?room_no=<?php echo $room_no ?>&id=<?php echo $room_id ?>" style="padding: 10px 0;">
									<?php echo errorMessage(); ?>
									<?php echo successMessage(); ?>
									<div class="form-group">
										<label for="subject_name">Subject Name</label>
										<input required="required" type="text" name="subject_name" class="form-control">
									</div>
									<div class="form-group">
										<label for="day">Day</label>
										<select required="required" class="form-control" name="day">
											<option value="monday">Monday</option>
											<option value="tuesday">Tuesday</option>
											<option value="wednesday">Wednesday</option>
											<option value="thursday">Thursday</option>
											<option value="friday">Friday</option>
											<option value="saturday">Saturday</option>
											<option value="sunday">Sunday</option>
										</select>
									</div>
									<div class="form-group">
										<label for="start_time">Start Time</label>
										<input required="required" type="time" name="start_time" class="form-control">
									</div>
									<div class="form-group">
										<label for="end_time">End Time</label>
										<input required="required" type="time" name="end_time" class="form-control">
									</div>
									<div class="form-group">
										<input type="submit" name="update_sched" value="Update" class="btn btn-success">
									</div>
								</form>
							</div>
						</div>
					</div>
					<?php
				}
			}else {
				header('location:set_schedule.php');
			}
			?>
		</div>
	</div>
</div>

</div>
</body>
</html>