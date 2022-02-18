<?php
	//since we need the database, lets require it
	//require_once(LIB_PATH.DS.'database.php');
	class User{

		protected static $table_name = "users";
		private $my_db;

		function __construct(){
			$this->my_db = Database::getInstance();
			// if($this->my_db === null){
			// 	die("No database Connection");
			// }
			//$this->_db = Database::open_connection();
		}


	    public function find_by_username($username = ""){
	    	$sql = "SELECT * FROM ".self::$table_name." WHERE username=:username";
	      	$params = array(':username' => $username);
	      	$stmt = $this->my_db->runQuery($sql, $params);
	      	$rowCount = $stmt->rowCount();
	      	if($rowCount > 0){
	      		return $stmt->fetchAll(PDO::FETCH_OBJ);
	      		//return true;
	      	}else{
	      		return false;
	      	}
	    }

	    public function getUserInfo($email){
	    	$sql = "SELECT * FROM ".self::$table_name." WHERE email=:email";
	      	$params = array(':email' => $email);
	      	$stmt = $this->my_db->runQuery($sql, $params);
	      	$rowCount = $stmt->rowCount();
	      	if($rowCount > 0){
	      		//return $stmt->fetchAll(PDO::FETCH_OBJ);
	      		//$this->find_by_id($stmt->fetch()[0]['id']);
	      		return true;
	      	}else{
	      		return false;
	      	}
	    }

	    //Common Database Methods
		public function find_all() {
  			$sql = "SELECT * FROM ".self::$table_name."";
	      	$stmt = $this->my_db->runQuery($sql);

	      	$rowCount = $stmt->rowCount();
	      	if($rowCount > 0){
	      		return $stmt->fetchAll(PDO::FETCH_OBJ);
	      	}else{
	      		return $rowCount;
	      	}
	    }
	    
	    public function find_by_id($id=0) {
	      	$sql = "SELECT * FROM ".self::$table_name." WHERE id=:id";
	      	$params = array(':id' => $id);
	      	$stmt = $this->my_db->runQuery($sql, $params);
	      	$rowCount = $stmt->rowCount();
	      	if($rowCount > 0){
	      		return $stmt->fetchAll(PDO::FETCH_OBJ);
	      	}else{
	      		return $rowCount;
	      	}
	    }

	    public function authenticate($username="", $password="") {

	    	$sql = "SELECT * FROM ".self::$table_name." WHERE username=?";
	      	$params = array($username);
	      	//print_r($sql); exit;
	      	$stmt = $this->my_db->runQuery($sql, $params);
	      	$rowCount = $stmt->rowCount();
	      	if($rowCount > 0){
	      		$result_array = $stmt->fetchAll(PDO::FETCH_OBJ);
	      	}
	      	//print_r($result_array); exit;
	    	foreach ($result_array as $key => $value) {
	    		# code...
	    		//print_r($value->password); exit;
	    		if(password_verify($password, $value->password)){
	    			
	    			//print_r($value); exit;
	    			// get this id
	    			$data = array(
		    			'id' => $value->id,
		    			'username' => $value->username,
						'name' => $value->name,
						'email' => $value->email,
						'password' => $value->password,
						'sort' => 'nill',
						'logged_in' => 1,
						'r_date' => $value->r_date
		    			//print_r($user->logged_in); exit;
					);
	    			if($this->update($value->id, $data)){
	    				Session::login($value);
	    				return true;
	    			}
	    		}
	    	}
	    	//return false;
		}

		public function return_loggedin_users(){
			$sql = "SELECT * FROM ".self::$table_name." WHERE logged_in = 1";
			$stmt = $this->my_db->runQuery($sql);
			$rowCount = $stmt->rowCount();
	      	if($rowCount > 0){
	      		$records = $stmt->fetchAll(PDO::FETCH_OBJ);
	      		$options ="";
				foreach ($records as $key => $value) {
				    # code...
					//$options .= "<option value='{$value->id}'>{$value->name}</option>".PHP_EOL;
					$udata = '{"r_id":"'.$value->id.'","r_uname":"'. $value->username .'","r_name":"'. $value->name .'","email":"'. $value->email .'"}';
					//print_r($udata); exit;
					//$user_id = ;
					if($value->id != $_SESSION['user_id'] ){
						$options .= "<div id='single_user' data-udata='{$udata}' class='chat_list'>
		                    <div class='chat_people'>
		                      <div class='chat_img'> <img src='media/img/chat_user.png' alt='chat'> </div>
		                      <div class='chat_ib'>
		                      	<div class='uname' data-uname='{$value->username}' hidden>{$value->username}</div>
		                        <h5>{$value->name} <span class='chat_date'>Dec 25</span></h5>
		                        <p>...</p>
		                      </div>
		                    </div>
		                </div>".PHP_EOL;
					}
					
				}
				// 'id':"{$value->id}",'r_uname':"{$value->username}",'r_name':"{$value->name}",'email':"{$value->email}"
				return $options;
	      	}
			//print_r($stmt); exit;
		}

	    public function create($username, $name, $email, $password, $sort, $logged_in, $r_date){
	    	$sql = "INSERT INTO ".self::$table_name." (id, username, name, email, password, sort, logged_in, r_date) VALUES (?,?,?,?,?,?,?,?)";
	    	$params = array(null, $username, $name, $email, $password, $sort, $logged_in, $r_date);
	    	//print_r($sql); exit;
	    	$stmt = $this->my_db->runQuery($sql, $params);
	    	$rowCount = $stmt->rowCount();
	    	if($rowCount > 0){
	      		return true;
	      	}else{
	      		return false;
	      	}
	    	//return $rowCount;
	    }

	    public function update($id, $data){
	    	$table = self::$table_name;
	    	$cond = "id='{$id}'";
	    	$result = $this->my_db->update($table, $data, $cond);
	    	if($result > 0){
	    		return true;
	    	}else{
	    		return false;
	    	}
	    }

	    public function delete(){
	    	
	    }
	}
?>