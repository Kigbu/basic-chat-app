<?php

	class Database{
		private $host = "localhost";
		private $user = "root";
		private $pass = "";
		private $dbname = "chat_app";

		public $isconnected;
		protected $db;
		private static  $getInstance = null;

		//connect to db
		public function __construct(){

			//Set the DSN
			$dsn = 'mysql:host='.$this->host.';dbname='.$this->dbname.';charset=utf8';
			//Set Options
			$options = array(
				PDO::ATTR_PERSISTENT 	=>true,
				PDO::ATTR_ERRMODE		=>PDO::ERRMODE_EXCEPTION
			);
			$this->isconnected = true;
			try {
				$this->db = new PDO($dsn, $this->user, $this->pass, $options);
				//$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				//$this->db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC); 
			} catch (PDOException $e) {
				throw new Exception($e->getMessage());
			}
		}

		public static function getInstance(){
			return self::$getInstance = new self;
		}


		//disconnect from db
		public function Disconnect(){
			$this->db = null;
			$this->isconnected = false;
		}
		/*
		*Insert, Create, and Delete Query
		*@PARAM string $sql SQL statement
		*@PARAM array $params Array values
		*@RETURN object $stmt returns  a statement pdo object
		*/
		public function runQuery($sql, $params = null) {
	        $pdo = $this->db;

	        if(is_null($params)){
	        	$stmt = $pdo->query($sql);
	        }else{
	        	try {
	        		$stmt = $pdo->prepare($sql);

	        		if($stmt){
	        			$stmt->execute($params);
	        		}else{
	        			print_r("Unable to prepare Statement");
	        		}
	        	} catch (PDOException $e) {
	        		throw new Exception($e->getMessage());
	        	}
	        }
	        return $stmt;
	    }

	    protected function updateQuery($table, $pkfield, $fields, $data){
	    	$pdo = $this->db;
	    	$data_params = array();

	    	$update = "";
	    	foreach ($fields as $f) {
	    		# code...
	    		if(!isset($data[$f]) || is_null($data[$f])){
	    			$v = 'NULL';
	    		}else{
	    			$v = ":$f";
	    			$data_params[$f] = $data[$f];
	    		}
	    		$update .= ",".$f."=".$v;
	    	}
	    	$update = substr($up, 2);
	    	if(empty($data[$pkfield])){
	    		$sql = "INSERT INTO ". $table ." SET ". $update;
	    	}else{
	    		$data_params[$pkfield] = $data[$pkfield];
	    		$sql = "UPDATE ". $table ." SET ". $update ." WHERE ". $pkfield ."=:". $pkfield;
	    	}
	    	$stmt = $this->runQuery($sql, $data_params);
	    	return $stmt->rowCount();
	    }

	    public function update($table, $data, $cond){
	    	$pdo = $this->db;
	    	$keys = '';
	    	foreach ($data as $key => $value) {
	    		# code...
	    		$keys .= "$key=:$key,";
	    	}
	    	$keys = rtrim($keys, ",");

	    	$sql = "UPDATE $table SET $keys WHERE $cond";
	    	$stmt = $pdo->prepare($sql);
	    	foreach ($data as $key => $value) {
	    		# code...
	    		$stmt->bindValue(":$key", $value);
	    	}
	    	return $stmt->execute();
	    }		
	}		
?>