<?php include('Includes/database.php') ?>
<?php include('Includes/functions.php') ?>
<?php session_start(); ?>
<?php
	if (isset($_POST['update_school_name'])) {
		$school_name = mysqli_real_escape_string($con,$_POST['sc_name']);
		if (empty($school_name)) {
			$_SESSION['error'] = "Empty School Name";
		}else {
			$sql = "UPDATE setting SET school_name = '$_POST[sc_name]' WHERE id = 1 ";
			$exec = mysqli_query($con, $sql);
			if ($exec) {
				$_SESSION['success'] = "School Name Updated";
			}else {
				echo mysqli_error($con);
			}
		}
	}else if (isset($_POST['update_sy'])) {
		$from = mysqli_real_escape_string($con, $_POST['from']);
		$to = mysqli_real_escape_string($con, $_POST['to']);

		if (empty($from) || empty($to)) {

		}else {
			$sql = "UPDATE setting SET sy_from = '$from', sy_to = '$to' WHERE id = 1 ";
			$exec = mysqli_query($con, $sql);
			if ($exec) {
				$_SESSION['success'] = "School Year Updated";
			}else {
				echo mysqli_error($con);
			}
		}

	}else if (isset($_POST['update_sem'])) {
		$sem = mysqli_real_escape_string($con, $_POST['sem']);
		
		if (empty($sem) ) {
			$_SESSION['error'] = "Semester Is Required *";
		} else {
			$sql = "UPDATE setting SET sem = '$sem' WHERE id = 1";
			$exec = mysqli_query($con,$sql);

			if($exec) {
				$_SESSION['success'] = "Semester Updated";
			}else {
				$_SESSION['error'] = "Opps... Something went wrong please try again";
			}
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>School Year & Semester</title>
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
	<?php
	$sql = "SELECT * FROM setting";
	$exec = mysqli_query($con, $sql);
	$schoolName = "";
	$syFrom = "";
	$syTo = "";
	$semester = 0;
	if ($row = mysqli_fetch_assoc($exec)) {
		$schoolName = $row['school_name'];
		$syFrom = $row['sy_from'];
		$syTo = $row['sy_to'];
		$semester = $row['sem'];
	}
	?>
	<div class="row">
		<div class="col-md-12 setting">
			<div class="row">
				<div class="setting-header">
					-- Settings --
				</div>
			</div>
			<div class="col-md-6 setting-body" style="font-weight: 600;">
				<div class="row">
					<div class="col-sm-12 ">
						<h4 class="pag-header">Current Setting</h4>
					</div>
				</div>
				<div class="col-sm-4">
					School Name <span style="float: right;">:</span>
				</div>
				<div class="col-sm-8">
					<?php echo $schoolName ?>
				</div>
				<div class="col-sm-4">
					School Year <span style="float: right;">:</span>
				</div>
				<div class="col-sm-8">
					<?php echo $syFrom . ' - ' . $syTo ?>
				</div>
				<div class="col-sm-4">
					Semester <span style="float: right;">:</span>
				</div>
				<div class="col-sm-8">
					<?php
					if ($semester == 1) {
						echo $semester . 'st';
					}else {
						echo $semester . 'nd';
					}
					?>
				</div>
			</div>
			<div class="col-md-6 setting-body">
				<div class="row">
					<div class="col-sm-12 ">
						<h4 style="margin-bottom: 17px;" class="pag-header">Update Setting</h4>
						<?php echo errorMessage(); ?>
						<?php echo successMessage(); ?>
					</div>
				</div>
				<div class="col-sm-12">
					<form method="POST" action="setting.php">
						<div class="col-sm-4" style="padding-top: 2px;">
							<label>School Name </label> 
							<span style="float: right;">:</span>
						</div>
						<div class="col-sm-8">
							<input type="text" name="sc_name" placeholder="Update School Name">
							<input class="setting_btn" type="submit" name="update_school_name" value="Update">
						</div>
					</form>
					<hr>
					
					<form method="POST" action="setting.php">
						<div class="col-sm-4" style="padding-top: 2px;">
							<label>School Year </label> 
							<span style="float: right;">:</span>
						</div>
						<div class="col-sm-8">
							<input placeholder="From" type="number" name="from" style="width: 96px;" min="2000" max="2900">
							<input placeholder="To" type="number" name="to" style="width: 96px;" min="2000" max="2900">
							<input class="setting_btn" type="submit" name="update_sy" value="Update">
						</div>
					</form>
					<hr><br>

					<form method="POST" action="setting.php">
						<div class="col-sm-4" style="padding-top: 2px;">
							<label>Semester </label> 
							<span style="float: right;">:</span>
						</div>
						<div class="col-sm-8">
							<input type="number" min="1" max="2" name="sem" style="width: 196px" placeholder="Semester">
							<input class="setting_btn" type="submit" name="update_sem" value="Update" class="btn-info">
						</div>
					</form>
					<hr>
				</div>
			</div>	
		</div>
	</div>
</div>
</body>
</html>