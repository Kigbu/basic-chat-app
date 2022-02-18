<?php
require_once("../core/init.php");

if(!empty($_POST['username'])  && !empty($_POST['password'])){
	$username = $_POST['username'];
	$password = $_POST['password'];
	$user = new User();
	$verify_user = $user->authenticate($username, $password);
	//var_dump($verify_user); exit;

	if($verify_user && Session::is_logged_in()){
		//return true;
		Redirect::redirectTo('../index.php');		
	}else{
		$_SESSION['error'] = "Invalid Login";
		Redirect::redirectTo('../index.php?page=login');
	}
}
?>