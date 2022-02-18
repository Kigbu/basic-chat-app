<?php
if(Session::is_logged_in()){
  Redirect::redirectTo("index.php");
}else{
?>  
  <section class="container-fluid">
  	<section class="row">
  		<div class="col-md-3">
  			
  		</div>
  		<div id="main" class="col-md-6 bg-light px-0 mb-5 shadow-lg rounded">
  			<div class="bg-secondary  text-light">
  				<h2 class="w-100 p-3 mb-3 text-center text-uppercase">My Chat App</h2>
  			</div>
  			<div class="chat-room px-5">
          <?php
          if(isset($_SESSION['error'])){  
            print '<div class="alert alert-danger" role="alert">
                    '. $_SESSION['error'] .'
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>';
                  unset($_SESSION['error']);
          }
          if(isset($_SESSION['success'])){  
            print '<div class="alert alert-success" role="alert">
                    '. $_SESSION['success'] .'
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>';
                  unset($_SESSION['success']);
          }
        ?>
  				<form class="" action="controller/login.php" method="post">
            <div class="form-row p-5">
              <div class="form-group form-group-lg col-12">
                <input type="text" placeholder="Username" id="username" name="username" class="form-control">
              </div>
              <div class="form-group form-group-lg col-12">
                <input type="password" placeholder="Password" id="password" name="password" class="form-control">
              </div>
              <div class="form-group form-group-lg col-12">
                <input type="submit" value="Login" id="login" class="btn btn-primary btn-block">
              </div>
            </div>
              
          </form>
  			</div>
  			<div class="card">
			  	<div class="card-body m-0 p-0">
			  	</div>
			  	<div class="card-footer text-muted">
			    	<div>
			    		<div class="d-flex">
			    			<div class="mr-auto p-2">
                  <a href="index.php">Chat</a>      
                </div>
			    			<div class="d-flex align-self-center">
			    				<a href="index.php?page=register">Register</a>
			    			</div>
			    		</div>
			    	</div>
			  	</div>
			</div>
  		</div>
  		<div class="col-md-3">
  			
  		</div>
  	</section>
  <section>
    <?php }?>