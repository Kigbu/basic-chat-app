<?php
require_once("../core/init.php");

if(isset($_POST['username']) && isset($_POST['name']) && isset($_POST['email']) && isset($_POST['password'])){
	$user = new User();
	if(!$user->getUserInfo($_POST['email'])){
		//print_r($user->getUserInfo($_POST['email'])); exit();
		$username 	= $_POST['username'];
		$name 		= $_POST['name'];
		$email 		= $_POST['email'];
		$password 	= Hash::make($_POST['password']);
		$sort 		= 'Null';
		$logged_in	= '0';
		$r_date		= date('Y-m-d h:i:s', time());
		$user = new User();
		try{
			if($user->create($username, $name, $email, $password, $sort, $logged_in, $r_date)){
				echo Session::myMessage("Account Successfully Created","Success");
			}
		}catch(Exception $e){
			echo Session::myMessage($e->getMessage(),"Error");	
		}
	}else{
		echo Session::myMessage("Account Already Exist","Error");
	}
}
//Redirect::redirectTo('../index.php?page=register');
?>