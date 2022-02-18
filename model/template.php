<?php
/**
* 
*/
class Template
{
	public static function render($get, $folder=null){
		//echo 'We got here';
		if(file_exists($folder."/".$get.".php")){
			include($folder."/".$get.".php");
		}
	}
	
}

?>