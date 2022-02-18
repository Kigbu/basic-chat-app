<?php
require_once('header.php');

$page = !isset($_GET['page']) ? 'landing' : $_GET['page'];
if($page){	
	Template::render($page, 'view');
}

require_once('footer.php');
?>