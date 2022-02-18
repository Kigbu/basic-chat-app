<?php

function die_r($value){
		echo '<pre>';
		print_r($value);
		echo '</pre>';
		die();
	}
	
	$user = new User();
	//print_r();

	die_r($user->getUserInfo('kigbua@gmail.com'));
	//die_r($user->return_loggedin_users());
	
?>