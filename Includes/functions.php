<?php

function errorMessage(){
	$message = "";

	if (isset($_SESSION['error'])) {
		
		$message = "<div class='alert alert-danger'>$_SESSION[error]</div>";
		$_SESSION['error'] = null;
	}

	
	return $message;
}

function successMessage() {

	$message = "";

	if (isset($_SESSION['success'])) {
		$message = "<div class='alert alert-success'>$_SESSION[success]</div>";
		$_SESSION['success'] = null;
	}

	
	return $message;
}

function getDateTime() {
	date_default_timezone_set("Asia/Manila");
	return date('m-d-Y g:i:s a');
}

function redirect($location) {
	header('location:' . $location . '.php');
}


function AccountRegistrationValidation($name, $username, $password, $repeatPassword) 
{
	$errors = [];
	
	if (empty($name)) 
	{
		
		$errors[] = "Name Is Required";
	
	}

	if (empty($username)) {

		$errors[] = "Username Is Required";

	}

	if (empty($password)) 
	{

		$errors[] = "Password Is Required";

	}

	if (empty($repeatPassword)) 
	{

		$errors[] = "Repeat Password Is Required";

	}

	if ($password != $repeatPassword) 
	{

		$errors[] = "Password And Confirm Password Does Not Match";

	}

	if (empty($errors)) {

		return true;
	}

	return $errors;

}


function loginValidation ($username, $password) {

	$errors = [];

	if (empty($username)) {


		$errors[] = "Username Is Empty";

	}

	if (empty($password)) {

		$errors[] = "Password Is Empty";

	}

	if (empty($errors)) {

		return true;
	}

	return $errors;

}

function isLogin() {

	if (!isset($_SESSION['userData']['id'])) {

		header('location: /app/login.php');

	}

}


