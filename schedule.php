<?php include('Includes/database.php') ?>

<?php
// $startTime = "09:00 AM";
// $endTime = "12:00 PM";

// $start = new DateTime($startTime);
// $end = new DateTime($endTime);

// $start_time = $start->getTimestamp();
// $end_time = $end->getTimestamp();
$start_time = "09:00 AM";
$sql = "SELECT * FROM setting";
$exec = mysqli_query($con, $sql);
$setting = mysqli_fetch_assoc($exec);
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
				<?php
				$extension = "";
				if ($setting['sem'] == 1) {
					$extension = 'st';
				}else {
					$extension = 'nd';
				}
				?>
					-- Schedule --
				</div>
			</div>
		</div>
	</nav>
</div>
<div class="container">
	<div class="row">
	<div class="col-md-2 room-aside">
		<div class="row">
			<div class="title-heading">
				Rooms List
			</div>
			<div class="room-list">
				<nav>
					<ul>
						<?php 
						$sql = "SELECT * FROM room ORDER BY room_number";
						$exec = mysqli_query($con,$sql) ;
						$room_order = 0;
						$smallest = 1000;
						while ($row = mysqli_fetch_assoc($exec)) {
							if ($row['room_id'] > $room_order) {
								$room_order = $row['room_id'];
							}
							if ($row['room_number'] < $smallest) {
								$smallest = $row['room_number'];
							}
							?>
							<a href="schedule.php?room_number=<?php echo $row['room_number']?>&room_id=<?php echo $row['room_id']?>"><li><?php echo $row['room_number'] ?></li></a>

							<?php
						}
						?>
						
					</ul>
				</nav>
			</div>
		</div>
	</div>
	<div class="col-md-10 sched-main">
		<?php

		if (!isset($_GET['room_number'])) {
			?>
		<?php
			$sql = "SELECT * FROM schedule WHERE room_id = '$room_order' AND sy_from = '$setting[sy_from]' AND sy_to = '$setting[sy_to]' AND semester = $setting[sem] ORDER BY str_to_date(start_time,'%h:%m %p')";
			$exec = mysqli_query($con,$sql);
			$num_rows = mysqli_num_rows($exec);
			$data = [];
			$mon = 1;
			$tue = 1;
			$wed = 1;
			$thu = 1;
			$fri = 1;
			$sat = 1;
			$sun = 1;

			if ($num_rows > 0) {
				$index = 0;
				while ($row = mysqli_fetch_array($exec)) {
					$data[$index] = $row;
					$index++;
				}
			}
			$monSched = [];
			$tueSched = [];
			$wedSched = [];
			$thuSched = [];
			$friSched = [];
			$satSched = [];
			$sunSched = [];
			$index = 0;
			foreach ($data as $sched) {
				$day = $sched[5];
				switch ($day) {
					case 'monday':
						$mon++;
						$monSched[$index] = $sched;
						break;
					case 'tuesday':
						$tue++;
						$tueSched[$index] = $sched;
						break;
					case 'wednesday':
						$wed++;
						$wedSched[$index] = $sched;
						break;
					case 'thursday':
						$thu++;
						$thuSched[$index] = $sched;
						break;
					case 'friday':
						$fri++;
						$friSched[$index] = $sched;
						break;
					case 'saturday':
						$sat++;
						$satSched[$index] = $sched;
						break;
					case 'sunday':
						$sun++;
						$sunSched[$index] = $sched;
						break;
				}
				$index++;
			}
			?>
		<?php
		$table = "";
		$table .= "<table class='schedule_table table'>
			<tr>
				<th>Day</th>
				<th>Time</th>
				<th>Subject</th>
			</tr> ";

		$table .= "<tr>
					<td rowspan=$mon>Monday</td>
					
				";
		if (sizeof($monSched) == 0) {
							$table .= '<td></td><td></td>';
		}

		$table .= "</tr>";
		?>
		
			<?php
			foreach ($monSched as $monday) {
				$table .= "
				<tr>
					<td>
						 $monday[start_time]  - $monday[end_time] 
					</td>
					<td>
						 $monday[subject_name]  
					</td>
				</tr>
				";
			}

			$table .= "
			<tr>
				<td rowspan='$tue'>Tuesday</td>
			";

			if (sizeof($tueSched) == 0) {
				$table .= '<td></td><td></td>';
			}

			$table .= "</tr>";
			?>


			

			<?php
			foreach ($tueSched as $tuesday) {
				$table .= "
				<tr>
					<td>
				$tuesday[start_time] - $tuesday[end_time] 
					</td>
					<td>
						 $tuesday[subject_name] 
					</td>
				</tr>	
				";
			}

			$table .= "
			<tr>
				<td rowspan= '$wed' >Wednesday</td>
			";
				if (sizeof($wedSched) == 0) {
				$table .= '<td></td><td></td>';
				}

			$table .= "</tr>";
			?>

				
				<?php
				foreach ($wedSched as $wednesday) {
					$table .= "
					<tr>
						<td>
							 $wednesday[start_time] - $wednesday[end_time] 
						</td>
						<td>
							$wednesday[subject_name] 
						</td>				
					</tr>
					";
				}

				$table .= "
				<tr>
					<td rowspan=' $thu'>Thursday</td>
				";
				if (sizeof($thuSched) == 0) {
							$table .= '<td></td><td></td>';
				}

				$table .= "</tr>";
				?>
				<?php
				foreach ($thuSched as $thursday) {
				$table .= "
				<tr>
						<td>
							 $thursday[start_time] - $thursday[end_time] 
						</td>
						<td>
							$thursday[subject_name]  
						</td>
					</tr>
				";
				}

				$table .= "
				<tr>
					<td rowspan='$fri'>Friday</td>
				";
				if (sizeof($friSched) == 0) {
							$table .= '<td></td><td></td>';
				}

				$table .= "</tr>";
				?>

				<?php
				foreach ($friSched as $friday) {
					$table .= "
					<tr>
						<td>
							$friday[start_time] - $friday[end_time] 
						</td>
						<td>
							 $friday[subject_name]  
						</td>
					</tr>
					";
				}
				$table .= "
				<tr>
					<td rowspan='$sat'>Saturday</td>
				";
				if (sizeof($satSched) == 0) {
							$table .= '<td></td><td></td>';
				}

				$table .= "</tr>";
				?>
				<?php
				foreach ($satSched as $saturday) {
					$table .= "
					<tr>
						<td>
							 $saturday[start_time] - $saturday[end_time] 
						</td>
						<td>
							 $saturday[subject_name]  
						</td>
					</tr>
					";
				}
				
				$table .= "
				<tr>
					<td rowspan= '$sun'>Sunday</td>
					
						
					
				";
				if (sizeof($sunSched) == 0) {
							$table .= '<td></td><td></td>';
				}
				$table .= "</tr>";	
				?>
				<?php	
					foreach ($sunSched as $sunday) {
						$table .= "
						<tr>
							<td>
								 $sunday[start_time] - $sunday[end_time] 
							</td>
							<td>
								 $sunday[subject_name]  
							</td>
						</tr>
						";
					}
				$table .= "</table>";	
				
				?>
				<div class="room_number">
					-- Room <?php echo $smallest ?> SY <?php echo $setting['sy_from'] . ' - ' . $setting['sy_to'] . ' Sem:' . $setting['sem'] . $extension  ?> --
					<div style="float: right; margin-top: 0px;">
						<a href="test.php?data=<?php echo $table ?>"><span class="badge" style="color: white;cursor: pointer; line-height: 1.5">Import To Excel</span></a>&nbsp;&nbsp;
						<a href="set_room_schedule.php?room_no=<?php echo $smallest ?>&id=4"><span class="badge" style="color: white;cursor: pointer; line-height: 1.5">Update Schedule</span></a>
					</div>
				</div>
			<?php
			echo $table;
		}else if (isset($_GET['room_number'])) {
			?>
			<?php
			$sql = "SELECT * FROM schedule WHERE room_id = '$_GET[room_id]' ORDER BY str_to_date(start_time,'%h:%m %p')";
			$exec = mysqli_query($con,$sql);
			$num_rows = mysqli_num_rows($exec);
			$data = [];
			$mon = 1;
			$tue = 1;
			$wed = 1;
			$thu = 1;
			$fri = 1;
			$sat = 1;
			$sun = 1;

			if ($num_rows > 0) {
				$index = 0;
				while ($row = mysqli_fetch_array($exec)) {
					$data[$index] = $row;
					$index++;
				}
			}
			$monSched = [];
			$tueSched = [];
			$wedSched = [];
			$thuSched = [];
			$friSched = [];
			$satSched = [];
			$sunSched = [];
			$index = 0;
			foreach ($data as $sched) {
				$day = $sched[5];
				switch ($day) {
					case 'monday':
						$mon++;
						$monSched[$index] = $sched;
						break;
					case 'tuesday':
						$tue++;
						$tueSched[$index] = $sched;
						break;
					case 'wednesday':
						$wed++;
						$wedSched[$index] = $sched;
						break;
					case 'thursday':
						$thu++;
						$thuSched[$index] = $sched;
						break;
					case 'friday':
						$fri++;
						$friSched[$index] = $sched;
						break;
					case 'saturday':
						$sat++;
						$satSched[$index] = $sched;
						break;
					case 'sunday':
						$sun++;
						$sunSched[$index] = $sched;
						break;
				}
				$index++;
			}
			?>
		<div class="room_number">
			-- Room <?php echo $_GET['room_number'] ?> - Schedule  --
			<div style="float: right; margin-top: 0px;">
				<a><span class="badge" style="color: white;cursor: pointer; line-height: 1.5">Import To Excel</span></a>&nbsp;&nbsp;
				<a><span class="badge" style="color: white;cursor: pointer; line-height: 1.5">Edit</span></a>
			</div>
		</div>
		<?php
		$table = "";
		$table .= "<table class='schedule_table table'>
			<tr>
				<th>Day</th>
				<th>Time</th>
				<th>Subject</th>
			</tr> ";

		$table .= "<tr>
					<td rowspan=$mon>Monday</td>
					
				";
		if (sizeof($monSched) == 0) {
							$table .= '<td></td><td></td>';
		}

		$table .= "</tr>";
		?>
		
			<?php
			foreach ($monSched as $monday) {
				$table .= "
				<tr>
					<td>
						 $monday[start_time]  - $monday[end_time] 
					</td>
					<td>
						 $monday[subject_name]  
					</td>
				</tr>
				";
			}

			$table .= "
			<tr>
				<td rowspan='$tue'>Tuesday</td>
			";

			if (sizeof($tueSched) == 0) {
				$table .= '<td></td><td></td>';
			}

			$table .= "</tr>";
			?>


			

			<?php
			foreach ($tueSched as $tuesday) {
				$table .= "
				<tr>
					<td>
				$tuesday[start_time] - $tuesday[end_time] 
					</td>
					<td>
						 $tuesday[subject_name] 
					</td>
				</tr>	
				";
			}

			$table .= "
			<tr>
				<td rowspan= '$wed' >Wednesday</td>
			";
				if (sizeof($wedSched) == 0) {
				$table .= '<td></td><td></td>';
				}

			$table .= "</tr>";
			?>

				
				<?php
				foreach ($wedSched as $wednesday) {
					$table .= "
					<tr>
						<td>
							 $wednesday[start_time] - $wednesday[end_time] 
						</td>
						<td>
							$wednesday[subject_name] 
						</td>				
					</tr>
					";
				}

				$table .= "
				<tr>
					<td rowspan=' $thu'>Thursday</td>
				";
				if (sizeof($thuSched) == 0) {
							$table .= '<td></td><td></td>';
				}

				$table .= "</tr>";
				?>
				<?php
				foreach ($thuSched as $thursday) {
				$table .= "
				<tr>
						<td>
							 $thursday[start_time] - $thursday[end_time] 
						</td>
						<td>
							$thursday[subject_name]  
						</td>
					</tr>
				";
				}

				$table .= "
				<tr>
					<td rowspan='$fri'>Friday</td>
				";
				if (sizeof($friSched) == 0) {
							$table .= '<td></td><td></td>';
				}

				$table .= "</tr>";
				?>

				<?php
				foreach ($friSched as $friday) {
					$table .= "
					<tr>
						<td>
							$friday[start_time] - $friday[end_time] 
						</td>
						<td>
							 $friday[subject_name]  
						</td>
					</tr>
					";
				}
				$table .= "
				<tr>
					<td rowspan='$sat'>Saturday</td>
				";
				if (sizeof($satSched) == 0) {
							$table .= '<td></td><td></td>';
				}

				$table .= "</tr>";
				?>
				<?php
				foreach ($satSched as $saturday) {
					$table .= "
					<tr>
						<td>
							 $saturday[start_time] - $saturday[end_time] 
						</td>
						<td>
							 $saturday[subject_name]  
						</td>
					</tr>
					";
				}
				
				$table .= "
				<tr>
					<td rowspan= '$sun'>Sunday</td>
					
						
					
				";
				if (sizeof($sunSched) == 0) {
							$table .= '<td></td><td></td>';
				}
				$table .= "</tr>";	
				?>
				<?php	
					foreach ($sunSched as $sunday) {
						$table .= "
						<tr>
							<td>
								 $sunday[start_time] - $sunday[end_time] 
							</td>
							<td>
								 $sunday[subject_name]  
							</td>
						</tr>
						";
					}
				$table .= "</table>";	
				echo $table;
				?>
			<?php
		}

		?>
		</div>
	</div>
</div>
</body>
</html>