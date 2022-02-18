<?php
require_once("../core/init.php");

if(isset($_POST['message']) && isset($_POST['receiver'])){
	$message 	= $_POST['message'];
	$sender 	= $_SESSION['user_id'];
	$receiver 	= $_POST['receiver'];
	$chat = new Chat(
		array(
			'message' 	=> $message,
			'sender' 	=> $sender,
			'receiver' 	=> $receiver,
			'c_read' 	=> 0,
			'c_seen' 	=> 0,
			'c_date' 	=> date('Y-m-d h:i:s', time())
		)
	);
	//print_r($chat);exit;
	try{
		if($chat->create()){
			$_SESSION['success'] = "Message Sent";
		}
	}catch(Exception $e){
		$_SESSION['error'] = $e->getMessage();
	}
	Redirect::redirectTo('../index.php');
}

?>