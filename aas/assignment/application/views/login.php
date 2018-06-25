<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title> Assignment </title>


<script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
	<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" ></script>

	<style type="text/css">
		
		h1{
			font-size: 21px;
			text-align: center;
		}
		.form-horizontal{
			width:400px;
			margin: auto;
			margin-top:5%;
		}

	</style>
</head>
<body>
  
  		<form class="form-horizontal" action="<?php echo base_url();?>index.php/welcome/login_check" method='post'>
  		  <div class="form-group">
		    <div class="col-sm-12">
		      	<h1> Welcome In Login DashBorad </h1>
		    </div>
		  </div>
		  <div class="form-group">
		    <div class="col-sm-offset-2 col-sm-8">
		      <input type="email" class="form-control" name='name' id="email" placeholder="Enter email">
		    </div>
		  </div>
		  <div class="form-group">
		    <div class="col-sm-offset-2 col-sm-8"> 
		      <input type="password" class="form-control" name='paswd' id="pwd" placeholder="Enter password">
		    </div>
		  </div>
		 
		  <div class="form-group"> 
		    <div class="col-sm-12 text-center">
		      <button type="submit" class="btn btn-default">Sign In</button>
		      <button type="button" class="btn btn-default" data-toggle="modal" data-target="#myModal">Sign Up</button>
		    </div>
		  </div>
		</form>


		<!-- Modal html code -->




  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">

        <div class="modal-body">
        	<h4 class="modal-title text-center"> Fill  the form for Register with Us.</h4>
        	<form class="form-horizontal" action="<?php echo base_url();?>index.php/Welcome/signup" enctype="multipart/form-data" method="post">
				 <div class="form-group">
				    <label class="control-label col-sm-5" for="name">Name:</label>
				    <div class="col-sm-7">
				      <input type="text" required class="form-control" id='name' name="name" placeholder="Enter name">
				    </div>
				  </div> 
				  <div class="form-group">
				    <label class="control-label col-sm-5" for="email">Email Id:</label>
				    <div class="col-sm-7">
				      <input type="email" required class="form-control" id='email' name="email_id" placeholder="Enter email id">
				    </div>
				  </div> 
				  <div class="form-group">
				    <label class="control-label col-sm-5" for="paswd">Password:</label>
				    <div class="col-sm-7">
				      <input type="password" required class="form-control" id="paswd" name="paswd" placeholder="Enter password">
				    </div>
				  </div> 
				   <div class="form-group">
				    <label class="control-label col-sm-5" for="cpaswd">Confirm Password:</label>
				    <div class="col-sm-7">
				      <input type="password" class="form-control" required id="cpaswd" name="cpaswd" placeholder="Enter Confirm Password">
				    </div>
				  </div> 
				   <div class="form-group">
				    <label class="control-label col-sm-5"  for="pic">Profile Image:</label>
				    <div class="col-sm-7">
				      <input type="file" required class="form-control" id="pic" name="pic" >
				    </div>
				  </div> 
				   <div class="form-group">
				    <div class="col-sm-12 text-center">
				      <button type="submit" class="btn btn-default" >Submit</button>
				      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

				    </div>
				  </div> 
			</form>
        </div>
      </div>
      
    </div>
  </div>
  








</body>
</html>