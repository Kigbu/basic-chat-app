<?php
/**
 * 
 */
class Chat 
{
	protected static $table_name = "chat_messages";
	private $my_db;
	

	function __construct()
	{
		$this->my_db = Database::getInstance();
	} 


	public function fetchMsgs($r_id, $perpage, $offset, $lastMsgId = null){

		$user_id = $_SESSION['user_id'];
		$username = $_SESSION['username'];
		//print_r($user_id." ".$r_id); exit();
        //$idp = isset($_POST['by_id']) ? "AND id > ".$_POST['by_id']: '';
        $MsgId = !is_null($lastMsgId) ? "AND id > ". $lastMsgId : '';

		$sql = "SELECT * FROM ".self::$table_name." WHERE sender = :user_id AND receiver = :r_id OR sender = :r_id AND receiver = :user_id {$MsgId} ORDER BY c_date DESC LIMIT {$perpage} OFFSET {$offset}";
		$params = array( ':user_id' => $user_id, ':r_id' => $r_id);
  	    $stmt = $this->my_db->runQuery($sql, $params);
        // print_r($stmt); exit();
  	    $rowCount = $stmt->rowCount();
  	    //print_r($rowCount); exit();
  	    if($rowCount > 0){
  		    $row =  $stmt->fetchAll(PDO::FETCH_OBJ);
  		    //print_r($row); exit();
  		    return json_encode(array_reverse($row));
  	    }else{
  		    return json_encode(array());
  	    }
	}

    public function fetchNewMsgs($s_id, $r_id, $lastMsgId){
        $username = $_SESSION['username'];

        //AND sender = :user_id AND receiver = :r_id OR sender = :r_id AND receiver = :user_id
        $sql = "SELECT * FROM ".self::$table_name." WHERE id > :lstMsgId AND ((sender = :user_id AND receiver = :r_id) OR (sender = :r_id AND receiver = :user_id)) ORDER BY c_date DESC";
        $params = array( ':user_id' => $s_id, ':r_id' => $r_id, 'lstMsgId' => $lastMsgId);
        $stmt = $this->my_db->runQuery($sql, $params);
        // print_r($stmt); exit();
        $rowCount = $stmt->rowCount();
        //print_r($rowCount); exit();
        if($rowCount > 0){
            $row =  $stmt->fetchAll(PDO::FETCH_OBJ);
            //print_r($row); exit();
            return json_encode(array_reverse($row));
        }else{
            return json_encode(array());
        }
    }

	public function createChat($message, $sender, $receiver, $c_read, $c_seen, $c_date){
		$sql = "INSERT INTO ".self::$table_name." (id, message, sender, receiver, c_read, c_seen, c_date) VALUES (?,?,?,?,?,?,?)";
    	$params = array(null, $message, $sender, $receiver, $c_read, $c_seen, $c_date);
    	//print_r($sql); exit;
    	$stmt = $this->my_db->runQuery($sql, $params);
    	$rowCount = $stmt->rowCount();
    	if($rowCount > 0){
    		return true;
    	}else{
    		return false;
    	}
	}
	public function delete_chat($chat_id){

	}

	//Common Database Methods
	public static function find_all() {
		return $this->find_by_sql("SELECT * FROM ".self::$table_name);
    }
    
    public static function find_by_id($id=0) {
  	    //global $database;
  	    $result_array = $this->find_by_sql("SELECT * FROM ".self::$table_name." WHERE id={$id} LIMIT 1");
  	    return !empty($result_array) ? array_shift($result_array) : false;
    }
  
    public function find_by_sql($sql="") {
     	$sql = "SELECT * FROM ".self::$table_name."";
      	$stmt = $this->my_db->runQuery($sql);

      	$rowCount = $stmt->rowCount();
      	if($rowCount > 0){
      		return $stmt->fetchAll(PDO::FETCH_OBJ);
      	}else{
      		return $rowCount;
      	}
    }
}
?>