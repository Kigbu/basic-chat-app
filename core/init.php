<?php 
session_start();
error_reporting(E_ALL);
	//echo 'Hello';
require_once('config.php');
include_once('constants.php');

//echo LIB_PATH;
spl_autoload_register(function($class){
	if(is_file(LIB_PATH.DS.strtolower($class).'.php')){
		require_once(LIB_PATH.DS.strtolower($class).'.php');
	}
});
?>