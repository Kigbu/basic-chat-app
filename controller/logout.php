<?php
require_once("../core/init.php");
if(Session::is_logged_in()){
	Session::logout();
	Redirect::redirectTo("../index.php?page=login");
}
?>