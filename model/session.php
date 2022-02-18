<?php
	// A class to help work with Sessions
	// In our case, primarily to manage logging users in and out

	// Keep in mind when working with sessions that it is generally 
	// inadvisable to store DB-related objects in sessions
	class Session{

		private static $logged_in;
		public static $user_id;
		public static $message;

		function __construct(){
			if(session_status == PHP_SESSION_NONE){
				session_start();
			}			

			self::check_message();
			self::check_login();
			if(self::$logged_in) {
		      	// actions to take right away if user is logged in
		      	self::$logged_in = true;
		    }else {
		      	// actions to take right away if user is not logged in
		    }
		}

		public static function is_logged_in() {
		    
			self::check_login();
		    return self::$logged_in;
		}

		public static function login($user) {
		    // database should find user based on username/password
		    if($user){
		      	self::$user_id = $_SESSION['user_id'] = $user->id;
		      	$_SESSION['username'] = $user->username;
		      	self::$logged_in = true;
		    }
		}

		public static function logout() {
		    
		    $user_id = $_SESSION['user_id'];
		    $username = $_SESSION['username'];

	    	$user = new User();
	    	$result_array = $user->find_by_id($user_id);
	    	// $result_array2 = $user->find_by_username($username);
	    	// print_r($result_array2[0]);
	    	// echo '<br/>';
	    	// echo '<br/>';
	    	// echo '<br/>';
	    	//print_r($result_array[0]); exit;
	    	foreach ($result_array as $key => $value) {
	    		# code...
	    		//print_r($value); exit;
	    		if($user_id == $value->id){
	    			// get this id
	    			$data = array(
		    			'id' => $value->id,
		    			'username' => $value->username,
						'name' => $value->name,
						'email' => $value->email,
						'password' => $value->password,
						'sort' => 'nill',
						'logged_in' => 0,
						'r_date' => $value->r_date
		    			//print_r($user->logged_in); exit;
					);	    			
	    			if($user->update($value->id, $data)){
	    				unset($_SESSION['user_id']);
					    self::$user_id = null;
					    self::$logged_in = false;
					    return true;
	    			}
	    		}
	    	}
	    	return false;		    
		}

		public static function message($msg=""){
			if(!empty($msg)) {
	    		// then this is "set message"
	    		// make sure you understand why $this->message=$msg wouldn't work
	    		$_SESSION['message'] = $msg;
	  		} else {
	    		// then this is "get message"
				return self::$message;
	  		}
		}

		private static function check_login() {
		    if(isset($_SESSION['user_id'])) {
		      self::$user_id = $_SESSION['user_id'];
		      self::$logged_in = true;
		    } else {
		      self::$user_id = null;
		      self::$logged_in = false;
		    }
		}

		private static function check_message(){
			// is there a message stored in sesstion?
			if(isset($_SESSION['message'])){
				//Add it an attribute and erase the stored version
				self::$message = $_SESSION['message'];
				unset($_SESSION['message']);
			}else{
				self::$message = "";
			}
		}

		public static function myMessage($msg, $type) {
		    $msgType = "";
		    $msgSubT = "";
		    $msgchk = "";
		    switch ($type) {
		    	case 'Success':
		    		# code...
		    		$msgType = "alert-success";
		        	$msgBtn = "btn-success";
		        	$msgchk = "fa-check-circle";
		        	$msgSubT = "Success:";
		    	break;
		    	case 'Warning':
		    		# code...
		    		$msgType = "alert-info";
			        $msgBtn = "btn-info-";
			        $msgchk = "fa-info-circle";
			        $msgSubT = "Please Note:";
		    	break;
		    	case 'Required':
		    		# code...
		    		$msgType = "alert-danger";
			        $msgBtn = "btn-danger";
			        $msgchk = "fa-bars-circle";
			        $msgSubT = "Please Note:";
		    	break;
		    	case 'Error':
		    		# code...
		    		$msgType = "alert-danger";
			        $msgBtn = "btn-danger";
			        $msgchk = "fa-times";
			        $msgSubT = "Error:";
		    	break;
		    }		    
		    $message = "
		            <div class='alert alert-border $msgType'>
		                <button class = 'btn $msgBtn pull-right' aria-hidden='true' type='button' data-dismiss='alert' style='border-radius:25px;padding:0px 5px;'>X</button>
		                <strong><i class='fa $msgchk'></i>$msgSubT </strong>$msg
		            </div>".PHP_EOL;
		    return $message;
		}


	}
?>