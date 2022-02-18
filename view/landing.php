<?php
if(!Session::is_logged_in()){
  Redirect::redirectTo("index.php?page=login");
}else{
?>
  <section class="container">
  	<section class="row">
  		<div class="col-md-2">
  			
  		</div>
  		<div id="main" class="main col-md-8 bg-light px-0 mb-5 shadow-lg rounded">
  			<div class="top_title text-light">
  				<h2 class="w-100 p-3 mb-3 text-center text-uppercase">My Chat App</h2>
  			</div>
        <div id="actioncomment"></div>
  			<div class="chat-room" >
  				<div class="media">
            <div class="media-body">
              <div class="inbox_people">
                <div class="headind_srch">
                  <div class="recent_heading">
                    <div class="d-flex align-self-center">
                    <a href="index.php?page=register">Register</a> &nbsp;|&nbsp;
                    <?php
                        if(!Session::is_logged_in()){
                              echo'<a href="index.php?page=login">Login</a>';
                        }else{
                            echo'<a href="controller/logout.php">Logout</a>';
                        }
                    ?>                    
                    </div>
                  </div>
                </div>
                <div id="inbox_chat" class="inbox_chat">
                  <?php 
                    $user = new User();
                    print($user->return_loggedin_users());
                  ?>
                </div>
                </div>
                <div class="mesgs" id="msgbody" data-cdata="">
                    <div class="msg_history">
                    </div>
                    <div class="type_msg">
                        <form method="post" action="index.php" id="chatform">
                            <div class="input_msg_write">
                                <div id="loggeduser" hidden><?php echo $_SESSION['user_id']; ?></div>
                                <input type="text" id="chat_msg" class="write_msg" placeholder="Type a message" />
                                <button class="msg_send_btn" id="sendbtn" type="submit"><i class="fa fa-paper-plane-o" aria-hidden="true"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
  		</div>
  		</div>
  		<div class="col-md-2">
  		</div>
  	</section>
  <section>
  <?php } ?>
<?php
  // $chat = new Chat();
  // print($chat->fetch_chat());
?>