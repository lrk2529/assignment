<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Assignment</title>

	<script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
	<!-- Latest compiled and minified CSS -->

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >
<link rel="stylesheet" type="text/css" href="https://bootstrap-wysiwyg.github.io/bootstrap3-wysiwyg/dist/bootstrap3-wysihtml5.min.css">
<link rel="stylesheet" type="text/css" href="https://bootstrap-wysiwyg.github.io/bootstrap3-wysiwyg/components/components-font-awesome/css/font-awesome.min.css">
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" ></script>
<script type="text/javascript" src="https://bootstrap-wysiwyg.github.io/bootstrap3-wysiwyg/components/wysihtml5x/dist/wysihtml5x-toolbar.min.js"></script>

<script type="text/javascript" src="https://bootstrap-wysiwyg.github.io/bootstrap3-wysiwyg/components/handlebars/handlebars.runtime.min.js"></script>
<script type="text/javascript" src="https://bootstrap-wysiwyg.github.io/bootstrap3-wysiwyg/dist/bootstrap3-wysihtml5.min.js"></script>
	<style type="text/css">


		input[type='text']{
        font-size: 21px;
    }

	</style>

</head>
<body>


<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="<?php echo base_url();?>index.php/welcome/home">Assignment Work </a>
    </div>
    <ul class="nav navbar-nav">
      <li ><a href="<?php echo base_url();?>index.php/welcome/home">All Articles</a></li>
      <li class="active" ><a href="<?php echo base_url();?>index.php/welcome/write">Write Article</a></li>
      <li><a href="<?php echo base_url();?>index.php/welcome/own">Own Articles</a></li>
      <li><a href="#">Likes Articles</a></li>
    </ul>
     <ul class="nav navbar-nav navbar-right">
        <li class="pull-" ><a href="<?php echo base_url();?>index.php/welcome/logout">Logout</a></li>
     </ul>
  </div>
</nav>


<div class="container">





  

  	 	<h2 class="text-center"> Write Article </h2>

  <hr>
  <div class="row" id="content">
      <form class="form-horizontal" action="<?php echo base_url();?>index.php/welcome/write_insert" enctype="multipart/form-data" method='post' >
        <div class="form-group">
          <label class="control-label col-sm-2" for="head">HeadLine</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" required id="head" name="headline" placeholder="Enter HeadLine of Article">
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-sm-2" for="pwd">Cover Image :</label>
          <div class="col-sm-10"> 
            <input type="file" class="form-control" required id="pic" name='pic' >
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-sm-2" for="pwd"> Content :</label>
          <div class="col-sm-10"> 
              <textarea class="textarea" required name='content' placeholder="Enter text ..." style="width: 100%; height: 200px; font-size: 14px; line-height: 18px;"></textarea>
          </div>
        </div>
        <div class="form-group"> 
          <div class="col-sm-offset-2 col-sm-10 text-center">
            <button type="submit" class="btn btn-default">Submit</button>
          </div>
        </div>
      </form>



        


 </div>




</div>
  
  <script>
  $('.textarea').wysihtml5({
    toolbar: {
      fa: true
    }
  });
</script>


</body>
</html>