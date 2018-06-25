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
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" ></script>
<script type="text/javascript" src="http://botmonster.com/jquery-bootpag/jquery.bootpag.js"></script>

	<style type="text/css">

		h4{
			    white-space: nowrap; 

		    overflow: hidden;
    text-overflow: ellipsis; 
		 			 -webkit-hyphens: auto;
  -ms-hyphens: auto;
  hyphens: auto;
  line-height: 26px;    
     max-height: 40px;      /* fallback */

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
      <li><a href="<?php echo base_url();?>index.php/welcome/write">Write Article</a></li>
      <li  class="active" ><a href="<?php echo base_url();?>index.php/welcome/own">Own Articles</a></li>
      <li><a href="#">Likes Articles</a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
        <li class="pull-" ><a href="<?php echo base_url();?>index.php/welcome/logout">Logout</a></li>
     </ul>
  </div>
</nav>


<div class="container">





  
  <div class="row">
  	 <div class='col-sm-6 col-md-6 col-lg-6'>
  	 	<h2> All ARTICLES </h2>
  	 </div>
  	 <div class='col-sm-6 col-md-6 col-lg-6'>
  	 	<h3 class="pull-right"> Sort By  &nbsp; &nbsp; 
  	 		<select class='select' >
  	 			<option value='nothing'> Select </option>
          <option value='name'> Author Name </option>
          <option value='heading'> Heading </option>
          <option value='less-popular'> LESS POPULAR </option>
          <option value='most-popular'> MOST POPULAR </option>
  	 		</select>
  	 	</h3>
  	 </div>
  </div>
  <br>
  <div class="row" id="content">



  	  <?php

        foreach ($all as $key => $value) {
        	echo '<div class="col-md-3">';	
        	echo '<div class="thumbnail">';
        	echo  '<img src="/assignment/upload/article/'.$value["image_link"].'" alt="Lights" style="width:100%;height:180px !important;">';
        	echo  '<div class="caption">';
        	echo  '<h4> '.$value["heading"].' </h4>';
          echo  '<span> <a href="'.base_url().'index.php/welcome/read/'.$value["article_id"].'"> Read On </a> </span>';
        	echo '<span class="pull-right"> By '.$value["name"].'
               <img class="img-circle" style="width:30px;height:30px;" src="/assignment/upload/profile/'.$value["pic_name"].'" alt="Lights" >
           		</span>';
           	echo ' </div> </div> </div>';
        }

  ?>

</div>

 <div class="row text-center" >
		<p id="pagination-here"></p>
 </div>


</div>
		

	<script type="text/javascript">
      var base_url = '<?php echo base_url(); ?>';
			var currentPageJson = JSON.parse('<?php echo json_encode($all); ?>');

			$('#pagination-here').bootpag({
			    total: <?php echo $pages>1 ? $pages : 0;?>,               // total pages
			    page: 1,            // default page
			    maxVisible: 10,     // visible pagination
			    leaps: true         // next/prev leaps through maxVisible
			}).on("page", function(event, num){

			      $.post('<?php echo base_url();?>index.php/welcome/ajaxCall/session/'+num,{},function(data){
            currentPageJson = JSON.parse(data);
             var enter ='';
             for (var i = 0;i < currentPageJson.length ; i++) {
                    var htmlcreate = '  <div class="col-md-3">\
                      <div class="thumbnail">\
                          <img src="/assignment/upload/article/'+  currentPageJson[i]["image_link"] +'" alt="Lights" style="width:100%;height:180px !important;">\
                          <div class="caption">\
                              <h4> '+ currentPageJson[i]["heading"] +' </h4>\
                             <span> <a href="'+base_url+'index.php/welcome/read/'+currentPageJson[i]["article_id"] +'" > Read On </a> </span>\
                               <span class="pull-right"> By '+ currentPageJson[i]["name"] +' \
                               <img class=" img-circle" style="width:30px;height:30px;" src="/assignment/upload/profile/'+  currentPageJson[i]["pic_name"] +'" alt="Lights" >\
                              </span>\
                          </div>\
                      </div>\
                    </div>';
                            enter+=htmlcreate;
                    }
                            
                 $("#content").html(enter);
         });
			});
			
       function sortby(e){
         // console.log(e.value);
          // console.log(currentPageJson);
          
          if(e.value=='name'){
            currentPageJson.sort(function(a,b){
                return a['name'] > b['name'];
             });
          }else if(e.value=='heading'){
            currentPageJson.sort(function(a,b){
                return a['heading'] > b['heading'];
             });
          }else if(e.value=='less-popular'){
             console.log('I have to do but need some basic facts for calculations and showing the data');
          }else if(e.value=='most-popular'){
             console.log('I have to do but need some basic facts for calculations and showing the data');
          }else{
              console.log('nothing to have to do');
          }


           var enter ='';
             for (var i = 0;i < currentPageJson.length ; i++) {
                    var htmlcreate = '  <div class="col-md-3">\
                      <div class="thumbnail">\
                          <img src="/assignment/upload/article/'+  currentPageJson[i]["image_link"] +'" alt="Lights" style="width:100%;height:180px !important;">\
                          <div class="caption">\
                              <h4> '+ currentPageJson[i]["heading"] +' </h4>\
                        <span> <a href="'+base_url+'index.php/welcome/read/'+currentPageJson[i]["article_id"] +'" > Read On </a> </span>\
                               <span class="pull-right"> By '+ currentPageJson[i]["name"] +' \
                               <img class=" img-circle" style="width:30px;height:30px;" src="/assignment/upload/profile/'+  currentPageJson[i]["pic_name"] +'" alt="Lights" >\
                              </span>\
                          </div>\
                      </div>\
                    </div>';
                            enter+=htmlcreate;
                    }
           $("#content").html(enter);
      }




	</script>

</body>
</html>