<?php

function errorMessage(){
	$message = "";
	if (isset($_SESSION['error'])) {
		$message = "<div class='alert alert-danger'>$_SESSION[error]</div>";
	}

	$_SESSION['error'] = null;
	return $message;
}

function successMessage() {
	$message = "";
	if (isset($_SESSION['success'])) {
		$message = "<div class='alert alert-success'>$_SESSION[success]</div>";
	}

	$_SESSION['success'] = null;
	return $message;
}

function getDateTime() {
	date_default_timezone_set("Asia/Manila");
	return date('m-d-Y g:i:s a');
}

function redirect($location) {
	header('location:' . $location . '.php');
}