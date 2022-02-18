<?php
require_once("../core/init.php");

if(session_status() == PHP_SESSION_NONE){
        session_start();
}
     
    if(isset($_SESSION['user_id']) && (strtoupper($_SERVER['REQUEST_METHOD']) === 'POST') && isset($_SERVER['HTTP_X_REQUESTED_WITH']) && isset($_POST['r_id']) && is_numeric($_POST['r_id'])) 
    {
        switch($_POST['r_type']){
        
            case 'get_chat':
            	$chat = new Chat();
            	//print_r($_POST); exit();
            	echo $chat->fetchMsgs($_POST['r_id'], $_POST['perpage'], $_POST['offset']);
                //echo 
            break;
            case 'scroll_chat':
                $chat = new Chat();
                //print_r($_POST); exit();
                echo $chat->fetchMsgs($_POST['r_id'], $_POST['perpage'], $_POST['offset']);
                //echo 
            break;
            case 'get_last_chat':
                $chat = new Chat();
                //print_r($_POST); exit();
                echo $chat->fetchNewMsgs($_POST['sender_id'], $_POST['r_id'], $_POST['lastMsgId']);
                //echo 
            break;
            case 'sendmsg':
                $chat = new Chat();
                $message    = $_POST['msg'];
                $sender     = $_POST['sender'];
                $receiver   = $_POST['r_id'];
                $c_read     = 0;
                $c_seen     = 0;
                $c_date     = date('Y-m-d h:i:s', time());
                if($chat->createChat($message, $sender, $receiver, $c_read, $c_seen, $c_date)){
                    echo '{"success": true}';
                }
            break;
            case '':
                
            break;
        
        }
    }
    else
    {
        echo '{"success":false1}';
    }

?>