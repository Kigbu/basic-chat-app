<?php
class Redirect{
	public static function redirectTo($to){
		header("location: $to");
	}
}

?>