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
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" ></script>

<style type="text/css">
  
  #content {
    position: relative;
    text-align: center;
    color: white;
}

.centered {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
}


.bottom_data{
    position: absolute;
    bottom: 8px;
    left: 16px;
}
.c{
   margin-top: 10px;
   background-color: lightgray;
   padding: 5px;
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
    <div class="row" id="content">
        <img src="<?php echo base_url().'upload/article/'.$image_link;?>" alt="Snow" style="width:100%;height: 380px;">
        <div class="centered"> <?php echo $heading; ?> </div>
        <span class='bottom_data'> <i class="fa fa-thumbs-up" uknow="<?php echo $type?'upd':'ins';?> " style="font-size:32px;color:<?php echo $type?'blue':'lightgray';?>; cursor: pointer;" onclick="like(this)"> </i> <span id="num"><?php echo $total; ?> </span> </span>
    </div>  
    <div class='row'>
        <hr>
          <div class="form-group">
            <label for="comt" style="font-size: 20px;color: gray">Comment:</label>
            <textarea  class="form-control" rows="2" cols="50" placeholder="Please give me some comment about article ..."  name="comment" id='comt' >  </textarea> 
          </div>
          <button type="button" class="btn btn-default" onclick='comment()'> Comment </button>
    </div>
    <div class="row" id="comment_collection">
        <div class='c' >
            <h5>Write comment The .img-circle class shapes the image to a circle (not available in IE8) The .img-circle class shapes the image to a circle (not available in IE8) The .img-circle class shapes the image to a circle (not available in IE8) The .img-circle class shapes the image to a circle (not available in IE8)</h5>
            <span class='pull-right'> By Raman kumar  <img src="cinqueterre.jpg" class="img-circle" alt="Cinque Terre" width="30" height="30"> </span>
            <br>
        </div>
    </div>
</div>
 <script type="text/javascript">
    var article_id="<?php echo $article_id; ?>";
    function like(th){
     if($(th).css('color')=='rgb(211, 211, 211)'){
         $(th).css('color','rgb(0,0,255)');
         cmd = $(th).attr('uknow');
         $.post('<?php echo base_url(); ?>index.php/welcome/like_update/1/'+article_id+"/"+cmd,{},function(data){
            if(cmd=='ins'){
              $(th).attr('uknow','upd');
            }
            $("#num").text(parseInt($("#num").text())+1);

            console.log(data);
         });
      }else{
         $(th).css('color','rgb(211, 211, 211)');
         $.post('<?php echo base_url() ?>index.php/welcome/like_update/0/'+article_id+'/upd',{},function(data){
            console.log(data);
            $("#num").text(parseInt($("#num").text())-1);
         });
      } 
       
    }

   function comment(){
      var comt = $("#comt").val();
      $.post('<?php echo base_url();?>index.php/welcome/comment/'+article_id,{'comment':comt},function(data){
        
          $("#comment_collection").prepend('<h1>'+comt+'</h1>');
      });
   }


 </script> 


</body>
</html>