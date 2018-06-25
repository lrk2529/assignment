
<?php
class M_welcome extends CI_Model {


 public function __constrctor(){
  	   parent::__construct();


  	   // how many article want to show in one page
  	  
  }

 public function signup($data){
 	 $insert = "insert into login values ( '".$data['name']."','".$data['email_id']."','".$data['password']."','".$data['image_name']."')";
 	 $query = $this->db->query($insert);
 }


 public function logincheck($user,$password){
 	$query = $this->db->query("select * from login where email_id ='".$user."' and password = '".$password."'");
 	$res = $query->result_array();

 	if(!$res[0]['email_id']){
 		return false;
 	}
    $this->session->set_userdata($res[0]);
 	return true;
 }


 public function articles($data='default',$start=0){
    $start = $start * $this->total;
 	if($data=='default'){
 		$query = $this->db->query('select count(*) count from articles');
 		$number_of_articles = $query->result_array();
 		$number_of_articles = $number_of_articles[0]['count'];
 		$this->pages = intval(ceil($number_of_articles/$this->total));
 		$query = $this->db->query("select `article_id`,`heading`,`image_link`,`pic_name`,`name` from articles a inner join login l on a.email_id=l.email_id limit $start,$this->total");
 	}else{
 		$query = $this->db->query("select count(*) count from articles where  email_id='".$this->session->userdata('email_id')."'");
 		$number_of_articles = $query->result_array();
 		$number_of_articles = $number_of_articles[0]['count'];
 		$this->pages = intval(ceil($number_of_articles/$this->total));
 		$number_of_articles = $query->result_array();
 		$number_of_articles = $number_of_articles[0]['count'];
 		$this->pages = intval(ceil($number_of_articles/$this->total));
 		$query = $this->db->query("select `article_id`,`heading`,`image_link`,`pic_name`,`name` from articles a inner join login l on a.email_id=l.email_id where a.email_id='".$this->session->userdata('email_id')."' limit $start,$this->total");	
 	}
 	$data=[];
 	$data['all'] = $query->result_array();
 	$data['pages'] =$this->pages;
 	return $data;
 }
  
 public function write_articles($email_id,$head,$type){
 	$query = $this->db->query('select max(article_id) max from articles ');
 	$article_id = $query->result_array();
 	$article_id = $article_id[0]['max']+1;
 	$image_name = $article_id.".".$type;
 	$insert = 'insert into articles values ('.$article_id.',"'.$email_id.'","'.$head.'","'.$image_name.'")';
 	$this->db->query($insert);
 	return $image_name;
 }

 public function like_update($article_id,$data,$cmd){
 	  if($cmd=='ins'){
 	  	$insert = 'insert into like_info values ("'.$article_id.'","'.$this->session->userdata('email_id').'","'.$data.'")';
 	  }else{
 	  	$insert = 'update  like_info set type = "'.$data.'" where  email_id = "'.$this->session->userdata('email_id').'"  and  article_id = "'.$article_id.'"';
 	  }
 	  //echo $insert;
 	  $this->db->query($insert);
 }
 
public function read($article_id){
	//$sql = "SELECT type,(select sum(`article_id`) from like_info where article_id=`article_id`) total,(select heading from articles where article_id=$article_id) headline,(select image_link from articles where article_id=$article_id ) pic_name FROM `like_info` WHERE `article_id`=$article_id and `email_id`='".$this->session->userdata("email_id")."'";
	
	$sql ="SELECT type FROM `like_info` WHERE `article_id`=$article_id and `email_id`='".$this->session->userdata("email_id")."'";
	$query = $this->db->query($sql);
	$data=[];
	if($query->num_rows()==0){
		$data['type']=0;
	}else{
	    $tmp = $query->result_array();
	    $data['type']= $tmp[0]['type'];
	}

	$sql ="select sum(type) total from like_info where article_id=$article_id";
	$query = $this->db->query($sql);
	$tmp = $query->result_array();
	$data['total']= $tmp[0]['total'];
	if($data['total']==Null)
		$data['total']=0;

	$sql ="select heading,image_link  from  articles where article_id=$article_id";
	$query = $this->db->query($sql);
	    $tmp = $query->result_array();
	    $data['heading']= $tmp[0]['heading'];
	    $data['image_link']= $tmp[0]['image_link'];
	return $data;
}

public function comment($com,$article_id){
	$insert = 'insert into comment values ("'.$article_id.'","'.$this->session->userdata('email_id').'","'.$com.'")';
	$this->db->query($insert);

}



 public function show_articles($num){

 }




}




?>